// Control de contraseña
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

// Solo letras
function onlyLetters(input) {
    input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
}

// Validación de celular
function checkCellInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length > 8) input.value = input.value.slice(0, 8);

    input.className = input.value.length === 8
        ? "w-full px-4 py-3.5 rounded-xl border outline-none text-sm font-medium transition-all success-input"
        : "w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
}

// Fortaleza de contraseña
function checkPasswordStrength(password) {
    const passInput = document.getElementById('pass');
    const label = document.getElementById('strength-label');
    const bars = [1, 2, 3, 4].map(i => document.getElementById(`bar-${i}`));

    const requirements = {
        'req-length': password.length >= 8,
        'req-number': /[0-9]/.test(password),
        'req-upper': /[A-Z]/.test(password),
        'req-special': /[@$!%*?&]/.test(password)
    };

    Object.entries(requirements).forEach(([id, isValid]) => {
        updateRequirementState(id, `ico-${id.split('-')[1]}`, isValid);
    });

    const passedCount = Object.values(requirements).filter(Boolean).length;

    // Reset bars
    bars.forEach(bar => bar.className = 'h-1.5 rounded-full bg-gray-200 transition-all duration-300');

    const strengthLevels = {
        0: { text: 'Vacía', color: 'text-gray-400', barColor: '', barCount: 0 },
        1: { text: 'Débil ❌', color: 'text-red-500', barColor: 'bg-red-500', barCount: 1 },
        2: { text: 'Media ⚠️', color: 'text-amber-500', barColor: 'bg-amber-500', barCount: 2 },
        3: { text: 'Buena 👍', color: 'text-blue-500', barColor: 'bg-blue-500', barCount: 3 },
        4: { text: 'Excelente 💪', color: 'text-emerald-500', barColor: 'bg-emerald-500', barCount: 4 }
    };

    const level = strengthLevels[passedCount] || strengthLevels[0];

    label.innerText = level.text;
    label.className = `text-xs font-bold ${level.color}`;

    for (let i = 0; i < level.barCount; i++) {
        bars[i].className = `h-1.5 rounded-full ${level.barColor} transition-all duration-300`;
    }

    // Actualizar clase del input
    passInput.className = passedCount === 4
        ? "w-full pl-4 pr-11 py-3.5 rounded-xl border outline-none text-sm font-medium transition-all success-input"
        : "w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";

    checkPasswordMatch();
}

function updateRequirementState(rowId, iconWrapperId, isValid) {
    const row = document.getElementById(rowId);
    const wrapper = document.getElementById(iconWrapperId);

    if (isValid) {
        row.className = "req-item flex items-center gap-2 text-emerald-600 font-bold scale-[1.01]";
        wrapper.className = "flex items-center text-emerald-500";
        wrapper.innerHTML = '<i data-lucide="check-circle-2" class="w-3.5 h-3.5 stroke-[3]"></i>';
    } else {
        row.className = "req-item flex items-center gap-2 text-gray-400 font-medium";
        wrapper.className = "flex items-center text-gray-300";
        wrapper.innerHTML = '<i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i>';
    }

    lucide.createIcons();
}

function checkPasswordMatch() {
    const pass = document.getElementById('pass').value;
    const confirmInput = document.getElementById('confirm_pass');
    const confirmValue = confirmInput.value;

    if (confirmValue.length === 0) {
        confirmInput.className = "w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
        return;
    }

    const isSecure = pass.length >= 8 && /[0-9]/.test(pass) && /[A-Z]/.test(pass) && /[@$!%*?&]/.test(pass);

    confirmInput.className = (pass === confirmValue && isSecure)
        ? "w-full pl-4 pr-11 py-3.5 rounded-xl border outline-none text-sm font-medium transition-all success-input"
        : "w-full pl-4 pr-11 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all";
}

// Cambio de roles
function setRole(role) {
    const header = document.getElementById('form-header');
    const content = document.getElementById('dynamic-content');

    const roleConfig = {
        student: {
            header: `<h1 class="text-2xl font-extrabold text-gray-900 mb-1 tracking-tight">Registro de Estudiante</h1>
                    <p class="text-gray-500 text-sm">Tu futuro profesional comienza aquí.</p>`,
            content: `
                <input type="hidden" name="role" value="student">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nombres Completos</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required 
                            oninput="onlyLetters(this)" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                            placeholder="Ej. Ana María">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido Paterno</label>
                        <input type="text" name="paternal_surname" value="{{ old('paternal_surname') }}" required 
                            oninput="onlyLetters(this)" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                            placeholder="López">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Apellido Materno</label>
                        <input type="text" name="maternal_surname" value="{{ old('maternal_surname') }}" required 
                            oninput="onlyLetters(this)" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                            placeholder="Pinto">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Celular (8 dígitos)</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" id="cell" required 
                            oninput="checkCellInput(this)" 
                            placeholder="Ej. 76543210" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all">
                    </div>
                    <div class="md:col-span-3 space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Carrera Universitaria</label>
                        <input type="text" name="career" value="{{ old('career') }}" required 
                            oninput="onlyLetters(this)" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                            placeholder="Ej. Ingeniería de Sistemas">
                    </div>
                </div>`
        },
        company: {
            header: `<h1 class="text-2xl font-extrabold text-gray-900 mb-1 tracking-tight">Registro de Empresa</h1>
                    <p class="text-gray-500 text-sm">Encuentra el talento que tu equipo necesita.</p>`,
            content: `
                <input type="hidden" name="role" value="company">
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
                            oninput="onlyLetters(this)" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                            placeholder="Ej. Tecnología">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Celular (8 dígitos)</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" id="cell" required 
                            oninput="checkCellInput(this)" 
                            placeholder="Ej. 70001234" 
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium transition-all">
                    </div>
                    <div class="md:col-span-3 pt-4 border-t border-gray-100 mt-2 space-y-4">
                        <p class="text-xs font-extrabold text-gray-800 uppercase tracking-widest">Datos del Responsable de RRHH</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Nombres</label>
                                <input type="text" name="hr_name" value="{{ old('hr_name') }}" required 
                                    oninput="onlyLetters(this)" 
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                                    placeholder="Juan">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-gray-400 uppercase">A. Paterno</label>
                                <input type="text" name="hr_paternal" value="{{ old('hr_paternal') }}" required 
                                    oninput="onlyLetters(this)" 
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                                    placeholder="Pérez">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-gray-400 uppercase">A. Materno</label>
                                <input type="text" name="hr_maternal" value="{{ old('hr_maternal') }}" required 
                                    oninput="onlyLetters(this)" 
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/30 outline-none input-focus text-sm font-medium" 
                                    placeholder="Quispe">
                            </div>
                        </div>
                    </div>
                </div>`
        }
    };

    const config = roleConfig[role] || roleConfig.student;
    header.innerHTML = config.header;
    content.innerHTML = config.content;
    lucide.createIcons();
}