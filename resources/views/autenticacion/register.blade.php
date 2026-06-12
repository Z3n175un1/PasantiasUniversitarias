<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if($rol === 'student')Registro Estudiante @else Registro Empresa @endif | UWorkFlow</title>
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
        .split-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.05) 0%, transparent 50%);
        }
        .float-icon {
            animation: float 6s infinite ease-in-out;
        }
        .float-icon:nth-child(2) { animation-delay: -2s; }
        .float-icon:nth-child(3) { animation-delay: -4s; }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-12px) rotate(2deg); }
            66% { transform: translateY(6px) rotate(-1deg); }
        }
        .fade-in { animation: fadeIn 0.6s ease forwards; }
        .fade-in-left { animation: fadeInLeft 0.6s ease forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInLeft { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        .glow-card { box-shadow: 0 0 40px rgba(43, 109, 242, 0.08); }
        .strength-bar { height: 4px; border-radius: 4px; transition: all 0.3s ease; }
        .strength-text { font-size: 11px; font-weight: 600; transition: all 0.3s ease; }
        .input-focus:focus {
            border-color: #2b6df2;
            box-shadow: 0 0 0 4px rgba(43, 109, 242, 0.1);
        }
        .error-input { border-color: #ef4444 !important; background-color: #fef2f2 !important; }
        .success-input { border-color: #10b981 !important; background-color: #f0fdf4 !important; }
        .success-input:focus { box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1) !important; border-color: #10b981 !important; }
        .req-item { transition: all 0.2s ease; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex">
    {{-- Left: Form (mobile first: full width, desktop: half) --}}
    <div class="w-full lg:w-1/2 flex items-start justify-center p-4 md:p-6 bg-[#f8faff] overflow-y-auto min-h-screen">
        <main class="w-full max-w-[520px] fade-in py-4 md:py-8">
            <section class="bg-white rounded-[32px] glow-card border border-gray-100 p-6 md:p-10">
                {{-- Header --}}
                <header class="mb-6">
                    <div class="flex items-center gap-2 mb-4 lg:hidden">
                        <div class="w-9 h-9 bg-[#0d121f] rounded-xl flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="text-white w-5 h-5"></i>
                        </div>
                        <span class="text-xl font-extrabold tracking-tighter text-[#0d121f]">UWorkFlow</span>
                    </div>
                    @if($rol === 'student')
                        <h1 class="text-2xl font-extrabold text-[#0d1b2a] tracking-tight">Registro de Estudiante</h1>
                        <p class="text-gray-500 text-sm font-medium mt-1">Tu futuro profesional comienza aquí.</p>
                    @else
                        <h1 class="text-2xl font-extrabold text-[#0d1b2a] tracking-tight">Registro de Empresa</h1>
                        <p class="text-gray-500 text-sm font-medium mt-1">Encuentra el talento que tu equipo necesita.</p>
                    @endif
                </header>

                <form method="POST" action="{{ url('/register') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="role" value="{{ $rol }}">

                    {{-- Student fields --}}
                    @if($rol === 'student')
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-bold text-gray-700 ml-1">Nombres Completos</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('full_name') error-input @enderror"
                                    placeholder="Ej. Ana María" pattern="[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s]+" title="Solo letras y espacios">
                                @error('full_name') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-bold text-gray-700 ml-1">Apellido Paterno</label>
                                    <input type="text" name="paternal_surname" value="{{ old('paternal_surname') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('paternal_surname') error-input @enderror"
                                        placeholder="López" pattern="[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s]+" title="Solo letras y espacios">
                                    @error('paternal_surname') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-700 ml-1">Apellido Materno</label>
                                    <input type="text" name="maternal_surname" value="{{ old('maternal_surname') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('maternal_surname') error-input @enderror"
                                        placeholder="Pinto" pattern="[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s]+" title="Solo letras y espacios">
                                    @error('maternal_surname') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-bold text-gray-700 ml-1">Celular (8 dígitos)</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('phone') error-input @enderror"
                                        placeholder="76543210" maxlength="8" pattern="[0-9]{8}" title="Debe tener 8 dígitos">
                                    @error('phone') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-700 ml-1">Carrera</label>
                                    <input type="text" name="career" value="{{ old('career') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                        placeholder="Ej. Ingeniería de Sistemas">
                                </div>
                            </div>
                        </div>

                    {{-- Company fields --}}
                    @else
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-bold text-gray-700 ml-1">Nombre de la Empresa</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                    placeholder="Ej. Tech Corp S.R.L.">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-bold text-gray-700 ml-1">Sector Económico</label>
                                    <input type="text" name="sector" value="{{ old('sector') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                        placeholder="Ej. Tecnología">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-700 ml-1">Celular (8 dígitos)</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('phone') error-input @enderror"
                                        placeholder="70001234" maxlength="8" pattern="[0-9]{8}" title="Debe tener 8 dígitos">
                                    @error('phone') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="pt-3 border-t border-gray-100">
                                <p class="text-xs font-extrabold text-gray-600 uppercase tracking-widest mb-4">Datos del Responsable de RRHH</p>
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label class="text-xs font-bold text-gray-700 ml-1">Nombres</label>
                                        <input type="text" name="hr_name" value="{{ old('hr_name') }}" required
                                            class="w-full px-3 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                            placeholder="Juan" pattern="[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s]+" title="Solo letras y espacios">
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-gray-700 ml-1">A. Paterno</label>
                                        <input type="text" name="hr_paternal" value="{{ old('hr_paternal') }}" required
                                            class="w-full px-3 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                            placeholder="Pérez" pattern="[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s]+" title="Solo letras y espacios">
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-gray-700 ml-1">A. Materno</label>
                                        <input type="text" name="hr_maternal" value="{{ old('hr_maternal') }}"
                                            class="w-full px-3 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                            placeholder="Quispe" pattern="[A-Za-zÁáÉéÍíÓóÚúÜüÑñ\s]*" title="Solo letras y espacios">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Common fields: Email --}}
                    <div class="pt-4 border-t border-gray-100 space-y-4">
                        <div>
                            <label class="text-xs font-bold text-gray-700 ml-1">Correo Electrónico</label>
                            <div class="relative">
                                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium @error('email') error-input @enderror"
                                    placeholder="usuario@ejemplo.com">
                            </div>
                            @error('email') <p class="text-red-500 text-xs font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password with strength indicator --}}
                        <div>
                            <label class="text-xs font-bold text-gray-700 ml-1">Contraseña</label>
                            <div class="relative">
                                <input type="password" id="pass" name="password" required
                                    class="w-full pl-4 pr-11 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                    placeholder="Mínimo 8 caracteres">
                                <button type="button" onclick="togglePassword('pass', 'eye-icon-1')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i id="eye-icon-1" data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                            {{-- Strength bar --}}
                            <div class="mt-2">
                                <div class="strength-bar w-full bg-gray-100 overflow-hidden" style="height:4px;border-radius:4px;">
                                    <div id="strength-bar" class="strength-bar" style="width:0%;background:#e5e7eb;"></div>
                                </div>
                                <p id="strength-text" class="strength-text text-gray-400 mt-1">&nbsp;</p>
                            </div>
                            {{-- Password requirements --}}
                            <div class="mt-2 space-y-1">
                                <p class="req-item text-xs text-gray-400 flex items-center gap-1.5" id="req-length">
                                    <i data-lucide="circle" class="w-2.5 h-2.5"></i> Mínimo 8 caracteres
                                </p>
                                <p class="req-item text-xs text-gray-400 flex items-center gap-1.5" id="req-upper">
                                    <i data-lucide="circle" class="w-2.5 h-2.5"></i> Una mayúscula
                                </p>
                                <p class="req-item text-xs text-gray-400 flex items-center gap-1.5" id="req-lower">
                                    <i data-lucide="circle" class="w-2.5 h-2.5"></i> Una minúscula
                                </p>
                                <p class="req-item text-xs text-gray-400 flex items-center gap-1.5" id="req-number">
                                    <i data-lucide="circle" class="w-2.5 h-2.5"></i> Un número
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-700 ml-1">Confirmar Contraseña</label>
                            <div class="relative">
                                <input type="password" id="confirm_pass" name="password_confirmation" required
                                    class="w-full pl-4 pr-11 py-3 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                    placeholder="Repite la contraseña">
                                <button type="button" onclick="togglePassword('confirm_pass', 'eye-icon-2')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i id="eye-icon-2" data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#0d121f] text-white py-4 rounded-2xl font-bold hover:bg-[#1a1f35] transition-all active:scale-[0.98] text-sm shadow-lg shadow-blue-900/10 mt-2">
                        Finalizar Registro
                    </button>

                    <div class="text-center pt-2">
                        <a href="{{ route('seleccion') }}" class="inline-flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-gray-600 transition">
                            <i data-lucide="arrow-left" class="w-3 h-3"></i>
                            Cambiar tipo de cuenta
                        </a>
                    </div>
                </form>
            </section>
        </main>
    </div>

    {{-- Right: Decoration --}}
    <div class="hidden lg:flex lg:w-1/2 split-bg items-center justify-center p-12 relative">
        <div class="relative z-10 text-center max-w-lg">
            <div class="absolute top-20 right-12 float-icon opacity-20">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center border border-white/10">
                    <i data-lucide="sparkles" class="w-8 h-8 text-white"></i>
                </div>
            </div>
            <div class="absolute bottom-32 left-16 float-icon opacity-20">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center border border-white/10">
                    <i data-lucide="target" class="w-6 h-6 text-white"></i>
                </div>
            </div>
            <div class="absolute top-1/3 left-10 float-icon opacity-10">
                <div class="w-20 h-20 bg-white/10 rounded-3xl flex items-center justify-center border border-white/10">
                    <i data-lucide="rocket" class="w-10 h-10 text-white"></i>
                </div>
            </div>

            <div class="flex items-center justify-center gap-3 mb-8 fade-in">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="graduation-cap" class="w-8 h-8 text-[#0d121f]"></i>
                </div>
                <span class="text-4xl font-extrabold tracking-tighter text-white">UWorkFlow</span>
            </div>

            @if($rol === 'student')
                <h1 class="text-3xl font-bold text-white leading-tight mb-4 fade-in-left">
                    Comienza tu viaje<br>
                    <span class="text-blue-300">hacia el éxito profesional</span>
                </h1>
                <p class="text-blue-200/70 text-sm leading-relaxed max-w-md mx-auto fade-in-left">
                    Explora oportunidades, conecta con empresas líderes y da el primer paso en tu carrera con la pasantía ideal.
                </p>
                <ul class="mt-8 space-y-3 text-left max-w-xs mx-auto fade-in">
                    <li class="flex items-center gap-3 text-blue-100 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-300 flex-shrink-0"></i>
                        Accede a +500 pasantías verificadas
                    </li>
                    <li class="flex items-center gap-3 text-blue-100 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-300 flex-shrink-0"></i>
                        Matching inteligente con tu perfil
                    </li>
                    <li class="flex items-center gap-3 text-blue-100 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-300 flex-shrink-0"></i>
                        Postulación en 1 clic
                    </li>
                </ul>
            @else
                <h1 class="text-3xl font-bold text-white leading-tight mb-4 fade-in-left">
                    Encuentra el mejor<br>
                    <span class="text-blue-300">talento para tu empresa</span>
                </h1>
                <p class="text-blue-200/70 text-sm leading-relaxed max-w-md mx-auto fade-in-left">
                    Publica vacantes, gestiona postulantes y descubre estudiantes talentosos listos para impulsar tu organización.
                </p>
                <ul class="mt-8 space-y-3 text-left max-w-xs mx-auto fade-in">
                    <li class="flex items-center gap-3 text-blue-100 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-300 flex-shrink-0"></i>
                        +1,000 estudiantes activos
                    </li>
                    <li class="flex items-center gap-3 text-blue-100 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-300 flex-shrink-0"></i>
                        Recomendaciones inteligentes
                    </li>
                    <li class="flex items-center gap-3 text-blue-100 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-blue-300 flex-shrink-0"></i>
                        Convenios con universidades
                    </li>
                </ul>
            @endif
        </div>
    </div>

    <script>
        lucide.createIcons();

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.setAttribute('data-lucide', input.type === 'password' ? 'eye' : 'eye-off');
            lucide.createIcons();
        }

        // Password strength
        const passInput = document.getElementById('pass');
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');

        passInput?.addEventListener('input', function() {
            const val = this.value;
            let score = 0;

            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;

            const colors = ['#e5e7eb', '#ef4444', '#f97316', '#eab308', '#10b981'];
            const labels = ['', 'Débil', 'Regular', 'Buena', 'Fuerte'];
            const textColors = ['', '#ef4444', '#f97316', '#eab308', '#10b981'];

            strengthBar.style.width = (score / 4 * 100) + '%';
            strengthBar.style.background = colors[score];
            strengthText.textContent = score > 0 ? labels[score] : '';
            strengthText.style.color = textColors[score];

            // Update requirements
            const checks = [
                { id: 'req-length', ok: val.length >= 8 },
                { id: 'req-upper', ok: /[A-Z]/.test(val) },
                { id: 'req-lower', ok: /[a-z]/.test(val) },
                { id: 'req-number', ok: /[0-9]/.test(val) },
            ];
            checks.forEach(c => {
                const el = document.getElementById(c.id);
                const icon = el.querySelector('i');
                if (c.ok) {
                    el.classList.remove('text-gray-400');
                    el.classList.add('text-green-600');
                    icon.setAttribute('data-lucide', 'check-circle-2');
                } else {
                    el.classList.remove('text-green-600');
                    el.classList.add('text-gray-400');
                    icon.setAttribute('data-lucide', 'circle');
                }
            });
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
