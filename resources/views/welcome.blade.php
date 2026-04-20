<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UWorkFlow - Pasantias Universitarias Para ti</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    :root {
    --primary-blue: #2b6df2;
    --dark-bg: #0d121f;
    --light-bg: #f8faff;
    --text-main: #1a1a1a;
    --text-muted: #666;
}

* { 
    margin: 0; 
    padding: 0; 
    box-sizing: border-box; 
    font-family: 'Inter', sans-serif; 
}

body { 
    background-color: white; 
    overflow-x: hidden;
}

/* NAVBAR */
.navbar { 
    display: flex; 
    justify-content: space-between; 
    padding: 25px 8%; align-items: center; 
}

.nav-link { 
    text-decoration: none; 
    color: var(--text-muted); 
    margin-right: 20px; 
    font-weight: 500; 
}

.btn-login { 
    text-decoration: none; 
    padding: 10px 20px; 
    border: 1px solid #ddd; 
    border-radius: 8px; 
    color: var(--text-main); 
    margin-right: 15px; 
}

.btn-register { 
    text-decoration: none; 
    padding: 10px 25px; 
    background: var(--dark-bg); 
    color: white; 
    border-radius: 8px; 
    font-weight: 600; 
}

/* HERO */
.hero { 
    display: flex; 
    padding: 60px 8%; 
    align-items: center; 
    gap: 40px; 
    background-color: var(--light-bg); 

}
.hero-content h1 {
    font-size: 3.5rem; 
    line-height: 1.1; 
    margin-bottom: 20px; 
    color: #0d1b2a; 
}

.highlight { 
    color: var(--primary-blue); 
}

.hero-content p { 
    color: var(--text-muted); 
    font-size: 1.1rem; 
    margin-bottom: 30px; 
    line-height: 1.6; 
}
.hero-buttons { 
    display: flex; 
    gap: 15px; 

}
.btn-dark { 
    background: var(--dark-bg); 
    color: white; 
    padding: 15px 25px; 
    border: none; 
    border-radius: 10px; 
    font-weight: 600; 
    cursor: pointer; 
}

.btn-light { 
    background: white; 
    border: 1px solid #eee; 
    padding: 15px 25px; 
    border-radius: 10px; 
    font-weight: 600; 
    cursor: pointer; 
}

.hero-image-container { 
    position: relative; 
}

.main-img { 
    width: 550px; 
    border-radius: 20px; 
}

.stats-card { 
    position: absolute; 
    bottom: 20px; 
    left: -20px; 
    background: white; 
    padding: 15px 20px; 
    border-radius: 15px; 
    display: flex; 
    align-items: center; 
    gap: 12px; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
}


/* FEATURES */
.features { display: flex; padding: 80px 8%; gap: 30px; }
.feature-card { background: white; padding: 40px; border-radius: 20px; border: 1px solid #f0f0f0; box-shadow: 0 5px 15px rgba(0,0,0,0.02); flex: 1; }
.f-icon { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 10px; margin-bottom: 20px; background: #eef4ff; font-size: 1.2rem; }
.feature-card h3 { margin-bottom: 15px; font-size: 1.4rem; }
.feature-card p { color: var(--text-muted); line-height: 1.6; }

/* SECTION STUDENTS (BLUE) */
.section-students { background: #2b6df2; padding: 80px 8%; display: flex; align-items: center; gap: 60px; color: white; }
.students-content { flex: 1; }
.big-icon { font-size: 3rem; display: block; margin-bottom: 20px; }
.section-students h2 { font-size: 2.5rem; margin-bottom: 25px; }
.section-students ul { list-style: none; margin-bottom: 30px; }
.section-students ul li { margin-bottom: 12px; font-size: 1.1rem; }
.btn-white { background: #f0f4ff; color: #1a1a1a; border: none; padding: 15px 30px; border-radius: 10px; font-weight: 600; cursor: pointer; }

.steps-container-blue { background: rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; flex: 1; display: flex; flex-direction: column; gap: 20px; }
.step-card-glass { background: rgba(255,255,255,0.2); padding: 25px; border-radius: 15px; }
.step-card-glass span { font-size: 0.9rem; opacity: 0.9; }
.step-card-glass h3 { font-size: 1.8rem; margin-top: 5px; }

/* SECTION COMPANIES (GREY) */
.section-companies { background: #fcfcfc; padding: 80px 8%; display: flex; align-items: center; gap: 60px; }
.steps-container-grey { background: #f8f8f8; padding: 40px; border-radius: 20px; flex: 1; display: flex; flex-direction: column; gap: 20px; }
.step-card-white { background: white; padding: 25px; border-radius: 15px; border: 1px solid #eee; }
.step-card-white span { color: #888; font-size: 0.9rem; }
.step-card-white h3 { font-size: 1.8rem; margin-top: 5px; color: #1a1a1a; }
.companies-content { flex: 1; }
.big-icon-blue { font-size: 3rem; color: #2b6df2; display: block; margin-bottom: 20px; }
.section-companies h2 { font-size: 2.5rem; margin-bottom: 25px; }
.section-companies ul { list-style: none; margin-bottom: 30px; }
.section-companies ul li { margin-bottom: 12px; color: #444; font-size: 1.1rem; }

/* FOOTER */
.footer { background: #0d121f; color: white; padding: 80px 8% 40px; }
.footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 40px; padding-bottom: 60px; border-bottom: 1px solid #222; }
.footer-brand p { color: #888; margin-top: 15px; max-width: 250px; }
.footer-links h4 { margin-bottom: 20px; font-size: 1.1rem; }
.footer-links a { display: block; color: #888; text-decoration: none; margin-bottom: 10px; transition: 0.3s; }
.footer-links a:hover { color: white; }
.footer-bottom { text-align: center; padding-top: 30px; color: #555; font-size: 0.9rem; }
</style>
<body>
    <header class="navbar">
        <div class="logo">
            <span class="icon-grad"><strong>UWorkFlow</strong>
        </div>
        <nav>
            <a href="#" class="nav-link">Home</a>
            <a href="#" class="btn-login">Login</a>
            <a href="#" class="btn-register">Registro</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Conecta tu futuro con la <span class="highlight"><br>Pasantía Perfecta</span></h1>
            <p>Cerrar la brecha entre estudiantes ambiciosos y empresas pensantes. Encuentra oportunidades de pasantía significativas o descubre el mejor talento para tu organización.</p>
            <div class="hero-buttons">
                <button class="btn-dark">Buscar Pasantías</button>
                <button class="btn-light">Publicar Pasantía</button>
            </div>
        </div>
        <div class="hero-image-container">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="Students" class="main-img">
            <div class="stats-card">
                <div class="stats-icon"></div>
                <div class="stats-text">
                    <span>Tasa de Éxito del</span>
                    <strong>87%</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="feature-card">
            <h3>Matching inteligente</h3>
            <p>Nuestra inteligente algoritmo combina estudiantes con las oportunidades de pasantía más relevantes basadas en habilidades, intereses y objetivos profesionales.</p>
        </div>
        <div class="feature-card">
            <h3>Empresas verificadas</h3>
            <p>Trabaja con confianza sabiendo que todas las empresas están verificadas y comprometidas a proporcionar experiencias de aprendizaje valiosas para los pasantes.</p>
        </div>
        <div class="feature-card">
            <h3>Manejo simplificado</h3>
            <p>El proceso de gestión de aplicaciones es intuitivo y sencillo, permitiéndote encontrar la coincidencia perfecta de manera eficiente.</p>
        </div>
    </section>

    <section class="section-students">
        <div class="students-content">
            <h2>Dirigido para estudiantes</h2>
            <ul>
                <li>✓ Explorar cientos de oportunidades de pasantía</li>
                <li>✓ Ser emparejado con posiciones que se ajusten a tu perfil</li>
                <li>✓ Seguir tus aplicaciones en tiempo real</li>
                <li>✓ Construir tu red profesional</li>
            </ul>
            <button class="btn-white">Comenzar como estudiante</button>
        </div>
        <div class="steps-container-blue">
            <div class="step-card-glass"><span>Crear perfil</span> <h3>Paso 1</h3></div>
            <div class="step-card-glass"><span>Buscar y aplicar</span> <h3>Paso 2</h3></div>
            <div class="step-card-glass"><span>Comenzar la pasantía</span> <h3>Paso 3</h3></div>
        </div>
    </section>

    <section class="section-companies">
        <div class="steps-container-grey">
            <div class="step-card-white"><span>Publicar oportunidades</span> <h3>Paso 1</h3></div>
            <div class="step-card-white"><span>Revisar los mejores candidatos</span> <h3>Paso 2</h3></div>
            <div class="step-card-white"><span>Contratar el mejor talento</span> <h3>Paso 3</h3></div>
        </div>
        <div class="companies-content">
            <h2>Para Empresas</h2>
            <ul>
                <li>✓ Acceder a un pool de estudiantes talentosos</li>
                <li>✓ Recomendaciones inteligentes para los mejores candidatos</li>
                <li>✓ Gestión de aplicaciones optimizada</li>
                <li>✓ Construir tu futuro equipo de trabajo</li>
            </ul>
            <button class="btn-dark">Comenzar como Empresa</button>
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
                <a href="#">Explorar Pasantías</a>
                <a href="#">Cómo Funciona</a>
                <a href="#">Historias de Éxito</a>
            </div>
            <div class="footer-links">
                <h4>Para Empresas</h4>
                <a href="#">Publicar Oportunidades</a>
                <a href="#">Encontrar Talento</a>
                <a href="#">Precios</a>
            </div>
            <div class="footer-links">
                <h4>Compañía</h4>
                <a href="#">Sobre Nosotros</a>
                <a href="#">Contacto</a>
                <a href="#">Política de Privacidad</a>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 InternConnect. Todos los derechos reservados a ADRI.
        </div>
    </footer>

</body>
</html>