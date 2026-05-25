/**
 * register.js — UWorkFlow
 * Ubicar en: public/js/register.js
 *
 * El JS no contiene ningún fragmento HTML.
 * Toda la estructura vive en register.blade.php.
 * Este archivo solo maneja visibilidad, validación y comportamiento.
 */

// ── Inicialización ────────────────────────────────────────────────────────────
// Al final del DOMContentLoaded existente, agregar:
window.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    setRole(typeof ROL_INICIAL !== 'undefined' ? ROL_INICIAL : 'student');
});

// ── Control de flujo entre vistas ─────────────────────────────────────────────

function selectInitialRole(role) {
    document.getElementById('step-selector').classList.add('hidden');
    document.getElementById('form-container').classList.remove('hidden');
    setRole(role);
}

function backToSelector() {
    document.getElementById('form-container').classList.add('hidden');
    document.getElementById('step-selector').classList.remove('hidden');
}

// ── Cambio de rol (tabs) ──────────────────────────────────────────────────────

function setRole(role) {
    const isStudent = role === 'student';

    // Tabs
    document.getElementById('tab-student').classList.toggle('role-active', isStudent);
    document.getElementById('tab-company').classList.toggle('role-active', !isStudent);

    // Encabezados
    document.getElementById('header-student').classList.toggle('hidden', !isStudent);
    document.getElementById('header-company').classList.toggle('hidden', isStudent);

    // Bloques de campos
    document.getElementById('fields-student').classList.toggle('hidden', !isStudent);
    document.getElementById('fields-company').classList.toggle('hidden', isStudent);

    // Campo oculto de rol para el controller
    document.getElementById('hidden-role').value = role;

    lucide.createIcons();
}

// ── Mostrar / ocultar contraseña ─────────────────────────────────────────────

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

// ── Helpers de validación inline ─────────────────────────────────────────────

function onlyLetters(input) {
    input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ ]/g, '');
}

function checkCellInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length > 8) input.value = input.value.slice(0, 8);

    input.classList.toggle('success-input', input.value.length === 8);
    input.classList.toggle('error-input', input.value.length > 0 && input.value.length < 8);
}

// ── Indicador de fortaleza de contraseña ─────────────────────────────────────

function checkPasswordStrength(password) {
    const passInput = document.getElementById('pass');
    const label = document.getElementById('strength-label');
    const bars = [1, 2, 3, 4].map(n => document.getElementById(`bar-${n}`));

    const rules = {
        length: password.length >= 8,
        number: /[0-9]/.test(password),
        upper: /[A-Z]/.test(password),
        special: /[@$!%*?&]/.test(password),
    };

    updateRequirementState('req-length', 'ico-length', rules.length);
    updateRequirementState('req-number', 'ico-number', rules.number);
    updateRequirementState('req-upper', 'ico-upper', rules.upper);
    updateRequirementState('req-special', 'ico-special', rules.special);

    const score = Object.values(rules).filter(Boolean).length;

    bars.forEach(b => b.className = 'h-1.5 rounded-full bg-gray-200 transition-all duration-300');

    passInput.classList.toggle('success-input', score === 4);

    if (password.length === 0) {
        label.textContent = 'Vacía';
        label.className = 'text-xs font-bold text-gray-400';
        checkPasswordMatch();
        return;
    }

    const levels = [
        { score: 1, text: 'Débil ❌', color: 'text-red-500', bar: 'bg-red-500' },
        { score: 2, text: 'Media ⚠️', color: 'text-amber-500', bar: 'bg-amber-500' },
        { score: 3, text: 'Buena 👍', color: 'text-blue-500', bar: 'bg-blue-500' },
        { score: 4, text: 'Excelente / Segura 💪', color: 'text-emerald-500', bar: 'bg-emerald-500' },
    ];

    const level = levels.find(l => l.score === score);
    if (level) {
        label.textContent = level.text;
        label.className = `text-xs font-bold ${level.color}`;
        bars.slice(0, score).forEach(b => {
            b.className = `h-1.5 rounded-full ${level.bar} transition-all duration-300`;
        });
    }

    checkPasswordMatch();
}

function updateRequirementState(rowId, iconWrapperId, isValid) {
    const row = document.getElementById(rowId);
    const wrapper = document.getElementById(iconWrapperId);

    if (isValid) {
        row.className = 'req-item flex items-center gap-2 text-emerald-600 font-bold scale-[1.01]';
        wrapper.className = 'flex items-center text-emerald-500';
        wrapper.innerHTML = `<i data-lucide="check-circle-2" class="w-3.5 h-3.5 stroke-[3]"></i>`;
    } else {
        row.className = 'req-item flex items-center gap-2 text-gray-400 font-medium';
        wrapper.className = 'flex items-center text-gray-300';
        wrapper.innerHTML = `<i data-lucide="circle" class="w-3.5 h-3.5 stroke-[3]"></i>`;
    }
    lucide.createIcons();
}

function checkPasswordMatch() {
    const pass = document.getElementById('pass').value;
    const confirmInput = document.getElementById('confirm_pass');

    if (confirmInput.value.length === 0) {
        confirmInput.classList.remove('success-input', 'error-input');
        return;
    }

    const isSecure = pass.length >= 8
        && /[0-9]/.test(pass)
        && /[A-Z]/.test(pass)
        && /[@$!%*?&]/.test(pass);

    const matches = pass === confirmInput.value && isSecure;
    confirmInput.classList.toggle('success-input', matches);
    confirmInput.classList.toggle('error-input', !matches);
}

// ── Validación final antes del submit ────────────────────────────────────────

function validateFinal(e) {
    const role = document.getElementById('hidden-role').value;
    const cellId = role === 'student' ? 'cell-student' : 'cell-company';
    const cell = document.getElementById(cellId);
    const pass = document.getElementById('pass');
    const confirm = document.getElementById('confirm_pass');
    let isValid = true;

    if (cell && cell.value.length !== 8) {
        cell.classList.add('error-input');
        isValid = false;
    }

    const pwd = pass.value;
    const isSecure = pwd.length >= 8
        && /[0-9]/.test(pwd)
        && /[A-Z]/.test(pwd)
        && /[@$!%*?&]/.test(pwd);

    if (!isSecure) {
        pass.classList.add('error-input');
        isValid = false;
    }

    if (pwd !== confirm.value) {
        confirm.classList.add('error-input');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
        alert('Por favor, asegúrate de que todos los campos cumplan con los requisitos marcados en verde.');
    }

    return isValid;
}