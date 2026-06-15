@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Usuarios')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-users mr-2"></i>Gestión de Usuarios
        </h1>
        <div>
            <a href="{{ route('admin.usuarios.crear') }}" class="btn btn-sm btn-primary mr-2">
                <i class="fas fa-plus mr-1"></i>Nuevo Usuario
            </a>
            <span class="badge badge-primary px-3 py-2">{{ $usuarios->total() }} usuarios</span>
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
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Listado de Usuarios</h3>
            <div class="card-tools">
                <form action="{{ route('admin.usuarios') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Buscar usuarios..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th style="width: 160px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td class="font-weight-bold">{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>
                                @php
                                    $rolLabel = match($usuario->rol_id) {
                                        1 => ['label' => 'Estudiante', 'class' => 'badge-info'],
                                        2 => ['label' => 'Empresa', 'class' => 'badge-warning'],
                                        3 => ['label' => 'Admin', 'class' => 'badge-danger'],
                                        default => ['label' => 'Desconocido', 'class' => 'badge-secondary'],
                                    };
                                @endphp
                                <span class="badge {{ $rolLabel['class'] }}">{{ $rolLabel['label'] }}</span>
                            </td>
                            <td>
                                @if($usuario->activo)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $usuario->creado_en ? $usuario->creado_en->format('d/m/Y') : 'N/A' }}</td>
                            <td>
                                @if($usuario->correo === 'prueba@edu.bo' && !$esSuperAdmin)
                                    <span class="text-muted" title="No puedes modificar al superadministrador">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                @else
                                <a href="{{ route('admin.usuarios.editar', $usuario->id) }}" class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.usuarios.toggle', $usuario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $usuario->activo ? 'btn-warning' : 'btn-success' }}" 
                                            title="{{ $usuario->activo ? 'Desactivar' : 'Activar' }}">
                                        <i class="fas {{ $usuario->activo ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                </form>
                                @endif
                                @if($usuario->correo !== 'prueba@edu.bo')
                                <form action="{{ route('admin.usuarios.eliminar', $usuario->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este usuario? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No se encontraron usuarios</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $usuarios->links() }}
        </div>
    </div>
@stop
