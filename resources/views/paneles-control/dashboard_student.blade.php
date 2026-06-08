<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiante | UWorkFlow</title>
    <link rel="icon" href="{{ asset('estudiante.ico') }}">
    @vite('resources/css/app.css')
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
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2">
                <i data-lucide="x-circle" class="w-5 h-5 text-red-600"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

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
                <button data-tab="documentos" class="tab-btn flex items-center gap-3 px-5 py-3.5 text-slate-600 hover:bg-slate-100 font-semibold rounded-2xl transition-all text-left text-sm w-full">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    Documentos y Habilidades
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
                            @php
                                $completado = 0;
                                if ($estudiante->universidad) $completado += 25;
                                if ($estudiante->carrera) $completado += 25;
                                if ($estudiante->anio_graduacion) $completado += 15;
                                if ($estudiante->biografia) $completado += 10;
                                if ($estudiante->documentos->count() > 0) $completado += 15;
                                if ($estudiante->habilidades->count() > 0) $completado += 10;
                            @endphp
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                {{ $completado }}%
                            </div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Perfil Completado</h4>
                                <p class="text-xs font-bold text-blue-600 mt-0.5">Completa tu perfil para mejorar tu match</p>
                            </div>
                        </div>
                    </div>

                    {{-- Alertas de perfil incompleto --}}
                    @php
                        $sinDocumentos = $estudiante->documentos->count() === 0;
                        $sinHabilidades = $estudiante->habilidades->count() === 0;
                    @endphp
                    @if($sinDocumentos || $sinHabilidades)
                        <div class="bg-amber-50 border border-amber-200 rounded-[2rem] p-5 flex items-start gap-4">
                            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-amber-800">Completa tu perfil para poder postular</h4>
                                <ul class="mt-2 space-y-1">
                                    @if($sinDocumentos)
                                        <li class="text-xs text-amber-700 flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                                            Sube al menos un documento (CV, certificado, etc.)
                                            <a href="#" onclick="event.preventDefault(); document.querySelector('[data-tab=\"documentos\"]').click();" class="underline font-bold hover:text-amber-900">Ir a Documentos</a>
                                        </li>
                                    @endif
                                    @if($sinHabilidades)
                                        <li class="text-xs text-amber-700 flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                                            Registra al menos una habilidad técnica o blanda
                                            <a href="#" onclick="event.preventDefault(); document.querySelector('[data-tab=\"documentos\"]').click();" class="underline font-bold hover:text-amber-900">Ir a Habilidades</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif

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

                {{-- Documentos y Habilidades --}}
                <section id="documentos" class="tab-content space-y-6">
                    {{-- Documentos --}}
                    <div class="bg-white p-7 rounded-[2rem] border border-slate-100 shadow-sm space-y-5">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 text-lg">
                                <i data-lucide="file-text" class="w-5 h-5 inline mr-2 text-blue-600"></i>Mis Documentos
                            </h3>
                            <button onclick="openModalDocumento()" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-xl text-xs hover:bg-blue-700 transition shadow-md">
                                <i data-lucide="upload" class="w-4 h-4 inline mr-1"></i>Subir Documento
                            </button>
                        </div>

                        @if($estudiante->documentos->count() > 0)
                            <div class="divide-y divide-slate-100">
                                @foreach($estudiante->documentos as $doc)
                                    <div class="flex items-center justify-between py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                                <i data-lucide="{{ $doc->tipo_mime == 'application/pdf' ? 'file' : 'file-image' }}" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-slate-900">{{ $doc->nombre_original }}</h4>
                                                <p class="text-xs text-slate-400">
                                                    {{ $doc->tipoDocumento->nombre ?? 'Documento' }} •
                                                    {{ round($doc->tamano_bytes / 1024, 1) }} KB
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('documentos.ver', $doc->id) }}" target="_blank"
                                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition" title="Ver">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('student.documentos.eliminar', $doc->id) }}" method="POST"
                                                  onsubmit="return confirm('¿Eliminar este documento?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition" title="Eliminar">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <i data-lucide="file-text" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                                <p class="text-sm text-slate-400">No has subido ningún documento aún.</p>
                                <p class="text-xs text-slate-300 mt-1">Sube tu CV, certificados u otros documentos.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Habilidades --}}
                    <div class="bg-white p-7 rounded-[2rem] border border-slate-100 shadow-sm space-y-5">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 text-lg">
                                <i data-lucide="zap" class="w-5 h-5 inline mr-2 text-amber-500"></i>Mis Habilidades
                                <span class="ml-2 text-xs font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">{{ $estudiante->habilidades->count() }}</span>
                            </h3>
                            <button onclick="openModalHabilidad()" class="px-4 py-2 bg-amber-500 text-white font-bold rounded-xl text-xs hover:bg-amber-600 transition shadow-md">
                                <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>Agregar Habilidad
                            </button>
                        </div>

                        @if($estudiante->habilidades->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($estudiante->habilidades as $hab)
                                    <div class="flex flex-col p-3 bg-slate-50 rounded-xl border border-slate-100 hover:border-amber-200 transition">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-sm text-slate-800">{{ $hab->habilidad->nombre ?? 'N/A' }}</span>
                                                <div class="flex gap-0.5">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="w-2 h-2 rounded-full {{ $i <= $hab->nivel ? 'bg-amber-400' : 'bg-slate-200' }}"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <button onclick="openModalEditarHabilidad({{ $hab->id }}, {{ $hab->nivel }}, '{{ $hab->habilidad->nombre }}')" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Editar nivel">
                                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                                </button>
                                                <form action="{{ route('student.habilidades.eliminar', $hab->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Eliminar" onclick="return confirm('¿Eliminar esta habilidad?')">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="mt-1.5 flex items-center gap-2">
                                            <span class="inline-block px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full">
                                                {{ $hab->habilidad->categoria ?? 'General' }}
                                            </span>
                                            <span class="text-[10px] text-slate-400 font-medium">
                                                Nivel: {{ $hab->nivel }}/5
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                    <i data-lucide="zap" class="w-8 h-8 text-slate-300"></i>
                                </div>
                                <h4 class="font-bold text-slate-500">No tienes habilidades registradas</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">Agrega tus habilidades técnicas y blandas para que las empresas te encuentren más fácilmente.</p>
                            </div>
                        @endif
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
                        <p class="text-xs text-slate-400 mt-0.5">Edita tu información académica y personal.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <form action="{{ route('student.perfil.actualizar') }}" method="POST" class="space-y-6 text-sm font-semibold" onsubmit="return validarPerfilEstudiante()">
                            @csrf
                            <div class="flex items-center gap-6 pb-6 border-b border-slate-100">
                                <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-md">
                                    {{ strtoupper(substr($estudiante->usuario->nombre ?? '?', 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $estudiante->usuario->nombre ?? 'N/A' }} {{ $estudiante->usuario->ap_paterno ?? '' }}</h3>
                                    <p class="text-xs text-slate-400">{{ $estudiante->usuario->correo ?? '' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Universidad</label>
                                    <select name="universidad" id="perfil-universidad"
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium appearance-none cursor-pointer">
                                        <option value="">Seleccionar universidad...</option>
                                        @foreach($universidades as $universidad)
                                            <option value="{{ $universidad }}" @selected(old('universidad', $estudiante->universidad) === $universidad)>{{ $universidad }}</option>
                                        @endforeach
                                    </select>
                                    <div class="error-text" id="perfil-universidad-error">La universidad es obligatoria</div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Carrera</label>
                                    <select name="carrera" id="perfil-carrera"
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium appearance-none cursor-pointer">
                                        <option value="">Seleccionar carrera...</option>
                                        @foreach($carreras as $carrera)
                                            <option value="{{ $carrera }}" @selected(old('carrera', $estudiante->carrera) === $carrera)>{{ $carrera }}</option>
                                        @endforeach
                                    </select>
                                    <div class="error-text" id="perfil-carrera-error">La carrera es obligatoria</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" id="perfil-fecha_nacimiento" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}"
                                           max="{{ now()->subYears(18)->format('Y-m-d') }}" min="{{ now()->subYears(30)->format('Y-m-d') }}"
                                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                                    <div class="error-text" id="perfil-fecha_nacimiento-error">Debes tener entre 18 y 30 años</div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Semestre Actual</label>
                                    <select name="semestre_actual" id="perfil-semestre" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium appearance-none cursor-pointer">
                                        <option value="">Seleccionar semestre...</option>
                                        @foreach($semestres as $semestre)
                                            <option value="{{ $semestre }}" @selected(old('semestre_actual', $estudiante->semestre_actual) == $semestre)>{{ $semestre }}°</option>
                                        @endforeach
                                    </select>
                                    <div class="error-text" id="perfil-semestre-error">Selecciona el semestre actual</div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Año de Graduación</label>
                                    <input type="number" name="anio_graduacion" id="perfil-anio" value="{{ old('anio_graduacion', $estudiante->anio_graduacion) }}" min="1900" max="2100"
                                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                                    <div class="error-text" id="perfil-anio-error">Ingresa un año válido (1900-2100)</div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Correo Electrónico</label>
                                    <input type="email" value="{{ $estudiante->usuario->correo ?? '' }}" disabled
                                           class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl font-medium text-slate-500 cursor-not-allowed">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Biografía / Sobre mí</label>
                                <textarea name="biografia" id="perfil-biografia" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none">{{ old('biografia', $estudiante->biografia) }}</textarea>
                            </div>

                            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition text-sm">
                                <i data-lucide="save" class="w-4 h-4 inline mr-1"></i>Guardar Cambios
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>

    {{-- Modal Subir Documento --}}
    <div id="modal-documento" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-lg mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Subir Documento</h3>
                <button onclick="closeModalDocumento()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('student.documentos.subir') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm font-semibold" onsubmit="return validarDocumento()">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Tipo de Documento</label>
                    <select name="tipo_documento_id" id="doc-tipo" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                        <option value="">Seleccionar...</option>
                        @foreach($tipos_documento as $td)
                            <option value="{{ $td->id }}">{{ $td->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="error-text" id="doc-tipo-error">Selecciona un tipo de documento</div>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Archivo (PDF, DOC, JPG, PNG - max 10MB)</label>
                    <input type="file" name="archivo" id="doc-archivo" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    <div class="error-text" id="doc-archivo-error">Selecciona un archivo válido (PDF, DOC, JPG, PNG - max 10MB)</div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalDocumento()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition">Subir</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Agregar Habilidad --}}
    <div id="modal-habilidad" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-lg mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Agregar Habilidad</h3>
                <button onclick="closeModalHabilidad()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('student.habilidades.guardar') }}" method="POST" class="space-y-4 text-sm font-semibold" onsubmit="return validarHabilidadEstudiante()">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Área / Categoría</label>
                    <select id="hab-categoria" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                        <option value="">Seleccionar área...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria }}">{{ $categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Habilidad</label>
                    <select name="habilidad_id" id="hab-select" required disabled class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                        <option value="">Primero selecciona un área</option>
                    </select>
                    <div class="error-text" id="hab-select-error">Selecciona una habilidad</div>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Nivel (1-5)</label>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="nivel" value="{{ $i }}" {{ $i == 3 ? 'checked' : '' }} class="sr-only peer">
                                <div class="text-center py-3 bg-slate-50 border border-slate-200 rounded-xl peer-checked:bg-amber-400 peer-checked:text-white peer-checked:border-amber-400 font-bold text-sm transition">
                                    {{ $i }}
                                </div>
                            </label>
                        @endfor
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalHabilidad()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition">Agregar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Editar Nivel de Habilidad --}}
    <div id="modal-editar-habilidad" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-md mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Editar Nivel</h3>
                <button onclick="closeModalEditarHabilidad()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form id="form-editar-habilidad" method="POST" class="space-y-4 text-sm font-semibold">
                @csrf
                @method('PATCH')
                <div class="text-center">
                    <p class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Habilidad</p>
                    <p id="edit-hab-nombre" class="text-lg font-bold text-slate-900 mt-1">-</p>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Nivel (1-5)</label>
                    <div class="flex gap-2" id="edit-hab-niveles">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="nivel" value="{{ $i }}" class="sr-only peer edit-nivel-radio">
                                <div class="text-center py-3 bg-slate-50 border border-slate-200 rounded-xl peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 font-bold text-sm transition">
                                    {{ $i }}
                                </div>
                            </label>
                        @endfor
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalEditarHabilidad()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
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
            'postulaciones': document.getElementById('postulaciones'),
            'documentos': document.getElementById('documentos'),
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

        // Modal Documento
        const modalDoc = document.getElementById('modal-documento');
        function openModalDocumento() { modalDoc.classList.remove('hidden'); }
        function closeModalDocumento() { modalDoc.classList.add('hidden'); }

        // Modal Habilidad
        const modalHab = document.getElementById('modal-habilidad');
        function openModalHabilidad() {
            modalHab.classList.remove('hidden');
            document.getElementById('hab-categoria').value = '';
            document.getElementById('hab-select').innerHTML = '<option value="">Primero selecciona un área</option>';
            document.getElementById('hab-select').disabled = true;
        }
        function closeModalHabilidad() { modalHab.classList.add('hidden'); }

        // Modal Editar Habilidad
        const modalEditarHab = document.getElementById('modal-editar-habilidad');
        function openModalEditarHabilidad(id, nivel, nombre) {
            document.getElementById('edit-hab-nombre').textContent = nombre;
            document.querySelectorAll('.edit-nivel-radio').forEach(r => {
                r.checked = (parseInt(r.value) === parseInt(nivel));
            });
            document.getElementById('form-editar-habilidad').action = '/student/habilidades/' + id + '/nivel';
            modalEditarHab.classList.remove('hidden');
        }
        function closeModalEditarHabilidad() { modalEditarHab.classList.add('hidden'); }

        // ─── FILTRO DE HABILIDADES POR CATEGORÍA ───
        const habilidadesPorCategoria = @json($habilidades_por_categoria);

        document.getElementById('hab-categoria').addEventListener('change', function() {
            const categoria = this.value;
            const select = document.getElementById('hab-select');

            select.innerHTML = '';

            if (!categoria) {
                select.innerHTML = '<option value="">Primero selecciona un área</option>';
                select.disabled = true;
                return;
            }

            select.disabled = false;
            const opciones = document.createElement('option');
            opciones.value = '';
            opciones.textContent = 'Seleccionar habilidad...';
            select.appendChild(opciones);

            const habilidades = habilidadesPorCategoria[categoria] || [];
            habilidades.forEach(function(h) {
                const opt = document.createElement('option');
                opt.value = h.id;
                opt.textContent = h.nombre;
                select.appendChild(opt);
            });

            select.className = 'w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer';
            lucide.createIcons();
        });

        // ─── VALIDACIÓN PERFIL ESTUDIANTE ───
        function mostrarError(inputId, errorId) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);
            if (input) input.classList.add('input-error');
            if (error) error.classList.add('visible');
        }

        function limpiarError(inputId, errorId) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);
            if (input) input.classList.remove('input-error');
            if (error) error.classList.remove('visible');
        }

        function validarPerfilEstudiante() {
            let valido = true;

            const universidad = document.getElementById('perfil-universidad');
            const carrera = document.getElementById('perfil-carrera');
            const fechaNac = document.getElementById('perfil-fecha_nacimiento');
            const semestre = document.getElementById('perfil-semestre');
            const anio = document.getElementById('perfil-anio');

            if (!universidad.value || universidad.value.trim() === '') {
                mostrarError('perfil-universidad', 'perfil-universidad-error');
                valido = false;
            } else {
                limpiarError('perfil-universidad', 'perfil-universidad-error');
            }

            if (!carrera.value || carrera.value.trim() === '') {
                mostrarError('perfil-carrera', 'perfil-carrera-error');
                valido = false;
            } else {
                limpiarError('perfil-carrera', 'perfil-carrera-error');
            }

            if (fechaNac && fechaNac.value) {
                const nac = new Date(fechaNac.value);
                const hoy = new Date();
                let edad = hoy.getFullYear() - nac.getFullYear();
                const mes = hoy.getMonth() - nac.getMonth();
                if (mes < 0 || (mes === 0 && hoy.getDate() < nac.getDate())) edad--;
                if (edad < 18 || edad > 30) {
                    mostrarError('perfil-fecha_nacimiento', 'perfil-fecha_nacimiento-error');
                    valido = false;
                } else {
                    limpiarError('perfil-fecha_nacimiento', 'perfil-fecha_nacimiento-error');
                }
            }

            if (semestre && !semestre.value) {
                mostrarError('perfil-semestre', 'perfil-semestre-error');
                valido = false;
            } else if (semestre) {
                limpiarError('perfil-semestre', 'perfil-semestre-error');
            }

            if (anio.value) {
                const anioNum = parseInt(anio.value);
                if (isNaN(anioNum) || anioNum < 1900 || anioNum > 2100) {
                    mostrarError('perfil-anio', 'perfil-anio-error');
                    valido = false;
                } else {
                    limpiarError('perfil-anio', 'perfil-anio-error');
                }
            } else {
                limpiarError('perfil-anio', 'perfil-anio-error');
            }

            if (!valido) universidad.focus();
            return valido;
        }

        function validarDocumento() {
            let valido = true;

            const tipo = document.getElementById('doc-tipo');
            const archivo = document.getElementById('doc-archivo');

            if (!tipo.value) {
                mostrarError('doc-tipo', 'doc-tipo-error');
                valido = false;
            } else {
                limpiarError('doc-tipo', 'doc-tipo-error');
            }

            if (!archivo.files || archivo.files.length === 0) {
                mostrarError('doc-archivo', 'doc-archivo-error');
                valido = false;
            } else {
                const file = archivo.files[0];
                const ext = file.name.split('.').pop().toLowerCase();
                const allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
                if (!allowed.includes(ext)) {
                    mostrarError('doc-archivo', 'doc-archivo-error');
                    document.getElementById('doc-archivo-error').textContent = 'Formato no permitido. Usa PDF, DOC, JPG o PNG.';
                    valido = false;
                } else if (file.size > 10485760) {
                    mostrarError('doc-archivo', 'doc-archivo-error');
                    document.getElementById('doc-archivo-error').textContent = 'El archivo no debe superar los 10MB.';
                    valido = false;
                } else {
                    limpiarError('doc-archivo', 'doc-archivo-error');
                }
            }

            return valido;
        }

        function validarHabilidadEstudiante() {
            const categoria = document.getElementById('hab-categoria');
            const select = document.getElementById('hab-select');
            if (!categoria.value) {
                categoria.classList.add('input-error');
                categoria.focus();
                return false;
            }
            categoria.classList.remove('input-error');
            if (!select.value) {
                mostrarError('hab-select', 'hab-select-error');
                select.focus();
                return false;
            }
            limpiarError('hab-select', 'hab-select-error');
            return true;
        }

        // Limpiar errores al interactuar
        document.addEventListener('input', function(e) {
            const id = e.target.id;
            if (id === 'perfil-universidad') limpiarError(id, 'perfil-universidad-error');
            if (id === 'perfil-carrera') limpiarError(id, 'perfil-carrera-error');
            if (id === 'perfil-anio') limpiarError(id, 'perfil-anio-error');
        });

        document.addEventListener('change', function(e) {
            const id = e.target.id;
            if (id === 'doc-tipo') limpiarError(id, 'doc-tipo-error');
            if (id === 'hab-select') limpiarError(id, 'hab-select-error');
        });
    </script>
</body>
</html>
