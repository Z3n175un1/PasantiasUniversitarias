@extends('adminlte::page')

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
                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-group w-100">
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="fas fa-search mr-1"></i>Filtrar
                        </button>
                    </div>
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
                        <th>Correo</th>
                        <th>Acción</th>
                        <th>Tipo</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td class="font-weight-bold">{{ $log->usuario->nombre ?? 'N/A' }}</td>
                            <td>{{ $log->usuario->correo ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $badgeClass = match($log->accion) {
                                        'Inicio de sesión' => 'badge-success',
                                        'Cierre de sesión' => 'badge-secondary',
                                        default => 'badge-info',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $log->accion }}</span>
                            </td>
                            <td>{{ $log->tipoEntidad->nombre ?? 'N/A' }}</td>
                            <td>
                                <small>{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->format('d/m/Y H:i:s') : 'N/A' }}</small>
                                <br>
                                <small class="text-muted">{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->diffForHumans() : '' }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay registros de actividad</td>
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
