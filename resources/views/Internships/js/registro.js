// Inicializar Iconos Lucide
lucide.createIcons();

// Interactividad del Selector de Roles
const roleButtons = document.querySelectorAll('.role-btn');

roleButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remover clase activa de todos los botones en el selector actual
        const parent = button.closest('.role-selector');
        parent.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
        
        // Agregar al seleccionado
        button.classList.add('active');
        
        console.log("Rol cambiado a:", button.innerText.trim());
    });
});

// Validación simple de coincidencia de contraseñas (solo para el registro)
const registerForm = document.querySelector('.register-form');
if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
        const pass = document.getElementById('password').value;
        const confirmPass = document.getElementById('confirm-password').value;
        
        if (pass !== confirmPass) {
            e.preventDefault();
            alert("Las contraseñas no coinciden.");
        }
    });
}