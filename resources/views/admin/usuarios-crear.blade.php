@extends('adminlte::page')

@push('css')
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
@endpush

@section('title', 'Crear Usuario')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0">
            <i class="fas fa-user-plus mr-2"></i>Nuevo Usuario
        </h1>
        <a href="{{ route('admin.usuarios') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>Volver
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Datos del Usuario</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.usuarios.guardar') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombres <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required pattern="[\pL\s]+" title="Solo letras y espacios">
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ap_paterno">Ap. Paterno <span class="text-danger">*</span></label>
                            <input type="text" name="ap_paterno" id="ap_paterno" class="form-control @error('ap_paterno') is-invalid @enderror" value="{{ old('ap_paterno') }}" required pattern="[\pL\s]+" title="Solo letras y espacios">
                            @error('ap_paterno')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ap_materno">Ap. Materno</label>
                            <input type="text" name="ap_materno" id="ap_materno" class="form-control @error('ap_materno') is-invalid @enderror" value="{{ old('ap_materno') }}" pattern="[\pL\s]+" title="Solo letras y espacios">
                            @error('ap_materno')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo">Correo electrónico <span class="text-danger">*</span></label>
                            <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                            @error('correo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contraseña <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rol_id">Rol <span class="text-danger">*</span></label>
                            <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror" required onchange="toggleProfileFields()">
                                <option value="">Seleccione un rol</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                        {{ ucfirst($rol->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rol_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Campos para Empresa --}}
                <div id="profile-company" class="mt-3 p-3 bg-light rounded d-none">
                    <h5 class="font-weight-bold mb-3"><i class="fas fa-building mr-2"></i>Perfil de Empresa</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_empresa">Nombre de la Empresa <span class="text-danger">*</span></label>
                                <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control @error('nombre_empresa') is-invalid @enderror" value="{{ old('nombre_empresa') }}">
                                @error('nombre_empresa')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industria">Industria / Sector <span class="text-danger">*</span></label>
                                <input type="text" name="industria" id="industria" class="form-control @error('industria') is-invalid @enderror" value="{{ old('industria') }}">
                                @error('industria')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                                @error('telefono')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
                                @error('direccion')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Campos para Estudiante --}}
                <div id="profile-student" class="mt-3 p-3 bg-light rounded d-none">
                    <h5 class="font-weight-bold mb-3"><i class="fas fa-graduation-cap mr-2"></i>Perfil de Estudiante</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="universidad">Universidad <span class="text-danger">*</span></label>
                                <input type="text" name="universidad" id="universidad" class="form-control @error('universidad') is-invalid @enderror" value="{{ old('universidad') }}">
                                @error('universidad')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="carrera_u">Carrera <span class="text-danger">*</span></label>
                                <input type="text" name="carrera" id="carrera_u" class="form-control @error('carrera') is-invalid @enderror" value="{{ old('carrera') }}">
                                @error('carrera')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}">
                                @error('fecha_nacimiento')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Guardar Usuario
                    </button>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
function toggleProfileFields() {
    const rol = document.getElementById('rol_id').value;
    document.getElementById('profile-company').classList.toggle('d-none', rol != '2');
    document.getElementById('profile-student').classList.toggle('d-none', rol != '1');
}
document.addEventListener('DOMContentLoaded', toggleProfileFields);
</script>
@stop
