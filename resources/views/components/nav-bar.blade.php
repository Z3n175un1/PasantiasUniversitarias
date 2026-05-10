<!-- Top Banner -->
<div class="bg-indigo-600 text-white py-2 px-4 text-center text-xs font-semibold tracking-wide">
    <span class="opacity-90">¡Nueva convocatoria de pasantías 2026 abierta!</span>
    <a href="/busqueda" class="ml-2 underline hover:text-indigo-100 transition-colors">Explorar ahora</a>
</div>

<nav class="bg-white border-b border-gray-100 py-0 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <a href="/" class="flex items-center">
            <img src="{{ asset('uworkflow-banner.ico') }}" alt="UWorkFlow Logo" class="w-48 h-auto object-contain">
        </a>
    </div>

    <div class="hidden md:flex items-center gap-8">
        <a href="/" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Home</a>
        <a href="/busqueda" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Pasantías</a>
        <a href="/notices" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Noticias</a>
    </div>

    <div class="flex items-center gap-4">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-indigo-600">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition-colors">Login</a>
            <a href="{{ route('account.type') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all shadow-sm">
                Registro
            </a>
        @endauth
    </div>
</nav>