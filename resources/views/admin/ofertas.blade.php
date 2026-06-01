@extends('adminlte::page')

@section('title', 'Ofertas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-briefcase mr-2"></i>Ofertas de Pasantía
        </h1>
        <span class="badge badge-info px-3 py-2">{{ $ofertas->count() }} ofertas</span>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Listado de Ofertas</h3>
            <div class="card-tools">
                <span class="badge badge-success mr-1">
                    {{ $ofertas->filter(fn($o) => $o->estadoPublicacion->nombre == 'abierta')->count() }} abiertas
                </span>
                <span class="badge badge-danger">
                    {{ $ofertas->filter(fn($o) => $o->estadoPublicacion->nombre != 'abierta')->count() }} cerradas
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Empresa</th>
                        <th>Ubicación</th>
                        <th>Duración</th>
                        <th>Estado</th>
                        <th style="width: 100px;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ofertas as $oferta)
                        <tr>
                            <td>{{ $oferta->id }}</td>
                            <td class="font-weight-bold">
                                <a href="{{ route('pasantia.show', $oferta->id) }}" target="_blank">
                                    {{ $oferta->titulo }}
                                </a>
                            </td>
                            <td>{{ $oferta->perfilEmpresa->nombre_empresa ?? 'N/A' }}</td>
                            <td>{{ $oferta->ubicacion->ciudad ?? 'Remoto' }}</td>
                            <td>
                                @if($oferta->fecha_inicio && $oferta->fecha_fin)
                                    @php
                                        $inicio = \Carbon\Carbon::parse($oferta->fecha_inicio);
                                        $fin = \Carbon\Carbon::parse($oferta->fecha_fin);
                                        $semanas = $inicio->diffInWeeks($fin);
                                    @endphp
                                    {{ $semanas }} semanas ({{ $inicio->format('d/m/Y') }} - {{ $fin->format('d/m/Y') }})
                                @else
                                    No especificada
                                @endif
                            </td>
                            <td>
                                @php
                                    $estado = $oferta->estadoPublicacion->nombre ?? 'desconocido';
                                    $badgeClass = match($estado) {
                                        'abierta' => 'badge-success',
                                        'cerrada' => 'badge-danger',
                                        default => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.ofertas.toggle', $oferta->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    @php
                                        $isOpen = $oferta->estadoPublicacion->nombre == 'abierta';
                                    @endphp
                                    <button type="submit" class="btn btn-sm {{ $isOpen ? 'btn-danger' : 'btn-success' }}"
                                            title="{{ $isOpen ? 'Cerrar oferta' : 'Abrir oferta' }}">
                                        <i class="fas {{ $isOpen ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No hay ofertas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
