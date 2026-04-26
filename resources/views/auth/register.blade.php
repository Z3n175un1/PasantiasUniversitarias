<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - UWorkFlow</title>
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
    <div class="w-full max-w-lg">
        <!-- Brand -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl shadow-xl shadow-blue-100 mb-4">
                <i data-lucide="graduation-cap" class="text-white w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Crea una cuenta</h1>
            <p class="text-slate-500 mt-2">Únete a la red de pasantías universitarias</p>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
            
            <!-- Role Selector -->
            <div class="bg-slate-50 p-1.5 rounded-2xl flex mb-8">
                @php $isCompany = request('role') === 'company'; @endphp
                <!-- <a href="?role=student" class="flex-1 py-3 px-4 rounded-xl text-sm text-center transition-all font-semibold {{ !$isCompany ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-400 hover:text-slate-600' }}">
                    <i data-lucide="user" class="inline-block w-4 h-4 mr-2 -mt-1"></i> Estudiante
                </a>
                <a href="?role=company" class="flex-1 py-3 px-4 rounded-xl text-sm text-center transition-all font-semibold {{ $isCompany ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-400 hover:text-slate-600' }}">
                    <i data-lucide="building-2" class="inline-block w-4 h-4 mr-2 -mt-1"></i> Empresa
                </a> -->
            </div>

            <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <input type="hidden" name="role" value="{{ request('role', 'student') }}">

                <!-- Name -->
                <div class="{{ $isCompany ? 'md:col-span-1' : 'md:col-span-1' }}">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                        {{ $isCompany ? 'Nombre del Contacto' : 'Nombre' }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="Ej. Juan Pérez">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                </div>

                @if($isCompany)
                <!-- Company Name -->
                <div class="md:col-span-1">
                    <label for="company_name" class="block text-sm font-bold text-slate-700 mb-2">Nombre de Empresa</label>
                    <input id="company_name" type="text" name="company_name" value="{{ old('company_name') }}" required 
                           class="block w-full px-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="Ej. TechCorp">
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2 text-xs" />
                </div>
                <!-- Industry -->
                <div class="md:col-span-1">
                    <label for="industry" class="block text-sm font-bold text-slate-700 mb-2">Industria</label>
                    <input id="industry" type="text" name="industry" value="{{ old('industry') }}" required 
                           class="block w-full px-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="Ej. Tecnología">
                    <x-input-error :messages="$errors->get('industry')" class="mt-2 text-xs" />
                </div>
                <!-- Location -->
                <div class="md:col-span-1">
                    <label for="location" class="block text-sm font-bold text-slate-700 mb-2">Ubicación</label>
                    <input id="location" type="text" name="location" value="{{ old('location') }}" required 
                           class="block w-full px-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="Ej. Ciudad">
                    <x-input-error :messages="$errors->get('location')" class="mt-2 text-xs" />
                </div>
                @else
                <!-- Last Name -->
                <div class="md:col-span-1">
                    <label for="last_name" class="block text-sm font-bold text-slate-700 mb-2">Apellidos</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required 
                           class="block w-full px-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="Ej. Pérez">
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-xs" />
                </div>
                <!-- Birth Date -->
                <div class="md:col-span-1">
                    <label for="birth_date" class="block text-sm font-bold text-slate-700 mb-2">Fecha de Nacimiento</label>
                    <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" required 
                           class="block w-full px-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all">
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2 text-xs" />
                </div>
                <!-- Career ID -->
                <div class="md:col-span-1">
                    <label for="career_id" class="block text-sm font-bold text-slate-700 mb-2">ID de Carrera</label>
                    <input id="career_id" type="number" name="career_id" value="{{ old('career_id', 1) }}" required min="1" max="5" 
                           class="block w-full px-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="1-5">
                    <x-input-error :messages="$errors->get('career_id')" class="mt-2 text-xs" />
                </div>
                @endif

                <!-- Email -->
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Institucional / Corporativo</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="tu@universidad.edu">
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
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirmar Clave</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 text-sm focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-600 transition-all" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
                </div>

                <!-- Terms -->
                <div class="md:col-span-2">
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="checkbox" required class="mt-1 rounded-lg bg-slate-50 border-slate-200 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="text-xs text-slate-500 leading-relaxed font-medium">
                            Estoy de acuerdo con los <a href="{{ route('terms') }}" target="_blank" class="text-blue-600 font-bold hover:underline">Términos y Condiciones</a> de UWorkFlow.
                        </span>
                    </label>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-slate-800 focus:ring-4 focus:ring-slate-100 transition-all shadow-xl shadow-slate-100">
                        Crear Cuenta
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-slate-500">
                    ¿Ya tienes una cuenta? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        Inicia sesión aquí
                    </a>
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