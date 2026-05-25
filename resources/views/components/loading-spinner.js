export class LoadingSpinner {
    constructor() {
        this.spinnerEl = null;
    }

    create() {
        if (this.spinnerEl) return;
        
        this.spinnerEl = document.createElement('div');
        // Estilos usando Tailwind CSS para mantener la estética limpia y moderna
        this.spinnerEl.className = 'fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[9999] flex flex-col items-center justify-center opacity-0 transition-opacity duration-300 pointer-events-none';
        
        this.spinnerEl.innerHTML = `
            <div class="bg-white p-6 rounded-2xl shadow-xl flex flex-col items-center transform scale-95 transition-transform duration-300">
                <div class="w-12 h-12 border-4 border-blue-100 border-t-blue-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-700 font-medium" id="spinner-message">Cargando...</p>
            </div>
        `;
        
        document.body.appendChild(this.spinnerEl);
    }

    show(message = 'Cargando...') {
        this.create();
        const msgEl = this.spinnerEl.querySelector('#spinner-message');
        if (msgEl) msgEl.textContent = message;
        
        // Forzar reflow para que la transición de CSS funcione
        void this.spinnerEl.offsetWidth;
        
        this.spinnerEl.classList.remove('opacity-0', 'pointer-events-none');
        this.spinnerEl.classList.add('opacity-100');
        
        const innerBox = this.spinnerEl.querySelector('.bg-white');
        if (innerBox) {
            innerBox.classList.remove('scale-95');
            innerBox.classList.add('scale-100');
        }
    }

    hide() {
        if (!this.spinnerEl) return;
        
        this.spinnerEl.classList.remove('opacity-100');
        this.spinnerEl.classList.add('opacity-0', 'pointer-events-none');
        
        const innerBox = this.spinnerEl.querySelector('.bg-white');
        if (innerBox) {
            innerBox.classList.remove('scale-100');
            innerBox.classList.add('scale-95');
        }
    }
}

// Exportar una instancia global para uso rápido
export const spinner = new LoadingSpinner();