<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'UWorkFlow') }} - Nuestra Historia</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}?v=1.0">   
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] min-h-screen font-['Plus_Jakarta_Sans'] text-slate-900 overflow-x-hidden">
    <x-nav-bar />

    <main class="max-w-7xl mx-auto px-6 py-12 lg:py-20">
        <!-- Header Section -->
        <div class="text-center mb-20 animate-in fade-in slide-in-from-top duration-1000">
            <span class="inline-block px-4 py-1.5 mb-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-indigo-50 rounded-full">
                Nuestra Identidad
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-6">
                Construyendo <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-teal-500">Puentes</span>
            </h1>
        </div>

        <div class="flex flex-col gap-8">
            
            <!-- Row 1: Misión (Título Izq - Texto Der) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-1 bg-rose-500 text-white p-8 rounded-[2.5rem] flex flex-col justify-center items-center text-center shadow-lg animate-in fade-in slide-in-from-left duration-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h2 class="text-3xl font-black uppercase tracking-tighter">Misión</h2>
                </div>
                <div class="md:col-span-3 bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-shadow flex items-center animate-in fade-in slide-in-from-right duration-700 delay-200">
                    <p class="text-xl text-slate-600 leading-relaxed italic">
                        "Eliminar las barreras entre los estudiantes brillantes y las empresas que están cambiando el mundo, democratizando el acceso a oportunidades de élite."
                    </p>
                </div>
            </div>

            <!-- Row 2: Visión (Texto Izq - Título Der) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-3 order-2 md:order-1 bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-shadow flex items-center animate-in fade-in slide-in-from-left duration-700 delay-300">
                    <p class="text-xl text-slate-600 leading-relaxed italic">
                        "Ser la plataforma líder global que define el estándar de las pasantías profesionales, priorizando el aprendizaje real sobre la burocracia."
                    </p>
                </div>
                <div class="md:col-span-1 order-1 md:order-2 bg-indigo-600 text-white p-8 rounded-[2.5rem] flex flex-col justify-center items-center text-center shadow-lg animate-in fade-in slide-in-from-right duration-700 delay-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <h2 class="text-3xl font-black uppercase tracking-tighter">Visión</h2>
                </div>
            </div>

            <!-- Row 3: Valores (Título Izq - Texto Der) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-1 bg-emerald-500 text-white p-8 rounded-[2.5rem] flex flex-col justify-center items-center text-center shadow-lg animate-in fade-in slide-in-from-left duration-700 delay-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <h2 class="text-3xl font-black uppercase tracking-tighter">Valores</h2>
                </div>
                <div class="md:col-span-3 bg-teal-50 p-10 rounded-[2.5rem] border border-teal-100 flex items-center animate-in fade-in slide-in-from-right duration-700 delay-400">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 w-full">
                        <div>
                            <h4 class="font-bold text-teal-900 mb-2">Transparencia</h4>
                            <p class="text-teal-800/70 text-sm">Procesos claros y honestos para todos.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-teal-900 mb-2">Seguridad</h4>
                            <p class="text-teal-800/70 text-sm">Empresas y estudiantes 100% verificados.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-teal-900 mb-2">Innovación</h4>
                            <p class="text-teal-800/70 text-sm">Tecnología al servicio del crecimiento humano.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 4: Imagen - Por qué existimos (Alternado) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative group rounded-[3rem] overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-1000 delay-300">
                    <img src="{{ asset('images/about/team.png') }}" alt="Nuestro Equipo" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-10">
                        <span class="px-4 py-1 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-bold uppercase tracking-widest">Nuestra Comunidad</span>
                    </div>
                </div>
                <div class="bg-slate-900 text-white p-12 rounded-[3rem] flex flex-col justify-center animate-in fade-in slide-in-from-right duration-1000 delay-500">
                    <h3 class="text-4xl font-bold mb-8">¿Por qué existimos?</h3>
                    <p class="text-slate-400 text-lg leading-relaxed mb-8">
                        Muchos estudiantes talentosos se pierden por falta de contactos, y las empresas pierden talento por procesos lentos. Nosotros usamos tecnología y empatía para cerrar esa brecha.
                    </p>
                    <div class="flex gap-6">
                        <div class="bg-white/10 p-4 rounded-2xl">
                            <div class="text-2xl font-bold">+10k</div>
                            <div class="text-xs text-slate-500 uppercase">Estudiantes</div>
                        </div>
                        <div class="bg-white/10 p-4 rounded-2xl">
                            <div class="text-2xl font-bold">+500</div>
                            <div class="text-xs text-slate-500 uppercase">Empresas</div>
                        </div>
                    </div>
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
                        <x-application-logo-black class="w-32 h-12" />
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

