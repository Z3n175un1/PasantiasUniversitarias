<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recuperar Contraseña | UWorkFlow</title>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .split-bg {
            background: linear-gradient(135deg, #0d121f 0%, #1a1f35 50%, #2b6df2 100%);
            position: relative;
            overflow: hidden;
        }
        .split-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 50%, rgba(43,109,242,0.15) 0%, transparent 60%);
        }
        .split-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 70% 20%, rgba(255,255,255,0.05) 0%, transparent 50%);
        }
        .float-icon {
            animation: float 6s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-12px) rotate(2deg); }
            66% { transform: translateY(6px) rotate(-1deg); }
        }
        .fade-in { animation: fadeIn 0.6s ease forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .glow-card { box-shadow: 0 0 40px rgba(43, 109, 242, 0.08); }
    </style>
</head>
<body class="min-h-screen flex">
    {{-- Left: Decoration --}}
    <div class="hidden lg:flex lg:w-1/2 split-bg items-center justify-center p-12 relative">
        <div class="relative z-10 text-center max-w-lg">
            <div class="absolute top-20 left-12 float-icon opacity-20">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center border border-white/10">
                    <i data-lucide="lock" class="w-8 h-8 text-white"></i>
                </div>
            </div>
            <div class="absolute bottom-32 right-16 float-icon opacity-20">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center border border-white/10">
                    <i data-lucide="shield" class="w-6 h-6 text-white"></i>
                </div>
            </div>

            <div class="flex items-center justify-center gap-3 mb-8 fade-in">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="graduation-cap" class="w-8 h-8 text-[#0d121f]"></i>
                </div>
                <span class="text-4xl font-extrabold tracking-tighter text-white">UWorkFlow</span>
            </div>

            <h1 class="text-3xl font-bold text-white leading-tight mb-4">
                ¿Olvidaste tu<br>
                <span class="text-blue-300">contraseña?</span>
            </h1>
            <p class="text-blue-200/70 text-sm leading-relaxed max-w-md mx-auto">
                No te preocupes, te enviaremos un enlace para restablecerla. Recuerda revisar tu bandeja de entrada.
            </p>
        </div>
    </div>

    {{-- Right: Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-[#f8faff]">
        <main class="w-full max-w-[440px] fade-in">
            <section class="bg-white rounded-[32px] glow-card border border-gray-100 p-8 md:p-10">
                <header class="mb-8">
                    <div class="flex items-center gap-2 mb-6 lg:hidden">
                        <div class="w-9 h-9 bg-[#0d121f] rounded-xl flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="text-white w-5 h-5"></i>
                        </div>
                        <span class="text-xl font-extrabold tracking-tighter text-[#0d121f]">UWorkFlow</span>
                    </div>
                    <h1 class="text-2xl font-extrabold text-[#0d1b2a] tracking-tight">Recuperar Contraseña</h1>
                    <p class="text-gray-500 text-sm font-medium mt-1">Ingresa tu correo y te enviaremos instrucciones.</p>
                </header>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-semibold flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 flex-shrink-0"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm font-semibold flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.olvide.enviar') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-gray-700 ml-1">Correo Electrónico</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2b6df2] transition-colors">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <input type="email" name="correo" value="{{ old('correo') }}" required
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:bg-white focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 transition-all font-medium text-sm"
                                placeholder="nombre@ejemplo.com">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#0d121f] text-white py-4 rounded-2xl font-bold hover:bg-[#1a1f35] transition-all active:scale-[0.98] text-sm shadow-lg shadow-blue-900/10 flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        Enviar Instrucciones
                    </button>
                </form>

                <footer class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-gray-600 transition uppercase tracking-wider">
                        <i data-lucide="arrow-left" class="w-3 h-3"></i>
                        Volver al inicio de sesión
                    </a>
                </footer>
            </section>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
