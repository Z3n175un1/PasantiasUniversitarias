<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | UWorkFlow</title>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .card-neo { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(226, 232, 240, 0.8); }
        .card-neo:hover { transform: translateY(-4px); box-shadow: 0 12px 20px -5px rgba(43, 109, 242, 0.08); }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="text-[#0f172a] overflow-x-hidden min-h-screen flex flex-col justify-between">
    @include('componentes.navbar')

    <main class="flex-1 max-w-[1400px] w-full mx-auto px-[8%] py-10">

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-semibold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="lg:w-64 flex flex-col gap-2">
                <button data-tab="inicio"
                    class="tab-btn active flex items-center gap-3 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all text-left text-sm w-full">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    Panel de Control
                </button>
                <button data-tab="usuarios"
                    class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Control de Usuarios
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">{{ $stats['usuarios'] }}</span>
                </button>
                <button data-tab="ofertas"
                    class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                    Ofertas
                    <span class="ml-auto bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full font-bold">{{ $stats['ofertas'] }}</span>
                </button>
                <button data-tab="estadisticas"
                    class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                    Estadísticas
                </button>
            </aside>

            <div class="flex-1">
                {{-- Panel de Control --}}
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40">
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">
                            Panel de Administración
                        </h1>
                        <p class="text-sm text-slate-500 mt-1">
                            Bienvenido, <span class="font-bold text-blue-600">{{ Auth::user()->nombre }}</span>
                            &middot; {{ now()->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center card-neo">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['usuarios'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Usuarios</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center card-neo">
                            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['estudiantes'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Estudiantes</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center card-neo">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="building-2" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['empresas'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Empresas</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center card-neo">
                            <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="briefcase" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['ofertas'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Ofertas</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center card-neo">
                            <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['postulaciones'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Postulaciones</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                            <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <i data-lucide="users" class="w-5 h-5 text-blue-600"></i>
                                Últimos Usuarios Registrados
                            </h3>
                            <div class="space-y-2">
                                @foreach($stats['ultimos_usuarios'] as $usuario)
                                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-slate-200 rounded-lg flex items-center justify-center font-bold text-xs">
                                                {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold">{{ $usuario->nombre }} {{ $usuario->ap_paterno }} {{ $usuario->ap_materno }}</p>
                                                <p class="text-xs text-slate-400">{{ $usuario->correo }}</p>
                                            </div>
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400">
                                            @if($usuario->rol_id == 1) Estudiante
                                            @elseif($usuario->rol_id == 2) Empresa
                                            @else Admin @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                            <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <i data-lucide="history" class="w-5 h-5 text-indigo-600"></i>
                                Actividad Reciente
                            </h3>
                            <div class="space-y-2">
                                @forelse($stats['ultimos_logs'] as $log)
                                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500">
                                                <i data-lucide="circle" class="w-3 h-3"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold">{{ $log->usuario->nombre ?? 'Sistema' }}</p>
                                                <p class="text-xs text-slate-400">{{ $log->accion }}</p>
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-slate-400">{{ $log->creado_en ? \Carbon\Carbon::parse($log->creado_en)->diffForHumans() : '' }}</span>
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-400 text-center py-4">Sin actividad reciente</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Gestión de Usuarios --}}
                <section id="usuarios" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Gestión de Usuarios</h2>

                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 flex items-center gap-2">
                                <i data-lucide="building-2" class="w-5 h-5 text-indigo-600"></i>
                                Empresas ({{ $stats['empresas'] }})
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50 text-xs font-bold uppercase text-slate-400">
                                        <th class="p-4">Empresa</th>
                                        <th class="p-4">Industria</th>
                                        <th class="p-4">Tamaño</th>
                                        <th class="p-4">Contacto</th>
                                        <th class="p-4">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-50">
                                    @foreach($stats['todas_empresas'] as $empresa)
                                        <tr class="hover:bg-slate-50/50">
                                            <td class="p-4 font-semibold">{{ $empresa->nombre_empresa }}</td>
                                            <td class="p-4 text-slate-500">{{ $empresa->industria }}</td>
                                            <td class="p-4 text-slate-500">{{ $empresa->tamano_empresa ?? 'N/A' }}</td>
                                            <td class="p-4 text-slate-500">{{ $empresa->usuario->correo ?? 'N/A' }}</td>
                                            <td class="p-4">
                                                @if($empresa->verificada)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-700 font-bold rounded-full text-xs">✓ Verificada</span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-700 font-bold rounded-full text-xs">⚠ Pendiente</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t border-slate-100">
                            {{ $stats['todas_empresas']->links() }}
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 flex items-center gap-2">
                                <i data-lucide="graduation-cap" class="w-5 h-5 text-green-600"></i>
                                Estudiantes ({{ $stats['estudiantes'] }})
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50 text-xs font-bold uppercase text-slate-400">
                                        <th class="p-4">Estudiante</th>
                                        <th class="p-4">Universidad</th>
                                        <th class="p-4">Carrera</th>
                                        <th class="p-4">Semestre</th>
                                        <th class="p-4">Año Graduación</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-50">
                                    @foreach($stats['todos_estudiantes'] as $estudiante)
                                        <tr class="hover:bg-slate-50/50">
                                            <td class="p-4 font-semibold">{{ $estudiante->usuario->nombre ?? 'N/A' }}</td>
                                            <td class="p-4 text-slate-500">{{ $estudiante->universidad }}</td>
                                            <td class="p-4 text-slate-500">{{ $estudiante->carrera }}</td>
                                            <td class="p-4 text-slate-500">{{ $estudiante->semestre_actual ? $estudiante->semestre_actual . '°' : 'N/A' }}</td>
                                            <td class="p-4 text-slate-500">{{ $estudiante->anio_graduacion ?? 'No definido' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t border-slate-100">
                            {{ $stats['todos_estudiantes']->links() }}
                        </div>
                    </div>
                </section>

                {{-- Ofertas --}}
                <section id="ofertas" class="tab-content space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900">Ofertas de Pasantía</h2>
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full">Abiertas: {{ $stats['ofertas_activas']->count() }}</span>
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full">Borrador: {{ $stats['ofertas_borrador'] }}</span>
                            <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-full">Cerradas: {{ $stats['ofertas_cerradas'] }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        @forelse($stats['ofertas_activas'] as $oferta)
                            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm card-neo">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                            <i data-lucide="briefcase" class="w-6 h-6"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-900">{{ $oferta->titulo }}</h3>
                                            <p class="text-sm text-blue-600 font-semibold">{{ $oferta->perfilEmpresa->nombre_empresa ?? 'Empresa' }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">
                                                {{ $oferta->ubicacion->ciudad ?? 'Remoto' }}
                                                @if($oferta->modalidad) • {{ $oferta->modalidad }} @endif
                                                @if($oferta->vacantes_disponibles) • {{ $oferta->vacantes_disponibles }} vacantes @endif
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold">
                                        {{ $oferta->estadoPublicacion->nombre ?? 'Activa' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm text-center">
                                <i data-lucide="briefcase" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                                <h3 class="font-bold text-slate-500">No hay ofertas activas</h3>
                                <p class="text-sm text-slate-400 mt-1">Las empresas aún no han publicado ofertas.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="p-4">
                        {{ $stats['ofertas_activas']->links() }}
                    </div>
                </section>

                {{-- Estadísticas --}}
                <section id="estadisticas" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Estadísticas del Sistema</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="font-bold mb-4 flex items-center gap-2">
                                <i data-lucide="pie-chart" class="w-5 h-5 text-blue-600"></i>
                                Distribución de Roles
                            </h3>
                            <canvas id="rolesChart" style="height: 260px;"></canvas>
                        </div>
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="font-bold mb-4 flex items-center gap-2">
                                <i data-lucide="bar-chart-3" class="w-5 h-5 text-indigo-600"></i>
                                Ofertas por Estado
                            </h3>
                            <canvas id="ofertasChart" style="height: 260px;"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <h3 class="font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i>
                            Resumen del mes de {{ now()->locale('es')->monthName }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <canvas id="resumenMesChart" style="height: 260px; max-width: 320px; margin: 0 auto;"></canvas>
                            <div class="flex flex-col justify-center gap-3">
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl">
                                    <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                                    <span class="text-sm font-semibold text-slate-600">Ofertas: <strong class="text-slate-900">{{ $stats['resumen_mes']['ofertas'] }}</strong></span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-green-50 rounded-xl">
                                    <span class="w-3 h-3 rounded-full bg-green-500"></span>
                                    <span class="text-sm font-semibold text-slate-600">Usuarios: <strong class="text-slate-900">{{ $stats['resumen_mes']['usuarios'] }}</strong></span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-xl">
                                    <span class="w-3 h-3 rounded-full bg-purple-500"></span>
                                    <span class="text-sm font-semibold text-slate-600">Postulaciones: <strong class="text-slate-900">{{ $stats['resumen_mes']['postulaciones'] }}</strong></span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-amber-50 rounded-xl">
                                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                    <span class="text-sm font-semibold text-slate-600">Empresas: <strong class="text-slate-900">{{ $stats['resumen_mes']['empresas'] }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <h3 class="font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="activity" class="w-5 h-5 text-green-600"></i>
                            Resumen General
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div class="p-4 bg-slate-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-slate-900">{{ $stats['usuarios'] }}</p>
                                <p class="text-xs font-bold text-slate-400">Usuarios Totales</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-green-600">{{ $stats['estudiantes'] }}</p>
                                <p class="text-xs font-bold text-slate-400">Estudiantes</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-indigo-600">{{ $stats['empresas'] }}</p>
                                <p class="text-xs font-bold text-slate-400">Empresas</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-amber-600">{{ $stats['admins'] }}</p>
                                <p class="text-xs font-bold text-slate-400">Administradores</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4 text-sm">
                            <div class="p-4 bg-blue-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-blue-600">{{ $stats['ofertas'] }}</p>
                                <p class="text-xs font-bold text-slate-400">Ofertas Publicadas</p>
                            </div>
                            <div class="p-4 bg-purple-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-purple-600">{{ $stats['postulaciones'] }}</p>
                                <p class="text-xs font-bold text-slate-400">Postulaciones</p>
                            </div>
                            <div class="p-4 bg-green-50 rounded-xl text-center">
                                <p class="text-2xl font-black text-green-600">{{ $stats['ofertas_activas']->count() }}</p>
                                <p class="text-xs font-bold text-slate-400">Ofertas Activas</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    @include('componentes.footer')

    <script>
        lucide.createIcons();

        // Control de Pestañas
        const tabButtons = document.querySelectorAll('.tab-btn');
        const sections = {
            'inicio': document.getElementById('inicio'),
            'usuarios': document.getElementById('usuarios'),
            'ofertas': document.getElementById('ofertas'),
            'estadisticas': document.getElementById('estadisticas')
        };

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.getAttribute('data-tab');
                tabButtons.forEach(b => {
                    b.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
                    b.classList.add('text-slate-600', 'hover:bg-slate-100');
                });
                btn.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
                btn.classList.remove('text-slate-600', 'hover:bg-slate-100');
                Object.values(sections).forEach(section => section.classList.remove('active'));
                if (sections[targetTab]) sections[targetTab].classList.add('active');
            });
        });

        // Gráficos
        const rolesCtx = document.getElementById('rolesChart')?.getContext('2d');
        if (rolesCtx) {
            new Chart(rolesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Estudiantes', 'Empresas', 'Administradores'],
                    datasets: [{
                        data: [{{ $stats['estudiantes'] }}, {{ $stats['empresas'] }}, {{ $stats['admins'] }}],
                        backgroundColor: ['#22c55e', '#6366f1', '#ef4444'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { size: 11, family: 'Inter' }, padding: 16 } }
                    }
                }
            });
        }

        const resumenMesCtx = document.getElementById('resumenMesChart')?.getContext('2d');
        if (resumenMesCtx) {
            const resumen = @json($stats['resumen_mes']);
            const total = Object.values(resumen).reduce((a, b) => a + b, 0);
            new Chart(resumenMesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Ofertas', 'Usuarios', 'Postulaciones', 'Empresas'],
                    datasets: [{
                        data: [resumen.ofertas, resumen.usuarios, resumen.postulaciones, resumen.empresas],
                        backgroundColor: ['#3b82f6', '#22c55e', '#a855f7', '#f59e0b'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }

        const ofertasCtx = document.getElementById('ofertasChart')?.getContext('2d');
        if (ofertasCtx) {
            new Chart(ofertasCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Abiertas', 'Borrador', 'Cerradas'],
                    datasets: [{
                        data: [{{ $stats['ofertas_activas']->count() }}, {{ $stats['ofertas_borrador'] }}, {{ $stats['ofertas_cerradas'] }}],
                        backgroundColor: ['#22c55e', '#f59e0b', '#ef4444'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { size: 11, family: 'Inter' }, padding: 16 } }
                    }
                }
            });
        }
    </script>
</body>
</html>
