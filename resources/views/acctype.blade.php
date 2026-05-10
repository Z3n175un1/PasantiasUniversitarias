<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Cuenta - UWorkFlow</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">
    <x-nav-bar />

    <main class="flex-1 flex flex-col items-center justify-center p-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-4">¿Cómo deseas unirte?</h1>
            <p class="text-slate-500 text-lg">Elige el tipo de cuenta que mejor se adapte a ti</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">
            <!-- Student Card -->
            <a href="{{ route('register') }}?role=student" class="group bg-white p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-blue-500 transition-all hover:-translate-y-2 flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="graduation-cap" class="w-12 h-12"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Soy Estudiante</h2>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Busco oportunidades de pasantías, quiero ganar experiencia y conectar con las mejores empresas.
                </p>
                <span class="mt-auto inline-flex items-center font-bold text-blue-600 group-hover:text-blue-700">
                    Crear perfil de estudiante <i data-lucide="arrow-right" class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </a>

            <!-- Company Card -->
            <a href="{{ route('register') }}?role=company" class="group bg-white p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-slate-900 transition-all hover:-translate-y-2 flex flex-col items-center text-center">
                <div class="w-24 h-24 bg-slate-50 text-slate-700 rounded-full flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-slate-900 group-hover:text-white transition-all duration-300">
                    <i data-lucide="building-2" class="w-12 h-12"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Soy Empresa</h2>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Busco talento universitario, quiero publicar ofertas de pasantías y evaluar candidatos.
                </p>
                <span class="mt-auto inline-flex items-center font-bold text-slate-700 group-hover:text-slate-900">
                    Crear perfil de empresa <i data-lucide="arrow-right" class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </a>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
