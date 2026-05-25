<header
    class="flex justify-between items-center py-4 px-[8%] bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
    <!-- NUEVO LOGO ANIMADO -->
    <a href="{{ route('index') }}" class="flex items-center gap-2.5 group logo-container cursor-pointer">
        <div class="w-10 h-10 bg-[#0d121f] rounded-xl flex items-center justify-center logo-icon shadow-sm">
            <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
        </div>
        <span class="text-2xl font-extrabold tracking-tighter text-[#0d121f]">UWorkFlow</span>
    </a>

    <nav class="flex items-center gap-6">
        <a href="{{ route('index') }}" class="text-[#666] font-medium hover:text-[#2b6df2] transition">Home</a>
        <a href="{{ route('login') }}"
            class="px-5 py-2.5 border border-[#ddd] rounded-xl text-[#1a1a1a] font-medium hover:bg-gray-50 transition">Login</a>
        <a href="{{ route('registro') }}"
            class="px-6 py-2.5 bg-[#0d121f] text-white rounded-xl font-semibold hover:bg-slate-800 transition shadow-md active:scale-95">Registro</a>
    </nav>
</header>