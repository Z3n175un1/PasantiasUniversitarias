<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora TOPSIS</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .row { margin-bottom: 10px; }
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Evaluar Proveedores (TOPSIS)</h2>

    <form action="{{ route('topsis.calculate') }}" method="POST">
        @csrf

        <div class="row">
            <input type="text" name="alternatives[0][name]" value="Proveedor A" required>
            <input type="number" step="0.01" name="alternatives[0][values][]" placeholder="Costo" required>
            <input type="number" step="0.01" name="alternatives[0][values][]" placeholder="Beneficio 1" required>
            <input type="number" step="0.01" name="alternatives[0][values][]" placeholder="Beneficio 2" required>
        </div>

        <div class="row">
            <input type="text" name="alternatives[1][name]" value="Proveedor B" required>
            <input type="number" step="0.01" name="alternatives[1][values][]" placeholder="Costo" required>
            <input type="number" step="0.01" name="alternatives[1][values][]" placeholder="Beneficio 1" required>
            <input type="number" step="0.01" name="alternatives[1][values][]" placeholder="Beneficio 2" required>
        </div>

        <div class="row">
            <input type="text" name="alternatives[2][name]" value="Proveedor C" required>
            <input type="number" step="0.01" name="alternatives[2][values][]" placeholder="Costo" required>
            <input type="number" step="0.01" name="alternatives[2][values][]" placeholder="Beneficio 1" required>
            <input type="number" step="0.01" name="alternatives[2][values][]" placeholder="Beneficio 2" required>
        </div>

        <button type="submit">Calcular Ranking</button>
    </form>

    @if(isset($ranking))
        <h3>Resultados del Ranking</h3>
        <table>
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Alternativa</th>
                    <th>Puntaje (Proximidad)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result['alternative'] }}</td>
                    <td>{{ $result['score'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>