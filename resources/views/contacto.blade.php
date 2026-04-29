<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | InternConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 h-screen w-screen">
    <x-nav-bar />

    <section class="bg-white shadow-lg rounded-xl p-8 max-w-6xl mx-auto my-8 pt-20 ">
        <div class="flex flex-col gap-3">
            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm text-center">Estamos aquí para ayudarte</span>
            <h1 class="text-3xl font-bold">Ponte en <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">contacto</span> con nosotros</h1>
            <p>¿Tienes dudas sobre cómo publicar una vacante o cómo mejorar tu perfil? Nuestro equipo te responderá en menos de 24 horas.</p>
            
            <div class="gap-4 flex-1 border-b-2 text-center">
                <form class="p-6 rounded-lg border-b-2 ">
                    <h1 class="text-2xl font-bold mb-4 text-blue-600 py-4 ">Formulario de Reclamaciones</h1>
                    <div class="py-4 flex flex-col gap-4">
                        <label class="text-left ">Nombre completo: </label>
                        <input class="border-b-2 border-blue-600 rounded-full w-[400px] " type="text" placeholder="Ej. Juan Pérez">
                    </div>
                    <div class="py-4 flex flex-col gap-4">
                        <label class="text-left ">Correo electrónico</label>
                        <input class="border-b-2 border-blue-600 rounded-full" type="email" placeholder="juan@ejemplo.com">
                    </div>
                    <div class="py-4 flex flex-col gap-4">
                        <label>Asunto</label>
                        <select class="border-b-2 border-blue-600 rounded-full">
                            <option>Soporte Técnico</option>
                            <option>Ventas / Empresas</option>
                            <option>Duda de Estudiante</option>
                            <option>Otro</option>
                        </select>
                    </div>
                    <div class="py-4 flex flex-col gap-4">
                        <label>Mensaje</label>
                        <textarea class="border-b-2 border-blue-600 rounded-[2vm]"rows="5" placeholder="¿En qué podemos ayudarte?"></textarea>
                    </div>
                    <button class="bg-blue-600 text-white 
                    w-full
                    h-[24px]  
                    text-center  
                    rounded-full
                    justify-center 
                    items-center 
                    text-bold"><i data-lucide="message" class="text-blue-400 "></i>Enviar Mensaje </button>
                </form>
            </div>
            <div class="contact-methods">
                <div class="method-item">
                    <div class="flex flex-col gap-4 border-b-2 ">
                        <div>
                            <i class="fa-solid fa-location-dot"></i>
                            <h4 class="text-blue-600 font-bold">Ubicación</h4>
                            <p>Calle Innovación 123, Hub Tecnológico</p>
                        </div>
                        <div >
                            <i class="fa-solid fa-envelope"></i>
                            <h4 class="text-blue-600 font-bold">Email</h4>
                            <p>soporte@internconnect.com</p>
                        </div>
                        <div>
                            <i class="fa-solid fa-phone"></i>
                            <h4 class="text-blue-600 font-bold">Teléfono</h4>
                            <p>+591 70737639</p>
                    </div>
                </div>
            </div>
        </div>
        </section>

<!-- Footer -->
    <footer class="bg-slate-900 text-white pt-24 pb-12">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-4 gap-12 pb-12 border-b border-slate-800">
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