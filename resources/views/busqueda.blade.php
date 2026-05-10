<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'UWorkFlow') }} - Encuentra tu Pasantía</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full text-slate-900">

    <x-nav-bar />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Explorar Oportunidades</h1>
            <p class="mt-2 text-slate-600">Descubre pasantías y trabajos que impulsarán tu carrera profesional.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-80 flex-shrink-0">
                <div class="sticky top-24 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtros
                        </h2>

                        <form class="space-y-6">
                            <!-- Search -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Cargo o palabra clave</label>
                                <div class="relative">
                                    <input type="text" placeholder="Ej. Designer, Dev..." 
                                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Country -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Ubicación</label>
                                <div class="relative">
                                    <input type="text" placeholder="Chile, México..." 
                                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="space-y-3">
                                <label class="text-sm font-medium text-slate-700">Tipo de oportunidad</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Pasantía / Práctica</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Trabajo</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Evento</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Modality -->
                            <div class="space-y-3">
                                <label class="text-sm font-medium text-slate-700">Modalidad</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Presencial</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Remoto</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Híbrido</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" 
                                class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-md shadow-indigo-200 active:scale-[0.98]">
                                Aplicar Filtros
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Results Section -->
            <section class="flex-1 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-slate-500 text-sm italic">
                        Hemos encontrado <span class="font-bold text-slate-900">550</span> resultados.
                    </p>
                    <div class="flex items-center gap-2 text-sm font-medium text-slate-600">
                        <span>Ordenar por:</span>
                        <select class="bg-transparent border-none focus:ring-0 cursor-pointer text-indigo-600">
                            <option>Más recientes</option>
                            <option>Relevancia</option>
                        </select>
                    </div>
                </div>

                <!-- Job Card 1 -->
                <div class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity -z-10"></div>
                    
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-14 h-14 bg-indigo-50 rounded-xl flex items-center justify-center flex-shrink-0 border border-indigo-100">
                            <img src="https://via.placeholder.com/100" alt="Logo" class="w-10 h-10 rounded-lg object-contain">
                        </div>
                        
                        <div class="flex-1 space-y-2">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                    Content Creator Intern | Startupeable
                                </h3>
                                <span class="text-xs font-medium text-slate-400">Hace 2 días</span>
                            </div>
                            
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <span class="font-semibold text-slate-900">Startupeable</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    Multipaís
                                </span>
                            </div>

                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-2">
                                Cada semana grabamos conversaciones de 60 minutos con los CEOs más top de LatAm. Tu trabajo: tomar esas conversaciones y convertirlas en contenido que llega a millones...
                            </p>

                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-100">Remoto</span>
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-full border border-indigo-100">Práctica Profesional</span>
                                <span class="px-3 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full border border-amber-100">Full-time</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300 relative overflow-hidden">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0 border border-blue-100">
                            <img src="https://via.placeholder.com/100" alt="Logo" class="w-10 h-10 rounded-lg object-contain">
                        </div>
                        
                        <div class="flex-1 space-y-2">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                    Ejecutiva (o) de Cuentas para Customer Success
                                </h3>
                                <span class="text-xs font-medium text-slate-400">Hace 5 horas</span>
                            </div>
                            
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <span class="font-semibold text-slate-900">Postedin</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    CDMX, México
                                </span>
                            </div>

                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-2">
                                Postedin está en búsqueda de una Ejecutiva/o de Cuentas para unir a un equipo dinámico y en crecimiento. La candidata ideal será responsable de administrar cuentas...
                            </p>

                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-100">Híbrido</span>
                                <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-semibold rounded-full border border-purple-100">Trabajo</span>
                                <span class="px-3 py-1 bg-rose-50 text-rose-700 text-xs font-semibold rounded-full border border-rose-100">Urgente</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination Placeholder -->
                <div class="pt-8 flex justify-center">
                    <nav class="inline-flex rounded-xl border border-slate-200 bg-white p-1">
                        <button class="px-4 py-2 rounded-lg hover:bg-slate-50 text-slate-600 transition-colors disabled:opacity-50" disabled>Anterior</button>
                        <button class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold">1</button>
                        <button class="px-4 py-2 rounded-lg hover:bg-slate-50 text-slate-600 transition-colors">2</button>
                        <button class="px-4 py-2 rounded-lg hover:bg-slate-50 text-slate-600 transition-colors">3</button>
                        <span class="px-4 py-2 text-slate-400">...</span>
                        <button class="px-4 py-2 rounded-lg hover:bg-slate-50 text-slate-600 transition-colors">12</button>
                        <button class="px-4 py-2 rounded-lg hover:bg-slate-50 text-slate-600 transition-colors">Siguiente</button>
                    </nav>
                </div>
            </section>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-24 pb-12">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-4 gap-12 pb-16 border-b border-slate-800">
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <x-application-logo class="w-8 h-8" />
                        <span class="text-xl font-bold">UWorkFlow</span>
                    </div>
                    <p class="text-slate-400 leading-relaxed mb-6">
                        Conectando el talento del mañana con las oportunidades de hoy.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-indigo-400">Para Estudiantes</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/offers" class="hover:text-white transition-colors">Explorar Pasantías</a></li>
                        <li><a href="/comufunciona" class="hover:text-white transition-colors">Cómo funciona</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Historias de éxito</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-indigo-400">Para Empresas</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/" class="hover:text-white transition-colors">Publicar Ofertas</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Encontrar Talento</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Precios</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-indigo-400">Compañía</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/about" class="hover:text-white transition-colors font-bold text-white">Nosotros</a></li>
                        <li><a href="/contacto" class="hover:text-white transition-colors">Contacto</a></li>
                        <li><a href="/priva" class="hover:text-white transition-colors">Privacidad</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 text-center text-slate-500 text-sm">
                <p>&copy; 2026 UWorkFlow. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
