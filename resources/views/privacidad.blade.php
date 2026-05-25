<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad | UWorkFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Importar Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .sidebar-link:hover {
            padding-left: 8px;
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        /* Estilos para la animación del logo */
        .logo-container:hover .logo-icon {
            transform: rotate(12deg) scale(1.1);
            background-color: #2b6df2;
        }

        .logo-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body class="bg-[#fcfcfc] text-[#1a1a1a]">

    <!-- NAVBAR (Actualizado con el nuevo logo animado) -->
    @include('components.navbar')

    <!-- MAIN CONTAINER -->
    <main class="max-w-7xl mx-auto px-[8%] py-16 flex flex-col lg:flex-row gap-12">

        <!-- SIDEBAR -->
        <aside class="lg:w-1/4">
            <div class="sticky top-28 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <h4 class="font-bold text-sm uppercase tracking-wider text-[#2b6df2] mb-6">Contenido</h4>
                <ul class="space-y-4">
                    <li><a href="#recoleccion"
                            class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">1. Recolección de
                            Datos</a></li>
                    <li><a href="#uso" class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">2. Uso de
                            Información</a></li>
                    <li><a href="#proteccion" class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">3.
                            Protección</a></li>
                    <li><a href="#cookies" class="sidebar-link block text-[#666] hover:text-[#2b6df2] font-medium">4.
                            Cookies</a></li>
                </ul>
            </div>
        </aside>

        <!-- CONTENT ARTICLE -->
        <article class="lg:w-3/4 bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#0d1b2a]">
                Política de <span class="text-[#2b6df2]">Privacidad</span>
            </h1>
            <p class="text-[#888] font-medium mb-12 flex items-center gap-2">
                <span class="w-2 h-2 bg-[#2b6df2] rounded-full"></span>
                Última actualización: 19 de junio de 2026
            </p>

            <div class="space-y-12 leading-relaxed text-[#444]">

                <section id="recoleccion" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">1. Recolección de Datos</h2>
                    <p class="mb-4">En UWorkFlow, recolectamos información personal que tú nos proporcionas
                        voluntariamente al registrarte, como tu nombre, dirección de correo electrónico, historial
                        académico y experiencia laboral.</p>
                    <p>También recopilamos automáticamente ciertos datos técnicos cuando visitas nuestra plataforma,
                        incluyendo tu dirección IP y el tipo de dispositivo que utilizas.</p>
                </section>

                <section id="uso" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">2. Uso de la Información</h2>
                    <p class="mb-4">La información recopilada se utiliza exclusivamente para:</p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-[#2b6df2] rounded-full mt-2 flex-shrink-0"></span>
                            Facilitar el proceso de postulación a pasantías.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-[#2b6df2] rounded-full mt-2 flex-shrink-0"></span>
                            Mejorar nuestro algoritmo de "matching" entre estudiantes y empresas.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 bg-[#2b6df2] rounded-full mt-2 flex-shrink-0"></span>
                            Enviar notificaciones relevantes sobre el estado de tus aplicaciones.
                        </li>
                    </ul>
                </section>

                <section id="proteccion" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">3. Protección de Datos</h2>
                    <p>Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos personales
                        contra acceso no autorizado, pérdida o alteración. Tus datos están cifrados y almacenados en
                        servidores seguros.</p>
                </section>

                <section id="cookies" class="scroll-mt-32">
                    <h2 class="text-2xl font-bold mb-4 text-[#1a1a1a]">4. Uso de Cookies</h2>
                    <p>Utilizamos cookies para mejorar tu experiencia de navegación y analizar el tráfico del sitio.
                        Puedes configurar tu navegador para rechazar todas las cookies, pero esto podría afectar la
                        funcionalidad de la plataforma.</p>
                </section>

            </div>
        </article>
    </main>

    <!-- FOOTER (Actualizado con el nuevo logo animado) -->
    @include('components.footer')

    <!-- Inicializar Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>