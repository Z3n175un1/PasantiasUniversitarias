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
                        <i class="fas fa-chart-bar mr-2"></i>Ofertas por Mes
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="ofertasChart" style="height: 300px;"></canvas>
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

    var ctxBar = document.getElementById('ofertasChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
                label: 'Ofertas',
                data: [
                    @for($i = 1; $i <= 12; $i++)
                        {{ $ofertas_por_mes->firstWhere('mes', $i)->total ?? 0 }},
                    @endfor
                ],
                backgroundColor: '#17a2b8',
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: false },
            scales: {
                yAxes: [{
                    ticks: { beginAtZero: true, stepSize: 1 }
                }]
            }
        }
    });
});
</script>
@stop

@section('plugins.Chartjs', true)
