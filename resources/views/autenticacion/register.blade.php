@extends('plantillas.auth')

@section('title', ($rol === 'student') ? 'Registro de Estudiante' : 'Registro de Empresa')

@section('content')
    {{-- Directo: action="/register" --}}
    <form method="POST" action="{{ url('/register') }}" class="space-y-8" novalidate>
        @csrf
        <input type="hidden" name="role" value="{{ $rol }}">

        <!-- Header -->
        <div id="form-header">
            @if($rol === 'student')
                <h1 class="text-2xl font-extrabold text-gray-900 mb-1 tracking-tight">
                    Registro de Estudiante 🎓
                </h1>
                <p class="text-gray-500 text-sm">Tu futuro profesional comienza aquí.</p>
            @else
                <h1 class="text-2xl font-extrabold text-gray-900 mb-1 tracking-tight">
                    Registro de Empresa 🏢
                </h1>
                <p class="text-gray-500 text-sm">Encuentra el talento que tu equipo necesita.</p>
            @endif
        </div>

        <!-- Campos según rol -->
        <div class="space-y-6">
            @if($rol === 'student')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nombres Completos</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Ej. Ana María">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido Paterno</label>
                        <input type="text" name="paternal_surname" value="{{ old('paternal_surname') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="López">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido Materno</label>
                        <input type="text" name="maternal_surname" value="{{ old('maternal_surname') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Pinto">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Celular (8 dígitos)</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="76543210" maxlength="8">
                    </div>
                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Carrera
                            Universitaria</label>
                        <input type="text" name="career" value="{{ old('career') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Ej. Ingeniería de Sistemas">
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nombre de la Empresa</label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Ej. Tech Corp S.R.L.">
                    </div>
                    <div class="md:col-span-2 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Sector Económico</label>
                        <input type="text" name="sector" value="{{ old('sector') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Ej. Tecnología">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Celular (8 dígitos)</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="70001234" maxlength="8">
                    </div>
                    <div class="md:col-span-3 pt-4 border-t border-gray-100 mt-2 space-y-4">
                        <p class="text-xs font-extrabold text-gray-800 uppercase tracking-widest">Datos del Responsable de RRHH
                        </p>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Nombres</label>
                                <input type="text" name="hr_name" value="{{ old('hr_name') }}" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                    placeholder="Juan">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">A. Paterno</label>
                                <input type="text" name="hr_paternal" value="{{ old('hr_paternal') }}" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                    placeholder="Pérez">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase">A. Materno</label>
                                <input type="text" name="hr_maternal" value="{{ old('hr_maternal') }}" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                                    placeholder="Quispe">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Campos Comunes -->
        <div class="pt-8 border-t border-gray-100 space-y-6">
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Correo Electrónico</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                        placeholder="usuario@ejemplo.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Contraseña</label>
                    <div class="relative">
                        <input type="password" id="pass" name="password" required
                            class="w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Escribe tu contraseña">
                        <button type="button" onclick="togglePassword('pass', 'eye-icon-1')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eye-icon-1" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Confirmar</label>
                    <div class="relative">
                        <input type="password" id="confirm_pass" name="password_confirmation" required
                            class="w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium"
                            placeholder="Repite contraseña">
                        <button type="button" onclick="togglePassword('confirm_pass', 'eye-icon-2')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eye-icon-2" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-black text-white py-4 rounded-2xl font-bold text-sm hover:bg-gray-800 transition-all mt-4">
            Finalizar Registro
        </button>

        <div class="text-center">
            <a href="{{ route('seleccion') }}" class="text-sm text-gray-500 hover:text-gray-700">
                ← Cambiar tipo de cuenta
            </a>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
@endpush