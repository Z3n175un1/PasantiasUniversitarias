<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LogController;
use App\Models\RegistroAuditoria;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\OfertaPasantia;
use App\Models\Usuario;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;
use App\Http\Controllers\TopsisController;

Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.form');
Route::post('/topsis', [TopsisController::class, 'calculate'])->name('topsis.calculate');

// ── Rutas públicas ────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/explora', function () {
    $ofertas = OfertaPasantia::with(['ubicacion', 'perfilEmpresa'])->get();
    $ubicaciones = \App\Models\Ubicacion::orderBy('ciudad')->get();
    $carreras = \App\Models\OfertaPasantia::whereNotNull('carrera')
        ->distinct()->orderBy('carrera')->pluck('carrera');
    $modalidades = \App\Models\OfertaPasantia::whereNotNull('modalidad')
        ->distinct()->orderBy('modalidad')->pluck('modalidad');
    return view('explora', compact('ofertas', 'ubicaciones', 'carreras', 'modalidades'));
})->name('explora');

Route::get('/comofunciona', function () {
    return view('comofunciona');
})->name('comofunciona');

Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/privacidad', function () {
    return view('privacidad');
})->name('privacidad');

// ── Login ─────────────────────────────────────────────────────────────────────

Route::get('/login', function () {
    return view('autenticacion.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'correo' => 'required|email',
        'password' => 'required'
    ]);

    $usuario = Usuario::where('correo', $request->correo)->first();

    if ($usuario && Hash::check($request->password, $usuario->contrasena_hash)) {
        Auth::login($usuario);
        $request->session()->regenerate();

        RegistroAuditoria::create([
            'usuario_id' => $usuario->id,
            'tipo_entidad_id' => 6,
            'entidad_id' => $usuario->id,
            'accion' => 'Inicio de sesión',
            'creado_en' => now(),
        ]);

        if ($usuario->rol_id == 3)
            return redirect('/admin/dashboard');
        if ($usuario->rol_id == 2)
            return redirect('/dashboard/company');
        return redirect('/dashboard/student');
    }

    return back()->withErrors(['correo' => 'Credenciales incorrectas'])->withInput();
});

Route::post('/logout', function () {
    if (Auth::check()) {
        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 7,
            'entidad_id' => Auth::id(),
            'accion' => 'Cierre de sesión',
            'creado_en' => now(),
        ]);
    }
    Auth::logout();
    return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
})->name('logout');

// ── Registro ──────────────────────────────────────────────────────────────────

Route::get('/seleccion', function () {
    return view('autenticacion.seleccion');
})->name('seleccion');

Route::get('/register/{rol}', function ($rol) {
    if (!in_array($rol, ['student', 'company'])) {
        abort(404);
    }
    return view('autenticacion.register', compact('rol'));
})->name('register')->where('rol', 'student|company');

Route::post('/register', function (Request $request) {
    $request->validate([
        'email' => 'required|email|unique:usuarios,correo',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:student,company',
    ], [
        'email.unique' => '¡Ups! Parece que ya registraste esta cuenta. Intenta iniciar sesión.',
    ]);

    $rolId = $request->role === 'student' ? 1 : 2;

    if ($request->role === 'student') {
        $data = [
            'nombre' => trim($request->full_name),
            'ap_paterno' => trim($request->paternal_surname),
            'ap_materno' => trim($request->maternal_surname),
        ];
    } else {
        $data = [
            'nombre' => trim($request->hr_name),
            'ap_paterno' => trim($request->hr_paternal),
            'ap_materno' => trim($request->hr_maternal),
        ];
    }

    try {
        $usuario = DB::transaction(function () use ($request, $data, $rolId) {
        $usuario = Usuario::create(array_merge($data, [
            'rol_id' => $rolId,
            'correo' => $request->email,
            'contrasena_hash' => Hash::make($request->password),
            'activo' => true,
        ]));

        if ($request->role === 'student') {
            PerfilEstudiante::create([
                'usuario_id' => $usuario->id,
                'universidad' => 'Por completar',
                'carrera' => $request->career,
                'anio_graduacion' => null,
                'biografia' => null,
            ]);

            RegistroAuditoria::create([
                'usuario_id' => $usuario->id,
                'tipo_entidad_id' => 3,
                'entidad_id' => $usuario->id,
                'accion' => 'Registro de estudiante',
                'creado_en' => now(),
            ]);
        } else {
            PerfilEmpresa::create([
                'usuario_id' => $usuario->id,
                'nombre_empresa' => $request->company_name,
                'industria' => $request->sector,
                'sitio_web' => null,
                'verificada' => false,
            ]);

            RegistroAuditoria::create([
                'usuario_id' => $usuario->id,
                'tipo_entidad_id' => 2,
                'entidad_id' => $usuario->id,
                'accion' => 'Registro de empresa',
                'creado_en' => now(),
            ]);
        }

        return $usuario;
    });

    Auth::login($usuario);

        if ($usuario->rol_id == 2) {
            return redirect('/dashboard/company')->with('success', '¡Bienvenida empresa!');
        }
        return redirect('/dashboard/student')->with('success', '¡Bienvenido estudiante!');
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == 23505) {
            return back()->withErrors(['email' => '¡Ups! Parece que ya registraste esta cuenta. Intenta iniciar sesión.'])->withInput();
        }
        throw $e;
    }
});

// ── Admin Panel (AdminLTE) ────────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD Usuarios
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
    Route::get('/usuarios/crear', [AdminController::class, 'crearUsuario'])->name('usuarios.crear');
    Route::post('/usuarios', [AdminController::class, 'guardarUsuario'])->name('usuarios.guardar');
    Route::get('/usuarios/{id}/editar', [AdminController::class, 'editarUsuario'])->name('usuarios.editar');
    Route::put('/usuarios/{id}', [AdminController::class, 'actualizarUsuario'])->name('usuarios.actualizar');
    Route::delete('/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
    Route::patch('/usuarios/{id}/toggle', [AdminController::class, 'toggleUsuario'])->name('usuarios.toggle');

    // Empresas y Estudiantes
    Route::get('/empresas', [AdminController::class, 'empresas'])->name('empresas');
    Route::patch('/empresas/{id}/toggle', [AdminController::class, 'toggleEmpresa'])->name('empresas.toggle');
    Route::get('/estudiantes', [AdminController::class, 'estudiantes'])->name('estudiantes');

    // Ofertas
    Route::get('/ofertas', [AdminController::class, 'ofertas'])->name('ofertas');
    Route::patch('/ofertas/{id}/toggle', [AdminController::class, 'toggleOferta'])->name('ofertas.toggle');

    // Reportes dinámicos
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes');

    // Logs (solo super admin)
    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    // Estadísticas
    Route::get('/estadisticas', [AdminController::class, 'estadisticas'])->name('estadisticas');
});

// ── Dashboards ────────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/admin', function () {
        abort_if(Auth::user()->rol_id != 3, 403);
        $stats = [
            'usuarios' => Usuario::count(),
            'empresas' => PerfilEmpresa::count(),
            'estudiantes' => PerfilEstudiante::count(),
            'ofertas' => OfertaPasantia::count(),
            'postulaciones' => Postulacion::count(),
            'ultimos_usuarios' => Usuario::with('rol')->latest('creado_en')->take(10)->get(),
            'todas_empresas' => PerfilEmpresa::with('usuario')->get(),
            'todos_estudiantes' => PerfilEstudiante::with('usuario')->get(),
            'ofertas_activas' => OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])->get(),
        ];
        return view('paneles-control.dashboard_admin', compact('stats'));
    })->name('dashboard.admin');

    Route::get('/dashboard/company', [App\Http\Controllers\CompanyController::class, 'dashboard'])->name('dashboard.company');
    Route::post('/company/ofertas', [App\Http\Controllers\CompanyController::class, 'guardarOferta'])->name('company.ofertas.guardar');
    Route::put('/company/ofertas/{id}/actualizar', [App\Http\Controllers\CompanyController::class, 'actualizarOferta'])->name('company.ofertas.actualizar');
    Route::delete('/company/ofertas/{id}', [App\Http\Controllers\CompanyController::class, 'eliminarOferta'])->name('company.ofertas.eliminar');
    Route::get('/company/citatorio/{postulacion_id}', [App\Http\Controllers\CompanyController::class, 'citatorio'])->name('company.citatorio');
    Route::get('/api/ofertas/{id}', function ($id) {
        $oferta = OfertaPasantia::with('requisitosHabilidad.habilidad')->findOrFail($id);
        return response()->json($oferta);
    })->middleware('auth');

    // Student routes
    // Postulaciones
    Route::post('/postulaciones', function (Request $request) {
        $request->validate([
            'oferta_pasantia_id' => 'required|exists:ofertas_pasantia,id',
        ]);

        $estudiante = \App\Models\PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();

        $existe = \App\Models\Postulacion::where('perfil_estudiante_id', $estudiante->id)
            ->where('oferta_pasantia_id', $request->oferta_pasantia_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya te has postulado a esta oferta.');
        }

        \App\Models\Postulacion::create([
            'perfil_estudiante_id' => $estudiante->id,
            'oferta_pasantia_id' => $request->oferta_pasantia_id,
            'estado_postulacion_id' => 1,
        ]);

        \App\Models\RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 5,
            'entidad_id' => $estudiante->id,
            'accion' => 'Postulación a oferta',
            'valor_nuevo' => ['oferta_pasantia_id' => $request->oferta_pasantia_id],
            'creado_en' => now(),
        ]);

        return back()->with('success', '¡Bien hecho! Te postulaste correctamente. :D');
    })->name('postulacion.store');

    Route::get('/dashboard/student', [App\Http\Controllers\StudentController::class, 'dashboard'])->name('dashboard.student');
    Route::post('/student/perfil', [App\Http\Controllers\StudentController::class, 'actualizarPerfil'])->name('student.perfil.actualizar');
    Route::post('/student/documentos', [App\Http\Controllers\StudentController::class, 'subirDocumento'])->name('student.documentos.subir');
    Route::delete('/student/documentos/{id}', [App\Http\Controllers\StudentController::class, 'eliminarDocumento'])->name('student.documentos.eliminar');
    Route::post('/student/habilidades', [App\Http\Controllers\StudentController::class, 'guardarHabilidad'])->name('student.habilidades.guardar');
    Route::delete('/student/habilidades/{id}', [App\Http\Controllers\StudentController::class, 'eliminarHabilidad'])->name('student.habilidades.eliminar');

    // Company profile routes
    Route::post('/company/perfil', [App\Http\Controllers\CompanyController::class, 'actualizarPerfil'])->name('company.perfil.actualizar');
    Route::patch('/company/postulaciones/{id}/estado', [App\Http\Controllers\CompanyController::class, 'cambiarEstadoPostulacion'])->name('company.postulaciones.estado');

});

// ── Pasantías ─────────────────────────────────────────────────────────────────

Route::get('/pasantia/{id}', function ($id) {
    $oferta = OfertaPasantia::where('id', $id)
        ->whereHas('estadoPublicacion', function($q) {
            $q->where('nombre', 'abierta');
        })
        ->with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion', 'requisitosHabilidad.habilidad'])
        ->firstOrFail();

    $ya_postulo = false;
    if (Auth::check() && Auth::user()->rol_id == 1) {
        $estudiante = \App\Models\PerfilEstudiante::where('usuario_id', Auth::id())->first();
        if ($estudiante) {
            $ya_postulo = \App\Models\Postulacion::where('perfil_estudiante_id', $estudiante->id)
                ->where('oferta_pasantia_id', $oferta->id)
                ->exists();
        }
    }

    return view('pasantias.show', compact('oferta', 'ya_postulo'));
})->name('pasantia.show');
