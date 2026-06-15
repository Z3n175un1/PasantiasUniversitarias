@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    <link rel="icon" href="{{ asset('ad.ico') }}">
@endpush

@section('title', 'Estudiantes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-graduation-cap mr-2"></i>Estudiantes Registrados
        </h1>
        <span class="badge badge-success px-3 py-2">{{ $estudiantes->count() }} estudiantes</span>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Listado de Estudiantes</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre(s)</th>
                        <th>Ap. Paterno</th>
                        <th>Ap. Materno</th>
                        <th>Correo</th>
                        <th>Universidad</th>
                        <th>Carrera</th>
                        <th>Año Graduación</th>
                        <th>Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->id }}</td>
                            <td class="font-weight-bold">{{ $estudiante->usuario->nombre ?? 'N/A' }}</td>
                            <td>{{ $estudiante->usuario->ap_paterno ?? 'N/A' }}</td>
                            <td>{{ $estudiante->usuario->ap_materno ?? 'N/A' }}</td>
                            <td>{{ $estudiante->usuario->correo ?? 'N/A' }}</td>
                            <td>{{ $estudiante->universidad }}</td>
                            <td>{{ $estudiante->carrera }}</td>
                            <td>{{ $estudiante->anio_graduacion ?? '—' }}</td>
                            <td>{{ $estudiante->usuario->creado_en ? $estudiante->usuario->creado_en->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No hay estudiantes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
