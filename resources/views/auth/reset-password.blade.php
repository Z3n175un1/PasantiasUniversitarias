<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restablecer Contraseña | UWorkFlow</title>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .split-bg {
            background: linear-gradient(135deg, #2b6df2 0%, #1a1f35 50%, #0d121f 100%);
            position: relative;
            overflow: hidden;
        }
        .split-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 70% 50%, rgba(43,109,242,0.2) 0%, transparent 60%);
        }
        .glow-card {
            box-shadow: 0 8px 40px rgba(0,0,0,0.06), 0 0 0 1px rgba(0,0,0,0.02);
        }
        .input-focus:focus { border-color: #2b6df2; box-shadow: 0 0 0 3px rgba(43,109,242,0.1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        .strength-bar { transition: width 0.3s ease, background 0.3s ease; }
    </style>
</head>
<body class="bg-[#f8faff]">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-[480px] fade-in">
            <div class="bg-white rounded-[32px] glow-card border border-gray-100 p-8 md:p-10">
                <div class="text-center mb-6">
                    <div class="w-14 h-14 bg-[#0d121f] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="graduation-cap" class="text-white w-7 h-7"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold text-[#0d1b2a] tracking-tight">Restablecer Contraseña</h1>
                    <p class="text-gray-500 text-sm font-medium mt-1">Ingresa tu nueva contraseña</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div>
                        <label class="text-xs font-bold text-gray-700 ml-1">Correo Electrónico</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="email" value="{{ $email }}" disabled
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-100 text-sm font-medium cursor-not-allowed">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-700 ml-1">Nueva Contraseña</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required minlength="8"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('password') error-input @enderror"
                                placeholder="Mínimo 8 caracteres">
                            <button type="button" onclick="togglePass('password','eye1')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i id="eye1" data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <div class="h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div id="strength-bar" class="h-full rounded-full" style="width:0%;background:#e5e7eb;"></div>
                            </div>
                            <p id="strength-text" class="text-xs mt-1 text-gray-400">&nbsp;</p>
                        </div>
                        @error('password') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-700 ml-1">Confirmar Contraseña</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                placeholder="Repite la contraseña">
                            <button type="button" onclick="togglePass('password_confirmation','eye2')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i id="eye2" data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#0d121f] hover:bg-[#1a1f35] text-white font-bold rounded-xl transition-all text-sm tracking-wide">
                        <i data-lucide="key" class="w-4 h-4 inline mr-1.5"></i>Restablecer Contraseña
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                        <i data-lucide="arrow-left" class="w-4 h-4 inline mr-1"></i>Volver al inicio de sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function togglePass(id, iconId) {
            const input = document.getElementById(id);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.setAttribute('data-lucide', input.type === 'password' ? 'eye' : 'eye-off');
            lucide.createIcons();
        }

        const passInput = document.getElementById('password');
        const bar = document.getElementById('strength-bar');
        const text = document.getElementById('strength-text');
        if (passInput) {
            passInput.addEventListener('input', function() {
                const val = this.value;
                let score = 0;
                if (val.length >= 8) score++;
                if (/[A-Z]/.test(val)) score++;
                if (/[a-z]/.test(val)) score++;
                if (/[0-9]/.test(val)) score++;
                const colors = ['#e5e7eb', '#ef4444', '#f97316', '#eab308', '#10b981'];
                const labels = ['', 'Débil', 'Regular', 'Buena', 'Fuerte'];
                const textColors = ['', '#ef4444', '#f97316', '#eab308', '#10b981'];
                bar.style.width = (score / 4 * 100) + '%';
                bar.style.background = colors[score];
                text.textContent = score > 0 ? labels[score] : '';
                text.style.color = textColors[score];
            });
        }
    </script>
</body>
</html>