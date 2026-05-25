<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWorkFlow | {{ $oferta->titulo }}</title>
    
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen">
    
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
                    <h2 class="text-xl font-bold text-gray-900 mb-4">📋 Descripción</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $oferta->descripcion }}</p>
                </div>
                
                {{-- Habilidades Requeridas --}}
                @if($oferta->requisitosHabilidad && $oferta->requisitosHabilidad->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">⭐ Habilidades Requeridas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($oferta->requisitosHabilidad as $requisito)
                            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="code" class="w-5 h-5 text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $requisito->habilidad->nombre ?? 'Habilidad' }}</p>
                                    <p class="text-xs text-gray-500">Nivel mínimo: {{ $requisito->nivel_minimo ?? '1' }}</p>
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
                    </div>
                    
                    @if($oferta->perfilEmpresa->verificada)
                        <div class="flex items-center gap-2 text-sm text-green-600 font-semibold mb-4">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            Empresa Verificada
                        </div>
                    @endif
                    
                    {{-- Botón Postular --}}
                    @auth
                        @if(auth()->user()->rol_id == 1)
                            <form action="{{ route('postulacion.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="oferta_pasantia_id" value="{{ $oferta->id }}">
                                <button type="submit" 
                                    class="w-full bg-[#0d121f] text-white py-4 rounded-2xl font-bold hover:bg-[#2b6df2] transition-all">
                                    🚀 Postular Ahora
                                </button>
                            </form>
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