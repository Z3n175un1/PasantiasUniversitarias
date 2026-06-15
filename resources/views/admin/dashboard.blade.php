@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="font-weight-bold mb-0">Panel de Administración</h1>
            <small class="text-muted">Bienvenido, {{ Auth::user()->nombre }}</small>
        </div>
        <div class="text-right">
            <span class="badge badge-primary px-3 py-2">{{ now()->format('d/m/Y') }}</span>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['usuarios'] }}</h3>
                    <p>Usuarios Totales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.usuarios') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['estudiantes'] }}</h3>
                    <p>Estudiantes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <a href="{{ route('admin.estudiantes') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['empresas'] }}</h3>
                    <p>Empresas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('admin.empresas') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['ofertas'] }}</h3>
                    <p>Ofertas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{ route('admin.ofertas') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $stats['admins'] }}</h3>
                    <p>Administradores</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <a href="{{ route('admin.usuarios') }}" class="small-box-footer">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-chart-bar mr-2"></i>Distribución de Usuarios
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="usersChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Pasantías {{ now()->locale('es')->monthName }}
                    </h3>
                </div>
                <div class="card-body text-center">
                    <h2 class="font-weight-bold text-info" style="font-size: 2.5rem;">{{ $ofertas_mes }}</h2>
                    <p class="text-muted">de {{ $stats['ofertas'] }} totales</p>
                    <canvas id="rolesChart" style="height: 180px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-clock mr-2"></i>Últimos Usuarios Registrados
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-info">{{ $stats['usuarios'] }} total</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['ultimos_usuarios'] as $usuario)
                                <tr>
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
                                    <td>{{ $usuario->creado_en ? $usuario->creado_en->diffForHumans() : 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No hay usuarios registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-briefcase mr-2"></i>Ofertas Recientes
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-success">{{ $stats['ofertas'] }} total</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Empresa</th>
                                <th>Ubicación</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ofertas_recientes as $oferta)
                                <tr>
                                    <td class="font-weight-bold">{{ $oferta->titulo }}</td>
                                    <td>{{ $oferta->perfilEmpresa->nombre_empresa ?? 'N/A' }}</td>
                                    <td>{{ $oferta->ubicacion->ciudad ?? 'Remoto' }}</td>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No hay ofertas disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-history mr-2"></i>Actividad Reciente
                    </h3>
                    <div class="card-tools">
                        @if(Auth::user()->correo === 'prueba@edu.bo')
                            <a href="{{ route('admin.logs') }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-eye mr-1"></i>Ver todos
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Administrador</th>
                                <th>Acción</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimos_logs as $log)
                                <tr>
                                    <td class="font-weight-bold">{{ $log->usuario->nombre ?? 'N/A' }}</td>
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
                                    <td>
                                        <small>{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->diffForHumans() : '' }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Sin actividad reciente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
$(function() {
    var ctxBar = document.getElementById('usersChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Estudiantes', 'Empresas', 'Administradores'],
            datasets: [{
                label: 'Cantidad',
                data: [{{ $stats['estudiantes'] }}, {{ $stats['empresas'] }}, {{ $distribucion['admins'] }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
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

    var ctxPie = document.getElementById('rolesChart').getContext('2d');
    var ofertasMes = {{ $ofertas_mes }};
    var resto = Math.max(0, {{ $stats['ofertas'] }} - ofertasMes);
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Este Mes (' + ofertasMes + ')', 'Resto (' + resto + ')'],
            datasets: [{
                data: [ofertasMes, resto],
                backgroundColor: ['#17a2b8', '#e9ecef'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            legend: { position: 'bottom' },
        }
    });
});
</script>
@stop

@section('plugins.Chartjs', true)
