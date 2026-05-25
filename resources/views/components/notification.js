export class Notification {
    constructor() {
        this.container = null;
    }

    createContainer() {
        if (this.container) return;
        this.container = document.createElement('div');
        this.container.className = 'fixed top-4 right-4 z-[9999] flex flex-col gap-3 pointer-events-none';
        document.body.appendChild(this.container);
    }

    show(title, message, type = 'success') {
        this.createContainer();

        const toast = document.createElement('div');
        
        // Estilos para los diferentes tipos de notificación
        const colors = {
            success: 'bg-green-50 text-green-800 border-green-200 shadow-green-100',
            error: 'bg-red-50 text-red-800 border-red-200 shadow-red-100',
            info: 'bg-blue-50 text-blue-800 border-blue-200 shadow-blue-100',
            warning: 'bg-yellow-50 text-yellow-800 border-yellow-200 shadow-yellow-100'
        };

        const iconColors = {
            success: 'text-green-500',
            error: 'text-red-500',
            info: 'text-blue-500',
            warning: 'text-yellow-500'
        };

        // Iconos SVG minimalistas (estilo Lucide)
        const icons = {
            success: `<svg class="w-6 h-6 ${iconColors.success}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`,
            error: `<svg class="w-6 h-6 ${iconColors.error}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`,
            info: `<svg class="w-6 h-6 ${iconColors.info}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
            warning: `<svg class="w-6 h-6 ${iconColors.warning}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`
        };

        toast.className = `p-4 rounded-2xl shadow-xl border w-80 md:w-96 transform transition-all duration-300 translate-x-full opacity-0 flex items-start gap-3 pointer-events-auto ${colors[type]}`;
        
        toast.innerHTML = `
            <div class="flex-shrink-0 mt-0.5">
                ${icons[type]}
            </div>
            <div class="flex-1">
                <h4 class="font-bold text-sm leading-none mb-1">${title}</h4>
                <p class="text-sm opacity-90 leading-relaxed">${message}</p>
            </div>
            <button class="flex-shrink-0 opacity-50 hover:opacity-100 transition-opacity focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;

        this.container.appendChild(toast);

        // Forzar reflow
        void toast.offsetWidth;

        // Animar entrada
        toast.classList.remove('translate-x-full', 'opacity-0');

        // Botón de cerrar
        const closeBtn = toast.querySelector('button');
        closeBtn.addEventListener('click', () => {
            this.dismiss(toast);
        });

        // Ocultar automáticamente a los 5 segundos
        setTimeout(() => {
            this.dismiss(toast);
        }, 5000);
    }

    dismiss(toast) {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300); // Esperar a que termine la transición
    }
}

// Exportar una instancia global
export const notify = new Notification();
