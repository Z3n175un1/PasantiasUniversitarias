// Inicializar Iconos Lucide
lucide.createIcons();

// Interactividad del Selector de Roles
const roleButtons = document.querySelectorAll('.role-btn');

roleButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remover clase activa de todos
        roleButtons.forEach(btn => btn.classList.remove('active'));
        // Agregar al seleccionado
        button.classList.add('active');
        
        console.log("Rol seleccionado:", button.getAttribute('data-role'));
    });
});