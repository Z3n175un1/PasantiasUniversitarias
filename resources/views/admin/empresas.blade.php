@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Empresas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-building mr-2"></i>Empresas Registradas
        </h1>
        <span class="badge badge-warning px-3 py-2">{{ $empresas->count() }} empresas</span>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Listado de Empresas</h3>
            <div class="card-tools">
                <span class="badge badge-warning">{{ $empresas->where('verificada', true)->count() }} verificadas</span>
                <span class="badge badge-secondary ml-1">{{ $empresas->where('verificada', false)->count() }} pendientes</span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Industria</th>
                        <th>Contacto</th>
                        <th>Web</th>
                        <th>Verificada</th>
                        <th>Registro</th>
                        <th style="width: 100px;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->id }}</td>
                            <td class="font-weight-bold">{{ $empresa->nombre_empresa }}</td>
                            <td>{{ $empresa->industria ?? 'N/A' }}</td>
                            <td>
                                <small>{{ $empresa->usuario->correo ?? 'N/A' }}</small>
                            </td>
                            <td>
                                @if($empresa->sitio_web)
                                    <a href="{{ $empresa->sitio_web }}" target="_blank" class="text-primary">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($empresa->verificada)
                                    <span class="badge badge-success"><i class="fas fa-check"></i> Verificada</span>
                                @else
                                    <span class="badge badge-warning"><i class="fas fa-clock"></i> Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $empresa->usuario->creado_en ? $empresa->usuario->creado_en->format('d/m/Y') : 'N/A' }}</td>
                            <td>
                                <form action="{{ route('admin.empresas.toggle', $empresa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $empresa->verificada ? 'btn-warning' : 'btn-success' }}"
                                            title="{{ $empresa->verificada ? 'Desmarcar verificación' : 'Verificar empresa' }}">
                                        <i class="fas {{ $empresa->verificada ? 'fa-times' : 'fa-check' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No hay empresas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
