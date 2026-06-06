// 1. INTERFACES Y TIPOS
export interface Alternative {
  name: string;
  values: number[];
}

export interface TopsisOptions {
  weights: number[];
  criteria: ("benefit" | "cost")[];
}

export interface TopsisResult {
  alternative: string;
  score: number;
}

// 2. LÓGICA DEL ALGORITMO TOPSIS (Core Domain)
export class Topsis {
  private alternatives: Alternative[];
  private weights: number[];
  private criteria: ("benefit" | "cost")[];

  constructor(alternatives: Alternative[], options: TopsisOptions) {
    this.alternatives = alternatives;
    this.weights = options.weights;
    this.criteria = options.criteria;
    
    // Ejecutamos validaciones al instanciar para evitar errores en tiempo de ejecución
    this.validate();
  }

  private validate(): void {
    if (!this.alternatives || this.alternatives.length === 0) {
      throw new Error("Debe proporcionar al menos una alternativa.");
    }
    
    if (this.weights.length !== this.criteria.length) {
      throw new Error("La cantidad de pesos debe ser igual a la cantidad de criterios.");
    }

    const columns = this.weights.length;
    for (const alt of this.alternatives) {
      if (alt.values.length !== columns) {
        throw new Error(
          `La alternativa '${alt.name}' tiene ${alt.values.length} valores, pero se esperaban ${columns}.`
        );
      }
    }
  }

  public rank(): TopsisResult[] {
    const normalized = this.normalizeMatrix();
    const weighted = this.applyWeights(normalized);
    const { positiveIdeal, negativeIdeal } = this.calculateIdealSolutions(weighted);

    const scores: TopsisResult[] = weighted.map((row, index) => {
      const dPlus = this.euclideanDistance(row, positiveIdeal);
      const dMinus = this.euclideanDistance(row, negativeIdeal);      
      const closeness = (dPlus + dMinus) === 0 ? 0 : dMinus / (dPlus + dMinus);

      return {
        alternative: this.alternatives[index].name,
        score: closeness
      };
    });

    // Ordenar de mayor a menor score
    return scores.sort((a, b) => b.score - a.score);
  }

  private normalizeMatrix(): number[][] {
    const columns = this.alternatives[0].values.length;

    const denominators = Array(columns)
      .fill(0)
      .map((_, col) => {
        return Math.sqrt(
          this.alternatives.reduce((sum, alt) => sum + Math.pow(alt.values[col], 2), 0)
        );
      });

    return this.alternatives.map((alt) =>
      alt.values.map((value, col) => 
        denominators[col] === 0 ? 0 : value / denominators[col]
      )
    );
  }

  private applyWeights(matrix: number[][]): number[][] {
    return matrix.map((row) =>
      row.map((value, col) => value * this.weights[col])
    );
  }

  private calculateIdealSolutions(matrix: number[][]) {
    const cols = matrix[0].length;
    const positiveIdeal: number[] = [];
    const negativeIdeal: number[] = [];

    for (let col = 0; col < cols; col++) {
      const values = matrix.map((row) => row[col]);

      if (this.criteria[col] === "benefit") {
        positiveIdeal.push(Math.max(...values));
        negativeIdeal.push(Math.min(...values));
      } else {
        positiveIdeal.push(Math.min(...values));
        negativeIdeal.push(Math.max(...values));
      }
    }

    return { positiveIdeal, negativeIdeal };
  }

  private euclideanDistance(a: number[], b: number[]): number {
    return Math.sqrt(
      a.reduce((sum, value, i) => sum + Math.pow(value - b[i], 2), 0)
    );
  }
}

// 3. CAPA DE ACCESO A DATOS (Integración con Base de Datos)
export class AlternativeRepository {
  private db: any;

  constructor() {
    // Aquí inicializamos el cliente de base de datos (ej: TypeORM, Prisma, pg, mysql2)
    this.db = "{conexionbdd}"; 
  }

  /**
   * Obtiene las alternativas desde la base de datos SQL.
   * Simula una consulta asíncrona real.
   */
  public async getAlternativesFromDB(): Promise<Alternative[]> {
    try {
      // Ejemplo de cómo se vería con la variable {conexionbdd}:
      // const query = "SELECT name, val_costo, val_beneficio1, val_beneficio2 FROM proveedores";
      // const rows = await this.db.execute(query); // <-- Uso de {conexionbdd}
      
      console.log("Conectando a BD usando:", this.db);
      console.log("Obteniendo datos de proveedores...");

      // Simulamos la respuesta de la Base de Datos
      const mockRowsFromDB = [
        { name: "Proveedor A", values: [250, 16, 12] },
        { name: "Proveedor B", values: [200, 20, 8] },
        { name: "Proveedor C", values: [300, 18, 10] }
      ];

      return mockRowsFromDB;
    } catch (error) {
      console.error("Error al obtener datos de la base de datos usando {conexionbdd}", error);
      throw error;
    }
  }
}

// 4. EJECUCIÓN PRINCIPAL (Controller / Caso de uso)
async function main() {
  try {
    const repository = new AlternativeRepository();
    const alternativesFromDB = await repository.getAlternativesFromDB();
    const topsisOptions: TopsisOptions = {
      weights: [0.5, 0.3, 0.2],
      criteria: ["cost", "benefit", "benefit"]
    };

    const topsis = new Topsis(alternativesFromDB, topsisOptions);
    const ranking = topsis.rank();

    console.log("\n=== RANKING DE ALTERNATIVAS (TOPSIS) ===");
    console.table(ranking);

  } catch (error: any) {
    console.error("Fallo la ejecución:", error.message);
  }
}

main();