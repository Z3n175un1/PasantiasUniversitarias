<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad | InternConnect</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="bg-slate-50 h-screen w-screen -mx-0 -py-0">
    <x-nav-bar />
    <main class="legal-container">
        <aside class="legal-sidebar">
            <div class="sidebar-box">
                <h4>Contenido</h4>
                <ul>
                    <li><a href="#recoleccion">1. Recolección de Datos</a></li>
                    <li><a href="#uso">2. Uso de Información</a></li>
                    <li><a href="#proteccion">3. Protección</a></li>
                    <li><a href="#cookies">4. Cookies</a></li>
                </ul>
            </div>
        </aside>

        <article class="legal-content">
            <h1>Política de <span class="highlight">Privacidad</span></h1>
            <p class="last-updated">Última actualización: 24 de abril de 2026</p>

            <section id="recoleccion">
                <h2>1. Recolección de Datos</h2>
                <p>En InternConnect, recolectamos información personal que tú nos proporcionas voluntariamente al registrarte, como tu nombre, dirección de correo electrónico, historial académico y experiencia laboral.</p>
                <p>También recopilamos automáticamente ciertos datos técnicos cuando visitas nuestra plataforma, incluyendo tu dirección IP y el tipo de dispositivo que utilizas.</p>
            </section>

            <section id="uso">
                <h2>2. Uso de la Información</h2>
                <p>La información recopilada se utiliza exclusivamente para:</p>
                <ul>
                    <li>Facilitar el proceso de postulación a pasantías.</li>
                    <li>Mejorar nuestro algoritmo de "matching" entre estudiantes y empresas.</li>
                    <li>Enviar notificaciones relevantes sobre el estado de tus aplicaciones.</li>
                </ul>
            </section>

            <section id="proteccion">
                <h2>3. Protección de Datos</h2>
                <p>Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos personales contra acceso no autorizado, pérdida o alteración. Tus datos están cifrados y almacenados en servidores seguros.</p>
            </section>

            <section id="cookies">
                <h2>4. Uso de Cookies</h2>
                <p>Utilizamos cookies para mejorar tu experiencia de navegación y analizar el tráfico del sitio. Puedes configurar tu navegador para rechazar todas las cookies, pero esto podría afectar la funcionalidad de la plataforma.</p>
            </section>
        </article>
    </main>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo-white">🎓 InternConnect</div>
                <p>Conectando estudiantes y empresas para experiencias de pasantía significativas.</p>
            </div>
            <div class="footer-links">
                <h4>Para Estudiantes</h4>
                <a href="explorar.html">Explorar Pasantías</a>
                <a href="comufunciona.html">Cómo Funciona</a>
            </div>
            <div class="footer-links">
                <h4>Para Empresas</h4>
                <a href="login.html">Publicar Oportunidades</a>
                <a href="login.html">Encontrar Talento</a>
            </div>
            <div class="footer-links">
                <h4>Compañía</h4>
                <a href="sobrenosotros.html">Sobre Nosotros</a>
                <a href="contacto.html">Contacto</a>
                <a href="privacidad.html">Política de Privacidad</a>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 InternConnect. Todos los derechos reservados.
        </div>
    </footer>


</body>
</html>