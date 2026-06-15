<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citatorio - {{ $postulacion->ofertaPasantia->titulo }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { font-size: 22px; margin: 0; text-transform: uppercase; }
        .header h2 { font-size: 16px; margin: 5px 0; }
        .header p { font-size: 12px; margin: 2px 0; color: #555; }
        .titulo { text-align: center; font-size: 18px; font-weight: bold; text-transform: uppercase; margin: 30px 0; text-decoration: underline; }
        .contenido { line-height: 2; font-size: 14px; text-align: justify; }
        .contenido p { margin: 15px 0; }
        .firma { margin-top: 60px; text-align: center; }
        .firma .linea { border-top: 1px solid #000; width: 300px; margin: 0 auto; padding-top: 10px; font-size: 13px; }
        .datos { margin: 20px 0; }
        .datos table { width: 100%; }
        .datos td { padding: 5px 10px; font-size: 14px; }
        .datos .label { font-weight: bold; width: 150px; }
        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
        }
        .no-print { text-align: center; margin-bottom: 20px; }
        .no-print button { padding: 10px 30px; font-size: 16px; cursor: pointer; background: #1a56db; color: #fff; border: none; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Imprimir Citatorio</button>
    </div>

    <div class="container">
        <div class="header">
            <h1>UNIVERSIDAD - CONVENIO DE PASANTÍAS</h1>
            <h2>SISTEMA DE GESTIÓN DE PASANTÍAS UNIVERSITARIAS</h2>
            <p>UWorkFlow</p>
        </div>

        <div class="titulo">C I T A T O R I O</div>

        <div class="contenido">
            <p>Señor(es): <strong>{{ trim(($postulacion->perfilEstudiante->usuario->nombre ?? '') . ' ' . ($postulacion->perfilEstudiante->usuario->ap_paterno ?? '') . ' ' . ($postulacion->perfilEstudiante->usuario->ap_materno ?? '')) }}</strong></p>
            <p>Estudiante de: <strong>{{ $postulacion->perfilEstudiante->carrera ?? 'N/A' }}</strong> - {{ $postulacion->perfilEstudiante->universidad ?? 'N/A' }}</p>

            <p>Por medio del presente, la empresa <strong>{{ $empresa->nombre_empresa ?? $postulacion->ofertaPasantia->perfilEmpresa->nombre_empresa }}</strong>, 
            en el marco del convenio de pasantías, tiene a bien <strong>CITAR</strong> al estudiante antes mencionado 
            para dar inicio a las actividades correspondientes a la pasantía en el cargo de 
            <strong>{{ $postulacion->ofertaPasantia->titulo }}</strong>.</p>

            <div class="datos">
                <table>
                    <tr><td class="label">Empresa:</td><td>{{ $empresa->nombre_empresa ?? $postulacion->ofertaPasantia->perfilEmpresa->nombre_empresa }}</td></tr>
                    <tr><td class="label">Cargo:</td><td>{{ $postulacion->ofertaPasantia->titulo }}</td></tr>
                    <tr><td class="label">Ubicación:</td><td>{{ $postulacion->ofertaPasantia->ubicacion->ciudad ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Fecha de Inicio:</td><td>{{ $postulacion->ofertaPasantia->fecha_inicio ? \Carbon\Carbon::parse($postulacion->ofertaPasantia->fecha_inicio)->format('d/m/Y') : 'N/A' }}</td></tr>
                    <tr><td class="label">Fecha de Finalización:</td><td>{{ $postulacion->ofertaPasantia->fecha_fin ? \Carbon\Carbon::parse($postulacion->ofertaPasantia->fecha_fin)->format('d/m/Y') : 'N/A' }}</td></tr>
                </table>
            </div>

            <p>El estudiante deberá presentarse en las instalaciones de la empresa en la fecha y hora indicada, 
            portando su documentación personal y el presente citatorio.</p>

            <p>Se extiende el presente citatorio para los fines consiguientes.</p>
        </div>

        <div class="firma">
            <p style="margin-bottom: 5px;">{{ now()->format('d \d\e F \d\e Y') }}</p>
            <br><br>
            <div class="linea">
                <strong>{{ $empresa->nombre_empresa ?? $postulacion->ofertaPasantia->perfilEmpresa->nombre_empresa }}</strong><br>
                Responsable de Talento Humano<br>
                {{ $empresa->usuario->correo ?? '' }}
            </div>
        </div>
    </div>
</body>
</html>
