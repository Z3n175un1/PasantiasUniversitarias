<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cómo Funciona | InternConnect</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-slate-50 min-h-screen w-screen">
    <x-nav-bar />
    <section class="page-header">
        <h1>Transparencia en cada <span class="highlight">paso</span></h1>
        <p>Descubre cómo InternConnect simplifica la conexión entre el talento emergente y las empresas líderes.</p>
    </section>

    <section class="section-students">
        <div class="students-content">
            <span class="big-icon">🚀</span>
            <h2>Ruta para Estudiantes</h2>
            <p>Tu carrera profesional comienza aquí. Hemos diseñado un proceso fluido para que te concentres en lo que importa: aprender.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card-glass">
                <span class="step-num">01</span>
                <h3>Crea tu Perfil</h3>
                <p>Completa tu portafolio, habilidades y preferencias. Nuestro algoritmo te hará visible ante las mejores empresas.</p>
            </div>
            <div class="step-card-glass">
                <span class="step-num">02</span>
                <h3>Aplica con un Click</h3>
                <p>No más formularios infinitos. Aplica a vacantes que coincidan con tu perfil de forma instantánea.</p>
            </div>
            <div class="step-card-glass">
                <span class="step-num">03</span>
                <h3>Entrevista y Contrata</h3>
                <p>Gestiona tus entrevistas desde la plataforma y recibe ofertas directamente en tu panel.</p>
            </div>
        </div>
    </section>

    <section class="section-companies">
        <div class="steps-grid">
            <div class="step-card-white">
                <span class="step-num-blue">01</span>
                <h3>Publica tu Vacante</h3>
                <p>Define los requisitos y el perfil que buscas. Nosotros nos encargamos de difundirlo.</p>
            </div>
            <div class="step-card-white">
                <span class="step-num-blue">02</span>
                <h3>Filtra con IA</h3>
                <p>Recibe una lista pre-seleccionada de los candidatos que mejor encajan con tu cultura organizacional.</p>
            </div>
            <div class="step-card-white">
                <span class="step-num-blue">03</span>
                <h3>Cierra el Trato</h3>
                <p>Formaliza la pasantía con herramientas de gestión integradas y seguimiento de progreso.</p>
            </div>
        </div>
        <div class="companies-content">
            <span class="big-icon-blue">🏢</span>
            <h2>Ruta para Empresas</h2>
            <p>Optimiza tu proceso de reclutamiento. Encuentra frescura, innovación y compromiso en un solo lugar.</p>
        </div>
    </section>

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