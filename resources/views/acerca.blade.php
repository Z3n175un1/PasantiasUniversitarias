<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-teal-100 via-indigo-500 to-sky-100 min-h-screen w-screen py-20">
    <x-nav-bar />
        <main class="container mx-auto py-10 ">
    <!--Seccion de misión-->    
            <section>       
                <div class="bg-sky-500 pt-30 pb-30 pl-10 pr-10 mb-50 rounded-full">
                    <p class="text-white text-4xl font-bold text-">Misión</p>
                </div>
                    <div>
                        En UWorkFlow, creemos que el talento no tiene fronteras. Nacimos para eliminar las barreras entre los estudiantes brillantes y las empresas que están cambiando el mundo.
                    </div>
            </section>

    <section class="flex items-center justify-center 
    w-full 
    bg-teal-400 
    py-20 my-10 
    rounded-full mx-20">
<!--Seccion de vision-->
        <div class="bg-sky-600 w-full">
            <h3>Nuestra <b>Visión</b></h3>
            <p>Ser la plataforma líder global que define el estándar de las pasantías profesionales, priorizando el aprendizaje real.</p>
        </div>
<!--Seccion de Compromiso-->
        <div class="flex flex-items-left bg-teal-400 py-20 my-10 rounded-full mx-20">
            <div class="f-icon blue-bg">🤝</div>
            <h3>Compromiso</h3>
            <p>Nos comprometemos a mantener un ecosistema seguro, verificado y justo para ambas partes.</p>
        </div>
        <div class="flex flex-items-left bg-teal-400 py-20 my-10 rounded-full mx-20">
            <h3><b>Innovación</b></h3>
        </div>
    </section>

    <section class="flex items-center justify-center 
    w-full 
    bg-slate-200 
    py-20 my-10 
    rounded-full mx-20">
        <div class="students-content">
            <span class="big-icon">🌍</span>
            <h2>Por qué existimos</h2>
            <p>Muchos estudiantes talentosos se pierden por falta de contactos, y muchas empresas pierden talento por procesos lentos. Nosotros somos el puente que une esos dos mundos con tecnología y empatía.</p>
            <div class="stats-grid-about">
                <div class="stat-item">
                    <strong>+10k</strong>
                    <span>Estudiantes</span>
                </div>
                <div class="stat-item">
                    <strong>+500</strong>
                    <span>Empresas</span>
                </div>
                <div class="stat-item">
                    <strong>15+</strong>
                    <span>Países</span>
                </div>
            </div>
        </div>
        <div class="about-image-container">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" alt="Nuestro Equipo" class="about-img">
        </div>
    </section>
</main>
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
                        <li><a href="/about" class="hover:text-white transition-colors">Nosotros</a></li>
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


</body>
</html>