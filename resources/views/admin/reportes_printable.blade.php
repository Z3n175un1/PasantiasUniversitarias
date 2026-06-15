<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ ucfirst($tipo) }} - Reporte UWorkFlow</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 12px; color: #1e293b; padding: 30px; }
        h1 { font-size: 20px; margin-bottom: 5px; }
        .subtitle { color: #64748b; font-size: 13px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #1e293b; color: white; padding: 8px 10px; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; }
        tr:nth-child(even) { background: #f8fafc; }
        .footer { margin-top: 25px; font-size: 11px; color: #94a3b8; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 15px; }
        @media print {
            body { padding: 15px; }
            .no-print { display: none; }
            @page { margin: 15mm; }
        }
    </style>
</head>
<body>
    <h1>Reporte de {{ ucfirst($tipo) }}</h1>
    <p class="subtitle">Generado el {{ now()->format('d/m/Y H:i') }} &mdash; {{ count($rows) }} registros</p>
    <table>
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" style="text-align:center;padding:30px;color:#94a3b8;">No hay datos disponibles</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">
        UWorkFlow &mdash; Sistema de Gestión de Pasantías Universitarias
    </div>
    <script>
        window.print();
    </script>
</body>
</html>