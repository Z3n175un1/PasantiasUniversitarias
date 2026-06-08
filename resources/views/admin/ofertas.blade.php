@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
@endpush

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
                        <th>Vacantes</th>
                        <th>Duración</th>
                        <th>Requisitos / Beneficios</th>
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
                                <span class="badge badge-info">{{ $oferta->vacantes_disponibles ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @if($oferta->duracion_semanas)
                                    {{ $oferta->duracion_semanas }} semanas
                                @elseif($oferta->fecha_inicio && $oferta->fecha_fin)
                                    @php
                                        $inicio = \Carbon\Carbon::parse($oferta->fecha_inicio);
                                        $fin = \Carbon\Carbon::parse($oferta->fecha_fin);
                                    @endphp
                                    {{ $inicio->diffInWeeks($fin) }} semanas
                                @else
                                    No especificada
                                @endif
                            </td>
                            <td>
                                @if($oferta->requisitos || $oferta->beneficios)
                                    <a href="#" class="text-info" data-toggle="popover" data-html="true"
                                       data-content="
                                        @if($oferta->requisitos)
                                            <b>Requisitos:</b><br>{{ nl2br(e(Str::limit($oferta->requisitos, 150))) }}<br><br>
                                        @endif
                                        @if($oferta->beneficios)
                                            <b>Beneficios:</b><br>{{ nl2br(e(Str::limit($oferta->beneficios, 150))) }}
                                        @endif
                                       "
                                       title="{{ $oferta->titulo }}">
                                        <i class="fas fa-info-circle"></i> Ver
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
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
                            <td colspan="9" class="text-center text-muted py-4">No hay ofertas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('js')
<script>
    $(function () {
        $('[data-toggle="popover"]').popover({ trigger: 'hover focus' });
    });
</script>
@endpush
