<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>502 · Error del servidor | UWorkFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; overflow: hidden; }
        .glow { text-shadow: 0 0 10px rgba(255,255,255,.6), 0 0 20px rgba(59,130,246,.8), 0 0 40px rgba(59,130,246,.6); }
        .float { animation: floatAnim 5s ease-in-out infinite; }
        @keyframes floatAnim { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-15px); } }
        .rotate-slow { animation: rotate 25s linear infinite; }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .pulse-custom { animation: pulseCustom 2s infinite; }
        @keyframes pulseCustom { 0%,100% { opacity:1; } 50% { opacity:.4; } }
        .grid-bg { background-image: linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 40px 40px; }
    </style>
</head>
<body class="bg-[#0d121f] text-white min-h-screen flex flex-col">
    <nav class="bg-[#0d121f]/80 border-b border-white/5 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('index') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="text-white w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-extrabold text-white">UWorkFlow</span>
                </a>
                <a href="{{ route('index') }}"
                   class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-400 hover:text-white transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-1 relative flex items-center justify-center grid-bg">
        <div class="absolute w-[500px] h-[500px] bg-blue-500/20 blur-3xl rounded-full top-[-100px] left-[-100px]"></div>
        <div class="absolute w-[400px] h-[400px] bg-cyan-400/20 blur-3xl rounded-full bottom-[-100px] right-[-100px]"></div>

        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-[10%] left-[15%] w-2 h-2 bg-blue-400 rounded-full pulse-custom"></div>
            <div class="absolute top-[30%] left-[70%] w-3 h-3 bg-cyan-300 rounded-full pulse-custom"></div>
            <div class="absolute top-[80%] left-[40%] w-2 h-2 bg-blue-500 rounded-full pulse-custom"></div>
            <div class="absolute top-[60%] left-[85%] w-4 h-4 bg-cyan-500 rounded-full pulse-custom"></div>
        </div>

        <div class="relative z-10 backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl p-10 md:p-16 shadow-2xl max-w-3xl text-center float">
            <div class="absolute -top-16 -right-16 w-40 h-40 border border-cyan-400/20 rounded-full rotate-slow"></div>
            <div class="absolute -bottom-20 -left-20 w-52 h-52 border border-blue-500/20 rounded-full rotate-slow"></div>

            <h1 class="text-8xl md:text-9xl font-black glow tracking-widest">502</h1>
            <h2 class="mt-6 text-2xl md:text-4xl font-bold text-cyan-300">Error del servidor</h2>
            <p class="mt-6 text-gray-300 text-lg leading-relaxed max-w-2xl mx-auto">
            El servidor recibió una respuesta inválida mientras procesaba tu solicitud. 
            Nuestro equipo técnico ya fue notificado. Por favor, intenta de nuevo en unos minutos.
            </p>

            <div class="mt-10">
                <div class="flex justify-between text-sm text-gray-400 mb-2">
                    <span>Reconectando servidores...</span>
                    <span>72%</span>
                </div>
                <div class="w-full h-3 bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full w-[72%] bg-gradient-to-r from-cyan-400 to-blue-600 animate-pulse rounded-full"></div>
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row gap-4 justify-center">
                <button onclick="location.reload()" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:scale-105 transition-all duration-300 font-semibold shadow-lg shadow-cyan-500/30 inline-flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    Reintentar
                </button>
                <a href="{{ route('index') }}" class="px-8 py-4 rounded-2xl border border-white/20 hover:bg-white/10 transition-all duration-300 font-semibold inline-flex items-center gap-2">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    Volver al inicio
                </a>
            </div>

            <div class="mt-12 text-xs tracking-[0.3em] uppercase text-gray-500">
                UWorkFlow · ERROR 502
            </div>
        </div>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>