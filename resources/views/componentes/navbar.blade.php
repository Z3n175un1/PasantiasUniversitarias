<header
    class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
    {{-- Logo --}}
    <a href="{{ route('index') }}" class="flex items-center gap-2.5 group logo-container cursor-pointer">
        <div
            class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center logo-icon shadow-sm transition-all duration-300 group-hover:bg-[#2b6df2] group-hover:rotate-12">
            <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
        </div>
        <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">UWorkFlow</span>
    </a>

    <nav class="flex items-center gap-6">
        <a href="{{ route('index') }}" class="text-[#666] font-medium hover:text-[#2b6df2] transition">Home</a>

        @auth
            {{-- Menú de usuario logueado --}}
            <div class="relative group">
                <button class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all">
                    {{-- Avatar --}}
                    <div
                        class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                        </span>
                    </div>
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900 leading-tight">
                            {{ Auth::user()->nombre }}
                        </p>
                        <p class="text-xs text-gray-500">
                            @if(Auth::user()->rol_id == 1)
                                Estudiante
                            @elseif(Auth::user()->rol_id == 2)
                                Empresa
                            @else
                                Administrador
                            @endif
                        </p>
                    </div>
                    <i data-lucide="chevron-down"
                        class="w-4 h-4 text-gray-400 transition-transform group-hover:rotate-180"></i>
                </button>

                {{-- Dropdown --}}
                <div
                    class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="p-3">
                        {{-- Info del usuario --}}
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">
                                    {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->nombre }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->correo }}</p>
                            </div>
                        </div>

                        {{-- Enlaces del dashboard --}}
                        @if(Auth::user()->rol_id == 1)
                            <a href="{{ route('dashboard.student') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                                Panel de Estudiante
                            </a>
                        @elseif(Auth::user()->rol_id == 2)
                            <a href="{{ route('dashboard.company') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                                Panel de Empresa
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                                Panel de Administración
                            </a>
                        @endif

                        {{-- Separador --}}
                        <div class="border-t border-gray-100 my-2"></div>

                        {{-- Cerrar Sesión --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-all w-full">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            {{-- Usuario NO logueado --}}
            <a href="{{ route('login') }}"
                class="px-5 py-2.5 border border-[#ddd] rounded-xl text-[#1a1a1a] font-medium hover:bg-gray-50 transition">
                Iniciar Sesión
            </a>
            <a href="{{ route('seleccion') }}"
                class="px-6 py-2.5 bg-[#0d121f] text-white rounded-xl font-semibold hover:bg-slate-800 transition shadow-md active:scale-95">
                Registro
            </a>
        @endauth
    </nav>
</header>

<script>
    // Re-inicializar iconos de Lucide cuando se carga el componente
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>