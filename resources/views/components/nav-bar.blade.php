<nav class="bg-white border-b border-gray-100 py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <a href="/" class="flex items-center">
            <x-application-logo class="w-10 h-10" />
        </a>
        <span class="text-xl font-bold text-slate-900 tracking-tight">UWorkFlow</span>
    </div>

    <div class="hidden md:flex items-center gap-8">
        <a href="/" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Home</a>
        <a href="{{ route('offers.index') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Pasantías</a>
        <a href="#" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Empresas</a>
        <a href="/notices" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Noticias</a>
    </div>

    <div class="flex items-center gap-4">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Login</a>
            <a href="{{ route('account.type') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all shadow-sm">
                Registro
            </a>
        @endauth
    </div>
</nav>