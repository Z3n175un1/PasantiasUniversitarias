<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiante | UWorkFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
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
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="lg:w-64 flex flex-col gap-2">
                <button data-tab="inicio" class="tab-btn active flex items-center gap-3 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all text-left text-sm w-full">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Inicio / Resumen
                </button>
                <button data-tab="postulaciones" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="send" class="w-5 h-5"></i>
                    Mis Postulaciones
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">{{ $total_postulaciones }}</span>
                </button>
                <button data-tab="ofertas" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                    Ofertas Disponibles
                </button>
                <button data-tab="perfil" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    Mi Perfil
                </button>
                <div class="h-px bg-slate-200 my-4"></div>
                <a href="{{ route('explora') }}" class="flex items-center gap-3 px-5 py-3.5 text-blue-600 hover:bg-blue-50 font-bold rounded-2xl transition-all text-sm">
                    <i data-lucide="search" class="w-5 h-5"></i>
                    Buscar Más Pasantías
                </a>
            </aside>

            <div class="flex-1">
                {{-- Inicio / Resumen --}}
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">¡Hola de nuevo, {{ $estudiante->usuario->nombre ?? 'Estudiante' }}! 👋</h1>
                            <p class="text-sm text-slate-500 mt-1">{{ $estudiante->carrera ?? 'Carrera no especificada' }} • {{ $estudiante->universidad ?? 'Universidad no especificada' }}</p>
                        </div>
                        <div class="flex items-center gap-3 bg-blue-50/60 p-4 rounded-2xl border border-blue-100/50">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                {{ min(100, ($estudiante->anio_graduacion ? 80 : 50) + ($estudiante->biografia ? 20 : 0)) }}%
                            </div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Perfil Completado</h4>
                                <p class="text-xs font-bold text-blue-600 mt-0.5">Completa tu perfil para mejorar tu match</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="send" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">{{ $total_postulaciones }}</h3>
                                <p class="text-sm font-semibold text-slate-400">Postulaciones Enviadas</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center"><i data-lucide="calendar" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">{{ $en_entrevista }}</h3>
                                <p class="text-sm font-semibold text-slate-400">En Entrevista</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center"><i data-lucide="briefcase" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">{{ $ofertas_disponibles->count() }}</h3>
                                <p class="text-sm font-semibold text-slate-400">Ofertas Disponibles</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-7 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                        <h3 class="font-bold text-slate-900 text-lg">Estado de mis postulaciones</h3>
                        <div class="space-y-3">
                            @forelse($postulaciones->take(5) as $post)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">{{ $post->ofertaPasantia->titulo ?? 'N/A' }}</h4>
                                        <p class="text-xs text-slate-500 font-medium">{{ $post->ofertaPasantia->perfilEmpresa->nombre_empresa ?? '' }} • {{ $post->ofertaPasantia->ubicacion->ciudad ?? '' }}</p>
                                    </div>
                                    @php
                                        $estadoColor = match($post->estado_postulacion_id) {
                                            1 => 'bg-amber-50 text-amber-700',
                                            2 => 'bg-blue-50 text-blue-700',
                                            3 => 'bg-purple-50 text-purple-700',
                                            4 => 'bg-green-50 text-green-700',
                                            5 => 'bg-red-50 text-red-700',
                                            default => 'bg-slate-50 text-slate-700',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 {{ $estadoColor }} font-bold rounded-full text-xs">
                                        {{ $post->estadoPostulacion->nombre ?? 'Pendiente' }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-slate-400 text-center py-4">Aún no te has postulado a ninguna oferta.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-6 rounded-[2rem] text-white space-y-4">
                        <div>
                            <div class="flex items-center gap-2 text-blue-400 font-extrabold uppercase text-xs tracking-wider">
                                <i data-lucide="cpu" class="w-4 h-4"></i> UWorkFlow
                            </div>
                            <h3 class="text-xl font-bold mt-2 tracking-tight">Encuentra la pasantía ideal</h3>
                            <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                Hay <b>{{ $ofertas_disponibles->count() }}</b> ofertas disponibles esperando por ti.
                                Revisa las oportunidades y postúlate a las que mejor se adapten a tu perfil.
                            </p>
                        </div>
                        <a href="{{ route('explora') }}" class="block w-full py-3 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition text-center">
                            Explorar Ofertas
                        </a>
                    </div>
                </section>

                {{-- Mis Postulaciones --}}
                <section id="postulaciones" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Historial de Postulaciones</h2>
                    <div class="space-y-4">
                        @forelse($postulaciones as $post)
                            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-{{ $post->estado_postulacion_id == 4 ? 'green' : ($post->estado_postulacion_id == 5 ? 'red' : 'blue') }}-50 text-{{ $post->estado_postulacion_id == 4 ? 'green' : ($post->estado_postulacion_id == 5 ? 'red' : 'blue') }}-600 rounded-xl flex items-center justify-center">
                                        <i data-lucide="{{ $post->estado_postulacion_id == 4 ? 'check-circle' : ($post->estado_postulacion_id == 5 ? 'x-circle' : 'clock') }}" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900">{{ $post->ofertaPasantia->titulo ?? 'N/A' }}</h3>
                                        <p class="text-xs text-slate-400 font-bold">
                                            {{ $post->ofertaPasantia->perfilEmpresa->nombre_empresa ?? '' }} •
                                            <span class="text-blue-600">{{ $post->ofertaPasantia->ubicacion->ciudad ?? '' }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                                    <span class="px-3 py-1 bg-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : ($post->estado_postulacion_id == 5 ? 'red' : 'blue')) }}-50 text-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : ($post->estado_postulacion_id == 5 ? 'red' : 'blue')) }}-700 font-bold rounded-full text-xs">
                                        {{ $post->estadoPostulacion->nombre ?? 'Pendiente' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm text-center">
                                <i data-lucide="send" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                                <h3 class="font-bold text-slate-500">No tienes postulaciones</h3>
                                <p class="text-sm text-slate-400 mt-1">Explora las ofertas disponibles y postúlate.</p>
                                <a href="{{ route('explora') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl text-sm hover:bg-blue-700 transition">Explorar Ofertas</a>
                            </div>
                        @endforelse
                    </div>
                </section>

                {{-- Ofertas Disponibles --}}
                <section id="ofertas" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Ofertas de Pasantía Disponibles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($ofertas_disponibles as $oferta)
                            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm card-neo flex flex-col justify-between">
                                <div>
                                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-3">
                                        <i data-lucide="briefcase" class="w-6 h-6"></i>
                                    </div>
                                    <h3 class="font-bold text-slate-900 text-lg">{{ $oferta->titulo }}</h3>
                                    <p class="text-xs text-slate-500 mt-1 font-medium">
                                        {{ $oferta->perfilEmpresa->nombre_empresa ?? '' }} • {{ $oferta->ubicacion->ciudad ?? '' }}
                                    </p>
                                    @if($oferta->descripcion)
                                        <p class="text-sm text-slate-500 mt-3">{{ Str::limit($oferta->descripcion, 120) }}</p>
                                    @endif
                                </div>
                                <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center">
                                    <span class="text-xs text-slate-400">
                                        @if($oferta->fecha_inicio)
                                            {{ \Carbon\Carbon::parse($oferta->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($oferta->fecha_fin)->format('d/m/Y') }}
                                        @endif
                                    </span>
                                    <a href="{{ route('pasantia.show', $oferta->id) }}" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-xl text-xs hover:bg-blue-700 transition">Ver Oferta</a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm text-center">
                                <i data-lucide="briefcase" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                                <h3 class="font-bold text-slate-500">No hay ofertas disponibles</h3>
                                <p class="text-sm text-slate-400 mt-1">Vuelve más tarde para encontrar nuevas oportunidades.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                {{-- Mi Perfil --}}
                <section id="perfil" class="tab-content space-y-6">
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold text-slate-900">Mi Perfil Académico</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Información de tu perfil de estudiante.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <div class="space-y-6 text-sm font-semibold">
                            <div class="flex items-center gap-6 pb-6 border-b border-slate-100">
                                <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-md">
                                    {{ strtoupper(substr($estudiante->usuario->nombre ?? '?', 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $estudiante->usuario->nombre ?? 'N/A' }}</h3>
                                    <p class="text-xs text-slate-400">{{ $estudiante->usuario->correo ?? '' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Universidad</label>
                                    <p class="font-bold text-slate-900">{{ $estudiante->universidad ?? 'No especificada' }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Carrera</label>
                                    <p class="font-bold text-slate-900">{{ $estudiante->carrera ?? 'No especificada' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Año de Graduación</label>
                                    <p class="font-bold text-slate-900">{{ $estudiante->anio_graduacion ?? 'No especificado' }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Correo Electrónico</label>
                                    <p class="font-bold text-slate-900">{{ $estudiante->usuario->correo ?? 'N/A' }}</p>
                                </div>
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

        const tabsMap = {
            'inicio': document.getElementById('inicio'),
            'postulaciones': document.getElementById('postulaciones'),
            'ofertas': document.getElementById('ofertas'),
            'perfil': document.getElementById('perfil')
        };
        const tabButtons = document.querySelectorAll('.tab-btn');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.getAttribute('data-tab');
                tabButtons.forEach(b => {
                    b.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                    b.classList.add('text-slate-600', 'hover:bg-slate-100');
                    b.classList.remove('font-bold');
                    b.classList.add('font-semibold');
                });
                btn.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.remove('text-slate-600', 'hover:bg-slate-100');
                btn.classList.add('font-bold');
                btn.classList.remove('font-semibold');

                Object.values(tabsMap).forEach(section => section.classList.remove('active'));
                if (tabsMap[targetTab]) tabsMap[targetTab].classList.add('active');
            });
        });
    </script>
</body>
</html>
