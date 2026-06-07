<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | UWorkFlow</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .card-neo {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .card-neo:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -5px rgba(43, 109, 242, 0.08);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body class="text-[#0f172a] overflow-x-hidden min-h-screen flex flex-col justify-between">
    @include('components.navbar')

    <main class="flex-1 max-w-[1400px] w-full mx-auto px-[8%] py-10">
        
        {{-- Mensajes --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar --}}
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
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">
                        {{ $stats['usuarios'] }}
                    </span>
                </button>
                <button data-tab="ofertas"
                    class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                    Ofertas Activas
                    <span class="ml-auto bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full font-bold">
                        {{ $stats['ofertas'] }}
                    </span>
                </button>
                <button data-tab="estadisticas"
                    class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                    Estadísticas
                </button>
            </aside>

            {{-- Contenido Principal --}}
            <div class="flex-1">
                {{-- Tab: Inicio --}}
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40">
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">
                            Panel de Administración 🛠️
                        </h1>
                        <p class="text-sm text-slate-500 mt-1">
                            Bienvenido, <span class="font-bold text-blue-600">{{ Auth::user()->nombre }}</span>
                        </p>
                    </div>

                    {{-- Estadísticas --}}
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['usuarios'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Usuarios</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center">
                            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['estudiantes'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Estudiantes</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="building-2" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['empresas'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Empresas</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center">
                            <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="briefcase" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['ofertas'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Ofertas</p>
                        </div>
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center">
                            <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <p class="text-2xl font-black text-slate-900">{{ $stats['postulaciones'] }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase">Postulaciones</p>
                        </div>
                    </div>

                    {{-- Últimos usuarios --}}
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <h3 class="font-bold text-slate-900 mb-4">Últimos Usuarios Registrados</h3>
                        <div class="space-y-3">
                            @foreach($stats['ultimos_usuarios'] as $usuario)
                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-slate-200 rounded-lg flex items-center justify-center">
                                            <span class="text-xs font-bold">{{ substr($usuario->nombre, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold">{{ $usuario->nombre }}</p>
                                            <p class="text-xs text-slate-400">{{ $usuario->correo }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- Tab: Usuarios --}}
                <section id="usuarios" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Gestión de Usuarios</h2>
                    
                    {{-- Empresas --}}
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-5 border-b">
                            <h3 class="font-bold text-slate-900">Empresas ({{ $stats['empresas'] }})</h3>
                        </div>
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 text-xs font-bold uppercase text-slate-400">
                                    <th class="p-4">Empresa</th>
                                    <th class="p-4">Industria</th>
                                    <th class="p-4">Contacto</th>
                                    <th class="p-4">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-slate-50">
                                    @foreach($stats['todas_empresas'] as $empresa)
                                    <tr>
                                        <td class="p-4 font-semibold">{{ $empresa->nombre_empresa }}</td>
                                        <td class="p-4 text-slate-500">{{ $empresa->industria }}</td>
                                        <td class="p-4 text-slate-500">{{ $empresa->usuario->correo ?? 'N/A' }}</td>
                                        <td class="p-4">
                                            @if($empresa->verificada)
                                                <span class="text-green-600 font-bold text-xs">✓ Verificada</span>
                                            @else
                                                <span class="text-amber-600 font-bold text-xs">⚠ Pendiente</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Estudiantes --}}
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-5 border-b">
                            <h3 class="font-bold text-slate-900">Estudiantes ({{ $stats['estudiantes'] }})</h3>
                        </div>
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 text-xs font-bold uppercase text-slate-400">
                                    <th class="p-4">Estudiante</th>
                                    <th class="p-4">Universidad</th>
                                    <th class="p-4">Carrera</th>
                                    <th class="p-4">Año Graduación</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-slate-50">
                                @foreach($stats['todos_estudiantes'] as $estudiante)
                                    <tr>
                                        <td class="p-4 font-semibold">{{ $estudiante->usuario->nombre ?? 'N/A' }}</td>
                                        <td class="p-4 text-slate-500">{{ $estudiante->universidad }}</td>
                                        <td class="p-4 text-slate-500">{{ $estudiante->carrera }}</td>
                                        <td class="p-4 text-slate-500">{{ $estudiante->anio_graduacion ?? 'No definido' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Tab: Ofertas --}}
                <section id="ofertas" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Ofertas de Pasantía Activas</h2>
                    <div class="space-y-4">
                        @foreach($stats['ofertas_activas'] as $oferta)
                            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-slate-900">{{ $oferta->titulo }}</h3>
                                        <p class="text-sm text-blue-600">{{ $oferta->perfilEmpresa->nombre_empresa ?? 'Empresa' }}</p>
                                        <p class="text-xs text-slate-400 mt-1">{{ $oferta->ubicacion->ciudad ?? 'Remoto' }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold">
                                        {{ $oferta->estadoPublicacion->nombre ?? 'Activa' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Tab: Estadísticas --}}
                <section id="estadisticas" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Estadísticas del Sistema</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl border border-slate-100">
                            <h3 class="font-bold mb-4">Distribución de Roles</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span>Estudiantes</span>
                                    <span class="font-bold">{{ $stats['estudiantes'] }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($stats['usuarios'] > 0) ? ($stats['estudiantes'] / $stats['usuarios'] * 100) : 0 }}%"></div>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span>Empresas</span>
                                    <span class="font-bold">{{ $stats['empresas'] }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ ($stats['usuarios'] > 0) ? ($stats['empresas'] / $stats['usuarios'] * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl border border-slate-100">
                            <h3 class="font-bold mb-4">Resumen General</h3>
                            <div class="space-y-2 text-sm">
                                <p>📊 Total Ofertas: <span class="font-bold">{{ $stats['ofertas'] }}</span></p>
                                <p>📝 Postulaciones: <span class="font-bold">{{ $stats['postulaciones'] }}</span></p>
                                <p>👥 Usuarios Totales: <span class="font-bold">{{ $stats['usuarios'] }}</span></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    @include('components.footer')

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
                sections[targetTab].classList.add('active');
            });
        });
    </script>
</body>
</html>