@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Respaldos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-database mr-2"></i>Respaldos de Base de Datos
        </h1>
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

    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-hdd mr-2"></i>Estado de la Base de Datos
                    </h3>
                </div>
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        <div class="w-16 h-16 mx-auto bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:64px;height:64px;">
                            <i class="fas fa-database text-white fa-2x"></i>
                        </div>
                    </div>
                    <h4 class="font-weight-bold">
                        @if($dbSize > 0)
                            {{ round($dbSize / 1024 / 1024, 2) }} MB
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </h4>
                    <p class="text-muted mb-0">Tamaño actual de la BD</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-2"></i>Generar Nuevo Respaldo
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Crea una copia de seguridad completa de la base de datos. El archivo se generará en formato SQL y podrás descargarlo.</p>
                    <form action="{{ route('admin.respaldos.generar') }}" method="POST" onsubmit="return confirm('¿Generar un nuevo respaldo? Esto puede tomar unos segundos.')">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-play mr-1"></i>Generar Respaldo Ahora
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-history mr-2"></i>Respaldos Anteriores
            </h3>
            <div class="card-tools">
                <span class="badge badge-info">{{ count($backups) }} respaldos</span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Archivo</th>
                        <th>Tamaño</th>
                        <th>Fecha</th>
                        <th style="width:120px;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($backups as $backup)
                        <tr>
                            <td class="font-weight-bold">
                                <i class="fas fa-file-archive mr-2 text-info"></i>{{ $backup['name'] }}
                            </td>
                            <td>{{ round($backup['size'] / 1024 / 1024, 2) }} MB</td>
                            <td>{{ $backup['date'] }}</td>
                            <td>
                                <a href="{{ route('admin.respaldos.descargar', $backup['name']) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este respaldo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" disabled title="Función próximamente">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle mr-1"></i>No hay respaldos generados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
$(function() {
    $('[data-card-widget="collapse"]').on('click', function(e) {
        e.preventDefault();
        $(this).closest('.card').find('.card-body').slideToggle();
    });
});
</script>
@stop
