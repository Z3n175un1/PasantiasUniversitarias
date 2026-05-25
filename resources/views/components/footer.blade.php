<!-- FOOTER -->
<footer class="bg-[#0d121f] text-white pt-24 pb-12 px-[8%] rounded-t-[40px]">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-16 border-b border-gray-800">
        <div class="footer-brand space-y-4">
            <a href="{{ route('index') }}" class="flex items-center gap-2.5 group logo-container cursor-pointer">
                <div
                    class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center logo-icon border border-white/10">
                    <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tighter text-white">UWorkFlow</span>
            </a>
            <p class="text-[#aaa] max-w-[280px] text-sm leading-relaxed">Conectando estudiantes y empresas para
                experiencias de pasantía significativas y de alto impacto.</p>
        </div>
        <div class="flex flex-col gap-3.5">
            <h4 class="font-bold mb-3 text-lg text-white/90">Para Estudiantes</h4>
            <a href="{{ route('explora') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Explorar
                Pasantías</a>
            <a href="{{ route('comofunciona') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Cómo
                Funciona</a>
        </div>
        <div class="flex flex-col gap-3.5">
            <h4 class="font-bold mb-3 text-lg text-white/90">Para Empresas</h4>
            <a href="{{ route('login') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Publicar
                Oportunidades</a>
            <a href="{{ route('login') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Encontrar
                Talento</a>
        </div>
        <div class="flex flex-col gap-3.5">
            <h4 class="font-bold mb-3 text-lg text-white/90">Compañía</h4>
            <a href="{{ route('sobrenosotros') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Sobre
                Nosotros</a>
            <a href="{{ route('contacto') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Contacto</a>
            <a href="{{ route('privacidad') }}" class="text-[#aaa] hover:text-[#2b6df2] transition text-sm">Política de
                Privacidad</a>
        </div>
    </div>
    <div class="text-center pt-12 text-[#666] text-sm">
        © 2026 InternConnect. Todos los derechos reservados. Desarrollado con pasión en Bolivia.
    </div>
</footer>