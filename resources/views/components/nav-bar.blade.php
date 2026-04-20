<nav class="bg-white border-b border-gray-100 py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
        </div>
        <span class="text-xl font-bold text-slate-900 tracking-tight">UWorkFlow</span>
    </div>

    <div class="hidden md:flex items-center gap-8">
        <a href="/" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Home</a>
        <a href="{{ route('offers.index') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Pasantías</a>
        <a href="#" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Empresas</a>
    </div>

    <div class="flex items-center gap-4">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Login</a>
            <a href="{{ route('register') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all shadow-sm">
                Registro
            </a>
        @endauth
    </div>
</nav>