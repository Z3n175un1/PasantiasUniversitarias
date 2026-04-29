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
        body{
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(to bottom, #ccfbf1, #a78bfa, #bae6fd);
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-teal-100 via-indigo-500 to-sky-100 min-h-screen">
    <x-nav-bar />
    <main class="flex flex-col p-6 pt-20 mt-10">
        <!-- Sección de Misión -->
        <section class="mb-12">
            <div class="bg-rose-300 text-white text-4xl font-bold p-8 rounded-lg mb-6 animate-fade-in">
                <h1>Misión</h1>
            </div>

            <div class="bg-sky-200 p-10 rounded-2xl">
                <p class="text-slate-600 text-lg leading-relaxed">
                    En UWorkFlow, creemos que el talento no tiene fronteras. Nacimos para eliminar las barreras entre los estudiantes brillantes y las empresas que están cambiando el mundo.
                </p>
            </div>
        </section>

        <!-- Sección de Visión -->
        <section class="mb-12">
            <div class="bg-green-300 text-white text-4xl font-bold p-8 rounded-lg mb-6 animate-fade-in">
                <h1>Visión</h1>
            </div>
            <div class="bg-sky-200 p-10 rounded-2xl mb-12">
                <p class="text-slate-600 text-lg leading-relaxed">
                    Ser la plataforma líder global que define el estándar de las pasantías profesionales, priorizando el aprendizaje real.
                </p>
            </div>

            <!-- Sección de Compromiso -->
            <div class="bg-sky-300 text-white text-4xl font-bold p-8 rounded-lg mb-6 animate-fade-in">
                <h1>Compromiso</h1>
            </div>
            <div class="bg-teal-200 p-10 rounded-2xl">
                <p class="text-slate-600 text-lg leading-relaxed">
                    Nos comprometemos a mantener un ecosistema seguro, verificado y justo para ambas partes.
                </p>
            </div>
        </section>

        <!-- Sección Por qué existimos -->
        <section class="bg-slate-200 py-16 px-8 rounded-2xl my-12">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-sky-800 mb-6">Por qué existimos</h2>
                    <p class="text-slate-700 text-lg leading-relaxed mb-8">
                        Muchos estudiantes talentosos se pierden por falta de contactos, y muchas empresas pierden talento por procesos lentos. Nosotros somos el puente que une esos dos mundos con tecnología y empatía.
                    </p>

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-amber-500 text-white p-6 rounded-xl text-center">
                            <div class="text-3xl font-bold mb-2">+10k</div>
                            <div class="text-sm">Estudiantes</div>
                        </div>
                        <div class="bg-amber-500 text-white p-6 rounded-xl text-center">
                            <div class="text-3xl font-bold mb-2">+500</div>
                            <div class="text-sm">Empresas</div>
                        </div>
                        <div class="bg-amber-500 text-white p-6 rounded-xl text-center">
                            <div class="text-3xl font-bold mb-2">15+</div>
                            <div class="text-sm">Países</div>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" alt="Nuestro Equipo" class="w-full rounded-2xl object-cover">
                </div>
            </div>
        </section>
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
                    <h4 class="font-bold mb-6 text-blue-400">Para Estudiantes</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/offers" class="hover:text-white transition-colors">Explorar Pasantías</a></li>
                        <li><a href="/comufunciona" class="hover:text-white transition-colors">Cómo funciona</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Historias de éxito</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-blue-400">Para Empresas</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/" class="hover:text-white transition-colors">Publicar Ofertas</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Encontrar Talento</a></li>
                        <li><a href="/" class="hover:text-white transition-colors">Precios</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-blue-400">Compañía</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="/about" class="hover:text-white transition-colors">Nosotros</a></li>
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