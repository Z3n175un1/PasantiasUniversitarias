<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWorkFlow | {{ $oferta->titulo }}</title>
    
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl text-sm font-semibold flex items-center gap-3 shadow-sm">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                </div>
                <div>
                    <p class="font-bold text-green-900">¡Super postulaste a la pasantía! 🎉</p>
                    <p class="text-green-700 text-xs mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl text-sm font-semibold flex items-center gap-3 shadow-sm">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i data-lucide="alert-circle" class="w-6 h-6 text-red-500"></i>
                </div>
                <div>
                    <p class="font-bold text-red-900">Oops!</p>
                    <p class="text-red-600 text-xs mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('index') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-[#0d121f] rounded-lg flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="text-white w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-extrabold text-[#0d121f]">UWorkFlow</span>
                </a>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('explora') }}" 
                       class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Volver
                    </a>
                    @auth
                        @php
                            $dashboardRoute = match(auth()->user()->rol_id) {
                                3 => 'dashboard.admin',
                                2 => 'dashboard.company',
                                default => 'dashboard.student'
                            };
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" 
                           class="px-5 py-2.5 bg-[#0d121f] text-white rounded-xl text-sm font-bold hover:bg-[#2b6df2] transition-all">
                            Mi Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2.5 bg-[#0d121f] text-white rounded-xl text-sm font-bold hover:bg-[#2b6df2] transition-all">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Contenido --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Columna Principal --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Header --}}
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-extrabold text-gray-900 mb-2">{{ $oferta->titulo }}</h1>
                            <p class="text-lg font-semibold text-blue-600">
                                {{ $oferta->perfilEmpresa->nombre_empresa ?? 'Empresa no especificada' }}
                            </p>
                        </div>
                        <span class="px-4 py-2 bg-green-50 text-green-700 font-bold rounded-full text-sm">
                            {{ $oferta->estadoPublicacion->nombre ?? 'Activa' }}
                        </span>
                    </div>
                    
                    {{-- Tags --}}
                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold">
                            <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i>
                            {{ $oferta->ubicacion->ciudad ?? 'No especificada' }}, {{ $oferta->ubicacion->pais ?? 'Bolivia' }}
                        </div>
                        @if($oferta->fecha_inicio)
                        <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold">
                            <i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i>
                            Inicio: {{ \Carbon\Carbon::parse($oferta->fecha_inicio)->format('d/m/Y') }}
                        </div>
                        @endif
                        @if($oferta->fecha_fin)
                        <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm font-semibold">
                            <i data-lucide="clock" class="w-4 h-4 text-blue-500"></i>
                            Fin: {{ \Carbon\Carbon::parse($oferta->fecha_fin)->format('d/m/Y') }}
                        </div>
                        @endif
                    </div>
                </div>
                
                {{-- Descripción --}}
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">📋 Descripción del Puesto</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $oferta->descripcion }}</p>

                    @if($oferta->requisitos)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <i data-lucide="list-checks" class="w-5 h-5 text-blue-500"></i>
                            Requisitos Específicos
                        </h3>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $oferta->requisitos }}</p>
                    </div>
                    @endif

                    @if($oferta->beneficios)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <i data-lucide="gift" class="w-5 h-5 text-green-500"></i>
                            Beneficios / Ofrecemos
                        </h3>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $oferta->beneficios }}</p>
                    </div>
                    @endif
                </div>
                
                {{-- Habilidades Requeridas (TOPSIS) --}}
                @if($oferta->requisitosHabilidad && $oferta->requisitosHabilidad->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">⭐ Habilidades Requeridas (Criterios TOPSIS)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($oferta->requisitosHabilidad as $requisito)
                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="code" class="w-5 h-5 text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold text-gray-900">{{ $requisito->habilidad->nombre ?? 'Habilidad' }}</p>
                                        <span class="text-[10px] font-extrabold uppercase {{ $requisito->tipo_criterio === 'benefit' ? 'text-green-600' : 'text-red-500' }}">
                                            {{ $requisito->tipo_criterio === 'benefit' ? 'Beneficio' : 'Costo' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-3 mt-1.5">
                                        <span class="text-xs text-gray-500">
                                            <span class="font-bold">Nivel min:</span> {{ $requisito->nivel_minimo ?? '1' }}/5
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            <span class="font-bold">Peso:</span> {{ $requisito->peso ?? '50' }}%
                                        </span>
                                    </div>
                                    <div class="mt-2 flex gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="w-2 h-2 rounded-full {{ $i <= ($requisito->nivel_minimo ?? 1) ? 'bg-blue-500' : 'bg-gray-200' }}"></span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">🏢 Sobre la Empresa</h3>
                    
                    <div class="mb-4">
                        <p class="font-bold text-gray-900">{{ $oferta->perfilEmpresa->nombre_empresa ?? 'Empresa' }}</p>
                        <p class="text-sm text-gray-500">{{ $oferta->perfilEmpresa->industria ?? 'Tecnología' }}</p>
                        @if($oferta->perfilEmpresa->tamano_empresa)
                            <span class="inline-block mt-1 px-2 py-0.5 bg-blue-50 text-blue-700 rounded-full text-[10px] font-extrabold">{{ $oferta->perfilEmpresa->tamano_empresa }}</span>
                        @endif
                    </div>

                    @if($oferta->perfilEmpresa->descripcion)
                    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
                        {{ Str::limit($oferta->perfilEmpresa->descripcion, 120) }}
                    </div>
                    @endif
                    
                    @if($oferta->perfilEmpresa->verificada)
                        <div class="flex items-center gap-2 text-sm text-green-600 font-semibold mb-4">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            Empresa Verificada
                        </div>
                    @endif

                    {{-- Detalles de la oferta --}}
                    <div class="border-t border-gray-100 pt-4 mb-4 space-y-3">
                        @if($oferta->modalidad)
                        <div class="flex items-center gap-2 text-sm">
                            <i data-lucide="briefcase" class="w-4 h-4 text-gray-400"></i>
                            <span class="text-gray-600">{{ $oferta->modalidad }}</span>
                        </div>
                        @endif
                        @if($oferta->carrera)
                        <div class="flex items-center gap-2 text-sm">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-gray-400"></i>
                            <span class="text-gray-600">{{ $oferta->carrera }}</span>
                        </div>
                        @endif
                        @if($oferta->vacantes_disponibles)
                        <div class="flex items-center gap-2 text-sm">
                            <i data-lucide="users" class="w-4 h-4 text-gray-400"></i>
                            <span class="text-gray-600">{{ $oferta->vacantes_disponibles }} vacante(s)</span>
                        </div>
                        @endif
                        @if($oferta->duracion_semanas)
                        <div class="flex items-center gap-2 text-sm">
                            <i data-lucide="clock" class="w-4 h-4 text-gray-400"></i>
                            <span class="text-gray-600">{{ $oferta->duracion_semanas }} semanas</span>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Botón Postular / Ya postulado --}}
                    @auth
                        @if(auth()->user()->rol_id == 1)
                            @if($ya_postulo)
                                <div class="w-full bg-blue-50 border border-blue-200 text-blue-800 py-4 rounded-2xl font-bold text-center">
                                    <div class="flex items-center justify-center gap-2 mb-1">
                                        <i data-lucide="check-circle" class="w-5 h-5 text-blue-600"></i>
                                        <span class="text-blue-900">¡Super postulaste a la pasantía! 🎉</span>
                                    </div>
                                    <p class="text-xs text-blue-600 font-medium">Ya te has postulado a esta oferta</p>
                                </div>
                            @else
                                <form action="{{ route('postulacion.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="oferta_pasantia_id" value="{{ $oferta->id }}">
                                    <button type="submit" 
                                        class="w-full bg-[#0d121f] text-white py-4 rounded-2xl font-bold hover:bg-[#2b6df2] transition-all">
                                        🚀 Postular Ahora
                                    </button>
                                </form>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full bg-[#0d121f] text-white py-4 rounded-2xl font-bold hover:bg-[#2b6df2] transition-all block text-center">
                            🔐 Inicia Sesión para Postular
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>