<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido | Pasantías Universitarias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #f43f5e;
            --bg: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated Background Elements */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.5;
            animation: move 20s infinite alternate;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            right: -100px;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: var(--accent);
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(100px, 100px) scale(1.2); }
        }

        .container {
            max-width: 800px;
            width: 90%;
            text-align: center;
            padding: 3rem;
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, white 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
        }

        p {
            font-size: 1.25rem;
            color: #94a3b8;
            margin-bottom: 2.5rem;
            font-weight: 300;
            line-height: 1.6;
        }

        .info-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: var(--accent);
            border-radius: 99px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-outline {
            border: 1px solid var(--glass-border);
            color: white;
        }

        .btn-outline:hover {
            background: var(--glass-border);
            transform: translateY(-2px);
        }

        footer {
            margin-top: 3rem;
            color: #64748b;
            font-size: 0.875rem;
        }

        @media (max-width: 640px) {
            h1 { font-size: 2.5rem; }
            .container { padding: 2rem; }
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <main class="container">
        <div class="info-badge">Entorno Hosteado</div>
        
        <h1>Bienvenido a Pasantías Universitarias</h1>
        
        <p>
            Gestiona tus pasantías de manera profesional y eficiente. <br>
            <span style="color: white; font-weight: 400;">
                Consultas a Adri por privado.
            </span>
        </p>

        @if (Route::has('login'))
            <div class="actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Ir al Panel de Control</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </main>

    <footer>
        &copy; {{ date('Y') }} Pasantías Universitarias. Todos los derechos reservados.
    </footer>
</body>
</html>

