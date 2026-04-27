<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'UWorkFlow') }} - Encuentra tu Pasantía</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased overflow-x-hidden">

    <x-nav-bar />

    <!-- Hero Section -->
    <section class="relative pt-16 pb-24 lg:pt-24 lg:pb-32 bg-[#F8FAFF] overflow-hidden">
        <div class="container mx-auto px-6 md:px-12 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                        </span>
                        Plataforma #1 de Pasantías
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8">
                        Conecta tu futuro con la <span class="text-blue-600 italic">Pasantía Perfecta</span>
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed mb-10 max-w-xl">
                        Cerrar la brecha entre estudiantes ambiciosos y empresas innovadoras. Encuentra oportunidades significativas o descubre el mejor talento para tu organización.
                    </p>
                    <!-- <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('offers.index') }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold text-center hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 hover:-translate-y-1">
                            Buscar Pasantías
                        </a>
                        <a href="{{ route('offers.create') }}" class="px-8 py-4 bg-white text-slate-900 border border-slate-200 rounded-2xl font-bold text-center hover:bg-slate-50 transition-all hover:-translate-y-1">
                            Publicar Pasantía
                        </a>
                    </div> -->
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="Estudiantes trabajando" class="w-full">
                    </div>
                    <!-- Stats Card -->
                    <div class="absolute -bottom-10 -left-6 md:-left-10 z-20 bg-white p-6 rounded-3xl shadow-2xl border border-slate-100 flex items-center gap-4 animate-bounce-slow">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase">Tasa de Éxito</p>
                            <p class="text-2xl font-extrabold text-slate-900">87.5%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </section>

    <!-- Features -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group p-10 bg-white border border-slate-100 rounded-[2rem] hover:border-blue-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Matching Inteligente</h3>
                    <p class="text-slate-500 leading-relaxed">Nuestro algoritmo conecta estudiantes con las oportunidades más relevantes basadas en habilidades y objetivos.</p>
                </div>
                <div class="group p-10 bg-white border border-slate-100 rounded-[2rem] hover:border-blue-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Empresas Verificadas</h3>
                    <p class="text-slate-500 leading-relaxed">Trabaja con confianza. Todas las empresas están validadas para garantizar experiencias de aprendizaje reales.</p>
                </div>
                <div class="group p-10 bg-white border border-slate-100 rounded-[2rem] hover:border-blue-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Gestión Simplificada</h3>
                    <p class="text-slate-500 leading-relaxed">Un proceso intuitivo para aplicar y gestionar vacantes de manera eficiente y centralizada.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Students Section -->
    <section class="py-24 bg-blue-600 rounded-[3rem] mx-6 md:mx-12 mb-24 overflow-hidden relative">
        <div class="container mx-auto px-8 md:px-16 flex flex-col lg:flex-row items-center gap-16 relative z-10 text-white">
            <div class="lg:w-1/2">
                <span class="text-blue-200 font-bold uppercase tracking-widest text-sm mb-4 block">Estudiantes</span>
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-8 leading-tight">Impulsa tu carrera profesional</h2>
                <ul class="space-y-4 mb-10">
                    <li class="flex items-center gap-3">
                        <div class="bg-blue-500/30 p-1 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                        <span class="text-lg">Explora cientos de oportunidades reales</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="bg-blue-500/30 p-1 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                        <span class="text-lg">Seguimiento de aplicaciones en tiempo real</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="bg-blue-500/30 p-1 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                        <span class="text-lg">Construye tu red profesional</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-white text-blue-600 rounded-2xl font-extrabold shadow-xl hover:-translate-y-1 transition-transform">
                    Comenzar como estudiante
                </a>
            </div>
            <div class="lg:w-1/2 grid grid-cols-1 gap-6 w-full">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-[2rem] border border-white/20">
                    <p class="text-sm font-bold opacity-60 mb-2">PASO 1</p>
                    <h3 class="text-2xl font-bold">Crea tu perfil profesional</h3>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-[2rem] border border-white/20 translate-x-4">
                    <p class="text-sm font-bold opacity-60 mb-2">PASO 2</p>
                    <h3 class="text-2xl font-bold">Busca y aplica a ofertas</h3>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-[2rem] border border-white/20 translate-x-8">
                    <p class="text-sm font-bold opacity-60 mb-2">PASO 3</p>
                    <h3 class="text-2xl font-bold">Inicia tu pasantía</h3>
                </div>
            </div>
        </div>
        <!-- Abstract curves -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    </section>

    

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-24 pb-12">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-4 gap-12 pb-16 border-b border-slate-800">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <x-application-logo class="w-8 h-8" />
                        <span class="text-xl font-bold">UWorkFlow</span>
                    </div>
                    <p class="text-slate-400 leading-relaxed mb-6">
                        Conectando el talento del mañana con las oportunidades de hoy.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-6 italic text-blue-400">Para Estudiantes</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/offers" class="hover:text-white transition-colors">Explorar Pasantías</a></li>
                        <li><a href="/comufunciona" class="hover:text-white transition-colors">Cómo funciona</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Historias de éxito</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 italic text-blue-400">Para Empresas</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/" class="hover:text-white transition-colors">Publicar Ofertas</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Encontrar Talento</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Precios</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 italic text-blue-400">Compañía</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/acerca" class="hover:text-white transition-colors">Nosotros</a></li>
                        <li><a href="/contacto" class="hover:text-white transition-colors">Contacto</a></li>
                        <li><a href="/priva" class="hover:text-white transition-colors">Privacidad</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-2 text-center text-slate-500 text-sm">
                <p>&copy; 2026 UWorkFlow. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8,0,1,1); }
            50% { transform: none; animation-timing-function: cubic-bezier(0,0,0.2,1); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 3s infinite;
        }
    </style>
</body>
</html>
