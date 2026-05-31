<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | UWorkFlow</title>

    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.01em;
        }

        .auth-gradient {
            background: radial-gradient(circle at top right, #f0f7ff 0%, #ffffff 100%);
        }
    </style>
</head>

<body class="auth-gradient min-h-screen flex items-center justify-center p-6">
    <main class="w-full max-w-[480px] animate-in fade-in slide-in-from-bottom-4 duration-700">
        <section
            class="bg-white rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-gray-100 p-8 md:p-12">

            {{-- Header --}}
            <header class="text-center mb-10 space-y-3">
                <a href="{{ route('index') }}" class="inline-flex items-center gap-2 group cursor-pointer mb-2">
                    <div
                        class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center transition-all group-hover:bg-[#2b6df2] group-hover:rotate-12">
                        <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">UWorkFlow</span>
                </a>
                <div>
                    <h1 class="text-3xl font-extrabold text-[#0d1b2a] tracking-tight">Iniciar Sesión</h1>
                    <p class="text-gray-500 text-sm font-medium leading-relaxed mt-1">
                        Ingresa tus credenciales para acceder a tu cuenta
                    </p>
                </div>
            </header>

            {{-- Mensaje de error general --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Formulario de Login --}}
            <form action="/login" method="POST" class="space-y-6" id="login-form">
                @csrf

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Correo Electrónico</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2b6df2] transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" name="correo" value="{{ old('correo') }}"
                            class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 transition-all font-medium text-sm @error('correo') border-red-300 bg-red-50 @enderror"
                            placeholder="nombre@ejemplo.com" required>
                    </div>
                    @error('correo')
                        <div class="text-red-500 text-xs font-bold ml-2 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700 ml-1">Contraseña</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2b6df2] transition-colors">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white focus:border-[#2b6df2] focus:ring-4 focus:ring-blue-50 transition-all font-medium text-sm"
                            placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                            <i id="eye-icon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                {{-- Recordar y Olvidé contraseña --}}
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="remember"
                            class="w-5 h-5 border-2 border-gray-200 rounded-md text-[#2b6df2] focus:ring-[#2b6df2]">
                        <span class="text-sm font-semibold text-gray-500">Recordar sesión</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-[#2b6df2] hover:opacity-70">¿Olvidaste tu contraseña?</a>
                </div>

                {{-- Botón Submit --}}
                <button type="submit"
                    class="w-full bg-[#0d121f] text-white py-5 rounded-[20px] font-black hover:bg-[#2b6df2] transition-all active:scale-95 flex items-center justify-center gap-2 group shadow-xl shadow-blue-900/5 text-sm">
                    <span>Ingresar a la Plataforma</span>
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            {{-- Footer --}}
            <footer class="mt-10 text-center space-y-6">
                <p class="text-sm font-semibold text-gray-500">
                    ¿Eres nuevo?
                    <a href="{{ route('seleccion') }}"
                        class="text-[#0d121f] font-black border-b-2 border-blue-100 hover:border-[#2b6df2] transition-all ml-1">
                        Crea una cuenta
                    </a>
                </p>
                <div class="pt-6 border-t border-gray-50">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter">
                        Plataforma segura de UWorkFlow © 2026
                    </p>
                </div>
            </footer>
        </section>

        {{-- Botón volver al inicio --}}
        <div class="mt-8 text-center">
            <a href="{{ route('index') }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-[#0d121f] transition-colors uppercase tracking-wider">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Volver al inicio
            </a>
        </div>
    </main>

    <script>
        lucide.createIcons();

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>

</html>