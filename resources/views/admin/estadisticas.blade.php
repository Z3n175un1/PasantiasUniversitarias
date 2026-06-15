@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Estadísticas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-chart-bar mr-2"></i>Estadísticas del Sistema
        </h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios Totales</span>
                    <span class="info-box-number">{{ $total_usuarios }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-graduation-cap"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Estudiantes</span>
                    <span class="info-box-number">{{ $total_estudiantes }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Empresas</span>
                    <span class="info-box-number">{{ $total_empresas }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ofertas</span>
                    <span class="info-box-number">{{ $total_ofertas }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-dark"><i class="fas fa-shield-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Administradores</span>
                    <span class="info-box-number">{{ $distribucion_roles['data'][2] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Distribución de Roles
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="rolesChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Pasantías del Mes Actual
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h2 class="font-weight-bold text-info" style="font-size: 3rem;">{{ $ofertas_mes }}</h2>
                        <p class="text-muted">pasantías publicadas en {{ now()->locale('es')->monthName }} {{ now()->year }}</p>
                    </div>
                    <canvas id="ofertasChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>Resumen General
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 col-6 text-center">
                            <h4 class="font-weight-bold text-info">{{ $total_usuarios }}</h4>
                            <small class="text-muted">Usuarios</small>
                        </div>
                        <div class="col-sm-3 col-6 text-center">
                            <h4 class="font-weight-bold text-success">{{ $total_estudiantes }}</h4>
                            <small class="text-muted">Estudiantes</small>
                        </div>
                        <div class="col-sm-3 col-6 text-center">
                            <h4 class="font-weight-bold text-warning">{{ $total_empresas }}</h4>
                            <small class="text-muted">Empresas</small>
                        </div>
                        <div class="col-sm-3 col-6 text-center">
                            <h4 class="font-weight-bold text-danger">{{ $total_ofertas }}</h4>
                            <small class="text-muted">Ofertas</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Postulaciones recibidas:</strong> {{ $total_postulaciones }}
                        </div>
                        <div class="col-sm-6">
                            <strong>Relación estudiantes/empresa:</strong>
                            @if($total_empresas > 0)
                                {{ number_format($total_estudiantes / $total_empresas, 1) }} estudiantes por empresa
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
$(function() {
    var ctxPie = document.getElementById('rolesChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: {!! json_encode($distribucion_roles['labels']) !!},
            datasets: [{
                data: {!! json_encode($distribucion_roles['data']) !!},
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: 'bottom' },
        }
    });

    var ctxPie2 = document.getElementById('ofertasChart').getContext('2d');
    var ofertasMes = {{ $ofertas_mes }};
    var resto = Math.max(0, {{ $total_ofertas }} - ofertasMes);
    new Chart(ctxPie2, {
        type: 'doughnut',
        data: {
            labels: ['Este Mes (' + ofertasMes + ')', 'Meses Anteriores (' + resto + ')'],
            datasets: [{
                data: [ofertasMes, resto],
                backgroundColor: ['#17a2b8', '#e9ecef'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            legend: { position: 'bottom' },
        }
    });
});
</script>
@stop

@section('plugins.Chartjs', true)
