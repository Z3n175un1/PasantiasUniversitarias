interface Alternative {
  name: string;
  values: number[];
}

interface TopsisOptions {
  weights: number[];
  criteria: ("benefit" | "cost")[];
}

class Topsis {
  private alternatives: Alternative[];
  private weights: number[];
  private criteria: ("benefit" | "cost")[];

  constructor(
    alternatives: Alternative[],
    options: TopsisOptions
  ) {
    this.alternatives = alternatives;
    this.weights = options.weights;
    this.criteria = options.criteria;
  }

  public rank() {
    const normalized = this.normalizeMatrix();
    const weighted = this.applyWeights(normalized);

    const { positiveIdeal, negativeIdeal } =
      this.calculateIdealSolutions(weighted);

    const scores = weighted.map((row, index) => {
      const dPlus = this.euclideanDistance(
        row,
        positiveIdeal
      );

      const dMinus = this.euclideanDistance(
        row,
        negativeIdeal
      );

      const closeness = dMinus / (dPlus + dMinus);

      return {
        alternative: this.alternatives[index].name,
        score: closeness
      };
    });

    return scores.sort(
      (a, b) => b.score - a.score
    );
  }

  private normalizeMatrix(): number[][] {
    const columns = this.alternatives[0].values.length;

    const denominators = Array(columns)
      .fill(0)
      .map((_, col) => {
        return Math.sqrt(
          this.alternatives.reduce(
            (sum, alt) =>
              sum + Math.pow(alt.values[col], 2),
            0
          )
        );
      });

    return this.alternatives.map((alt) =>
      alt.values.map(
        (value, col) =>
          value / denominators[col]
      )
    );
  }

  private applyWeights(
    matrix: number[][]
  ): number[][] {
    return matrix.map((row) =>
      row.map(
        (value, col) =>
          value * this.weights[col]
      )
    );
  }

  private calculateIdealSolutions(
    matrix: number[][]
  ) {
    const cols = matrix[0].length;

    const positiveIdeal: number[] = [];
    const negativeIdeal: number[] = [];

    for (let col = 0; col < cols; col++) {
      const values = matrix.map(
        (row) => row[col]
      );

      if (this.criteria[col] === "benefit") {
        positiveIdeal.push(Math.max(...values));
        negativeIdeal.push(Math.min(...values));
      } else {
        positiveIdeal.push(Math.min(...values));
        negativeIdeal.push(Math.max(...values));
      }
    }

    return {
      positiveIdeal,
      negativeIdeal
    };
  }

  private euclideanDistance(
    a: number[],
    b: number[]
  ): number {
    return Math.sqrt(
      a.reduce(
        (sum, value, i) =>
          sum + Math.pow(value - b[i], 2),
        0
      )
    );
  }
}

// Primer ejemplo de uso luego poner e implementar la libreria de sql o de base de datos usando laravel
const alternatives = [
  {
    name: "Proveedor A",
    values: [250, 16, 12]
  },
  {
    name: "Proveedor B",
    values: [200, 20, 8]
  },
  {
    name: "Proveedor C",
    values: [300, 18, 10]
  }
];

const topsis = new Topsis(
  alternatives,
  {
    weights: [0.5, 0.3, 0.2],
    criteria: [
      "cost",
      "benefit",
      "benefit"
    ]
  }
);

console.log(topsis.rank());