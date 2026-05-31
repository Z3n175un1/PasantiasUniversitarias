<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Empresa | UWorkFlow</title>
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

    @if(session('success'))
        <div class="max-w-[1400px] mx-auto px-[8%] pt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                {{ session('success') }}
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
                                                <span class="text-{{ $oferta->estado_publicacion_id == 2 ? 'green' : 'gray' }}-600">
                                                    {{ $oferta->estadoPublicacion->nombre ?? 'Borrador' }}
                                                </span>
                                                @if($oferta->fecha_inicio)
                                                    • {{ \Carbon\Carbon::parse($oferta->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($oferta->fecha_fin)->format('d/m/Y') }}
                                                @endif
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
                    @if($postulaciones_recientes->count() > 0)
                        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold uppercase tracking-wider text-slate-400">
                                        <th class="p-5">Estudiante</th>
                                        <th class="p-5">Carrera / Universidad</th>
                                        <th class="p-5">Oferta</th>
                                        <th class="p-5">Estado</th>
                                        <th class="p-5 text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-50">
                                    @foreach($postulaciones_recientes as $post)
                                        <tr>
                                            <td class="p-5 font-bold text-slate-900">{{ $post->perfilEstudiante->usuario->nombre ?? 'N/A' }}</td>
                                            <td class="p-5">
                                                {{ $post->perfilEstudiante->carrera ?? 'N/A' }}<br>
                                                <span class="text-xs text-slate-400">{{ $post->perfilEstudiante->universidad ?? '' }}</span>
                                            </td>
                                            <td class="p-5">{{ $post->ofertaPasantia->titulo ?? 'N/A' }}</td>
                                            <td class="p-5">
                                                <span class="px-2.5 py-1 bg-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : 'blue') }}-50 text-{{ $post->estado_postulacion_id == 1 ? 'amber' : ($post->estado_postulacion_id == 4 ? 'green' : 'blue') }}-700 rounded-full font-bold text-xs">
                                                    {{ $post->estadoPostulacion->nombre ?? 'Pendiente' }}
                                                </span>
                                            </td>
                                            <td class="p-5 text-right">
                                                <a href="{{ route('company.citatorio', $post->id) }}" target="_blank" class="px-3 py-1.5 bg-indigo-600 text-white font-bold rounded-xl text-xs hover:bg-indigo-700 transition">
                                                    <i data-lucide="file-text" class="w-3.5 h-3.5 inline mr-1"></i>Citatorio
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold text-slate-900">Perfil de la Empresa</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Información de tu organización.</p>
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

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

            <form action="{{ route('company.ofertas.guardar') }}" method="POST" class="space-y-4 text-sm font-semibold">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Título del Puesto</label>
                    <input type="text" name="titulo" required placeholder="Ej. Pasante Laravel Backend" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Descripción</label>
                    <textarea name="descripcion" rows="4" required placeholder="Describe las responsabilidades y requisitos..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
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
                                <option value="{{ $estado->id }}">{{ ucfirst($estado->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
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

            <form id="form-editar-oferta" method="POST" class="space-y-4 text-sm font-semibold">
                @csrf
                @method('PUT')
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Título del Puesto</label>
                    <input type="text" name="titulo" id="edit-titulo" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Descripción</label>
                    <textarea name="descripcion" id="edit-descripcion" rows="4" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
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
                    <div class="grid grid-cols-2 gap-2">
                        <div class="space-y-1.5">
                            <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Inicio</label>
                            <input type="date" name="fecha_inicio" id="edit-fecha_inicio" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fin</label>
                            <input type="date" name="fecha_fin" id="edit-fecha_fin" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalEditar()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    @include('componentes.footer')

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

        // Modal Crear
        const modalCrear = document.getElementById('modal-crear-oferta');
        function openModalCrear() { modalCrear.classList.remove('hidden'); }
        function closeModalCrear() { modalCrear.classList.add('hidden'); }

        // Modal Editar
        const modalEditar = document.getElementById('modal-editar-oferta');
        function openModalEditar(id) {
            fetch('/api/ofertas/' + id)
                .then(r => r.json())
                .then(data => {
                    document.getElementById('edit-titulo').value = data.titulo;
                    document.getElementById('edit-descripcion').value = data.descripcion;
                    document.getElementById('edit-ubicacion_id').value = data.ubicacion_id;
                    document.getElementById('edit-fecha_inicio').value = data.fecha_inicio;
                    document.getElementById('edit-fecha_fin').value = data.fecha_fin;
                    document.getElementById('form-editar-oferta').action = '/company/ofertas/' + id + '/actualizar';
                    modalEditar.classList.remove('hidden');
                });
        }
        function closeModalEditar() { modalEditar.classList.add('hidden'); }
    </script>
</body>
</html>
