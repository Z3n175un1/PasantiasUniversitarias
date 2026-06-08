@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Logs del Sistema')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-history mr-2"></i>Logs del Sistema
        </h1>
        <div>
            <span class="badge badge-danger px-3 py-2">
                <i class="fas fa-lock mr-1"></i>Acceso restringido
            </span>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-filter mr-2"></i>Filtros
            </h3>
            <div class="card-tools">
                <button class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.logs') }}" class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Administrador</label>
                        <select name="usuario" class="form-control form-control-sm">
                            <option value="">Todos</option>
                            @foreach($usuarios as $u)
                                <option value="{{ $u->id }}" {{ request('usuario') == $u->id ? 'selected' : '' }}>
                                    {{ $u->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tipo de Entidad</label>
                        <select name="tipo_entidad" class="form-control form-control-sm">
                            <option value="">Todas</option>
                            @foreach($tiposEntidad as $t)
                                <option value="{{ $t->id }}" {{ request('tipo_entidad') == $t->id ? 'selected' : '' }}>
                                    {{ $t->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Acción</label>
                        <input type="text" name="accion" class="form-control form-control-sm" placeholder="Buscar acción..." value="{{ request('accion') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Desde</label>
                        <input type="date" name="fecha_desde" class="form-control form-control-sm" value="{{ request('fecha_desde') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Hasta</label>
                        <input type="date" name="fecha_hasta" class="form-control form-control-sm" value="{{ request('fecha_hasta') }}">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-search mr-1"></i>Filtrar
                    </button>
                    <a href="{{ route('admin.logs') }}" class="btn btn-sm btn-secondary ml-1">
                        <i class="fas fa-undo mr-1"></i>Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-list mr-2"></i>Registro de Actividades
            </h3>
            <div class="card-tools">
                <span class="badge badge-danger">{{ $logs->total() }} registros</span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Administrador</th>
                        <th>Acción</th>
                        <th>Tipo</th>
                        <th>Entidad Afectada</th>
                        <th>Cambios</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        @php
                            $badgeClass = match($log->accion) {
                                'Inicio de sesión' => 'badge-success',
                                'Cierre de sesión' => 'badge-secondary',
                                'Creación de usuario', 'Registro de estudiante', 'Registro de empresa', 'Creación de oferta' => 'badge-primary',
                                'Modificación de usuario', 'Modificación de oferta' => 'badge-warning',
                                'Eliminación de usuario', 'Eliminación de oferta' => 'badge-danger',
                                'Activación de usuario' => 'badge-success',
                                'Desactivación de usuario' => 'badge-dark',
                                'Verificación de empresa' => 'badge-success',
                                'Desverificación de empresa' => 'badge-dark',
                                'Cambio de estado de oferta' => 'badge-info',
                                default => 'badge-info',
                            };

                            $entidad = $entidades[$log->id] ?? null;
                            $cambios = $log->cambiosFormateados();
                            $cambiosId = 'cambios-' . $log->id;
                        @endphp
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td class="font-weight-bold">{{ $log->usuario->nombre ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $badgeClass }}">{{ $log->accion }}</span>
                            </td>
                            <td>{{ $log->tipoEntidad->nombre ?? 'N/A' }}</td>
                            <td style="max-width: 200px;">
                                @if($entidad)
                                    <div class="d-flex align-items-center">
                                        @if(!empty($entidad['url']))
                                            <a href="{{ $entidad['url'] }}" target="_blank" class="font-weight-bold text-primary text-truncate d-inline-block" style="max-width: 160px;">
                                                {{ $entidad['nombre'] }}
                                            </a>
                                        @else
                                            <span class="font-weight-bold text-truncate d-inline-block" style="max-width: 160px;">
                                                {{ $entidad['nombre'] }}
                                            </span>
                                        @endif
                                    </div>
                                    @if(!empty($entidad['correo']))
                                        <small class="text-muted d-block">{{ $entidad['correo'] }}</small>
                                    @endif
                                    @if(!empty($entidad['empresa']))
                                        <small class="text-muted d-block">{{ $entidad['empresa'] }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">ID: {{ $log->entidad_id }}</span>
                                @endif
                            </td>
                            <td style="max-width: 300px;">
                                @if(count($cambios) > 0)
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#{{ $cambiosId }}">
                                        <i class="fas fa-exchange-alt mr-1"></i>{{ count($cambios) }} cambio(s)
                                    </button>

                                    <div class="modal fade" id="{{ $cambiosId }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-history mr-2"></i>Detalle de Cambios
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <div class="p-3 bg-light border-bottom">
                                                        <strong>Acción:</strong>
                                                        <span class="badge {{ $badgeClass }} ml-1">{{ $log->accion }}</span>
                                                        <br>
                                                        <strong>Entidad:</strong>
                                                        <span class="ml-1">{{ $entidad['nombre'] ?? ('ID ' . $log->entidad_id) }}</span>
                                                        <br>
                                                        <strong>Administrador:</strong>
                                                        <span class="ml-1">{{ $log->usuario->nombre ?? 'N/A' }}</span>
                                                        <br>
                                                        <strong>Fecha:</strong>
                                                        <span class="ml-1">{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->format('d/m/Y H:i:s') : 'N/A' }}</span>
                                                    </div>
                                                    <table class="table table-bordered mb-0">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th style="width: 30%;">Campo</th>
                                                                <th style="width: 35%;" class="text-danger">Valor Anterior</th>
                                                                <th style="width: 35%;" class="text-success">Valor Nuevo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($cambios as $cambio)
                                                                <tr>
                                                                    <td class="font-weight-bold">{{ $cambio['campo'] }}</td>
                                                                    <td class="bg-danger-light text-danger">
                                                                        <s>{{ $cambio['antes'] }}</s>
                                                                    </td>
                                                                    <td class="bg-success-light text-success">
                                                                        <strong>{{ $cambio['despues'] }}</strong>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->format('d/m/Y H:i:s') : 'N/A' }}</small>
                                <br>
                                <small class="text-muted">{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->diffForHumans() : '' }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No hay registros de actividad</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $logs->links() }}
        </div>
    </div>
@stop

@section('css')
<style>
.bg-danger-light { background-color: #fde8e8; }
.bg-success-light { background-color: #e8fde8; }
</style>
@stop
