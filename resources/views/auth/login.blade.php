<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UWorkFlow</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">
    
<x-nav-bar />

<main class="flex-1 flex items-center justify-center p-6">
    <div class="w-2/3 max-w-sm">
        <!-- Brand -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl shadow-xl shadow-blue-100 mb-4">
                <i data-lucide="graduation-cap" class="text-white w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Bienvenido</h1>
            <p class="text-slate-500 mt-2">Ingresa para continuar a tu panel de control</p>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Correo Electrónico</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="tu@email.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Contraseña</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <!-- Extras -->
                <div class="flex items-center justify-between text-xs">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded-lg bg-slate-50 border-slate-200 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ms-2 font-bold text-slate-500 group-hover:text-slate-700 transition-colors uppercase tracking-tight">Recordar sesión</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors uppercase tracking-tight">
                            ¿Olvidaste tu clave?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-slate-800 focus:ring-4 focus:ring-slate-100 transition-all shadow-xl shadow-slate-100">
                    Iniciar Sesión
                </button>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-slate-500">
                    ¿No tienes una cuenta? 
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        Regístrate aquí
                    </a>
                </p>
                <p class="mt-6 text-[11px] text-slate-400 leading-relaxed px-4">
                    Al iniciar sesión, aceptas nuestros <a href="#" class="underline">Términos de Servicio</a> y nuestra <a href="#" class="underline">Política de Privacidad</a>.
                </p>
            </div>
        </div>
    </div>
</main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>