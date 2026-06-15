@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Reportes Dinámicos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-file-alt mr-2"></i>Reportes Dinámicos
        </h1>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-sliders-h mr-2"></i>Filtros
            </h3>
            <div class="card-tools">
                <button class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reportes') }}" class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo de Reporte</label>
                        <select name="tipo" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="usuarios" {{ $tipo == 'usuarios' ? 'selected' : '' }}>Usuarios</option>
                            <option value="ofertas" {{ $tipo == 'ofertas' ? 'selected' : '' }}>Ofertas</option>
                            <option value="postulaciones" {{ $tipo == 'postulaciones' ? 'selected' : '' }}>Postulaciones</option>
                            <option value="logs" {{ $tipo == 'logs' ? 'selected' : '' }}>Actividad (Logs)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha Desde</label>
                        <input type="date" name="fecha_desde" class="form-control form-control-sm" value="{{ $fecha_desde }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha Hasta</label>
                        <input type="date" name="fecha_hasta" class="form-control form-control-sm" value="{{ $fecha_hasta }}">
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-group w-100">
                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-search mr-1"></i>Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-list mr-2"></i>{{ $data['titulo'] }}
            </h3>
            <div class="card-tools">
                <span class="badge badge-primary">{{ $data['items']->count() }} registros</span>
                <div class="btn-group ml-2">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download mr-1"></i>Exportar
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('admin.reportes.exportar', 'csv') }}?tipo={{ $tipo }}&fecha_desde={{ $fecha_desde }}&fecha_hasta={{ $fecha_hasta }}">
                            <i class="fas fa-file-csv mr-2 text-success"></i>CSV
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.reportes.exportar', 'html') }}?tipo={{ $tipo }}&fecha_desde={{ $fecha_desde }}&fecha_hasta={{ $fecha_hasta }}" target="_blank">
                            <i class="fas fa-file-pdf mr-2 text-danger"></i>PDF (Vista Imprimible)
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            @foreach($data['columnas'] as $columna)
                                <th>{{ $columna }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['items'] as $item)
                            <tr>
                                @switch($tipo)
                                    @case('usuarios')
                                        <td>{{ $item->id }}</td>
                                        <td class="font-weight-bold">{{ trim(($item->nombre ?? '') . ' ' . ($item->ap_paterno ?? '') . ' ' . ($item->ap_materno ?? '')) }}</td>
                                        <td>{{ $item->correo }}</td>
                                        <td>
                                            @php
                                                $rolLabel = match($item->rol_id) {
                                                    1 => ['label' => 'Estudiante', 'class' => 'badge-info'],
                                                    2 => ['label' => 'Empresa', 'class' => 'badge-warning'],
                                                    3 => ['label' => 'Admin', 'class' => 'badge-danger'],
                                                    default => ['label' => 'Desconocido', 'class' => 'badge-secondary'],
                                                };
                                            @endphp
                                            <span class="badge {{ $rolLabel['class'] }}">{{ $rolLabel['label'] }}</span>
                                        </td>
                                        <td>
                                            @if($item->activo)
                                                <span class="badge badge-success">Sí</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->creado_en ? \Carbon\Carbon::parse($item->creado_en)->format('d/m/Y') : 'N/A' }}</td>
                                        @break

                                    @case('ofertas')
                                        <td>{{ $item->id }}</td>
                                        <td class="font-weight-bold">{{ $item->titulo }}</td>
                                        <td>{{ $item->perfilEmpresa->nombre_empresa ?? 'N/A' }}</td>
                                        <td>{{ $item->ubicacion->ciudad ?? 'Remoto' }}</td>
                                        <td>
                                            @php
                                                $estado = $item->estadoPublicacion->nombre ?? 'desconocido';
                                            @endphp
                                            <span class="badge badge-{{ $estado == 'abierta' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($estado) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->fecha_inicio ? \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') : 'N/A' }}</td>
                                        @break

                                    @case('postulaciones')
                                        <td>{{ $item->id }}</td>
                                        <td>{{ trim(($item->perfilEstudiante->usuario->nombre ?? '') . ' ' . ($item->perfilEstudiante->usuario->ap_paterno ?? '') . ' ' . ($item->perfilEstudiante->usuario->ap_materno ?? '')) }}</td>
                                        <td>{{ $item->ofertaPasantia->titulo ?? 'N/A' }}</td>
                                        <td>{{ $item->estadoPostulacion->nombre ?? 'N/A' }}</td>
                                        <td>{{ $item->puntaje_topsis ?? '—' }}</td>
                                        <td>—</td>
                                        @break

                                    @case('logs')
                                        <td>{{ $item->id }}</td>
                                        <td>{{ trim(($item->usuario->nombre ?? '') . ' ' . ($item->usuario->ap_paterno ?? '') . ' ' . ($item->usuario->ap_materno ?? '')) }}</td>
                                        <td>{{ $item->accion }}</td>
                                        <td>{{ $item->tipoEntidad->nombre ?? 'N/A' }}</td>
                                        <td>{{ $item->creado_en ? \Carbon\Carbon::parse($item->creado_en)->format('d/m/Y H:i') : 'N/A' }}</td>
                                        @break
                                @endswitch
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($data['columnas']) }}" class="text-center text-muted py-4">
                                    No hay datos disponibles con los filtros seleccionados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
