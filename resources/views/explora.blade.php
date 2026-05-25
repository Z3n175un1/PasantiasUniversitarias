<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Pasantías | UWorkFlow</title>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .card-neo {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .card-neo:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(43, 109, 242, 0.1);
            border-color: #2b6df2;
        }
        .search-gradient {
            background: radial-gradient(circle at top right, #eff6ff 0%, #ffffff 100%);
        }
    </style>
</head>
<body class="bg-white overflow-x-hidden text-[#1a1a1a]">
    @include('components.navbar')

    <main class="min-h-screen bg-[#f8fafc]">
        {{-- Buscador --}}
        <section class="pt-12 pb-20 px-[8%] search-gradient relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-600 uppercase bg-blue-50 rounded-full">
                    {{ count($ofertas) }} pasantías disponibles
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 tracking-tight">
                    Encuentra tu próximo <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">gran reto</span>
                </h1>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <i data-lucide="search" class="w-6 h-6 text-slate-400"></i>
                    </div>
                    <input type="text" id="search-input" placeholder="Buscar por título o empresa..."
                        class="w-full pl-16 pr-32 py-5 bg-white border-2 border-slate-100 rounded-3xl outline-none focus:border-blue-400 focus:ring-8 focus:ring-blue-50 transition-all text-lg shadow-2xl shadow-slate-200/50 font-medium">
                </div>
            </div>
        </section>

        <section class="max-w-[1400px] mx-auto px-[8%] -mt-10 pb-20 relative z-20">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Filtros --}}
                <aside class="lg:w-80 space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/60 sticky top-28">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-slate-900 flex items-center gap-2 text-base">
                                <i data-lucide="sliders-horizontal" class="w-4 h-4 text-blue-600"></i>
                                Filtros
                            </h3>
                            <button id="btn-limpiar" class="text-xs font-bold text-blue-600 hover:underline">Limpiar</button>
                        </div>

                        <div class="space-y-6">
                            {{-- Departamento --}}
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">Departamento</label>
                                <select id="select-departamento"
                                    class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all text-sm font-semibold appearance-none cursor-pointer">
                                    <option value="Todos">Todos los departamentos</option>
                                    @foreach($ofertas->pluck('ubicacion.region')->unique()->filter() as $region)
                                        <option value="{{ $region }}">{{ $region }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Modalidad --}}
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">Modalidad</label>
                                <div class="space-y-2.5">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" value="Remoto" class="filter-modalidad w-5 h-5 rounded-md text-blue-600">
                                        <span class="text-sm font-semibold text-slate-600">Virtual / Remoto</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" value="Presencial" class="filter-modalidad w-5 h-5 rounded-md text-blue-600">
                                        <span class="text-sm font-semibold text-slate-600">Presencial</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Resultados --}}
                <div class="flex-1 space-y-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-slate-900">Resultados</h2>
                        <p class="text-sm text-slate-500" id="results-counter">{{ count($ofertas) }} pasantías encontradas</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="postings-grid">
                        @foreach($ofertas as $oferta)
                            <a href="/pasantia/{{ $oferta->id }}" 
                               class="job-card card-neo bg-white p-7 rounded-[2rem] flex flex-col justify-between cursor-pointer"
                               data-title="{{ strtolower($oferta->titulo) }}"
                               data-company="{{ strtolower($oferta->perfilEmpresa->nombre_empresa ?? '') }}"
                               data-dept="{{ $oferta->ubicacion->region ?? '' }}"
                               data-modality="Presencial">
                                <div>
                                    <div class="flex justify-between items-start mb-6">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                            <i data-lucide="briefcase" class="w-8 h-8 text-indigo-600"></i>
                                        </div>
                                    </div>
                                    <div class="space-y-2 mb-6">
                                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">
                                            {{ $oferta->titulo }}
                                        </h3>
                                        <p class="text-sm font-bold text-blue-600">
                                            {{ $oferta->perfilEmpresa->nombre_empresa ?? 'Empresa' }}
                                        </p>
                                        <p class="text-sm text-slate-500 line-clamp-2 mt-2">
                                            {{ Str::limit($oferta->descripcion, 90) }}
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        <div class="flex items-center gap-1.5 px-3 py-1 bg-slate-50 rounded-lg text-xs font-semibold text-slate-600">
                                            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                            <span>{{ $oferta->ubicacion->ciudad ?? 'Remoto' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                    <span class="text-xs font-bold text-slate-400">
                                        {{ $oferta->fecha_inicio ? \Carbon\Carbon::parse($oferta->fecha_inicio)->diffForHumans() : 'Reciente' }}
                                    </span>
                                    <span class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-colors">
                                        Ver más
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if(count($ofertas) === 0)
                        <div class="bg-white border border-slate-100 rounded-[2rem] p-12 text-center">
                            <i data-lucide="search" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">No se encontraron pasantías</h3>
                            <p class="text-sm text-slate-500">Intenta con otros filtros de búsqueda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')

    <script>
        lucide.createIcons();

        const searchInput = document.getElementById('search-input');
        const selectDept = document.getElementById('select-departamento');
        const checkboxesModality = document.querySelectorAll('.filter-modalidad');
        const jobCards = document.querySelectorAll('.job-card');
        const btnLimpiar = document.getElementById('btn-limpiar');
        const resultsCounter = document.getElementById('results-counter');

        function filtrarOfertas() {
            const search = searchInput.value.toLowerCase();
            const dept = selectDept.value;
            const modalidades = Array.from(checkboxesModality)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            let visibles = 0;

            jobCards.forEach(card => {
                const title = card.getAttribute('data-title');
                const company = card.getAttribute('data-company');
                const cardDept = card.getAttribute('data-dept');
                const modality = card.getAttribute('data-modality');

                const matchSearch = !search || title.includes(search) || company.includes(search);
                const matchDept = dept === 'Todos' || dept === cardDept;
                const matchModality = modalidades.length === 0 || modalidades.includes(modality);

                if (matchSearch && matchDept && matchModality) {
                    card.classList.remove('hidden');
                    visibles++;
                } else {
                    card.classList.add('hidden');
                }
            });

            resultsCounter.textContent = visibles === 1 ? '1 pasantía encontrada' : `${visibles} pasantías encontradas`;
        }

        searchInput.addEventListener('input', filtrarOfertas);
        selectDept.addEventListener('change', filtrarOfertas);
        checkboxesModality.forEach(cb => cb.addEventListener('change', filtrarOfertas));

        btnLimpiar.addEventListener('click', () => {
            searchInput.value = '';
            selectDept.value = 'Todos';
            checkboxesModality.forEach(cb => cb.checked = false);
            filtrarOfertas();
        });
    </script>
</body>
</html>