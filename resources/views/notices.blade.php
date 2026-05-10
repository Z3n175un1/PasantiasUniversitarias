<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'UWorkFlow') }} - Nuestra Historia</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sky-200 min-h-screen font-['Plus_Jakarta_Sans'] text-slate-900 overflow-x-hidden">
    <x-nav-bar />
    <main class="min-h-screen pb-20">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-100 to-sky-200 -z-10"></div>
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-6 text-center relative">
                <h1 class="text-6xl md:text-7xl font-extrabold text-slate-900 mb-6 tracking-tight animate-in fade-in slide-in-from-top duration-1000">
                    NOTICIAS
                </h1>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed animate-in fade-in slide-in-from-bottom duration-1000 delay-200">
                    Mantente al tanto de las últimas actualizaciones, lanzamientos y novedades de <span class="text-blue-600 font-bold">UWorkFlow</span>.
                </p>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-6 -mt-10">
            <!-- Featured News -->
            <div class="bg-slate-900 rounded-[3rem] overflow-hidden shadow-2xl flex flex-col md:flex-row items-stretch mb-12 animate-in fade-in slide-in-from-bottom duration-700 delay-300">
                <div class="md:w-1/2 p-12 flex flex-col justify-center">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-semibold mb-6 w-fit">
                        ÚLTIMA ACTUALIZACIÓN
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6
                    animate-in
                    fade-in-up
                    duration-1000
                    delay-200">
                    Versión 1.0.0 "RomeoSantoBacalao"</h2>
                    <p class="text-slate-400 text-lg leading-relaxed mb-8">
                        ¡Estamos emocionados de anunciar el lanzamiento oficial de UWorkFlow! Esta primera versión sienta las bases de nuestra misión: conectar el talento universitario con el sector empresarial de forma eficiente y segura.
                    </p>
                    <div class="flex items-center gap-4 text-slate-500 text-sm">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            4 de Mayo, 2026
                        </span>
                        <span class="w-1 h-1 bg-slate-700 rounded-full"></span>
                        <span>v1.0.0</span>
                    </div>
                </div>
                <div class="md:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 p-12 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                    <div class="relative text-center">
                        <span class="text-9xl font-black text-white/10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">1.0</span>
                        <p class="text-white text-3xl font-bold italic tracking-wider">RECIÉN SALIDO DEL HORNITO 😈</p>
                    </div>
                </div>
            </div>

            <!-- News Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Update 1 -->
                <div class="group bg-white/60 backdrop-blur-md p-8 rounded-[2rem] border border-white/40 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Mejoras de Rendimiento</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Optimizamos la carga de archivos estáticos y consultas a base de datos para una experiencia ultra rápida.</p>
                    <a href="#" class="inline-flex items-center text-blue-600 font-semibold gap-2 hover:gap-3 transition-all">
                        Leer más <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- Update 2 -->
                <div class="group bg-white/60 backdrop-blur-md p-8 rounded-[2rem] border border-white/40 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Nueva Seguridad 2FA</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Añadimos soporte para autenticación de dos factores para proteger las cuentas de estudiantes y empresas.</p>
                    <a href="#" class="inline-flex items-center text-indigo-600 font-semibold gap-2 hover:gap-3 transition-all">
                        Leer más <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- Update 3 -->
                <div class="group bg-white/60 backdrop-blur-md p-8 rounded-[2rem] border border-white/40 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-sky-100 rounded-2xl flex items-center justify-center text-sky-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Módulo de Empresas</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Refinamos el proceso de registro corporativo para agilizar la publicación de nuevas vacantes.</p>
                    <a href="#" class="inline-flex items-center text-sky-600 font-semibold gap-2 hover:gap-3 transition-all">
                        Leer más <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
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