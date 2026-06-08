<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Empresa | UWorkFlow</title>
    <link rel="icon" href="{{ asset('empresa.ico') }}">
    @vite('resources/css/app.css')
    <style>
        .selector-carrera-item:hover, .selector-habilidad-item:hover { border-color: #818cf8 !important; }
        #selector-carrera-lista::-webkit-scrollbar, #selector-habilidad-lista::-webkit-scrollbar { width: 6px; }
        #selector-carrera-lista::-webkit-scrollbar-thumb, #selector-habilidad-lista::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .card-neo { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(226, 232, 240, 0.8); }
        .card-neo:hover { transform: translateY(-4px); box-shadow: 0 12px 20px -5px rgba(43, 109, 242, 0.08); }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .input-error { border-color: #ef4444 !important; background-color: #fef2f2 !important; }
        .error-text { color: #ef4444; font-size: 11px; font-weight: 600; margin-top: 4px; display: none; }
        .error-text.visible { display: block; }
    </style>
</head>
<body class="text-[#0f172a] overflow-x-hidden min-h-screen flex flex-col justify-between">
    @include('componentes.navbar')

    @if(session('success'))
        <div class="max-w-[1400px] mx-auto px-[8%] pt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-[1400px] mx-auto px-[8%] pt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main class="flex-1 max-w-[1400px] w-full mx-auto px-[8%] py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="lg:w-64 flex flex-col gap-2">
                <button data-tab="inicio" class="tab-btn active flex items-center gap-3 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all text-left text-sm w-full">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Panel de Control
                </button>
                <button data-tab="ofertas" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                    Gestionar Ofertas
                    <span class="ml-auto bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-full font-bold">{{ $ofertas->count() }}</span>
                </button>
                <button data-tab="postulantes" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Candidatos / Postulantes
                    <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full font-bold">{{ $total_postulantes }}</span>
                </button>
                <button data-tab="perfil" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                    Perfil de Empresa
                </button>
                <div class="h-px bg-slate-200 my-4"></div>
                <button onclick="openModalCrear()" class="flex items-center justify-center gap-2 px-5 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition-all text-sm w-full shadow-md shadow-indigo-100">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    Publicar Vacante
                </button>
            </aside>

            <div class="flex-1">
                {{-- Panel de Control --}}
                <section id="inicio" class="tab-content active space-y-8">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Bienvenido, {{ $empresa->nombre_empresa }} 🏢</h1>
                            <p class="text-sm text-slate-500 mt-1">Sector: {{ $empresa->industria ?? 'No especificado' }}</p>
                        </div>
                        <span class="px-4 py-2 bg-green-50 text-green-700 font-extrabold rounded-xl text-xs border border-green-200/50">
                            {{ $empresa->verificada ? 'Verificada' : 'Pendiente de verificación' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="briefcase" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">{{ $ofertas->count() }}</h3>
                                <p class="text-sm font-semibold text-slate-400">Ofertas Publicadas</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center"><i data-lucide="users" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">{{ $total_postulantes }}</h3>
                                <p class="text-sm font-semibold text-slate-400">Postulantes Recibidos</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center"><i data-lucide="check-circle" class="w-6 h-6"></i></div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">{{ $ofertas->filter(fn($o) => $o->estado_publicacion_id == 2)->count() }}</h3>
                                <p class="text-sm font-semibold text-slate-400">Ofertas Activas</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-7 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                        <h3 class="font-bold text-slate-900 text-lg">Últimas Postulaciones Recibidas</h3>
                        <div class="divide-y divide-slate-100">
                            @forelse($postulaciones_recientes as $post)
                                <div class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center font-bold text-xs text-slate-700">
                                            {{ strtoupper(substr($post->perfilEstudiante->usuario->nombre ?? '?', 0, 2)) }}
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">{{ $post->perfilEstudiante->usuario->nombre ?? 'N/A' }}</h4>
                                            <p class="text-xs text-slate-400">{{ $post->perfilEstudiante->carrera ?? '' }} • {{ $post->ofertaPasantia->titulo ?? '' }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs bg-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : 'blue') }}-50 text-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : 'blue') }}-700 px-2.5 py-1 rounded-full font-bold">
                                        {{ $post->estadoPostulacion->nombre ?? 'Pendiente' }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-slate-400 py-4 text-center">Aún no has recibido postulaciones.</p>
                            @endforelse
                        </div>
                    </div>
                </section>

                {{-- Gestionar Ofertas --}}
                <section id="ofertas" class="tab-content space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900">Mis Ofertas de Pasantía</h2>
                        <button onclick="openModalCrear()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition shadow-md">
                            <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>Nueva Oferta
                        </button>
                    </div>

                    <div class="space-y-4">
                        @forelse($ofertas as $oferta)
                            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm card-neo">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                                            <i data-lucide="briefcase" class="w-6 h-6"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-900 text-lg">{{ $oferta->titulo }}</h3>
                                            <p class="text-xs text-slate-400 font-bold">
                                                {{ $oferta->ubicacion->ciudad ?? 'Remoto' }} •
                                                {{ $oferta->modalidad ?? 'Presencial' }} •
                                                <span class="text-{{ $oferta->estado_publicacion_id == 2 ? 'green' : 'gray' }}-600">
                                                    {{ $oferta->estadoPublicacion->nombre ?? 'Borrador' }}
                                                </span>
                                                @if($oferta->fecha_inicio)
                                                    • {{ \Carbon\Carbon::parse($oferta->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($oferta->fecha_fin)->format('d/m/Y') }}
                                                @endif
                                            </p>
                                            <p class="text-[10px] text-slate-400 mt-0.5">
                                                @if($oferta->vacantes_disponibles) {{ $oferta->vacantes_disponibles }} vacante(s) • @endif
                                                @if($oferta->duracion_semanas) {{ $oferta->duracion_semanas }} semanas @endif
                                                @if($oferta->carrera) • {{ $oferta->carrera }} @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                                        <button onclick="openModalEditar({{ $oferta->id }})" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition" title="Editar">
                                            <i data-lucide="edit-2" class="w-5 h-5"></i>
                                        </button>
                                        <form action="{{ route('company.ofertas.eliminar', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta oferta?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition" title="Eliminar">
                                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if($oferta->descripcion)
                                    <p class="text-sm text-slate-500 mt-3 ml-16">{{ Str::limit($oferta->descripcion, 150) }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm text-center">
                                <i data-lucide="briefcase" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                                <h3 class="font-bold text-slate-500">No tienes ofertas publicadas</h3>
                                <p class="text-sm text-slate-400 mt-1">Crea tu primera oferta para recibir postulaciones.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                {{-- Postulantes --}}
                <section id="postulantes" class="tab-content space-y-6">
                    <h2 class="text-xl font-bold text-slate-900">Postulantes Recibidos</h2>
                    @if($todas_postulaciones->count() > 0)
                        <div class="space-y-4">
                            @foreach($todas_postulaciones as $post)
                                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                                    <div class="p-5">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-sm text-slate-700">
                                                    {{ strtoupper(substr($post->perfilEstudiante->usuario->nombre ?? '?', 0, 2)) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-slate-900">{{ $post->perfilEstudiante->usuario->nombre ?? 'N/A' }}</h4>
                                                    <p class="text-xs text-slate-400">{{ $post->perfilEstudiante->carrera ?? 'N/A' }} - {{ $post->perfilEstudiante->universidad ?? '' }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                @if($post->puntaje_topsis !== null)
                                                    <div class="px-3 py-1.5 bg-indigo-50 text-indigo-700 font-extrabold rounded-xl text-xs flex items-center gap-1.5">
                                                        <i data-lucide="trophy" class="w-3.5 h-3.5"></i>
                                                        TOPSIS: {{ $post->puntaje_topsis }}%
                                                    </div>
                                                @endif
                                                <form action="{{ route('company.postulaciones.estado', $post->id) }}" method="POST" class="flex items-center gap-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="estado_postulacion_id" onchange="this.form.submit()" class="text-xs font-bold rounded-full px-2.5 py-1 border-0 cursor-pointer bg-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : 'blue') }}-50 text-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : 'blue') }}-700 outline-none">
                                                        @foreach($estados_postulacion as $estado)
                                                            <option value="{{ $estado->id }}" {{ $post->estado_postulacion_id == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                                <a href="{{ route('company.citatorio', $post->id) }}" target="_blank" class="px-3 py-1.5 bg-indigo-600 text-white font-bold rounded-xl text-xs hover:bg-indigo-700 transition">
                                                    <i data-lucide="file-text" class="w-3.5 h-3.5 inline mr-1"></i>Citatorio
                                                </a>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3 pt-4 border-t border-slate-100">
                                            <div>
                                                <p class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-2">Documentos</p>
                                                @if($post->perfilEstudiante->documentos && $post->perfilEstudiante->documentos->count() > 0)
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($post->perfilEstudiante->documentos as $doc)
                                                            <a href="{{ route('documentos.ver', $doc->id) }}" target="_blank"
                                                               class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-semibold transition">
                                                                <i data-lucide="file" class="w-3 h-3"></i>
                                                                {{ $doc->tipoDocumento->nombre ?? 'Documento' }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-xs text-slate-400">Sin documentos</p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-2">Habilidades</p>
                                                @if($post->perfilEstudiante->habilidades && $post->perfilEstudiante->habilidades->count() > 0)
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($post->perfilEstudiante->habilidades as $hab)
                                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-semibold">
                                                                <i data-lucide="code" class="w-3 h-3"></i>
                                                                {{ $hab->habilidad->nombre ?? 'Habilidad' }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-xs text-slate-400">Sin habilidades registradas</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-3 pt-3 border-t border-slate-100">
                                            <p class="text-xs text-slate-400">
                                                Oferta: <span class="font-semibold text-slate-600">{{ $post->ofertaPasantia->titulo ?? 'N/A' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm text-center">
                            <i data-lucide="users" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                            <h3 class="font-bold text-slate-500">No hay postulaciones aún</h3>
                            <p class="text-sm text-slate-400 mt-1">Los estudiantes postularán a tus ofertas y aparecerán aquí.</p>
                        </div>
                    @endif
                </section>

                {{-- Perfil de Empresa --}}
                <section id="perfil" class="tab-content space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Perfil de la Empresa</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Información de tu organización.</p>
                        </div>
                        <button onclick="openModalEditarPerfil()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition shadow-md flex items-center gap-1.5">
                            <i data-lucide="edit-3" class="w-4 h-4"></i> Editar Perfil
                        </button>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <div class="space-y-6 text-sm font-semibold">
                            <div class="flex items-center gap-6 pb-6 border-b border-slate-100">
                                <div class="w-20 h-20 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-md">
                                    {{ strtoupper(substr($empresa->nombre_empresa, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $empresa->nombre_empresa }}</h3>
                                    <p class="text-xs text-slate-400">{{ $empresa->industria ?? 'Industria no especificada' }}</p>
                                    @if($empresa->tamano_empresa)
                                        <span class="inline-block mt-1 px-2.5 py-0.5 bg-blue-50 text-blue-700 rounded-full text-[10px] font-extrabold">{{ $empresa->tamano_empresa }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Nombre de la Empresa</label>
                                    <p class="font-bold text-slate-900">{{ $empresa->nombre_empresa }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Industria / Sector</label>
                                    <p class="font-bold text-slate-900">{{ $empresa->industria ?? 'No especificado' }}</p>
                                </div>
                            </div>

                            @if($empresa->descripcion)
                            <div>
                                <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Acerca de la Empresa</label>
                                <p class="text-sm font-medium text-slate-700 leading-relaxed">{{ $empresa->descripcion }}</p>
                            </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Teléfono</label>
                                    <p class="font-bold text-slate-900">{{ $empresa->telefono ?? 'No registrado' }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Dirección</label>
                                    <p class="font-bold text-slate-900">{{ $empresa->direccion ?? 'No registrada' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Correo de Contacto</label>
                                    <p class="font-bold text-slate-900">{{ $empresa->usuario->correo ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Sitio Web</label>
                                    @if($empresa->sitio_web)
                                        <a href="{{ $empresa->sitio_web }}" target="_blank" class="font-bold text-blue-600 hover:underline">{{ $empresa->sitio_web }}</a>
                                    @else
                                        <p class="font-bold text-slate-400">No registrado</p>
                                    @endif
                                </div>
                                <div>
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Año de Fundación</label>
                                    <p class="font-bold text-slate-900">{{ $empresa->anio_fundacion ?? 'No registrado' }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider block mb-1">Estado de Verificación</label>
                                @if($empresa->verificada)
                                    <span class="px-3 py-1 bg-green-50 text-green-700 font-bold rounded-full text-xs">Verificada</span>
                                @else
                                    <span class="px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-full text-xs">Pendiente</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    {{-- Modal Crear Oferta --}}
    <div id="modal-crear-oferta" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Nueva Oferta de Pasantía</h3>
                <button onclick="closeModalCrear()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <form action="{{ route('company.ofertas.guardar') }}" method="POST" class="space-y-4 text-sm font-semibold" onsubmit="return validarFormCrear()">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Título del Puesto</label>
                    <input type="text" name="titulo" id="crear-titulo" required placeholder="Ej. Pasante Laravel Backend" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    <div class="error-text" id="crear-titulo-error">El título es obligatorio</div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Descripción</label>
                    <textarea name="descripcion" id="crear-descripcion" rows="4" required placeholder="Describe las responsabilidades y requisitos..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                    <div class="error-text" id="crear-descripcion-error">La descripción es obligatoria</div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Modalidad</label>
                        <select name="modalidad" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            @foreach($modalidades as $modalidad)
                                <option value="{{ $modalidad }}">{{ $modalidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Carrera afín</label>
                        <input type="hidden" name="carrera" id="crear-carrera" value="">
                        <button type="button" onclick="abrirSelectorCarrera('crear-carrera', 'crear-carrera-trigger')"
                            id="crear-carrera-trigger"
                            class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-left text-sm font-semibold text-slate-500 hover:border-indigo-400 transition flex items-center justify-between gap-2">
                            <span id="crear-carrera-texto">Todas las carreras</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 shrink-0"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Ubicación</label>
                        <select name="ubicacion_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            @foreach(\App\Models\Ubicacion::all() as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->ciudad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Estado</label>
                        <select name="estado_publicacion_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            @foreach(\App\Models\EstadoPublicacion::all() as $estado)
                                <option value="{{ $estado->id }}" {{ $estado->nombre == 'abierta' ? 'selected' : '' }}>{{ ucfirst($estado->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Vacantes Disponibles</label>
                        <input type="number" name="vacantes_disponibles" id="crear-vacantes" min="1" max="999" value="1"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Duración (semanas)</label>
                        <input type="number" name="duracion_semanas" id="crear-duracion" min="1" max="156" placeholder="Ej. 12"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="crear-fecha_inicio" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                        <div class="error-text" id="crear-fecha_inicio-error">La fecha de inicio es obligatoria</div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="crear-fecha_fin" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                        <div class="error-text" id="crear-fecha_fin-error">La fecha de fin es obligatoria y debe ser posterior a la de inicio</div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Requisitos Específicos</label>
                    <textarea name="requisitos" id="crear-requisitos" rows="3" placeholder="Ej. Conocimientos en Laravel, disponibilidad para viajar..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Beneficios / Ofrecemos</label>
                    <textarea name="beneficios" id="crear-beneficios" rows="3" placeholder="Ej. Certificado, experiencia laboral, horario flexible..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                {{-- Habilidades Requeridas (TOPSIS) --}}
                <div class="border-t border-slate-200 pt-4">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                            <i data-lucide="code" class="w-4 h-4"></i> Habilidades Requeridas (Criterios TOPSIS)
                        </label>
                        <button type="button" onclick="agregarFilaHabilidad('crear')" class="px-3 py-1.5 bg-indigo-50 text-indigo-700 font-bold rounded-lg text-xs hover:bg-indigo-100 transition">
                            <i data-lucide="plus" class="w-3.5 h-3.5 inline mr-0.5"></i>Agregar
                        </button>
                    </div>
                    <div id="crear-habilidades-container">
                        <div class="text-xs text-slate-400 text-center py-3" id="crear-habilidades-empty">
                            No hay habilidades agregadas. Haz clic en "Agregar" para añadir criterios TOPSIS.
                        </div>
                    </div>
                    <div class="error-text" id="crear-habilidades-error">Agrega al menos una habilidad requerida</div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalCrear()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">Publicar Oferta</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Editar Oferta --}}
    <div id="modal-editar-oferta" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Editar Oferta</h3>
                <button onclick="closeModalEditar()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <form id="form-editar-oferta" method="POST" class="space-y-4 text-sm font-semibold" onsubmit="return validarFormEditar()">
                @csrf
                @method('PUT')
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Título del Puesto</label>
                    <input type="text" name="titulo" id="edit-titulo" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    <div class="error-text" id="edit-titulo-error">El título es obligatorio</div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Descripción</label>
                    <textarea name="descripcion" id="edit-descripcion" rows="4" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                    <div class="error-text" id="edit-descripcion-error">La descripción es obligatoria</div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Modalidad</label>
                        <select name="modalidad" id="edit-modalidad" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            @foreach($modalidades as $modalidad)
                                <option value="{{ $modalidad }}">{{ $modalidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Carrera afín</label>
                        <input type="hidden" name="carrera" id="edit-carrera" value="">
                        <button type="button" onclick="abrirSelectorCarrera('edit-carrera', 'edit-carrera-trigger')"
                            id="edit-carrera-trigger"
                            class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-left text-sm font-semibold text-slate-500 hover:border-indigo-400 transition flex items-center justify-between gap-2">
                            <span id="edit-carrera-texto">Todas las carreras</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 shrink-0"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Ubicación</label>
                        <select name="ubicacion_id" id="edit-ubicacion_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            @foreach(\App\Models\Ubicacion::all() as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->ciudad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="edit-fecha_inicio" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                        <div class="error-text" id="edit-fecha_inicio-error">La fecha de inicio es obligatoria</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="edit-fecha_fin" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                        <div class="error-text" id="edit-fecha_fin-error">La fecha de fin debe ser posterior a la de inicio</div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Vacantes</label>
                        <input type="number" name="vacantes_disponibles" id="edit-vacantes" min="1" max="999"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Duración (semanas)</label>
                    <input type="number" name="duracion_semanas" id="edit-duracion" min="1" max="156" placeholder="Ej. 12"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Requisitos Específicos</label>
                    <textarea name="requisitos" id="edit-requisitos" rows="3" placeholder="Ej. Conocimientos en Laravel, disponibilidad para viajar..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Beneficios / Ofrecemos</label>
                    <textarea name="beneficios" id="edit-beneficios" rows="3" placeholder="Ej. Certificado, experiencia laboral, horario flexible..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                {{-- Habilidades Requeridas (TOPSIS) --}}
                <div class="border-t border-slate-200 pt-4">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1">
                            <i data-lucide="code" class="w-4 h-4"></i> Habilidades Requeridas (Criterios TOPSIS)
                        </label>
                        <button type="button" onclick="agregarFilaHabilidad('edit')" class="px-3 py-1.5 bg-indigo-50 text-indigo-700 font-bold rounded-lg text-xs hover:bg-indigo-100 transition">
                            <i data-lucide="plus" class="w-3.5 h-3.5 inline mr-0.5"></i>Agregar
                        </button>
                    </div>
                    <div id="edit-habilidades-container">
                        <div class="text-xs text-slate-400 text-center py-3" id="edit-habilidades-empty">
                            No hay habilidades agregadas. Haz clic en "Agregar" para añadir criterios TOPSIS.
                        </div>
                    </div>
                    <div class="error-text" id="edit-habilidades-error">Agrega al menos una habilidad requerida</div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalEditar()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Editar Perfil de Empresa --}}
    <div id="modal-editar-perfil" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Editar Perfil de Empresa</h3>
                <button onclick="closeModalEditarPerfil()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <form action="{{ route('company.perfil.actualizar') }}" method="POST" class="space-y-4 text-sm font-semibold">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Nombre de la Empresa</label>
                        <input type="text" name="nombre_empresa" id="perfil-nombre" value="{{ $empresa->nombre_empresa }}" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Industria / Sector</label>
                        <input type="text" name="industria" id="perfil-industria" value="{{ $empresa->industria }}" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Acerca de la Empresa</label>
                    <textarea name="descripcion" id="perfil-descripcion" rows="4"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none">{{ $empresa->descripcion }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Teléfono</label>
                        <input type="text" name="telefono" id="perfil-telefono" value="{{ $empresa->telefono }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Tamaño de Empresa</label>
                        <select name="tamano_empresa"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            <option value="">Seleccionar...</option>
                            <option value="Pequeña" {{ $empresa->tamano_empresa == 'Pequeña' ? 'selected' : '' }}>Pequeña (1-50 empleados)</option>
                            <option value="Mediana" {{ $empresa->tamano_empresa == 'Mediana' ? 'selected' : '' }}>Mediana (51-250 empleados)</option>
                            <option value="Grande" {{ $empresa->tamano_empresa == 'Grande' ? 'selected' : '' }}>Grande (251+ empleados)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Dirección</label>
                        <input type="text" name="direccion" id="perfil-direccion" value="{{ $empresa->direccion }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Año de Fundación</label>
                        <input type="number" name="anio_fundacion" id="perfil-anio" value="{{ $empresa->anio_fundacion }}" min="1800" max="{{ date('Y') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Sitio Web</label>
                        <input type="url" name="sitio_web" id="perfil-sitio" value="{{ $empresa->sitio_web }}" placeholder="https://ejemplo.com"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Correo de Contacto</label>
                        <input type="email" value="{{ $empresa->usuario->correo ?? '' }}" disabled
                            class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed font-medium">
                        <p class="text-[10px] text-slate-400 mt-0.5">El correo se gestiona desde la configuración de la cuenta.</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalEditarPerfil()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    @include('componentes.footer')

    {{-- Modal selector grande de habilidades (compartido para todas las filas) --}}
    <div id="modal-selector-habilidad" class="fixed inset-0 bg-[#0d121f]/50 backdrop-blur-sm z-[60] flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-3xl mx-4 rounded-2xl shadow-2xl border border-slate-100 max-h-[85vh] flex flex-col">
            <div class="flex items-center justify-between p-5 border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-900">Seleccionar Habilidad</h3>
                <button onclick="cerrarSelectorHabilidad()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="p-4 border-b border-slate-100">
                <input type="text" id="selector-habilidad-buscar" placeholder="Buscar habilidad..." oninput="filtrarHabilidades()"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-indigo-400 transition">
            </div>
            <div id="selector-habilidad-lista" class="flex-1 overflow-y-auto p-4 grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach($habilidades as $hab)
                    <button type="button" class="selector-habilidad-item px-4 py-3 rounded-xl text-left text-sm font-semibold border-2 transition hover:bg-indigo-50 hover:border-indigo-300 border-slate-200 text-slate-600" data-value="{{ $hab->id }}">{{ $hab->nombre }}</button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal selector grande de carreras --}}
    <div id="modal-selector-carrera" class="fixed inset-0 bg-[#0d121f]/50 backdrop-blur-sm z-[60] flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-3xl mx-4 rounded-2xl shadow-2xl border border-slate-100 max-h-[85vh] flex flex-col">
            <div class="flex items-center justify-between p-5 border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-900">Seleccionar Carrera</h3>
                <button onclick="cerrarSelectorCarrera()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="p-4 border-b border-slate-100">
                <input type="text" id="selector-carrera-buscar" placeholder="Buscar carrera..." oninput="filtrarCarreras()"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-indigo-400 transition">
            </div>
            <div id="selector-carrera-lista" class="flex-1 overflow-y-auto p-4 grid grid-cols-2 md:grid-cols-3 gap-2">
                <button type="button" class="selector-carrera-item px-4 py-3 rounded-xl text-left text-sm font-semibold border-2 transition hover:bg-indigo-50 hover:border-indigo-300 border-slate-200 text-slate-600" data-value="">Todas las carreras</button>
                @foreach($carreras as $carrera)
                    <button type="button" class="selector-carrera-item px-4 py-3 rounded-xl text-left text-sm font-semibold border-2 transition hover:bg-indigo-50 hover:border-indigo-300 border-slate-200 text-slate-600" data-value="{{ $carrera }}">{{ $carrera }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const tabsMap = {
            'inicio': document.getElementById('inicio'),
            'ofertas': document.getElementById('ofertas'),
            'postulantes': document.getElementById('postulantes'),
            'perfil': document.getElementById('perfil')
        };
        const tabButtons = document.querySelectorAll('.tab-btn');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.getAttribute('data-tab');
                tabButtons.forEach(b => {
                    b.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                    b.classList.add('text-slate-600', 'hover:bg-slate-100');
                    b.classList.replace('font-bold', 'font-semibold');
                });
                btn.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
                btn.classList.remove('text-slate-600', 'hover:bg-slate-100');
                btn.classList.replace('font-semibold', 'font-bold');

                Object.values(tabsMap).forEach(section => section.classList.remove('active'));
                if (tabsMap[targetTab]) tabsMap[targetTab].classList.add('active');
            });
        });

        // Modal Editar Perfil
        const modalPerfil = document.getElementById('modal-editar-perfil');
        function openModalEditarPerfil() { modalPerfil.classList.remove('hidden'); }
        function closeModalEditarPerfil() { modalPerfil.classList.add('hidden'); }

        // Modal Crear
        const modalCrear = document.getElementById('modal-crear-oferta');
        function openModalCrear() {
            modalCrear.classList.remove('hidden');
            document.getElementById('crear-habilidades-container').innerHTML = '<div class="text-xs text-slate-400 text-center py-3" id="crear-habilidades-empty">No hay habilidades agregadas. Haz clic en "Agregar" para añadir criterios TOPSIS.</div>';
            limpiarErrores('crear');
        }
        function closeModalCrear() {
            modalCrear.classList.add('hidden');
            limpiarErrores('crear');
        }

        // Modal Editar
        const modalEditar = document.getElementById('modal-editar-oferta');
        function openModalEditar(id) {
            fetch('/api/ofertas/' + id)
                .then(r => r.json())
                .then(data => {
                    document.getElementById('edit-titulo').value = data.titulo;
                    document.getElementById('edit-descripcion').value = data.descripcion;
                    document.getElementById('edit-modalidad').value = data.modalidad || 'Presencial';
                    document.getElementById('edit-carrera').value = data.carrera || '';
                    document.getElementById('edit-carrera-texto').textContent = data.carrera || 'Todas las carreras';
                    document.getElementById('edit-ubicacion_id').value = data.ubicacion_id;
                    document.getElementById('edit-fecha_inicio').value = data.fecha_inicio;
                    document.getElementById('edit-fecha_fin').value = data.fecha_fin;
                    document.getElementById('edit-vacantes').value = data.vacantes_disponibles || 1;
                    document.getElementById('edit-duracion').value = data.duracion_semanas || '';
                    document.getElementById('edit-requisitos').value = data.requisitos || '';
                    document.getElementById('edit-beneficios').value = data.beneficios || '';
                    document.getElementById('form-editar-oferta').action = '/company/ofertas/' + id + '/actualizar';

                    const container = document.getElementById('edit-habilidades-container');
                    container.innerHTML = '';
                    if (data.requisitos_habilidad && data.requisitos_habilidad.length > 0) {
                        data.requisitos_habilidad.forEach(req => {
                            agregarFilaHabilidad('edit', req);
                        });
                    } else {
                        container.innerHTML = '<div class="text-xs text-slate-400 text-center py-3" id="edit-habilidades-empty">No hay habilidades agregadas. Haz clic en "Agregar" para añadir criterios TOPSIS.</div>';
                    }
                    modalEditar.classList.remove('hidden');
                    limpiarErrores('edit');
                });
        }
        function closeModalEditar() {
            modalEditar.classList.add('hidden');
            limpiarErrores('edit');
        }

        // ─── SELECTOR GRANDE DE CARRERAS ───
        let selectorCarreraHiddenId = null;
        let selectorCarreraTriggerId = null;

        function abrirSelectorCarrera(hiddenId, triggerId) {
            selectorCarreraHiddenId = hiddenId;
            selectorCarreraTriggerId = triggerId;
            const modal = document.getElementById('modal-selector-carrera');
            modal.classList.remove('hidden');
            document.getElementById('selector-carrera-buscar').value = '';
            document.querySelectorAll('.selector-carrera-item').forEach(item => {
                item.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600');
                item.classList.add('border-slate-200', 'text-slate-600');
                if (item.dataset.value === document.getElementById(hiddenId).value) {
                    item.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');
                    item.classList.remove('border-slate-200', 'text-slate-600');
                }
                item.style.display = '';
            });
        }

        function cerrarSelectorCarrera() {
            document.getElementById('modal-selector-carrera').classList.add('hidden');
        }

        function filtrarCarreras() {
            const q = document.getElementById('selector-carrera-buscar').value.toLowerCase();
            document.querySelectorAll('.selector-carrera-item').forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        }

        document.addEventListener('click', function (e) {
            const item = e.target.closest('.selector-carrera-item');
            if (item) {
                const hidden = document.getElementById(selectorCarreraHiddenId);
                const trigger = document.getElementById(selectorCarreraTriggerId);
                hidden.value = item.dataset.value;
                const texto = trigger.querySelector('span');
                texto.textContent = item.dataset.value || 'Todas las carreras';
                cerrarSelectorCarrera();
            }
            const modal = document.getElementById('modal-selector-carrera');
            if (e.target === modal) cerrarSelectorCarrera();
        });

        // ─── SELECTOR GRANDE DE HABILIDADES ───
        function abrirSelectorHabilidad(btn) {
            const container = btn.closest('.fila-habilidad');
            const hidden = container.querySelector('input[type="hidden"][name*="[habilidad_id]"]');
            const modal = document.getElementById('modal-selector-habilidad');
            modal._targetHidden = hidden;
            modal._targetBtn = btn;
            modal.classList.remove('hidden');
            document.getElementById('selector-habilidad-buscar').value = '';
            document.querySelectorAll('.selector-habilidad-item').forEach(item => {
                item.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600');
                item.classList.add('border-slate-200', 'text-slate-600');
                if (item.dataset.value === (hidden ? hidden.value : '')) {
                    item.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');
                    item.classList.remove('border-slate-200', 'text-slate-600');
                }
                item.style.display = '';
            });
        }

        function cerrarSelectorHabilidad() {
            document.getElementById('modal-selector-habilidad').classList.add('hidden');
        }

        function filtrarHabilidades() {
            const q = document.getElementById('selector-habilidad-buscar').value.toLowerCase();
            document.querySelectorAll('.selector-habilidad-item').forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        }

        document.addEventListener('click', function (e) {
            const item = e.target.closest('.selector-habilidad-item');
            if (item) {
                const modal = document.getElementById('modal-selector-habilidad');
                const hidden = modal._targetHidden;
                const btn = modal._targetBtn;
                if (hidden) hidden.value = item.dataset.value;
                if (btn) {
                    const texto = btn.querySelector('.skill-texto');
                    if (texto) texto.textContent = item.textContent;
                    btn.classList.remove('text-slate-500');
                    btn.classList.add('text-slate-800');
                }
                cerrarSelectorHabilidad();
            }
            const modal = document.getElementById('modal-selector-habilidad');
            if (e.target === modal) cerrarSelectorHabilidad();
        });

        // ─── HABILIDADES DINÁMICAS (TOPSIS) ───
        const habilidadesData = @json($habilidades);

        function agregarFilaHabilidad(prefix, data) {
            const container = document.getElementById(prefix + '-habilidades-container');
            const empty = container.querySelector('#' + prefix + '-habilidades-empty');
            if (empty) empty.remove();

            const index = container.querySelectorAll('.fila-habilidad').length;
            const div = document.createElement('div');
            div.className = 'fila-habilidad bg-slate-50 rounded-xl p-3 mb-2 border border-slate-200';
            div.dataset.index = index;

            const skillNombre = data ? (habilidadesData.find(h => h.id == data.habilidad_id)?.nombre || 'Seleccionar habilidad') : 'Seleccionar habilidad';

            div.innerHTML = `
                <div class="space-y-2">
                    <label class="text-[10px] font-extrabold text-slate-400 uppercase">Habilidad</label>
                    <input type="hidden" name="habilidades[${index}][habilidad_id]" value="${data ? data.habilidad_id : ''}">
                    <button type="button" onclick="abrirSelectorHabilidad(this)"
                        class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-left text-sm font-semibold ${data ? 'text-slate-800' : 'text-slate-500'} hover:border-indigo-400 transition flex items-center justify-between gap-2">
                        <span class="skill-texto">${skillNombre}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    </button>
                    <div class="flex items-start gap-2">
                        <div class="w-28 space-y-1.5">
                            <label class="text-[10px] font-extrabold text-slate-400 uppercase">Nivel Min</label>
                            <select name="habilidades[${index}][nivel_minimo]" required
                                class="w-full px-2 py-2 bg-white border border-slate-200 rounded-lg outline-none focus:border-indigo-400 text-xs font-medium">
                                <option value="1" ${data && data.nivel_minimo == 1 ? 'selected' : ''}>1 - Inexperto</option>
                                <option value="2" ${data && data.nivel_minimo == 2 ? 'selected' : ''}>2 - Básico</option>
                                <option value="3" ${data && data.nivel_minimo == 3 ? 'selected' : ''}>3 - Intermedio</option>
                                <option value="4" ${data && data.nivel_minimo == 4 ? 'selected' : ''}>4 - Alto</option>
                                <option value="5" ${data && data.nivel_minimo == 5 ? 'selected' : ''}>5 - Experto</option>
                            </select>
                        </div>
                        <div class="w-20 space-y-1.5">
                            <label class="text-[10px] font-extrabold text-slate-400 uppercase">Peso (%)</label>
                            <input type="number" name="habilidades[${index}][peso]" min="0" max="100" step="0.1" required value="${data ? data.peso : 50}"
                                class="w-full px-2 py-2 bg-white border border-slate-200 rounded-lg outline-none focus:border-indigo-400 text-xs font-medium text-center">
                        </div>
                        <div class="w-24 space-y-1.5">
                            <label class="text-[10px] font-extrabold text-slate-400 uppercase">Criterio</label>
                            <select name="habilidades[${index}][tipo_criterio]" required
                                class="w-full px-2 py-2 bg-white border border-slate-200 rounded-lg outline-none focus:border-indigo-400 text-xs font-medium">
                                <option value="benefit" ${data && data.tipo_criterio === 'benefit' ? 'selected' : ''}>Beneficio 👍</option>
                                <option value="cost" ${data && data.tipo_criterio === 'cost' ? 'selected' : ''}>Costo 👎</option>
                            </select>
                        </div>
                        <button type="button" onclick="this.closest('.fila-habilidad').remove()"
                            class="mt-5 p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(div);
            const chipContainer = div.querySelector('.chip-skill-container');
            if (chipContainer) initSkillChipSelector(chipContainer);
            lucide.createIcons();
        }

        // ─── VALIDACIÓN DE FORMULARIOS ───
        function mostrarError(inputId, errorId) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);
            if (input) input.classList.add('input-error');
            if (error) error.classList.add('visible');
        }

        function limpiarErrores(prefix) {
            document.querySelectorAll('#' + prefix + '\\-habilidades-container .input-error, #' + prefix + '\\-habilidades-error').forEach(el => {
                if (el.classList) el.classList.remove('visible', 'input-error');
            });
            document.querySelectorAll('[id^="' + prefix + '-"]').forEach(el => {
                el.classList.remove('input-error');
                if (el.classList.contains('error-text')) el.classList.remove('visible');
            });
        }

        function validarCampo(inputId, errorId) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);
            if (!input) return true;
            if (!input.value || input.value.trim() === '') {
                input.classList.add('input-error');
                if (error) error.classList.add('visible');
                return false;
            }
            input.classList.remove('input-error');
            if (error) error.classList.remove('visible');
            return true;
        }

        function validarFechas(prefix) {
            const inicio = document.getElementById(prefix + '-fecha_inicio');
            const fin = document.getElementById(prefix + '-fecha_fin');
            const error = document.getElementById(prefix + '-fecha_fin-error');
            if (!inicio || !fin) return true;
            if (fin.value && inicio.value && fin.value <= inicio.value) {
                fin.classList.add('input-error');
                if (error) error.classList.add('visible');
                return false;
            }
            fin.classList.remove('input-error');
            if (error) error.classList.remove('visible');
            return true;
        }

        function validarHabilidades(prefix) {
            const container = document.getElementById(prefix + '-habilidades-container');
            const error = document.getElementById(prefix + '-habilidades-error');
            const filas = container.querySelectorAll('.fila-habilidad');
            if (filas.length === 0) {
                if (error) error.classList.add('visible');
                return false;
            }
            let valido = true;
            filas.forEach(fila => {
                const hidden = fila.querySelector('input[type="hidden"][name*="[habilidad_id]"]');
                if (hidden && !hidden.value) {
                    fila.querySelector('.chip-skill-container')?.classList.add('input-error');
                    valido = false;
                }
            });
            if (!valido && error) error.classList.add('visible');
            else if (error) error.classList.remove('visible');
            return valido;
        }

        function validarFormCrear() {
            limpiarErrores('crear');
            const valido =
                validarCampo('crear-titulo', 'crear-titulo-error') &&
                validarCampo('crear-descripcion', 'crear-descripcion-error') &&
                validarCampo('crear-fecha_inicio', 'crear-fecha_inicio-error') &&
                validarCampo('crear-fecha_fin', 'crear-fecha_fin-error') &&
                validarFechas('crear') &&
                validarHabilidades('crear');
            if (!valido) {
                document.getElementById('crear-titulo').focus();
                return false;
            }
            return true;
        }

        function validarFormEditar() {
            limpiarErrores('edit');
            const valido =
                validarCampo('edit-titulo', 'edit-titulo-error') &&
                validarCampo('edit-descripcion', 'edit-descripcion-error') &&
                validarCampo('edit-fecha_inicio', 'edit-fecha_inicio-error') &&
                validarCampo('edit-fecha_fin', 'edit-fecha_fin-error') &&
                validarFechas('edit') &&
                validarHabilidades('edit');
            if (!valido) {
                document.getElementById('edit-titulo').focus();
                return false;
            }
            return true;
        }

        // Limpiar errores al escribir
        document.addEventListener('input', function(e) {
            const target = e.target;
            if (target.id && target.id.includes('titulo') || target.id.includes('descripcion') || target.id.includes('fecha')) {
                target.classList.remove('input-error');
                const errorId = target.id + '-error';
                const error = document.getElementById(errorId);
                if (error) error.classList.remove('visible');
            }
        });
    </script>
</body>
</html>
