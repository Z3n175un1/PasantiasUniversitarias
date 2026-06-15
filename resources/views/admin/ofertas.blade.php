@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
    <style>
        .selector-carrera-item:hover { border-color: #818cf8 !important; }
        #selector-carrera-lista::-webkit-scrollbar { width: 6px; }
        #selector-carrera-lista::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
@endpush

@section('title', 'Ofertas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-briefcase mr-2"></i>Ofertas de Pasantía
        </h1>
        <span class="badge badge-info px-3 py-2">{{ $ofertas->count() }} ofertas</span>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Listado de Ofertas</h3>
            <div class="card-tools">
                <span class="badge badge-success mr-1">
                    {{ $ofertas->filter(fn($o) => $o->estadoPublicacion->nombre == 'abierta')->count() }} abiertas
                </span>
                <span class="badge badge-danger">
                    {{ $ofertas->filter(fn($o) => $o->estadoPublicacion->nombre != 'abierta')->count() }} cerradas
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Empresa</th>
                        <th>Ubicación</th>
                        <th>Vacantes</th>
                        <th>Duración</th>
                        <th>Requisitos / Beneficios</th>
                        <th>Estado</th>
                        <th style="width: 150px;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ofertas as $oferta)
                        <tr>
                            <td>{{ $oferta->id }}</td>
                            <td class="font-weight-bold">
                                <a href="{{ route('pasantia.show', $oferta->id) }}" target="_blank">
                                    {{ $oferta->titulo }}
                                </a>
                            </td>
                            <td>{{ $oferta->perfilEmpresa->nombre_empresa ?? 'N/A' }}</td>
                            <td>{{ $oferta->ubicacion->ciudad ?? 'Remoto' }}</td>
                            <td>
                                <span class="badge badge-info">{{ $oferta->vacantes_disponibles ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @if($oferta->duracion_semanas)
                                    {{ intval($oferta->duracion_semanas) }} semanas
                                @elseif($oferta->fecha_inicio && $oferta->fecha_fin)
                                    @php
                                        $inicio = \Carbon\Carbon::parse($oferta->fecha_inicio);
                                        $fin = \Carbon\Carbon::parse($oferta->fecha_fin);
                                    @endphp
                                    {{ intval($inicio->diffInWeeks($fin)) }} semanas
                                @else
                                    No especificada
                                @endif
                            </td>
                            <td>
                                @if($oferta->requisitos || $oferta->beneficios)
                                    <a href="#" class="text-info" data-toggle="popover" data-html="true"
                                       data-content="
                                        @if($oferta->requisitos)
                                            <b>Requisitos:</b><br>{{ nl2br(e(Str::limit($oferta->requisitos, 150))) }}<br><br>
                                        @endif
                                        @if($oferta->beneficios)
                                            <b>Beneficios:</b><br>{{ nl2br(e(Str::limit($oferta->beneficios, 150))) }}
                                        @endif
                                       "
                                       title="{{ $oferta->titulo }}">
                                        <i class="fas fa-info-circle"></i> Ver
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $estado = $oferta->estadoPublicacion->nombre ?? 'desconocido';
                                    $badgeClass = match($estado) {
                                        'abierta' => 'badge-success',
                                        'cerrada' => 'badge-danger',
                                        default => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                            </td>
                            <td nowrap>
                                <button type="button" class="btn btn-sm btn-info" title="Editar oferta" onclick="openEditModal({{ $oferta->id }})">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form action="{{ route('admin.ofertas.toggle', $oferta->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    @php
                                        $isOpen = $oferta->estadoPublicacion->nombre == 'abierta';
                                    @endphp
                                    <button type="submit" class="btn btn-sm {{ $isOpen ? 'btn-danger' : 'btn-success' }}"
                                            title="{{ $isOpen ? 'Cerrar oferta' : 'Abrir oferta' }}">
                                        <i class="fas {{ $isOpen ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No hay ofertas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Editar Oferta --}}
    <div id="modal-editar-oferta" class="fixed inset-0 bg-[#0d121f]/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl mx-4 p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 space-y-6 relative max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Editar Oferta</h3>
                <button onclick="closeEditModal()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <form id="form-editar-oferta" method="POST" class="space-y-4 text-sm font-semibold">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Título del Puesto</label>
                    <input type="text" name="titulo" id="edit-titulo" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Descripción</label>
                    <textarea name="descripcion" id="edit-descripcion" rows="4" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Modalidad</label>
                        <select name="modalidad" id="edit-modalidad" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            <option value="Presencial">Presencial</option>
                            <option value="Remoto">Remoto</option>
                            <option value="Híbrido">Híbrido</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Carrera afín</label>
                        <input type="hidden" name="carrera" id="edit-carrera" value="">
                        <button type="button" onclick="abrirSelectorCarrera('edit-carrera', 'edit-carrera-trigger')"
                            id="edit-carrera-trigger"
                            class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-left text-sm font-semibold text-slate-500 hover:border-indigo-400 transition flex items-center justify-between gap-2">
                            <span id="edit-carrera-texto">Todas las carreras</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 shrink-0"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Ubicación</label>
                        <select name="ubicacion_id" id="edit-ubicacion_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all appearance-none cursor-pointer">
                            @foreach($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->ciudad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="edit-fecha_inicio" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="edit-fecha_fin" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Vacantes</label>
                        <input type="number" name="vacantes_disponibles" id="edit-vacantes" min="1" max="999" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Duración (semanas)</label>
                    <input type="number" name="duracion_semanas" id="edit-duracion" min="1" max="156" placeholder="Ej. 12" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Requisitos</label>
                    <textarea name="requisitos" id="edit-requisitos" rows="3" placeholder="Ej. Conocimientos en Laravel..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Beneficios</label>
                    <textarea name="beneficios" id="edit-beneficios" rows="3" placeholder="Ej. Certificado, horario flexible..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:bg-white focus:border-blue-400 transition-all font-medium resize-none"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="flex-1 py-3 bg-slate-100 font-bold text-slate-600 rounded-xl">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal selector grande de carreras --}}
    <div id="modal-selector-carrera" class="fixed inset-0 bg-[#0d121f]/50 backdrop-blur-sm z-[60] flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-3xl mx-4 rounded-2xl shadow-2xl border border-slate-100 max-h-[85vh] flex flex-col">
            <div class="flex items-center justify-between p-5 border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-900">Seleccionar Carrera</h3>
                <button onclick="cerrarSelectorCarrera()" class="p-1.5 hover:bg-slate-100 rounded-full text-slate-400">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="p-4 border-b border-slate-100">
                <input type="text" id="selector-carrera-buscar" placeholder="Buscar carrera..." oninput="filtrarCarreras()"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-indigo-400 transition">
            </div>
            <div id="selector-carrera-lista" class="flex-1 overflow-y-auto p-4 grid grid-cols-2 md:grid-cols-3 gap-2">
                <button type="button" class="selector-carrera-item px-4 py-3 rounded-xl text-left text-sm font-semibold border-2 transition hover:bg-indigo-50 hover:border-indigo-300 border-slate-200 text-slate-600" data-value="">Todas las carreras</button>
                @foreach($carreras as $carrera)
                    <button type="button" class="selector-carrera-item px-4 py-3 rounded-xl text-left text-sm font-semibold border-2 transition hover:bg-indigo-50 hover:border-indigo-300 border-slate-200 text-slate-600" data-value="{{ $carrera }}">{{ $carrera }}</button>
                @endforeach
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(function () {
        $('[data-toggle="popover"]').popover({ trigger: 'hover focus' });
    });

    // ─── SELECTOR GRANDE DE CARRERAS ───
    let selectorCarreraHiddenId = null;
    let selectorCarreraTriggerId = null;

    function abrirSelectorCarrera(hiddenId, triggerId) {
        selectorCarreraHiddenId = hiddenId;
        selectorCarreraTriggerId = triggerId;
        const modal = document.getElementById('modal-selector-carrera');
        modal.classList.remove('hidden');
        document.getElementById('selector-carrera-buscar').value = '';
        document.querySelectorAll('.selector-carrera-item').forEach(item => {
            item.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600');
            item.classList.add('border-slate-200', 'text-slate-600');
            if (item.dataset.value === document.getElementById(hiddenId).value) {
                item.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');
                item.classList.remove('border-slate-200', 'text-slate-600');
            }
            item.style.display = '';
        });
    }

    function cerrarSelectorCarrera() {
        document.getElementById('modal-selector-carrera').classList.add('hidden');
    }

    function filtrarCarreras() {
        const q = document.getElementById('selector-carrera-buscar').value.toLowerCase();
        document.querySelectorAll('.selector-carrera-item').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    }

    document.addEventListener('click', function (e) {
        const item = e.target.closest('.selector-carrera-item');
        if (item) {
            const hidden = document.getElementById(selectorCarreraHiddenId);
            const trigger = document.getElementById(selectorCarreraTriggerId);
            hidden.value = item.dataset.value;
            const texto = trigger.querySelector('span');
            texto.textContent = item.dataset.value || 'Todas las carreras';
            cerrarSelectorCarrera();
        }
        const modal = document.getElementById('modal-selector-carrera');
        if (e.target === modal) cerrarSelectorCarrera();
    });

    const modalEditar = document.getElementById('modal-editar-oferta');

    function openEditModal(id) {
        fetch('/admin/ofertas/' + id)
            .then(r => r.json())
            .then(data => {
                document.getElementById('edit-id').value = data.id;
                document.getElementById('edit-titulo').value = data.titulo;
                document.getElementById('edit-descripcion').value = data.descripcion;
                document.getElementById('edit-modalidad').value = data.modalidad;
                document.getElementById('edit-carrera').value = data.carrera || '';
                document.getElementById('edit-carrera-texto').textContent = data.carrera || 'Todas las carreras';
                document.getElementById('edit-ubicacion_id').value = data.ubicacion_id;
                document.getElementById('edit-fecha_inicio').value = data.fecha_inicio ? data.fecha_inicio.substring(0, 10) : '';
                document.getElementById('edit-fecha_fin').value = data.fecha_fin ? data.fecha_fin.substring(0, 10) : '';
                document.getElementById('edit-vacantes').value = data.vacantes_disponibles || '';
                document.getElementById('edit-duracion').value = data.duracion_semanas || '';
                document.getElementById('edit-requisitos').value = data.requisitos || '';
                document.getElementById('edit-beneficios').value = data.beneficios || '';

                document.getElementById('form-editar-oferta').action = '/admin/ofertas/' + data.id;
                modalEditar.classList.remove('hidden');
            });
    }

    function closeEditModal() {
        modalEditar.classList.add('hidden');
    }

    document.addEventListener('click', function (e) {
        if (e.target === modalEditar) closeEditModal();
    });
</script>
@endpush
