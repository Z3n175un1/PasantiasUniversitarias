<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Oportunidades | InternConnect</title>
    <link rel="stylesheet" href="../css/styleindex.css">
    <link rel="stylesheet" href="../css/explorar.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen w-screen">
    <x-nav-bar />
    <header class="navbar">
        <div class="logo">
            <span class="icon-grad">🎓</span> <strong>InternConnect</strong>
        </div>
        <nav>
            <a href="index.html" class="nav-link">Home</a>
            <a href="login.html" class="btn-login">Login</a>
            <a href="registro.html" class="btn-register">Registro</a>
        </nav>
    </header>

    <main class="explore-container">
        <aside class="filters-sidebar">
            <div class="filter-group">
                <label>Buscar por nombre del cargo</label>
                <input type="text" placeholder="Ej. Designer">
            </div>

            <div class="filter-group">
                <label>País</label>
                <input type="text" placeholder="Ej. Chile, México...">
            </div>

            <div class="filter-group">
                <label>¿Qué estás buscando?</label>
                <div class="checkbox-item"><input type="checkbox"> Práctica, pasantía, internship</div>
                <div class="checkbox-item"><input type="checkbox"> Trabajo</div>
                <div class="checkbox-item"><input type="checkbox"> Evento</div>
            </div>

            <div class="filter-group">
                <label>Modalidad de Trabajo</label>
                <div class="checkbox-item"><input type="checkbox"> Presencial (En oficinas)</div>
                <div class="checkbox-item"><input type="checkbox"> Remoto (100% Home Office)</div>
                <div class="checkbox-item"><input type="checkbox"> Híbrido (Mixto)</div>
            </div>
            
            <button class="btn-dark w-100">Buscar</button>
        </aside>

        <section class="results-section">
            <p class="results-count">Hemos encontrado <strong>550</strong> resultados.</p>

            <div class="job-card-wide">
                <div class="card-main-info">
                    <div class="company-logo-box">
                        <img src="https://via.placeholder.com/50" alt="Logo">
                    </div>
                    <div class="title-meta">
                        <h3>Content Creator Intern | Startupeable</h3>
                        <p class="meta-text"><span class="brand-name">Startupeable</span> 📍 1930 Franklin St, Multipaís</p>
                    </div>
                </div>
                <p class="job-description">
                    Cada semana grabamos conversaciones de 60 minutos con los CEOs más top de LatAm. Tu trabajo: tomar esas conversaciones y convertirlas en contenido que llega a millones...
                </p>
                <div class="card-footer-tags">
                    <span class="tag-blue">Remoto</span>
                    <span class="tag-purple">Práctica, pasantía, internship</span>
                </div>
            </div>

            <div class="job-card-wide">
                <div class="card-main-info">
                    <div class="company-logo-box">
                        <img src="https://via.placeholder.com/50" alt="Logo">
                    </div>
                    <div class="title-meta">
                        <h3>Ejecutiva (o) de Cuentas para Customer Success</h3>
                        <p class="meta-text"><span class="brand-name">Postedin</span> 📍 Ciudad de México, México</p>
                    </div>
                </div>
                <p class="job-description">
                    Postedin está en búsqueda de una Ejecutiva/o de Cuentas para unir a un equipo dinámico y en crecimiento. La candidata ideal será responsable de administrar cuentas...
                </p>
                <div class="card-footer-tags">
                    <span class="tag-blue">Remoto</span>
                    <span class="tag-purple">Trabajo</span>
                </div>
            </div>

        </section>
    </main>

    </body>
</html>