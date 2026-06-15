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
    $ofertas = OfertaPasantia::whereHas('estadoPublicacion', function ($q) {
            $q->where('nombre', 'abierta');
        })
        ->with(['ubicacion', 'perfilEmpresa'])
        ->get();
    $ubicaciones = \App\Models\Ubicacion::orderBy('ciudad')->get();
    $carreras = [
        'Administración de Empresas', 'Administración Turística y Hotelera', 'Agronomía',
        'Antropología', 'Arqueología', 'Arquitectura', 'Artes Plásticas', 'Auditoría',
        'Bioquímica', 'Biotecnología', 'Ciencia de la Computación', 'Ciencia Política',
        'Ciencias de la Comunicación', 'Ciencias de la Educación', 'Ciencias del Deporte',
        'Contabilidad', 'Derecho', 'Diseño de Interiores', 'Diseño Digital', 'Diseño Gráfico',
        'Economía', 'Enfermería', 'Filosofía', 'Física', 'Fisioterapia', 'Geografía',
        'Historia', 'Idiomas / Lingüística', 'Ingeniería Agroindustrial', 'Ingeniería Agronómica',
        'Ingeniería Ambiental', 'Ingeniería Biomédica', 'Ingeniería Civil', 'Ingeniería Comercial',
        'Ingeniería de Alimentos', 'Ingeniería de Sistemas', 'Ingeniería de Telecomunicaciones',
        'Ingeniería Económica', 'Ingeniería Eléctrica', 'Ingeniería Electrónica',
        'Ingeniería en Biotecnología', 'Ingeniería en Energías Renovables', 'Ingeniería Forestal',
        'Ingeniería Geológica', 'Ingeniería Industrial', 'Ingeniería Informática',
        'Ingeniería Mecánica', 'Ingeniería Mecatrónica', 'Ingeniería Metalúrgica',
        'Ingeniería Petrolera', 'Ingeniería Química', 'Ingeniería Textil', 'Ingeniería Topográfica',
        'Literatura', 'Marketing', 'Matemáticas', 'Medicina', 'Medicina Veterinaria', 'Música',
        'Negocios Internacionales', 'Nutrición', 'Odontología', 'Pedagogía', 'Periodismo',
        'Psicología', 'Química', 'Relaciones Internacionales', 'Sociología', 'Trabajo Social',
        'Turismo y Hotelería',
    ];
    $modalidades = \App\Models\OfertaPasantia::whereNotNull('modalidad')
        ->distinct()->orderBy('modalidad')->pluck('modalidad');
    return view('explora', compact('ofertas', 'ubicaciones', 'carreras', 'modalidades'));
})->name('explora');

Route::get('/comofunciona', function () {
    return view('comofunciona');
})->name('comofunciona');

Route::get('/sobrenosotros', function () {
    $estudiantes_count = PerfilEstudiante::count();
    $empresas_count = PerfilEmpresa::count();
    return view('sobrenosotros', compact('estudiantes_count', 'empresas_count'));
})->name('sobrenosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/privacidad', function () {
    return view('privacidad');
})->name('privacidad');

// ── Login ─────────────────────────────────────────────────────────────────────

Route::get('/login', function () {
    $ofertas_count = OfertaPasantia::count();
    $empresas_count = PerfilEmpresa::count();
    $estudiantes_count = PerfilEstudiante::count();
    return view('autenticacion.login', compact('ofertas_count', 'empresas_count', 'estudiantes_count'));
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

// ── Olvidé Contraseña ─────────────────────────────────────────────────────────

Route::get('/olvide-password', function () {
    return view('autenticacion.olvide-password');
})->name('password.olvide');

Route::post('/olvide-password', function (Request $request) {
    $request->validate(['correo' => 'required|email']);

    $usuario = Usuario::where('correo', $request->correo)->first();

    if ($usuario) {
        RegistroAuditoria::create([
            'usuario_id' => $usuario->id,
            'tipo_entidad_id' => 6,
            'entidad_id' => $usuario->id,
            'accion' => 'Solicitud de restablecimiento de contraseña',
            'valor_nuevo' => ['correo' => $request->correo],
            'creado_en' => now(),
        ]);
    }

    return back()->with('success', 'Si el correo existe en nuestro sistema, recibirás instrucciones para restablecer tu contraseña.');
})->name('password.olvide.enviar');

// ── Registro ──────────────────────────────────────────────────────────────────

Route::get('/seleccion', function () {
    return view('autenticacion.seleccion');
})->name('seleccion');

Route::get('/register/{rol}', function ($rol) {
    if (!in_array($rol, ['student', 'company'])) {
        abort(404);
    }
    $ofertas_count = OfertaPasantia::count();
    $carreras = [
        'Administración de Empresas', 'Administración Turística y Hotelera', 'Agronomía',
        'Antropología', 'Arqueología', 'Arquitectura', 'Artes Plásticas', 'Auditoría',
        'Bioquímica', 'Biotecnología', 'Ciencia de la Computación', 'Ciencia Política',
        'Ciencias de la Comunicación', 'Ciencias de la Educación', 'Ciencias del Deporte',
        'Contabilidad', 'Derecho', 'Diseño de Interiores', 'Diseño Digital', 'Diseño Gráfico',
        'Economía', 'Enfermería', 'Filosofía', 'Física', 'Fisioterapia', 'Geografía',
        'Historia', 'Idiomas / Lingüística', 'Ingeniería Agroindustrial', 'Ingeniería Agronómica',
        'Ingeniería Ambiental', 'Ingeniería Biomédica', 'Ingeniería Civil', 'Ingeniería Comercial',
        'Ingeniería de Alimentos', 'Ingeniería de Sistemas', 'Ingeniería de Telecomunicaciones',
        'Ingeniería Económica', 'Ingeniería Eléctrica', 'Ingeniería Electrónica',
        'Ingeniería en Biotecnología', 'Ingeniería en Energías Renovables', 'Ingeniería Forestal',
        'Ingeniería Geológica', 'Ingeniería Industrial', 'Ingeniería Informática',
        'Ingeniería Mecánica', 'Ingeniería Mecatrónica', 'Ingeniería Metalúrgica',
        'Ingeniería Petrolera', 'Ingeniería Química', 'Ingeniería Textil', 'Ingeniería Topográfica',
        'Literatura', 'Marketing', 'Matemáticas', 'Medicina', 'Medicina Veterinaria', 'Música',
        'Negocios Internacionales', 'Nutrición', 'Odontología', 'Pedagogía', 'Periodismo',
        'Psicología', 'Química', 'Relaciones Internacionales', 'Sociología', 'Trabajo Social',
        'Turismo y Hotelería',
    ];
    return view('autenticacion.register', compact('rol', 'ofertas_count', 'carreras'));
})->name('register')->where('rol', 'student|company');

Route::post('/register', function (Request $request) {
    $rules = [
        'email' => 'required|email|unique:usuarios,correo',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:student,company',
        'phone' => 'required|digits:8',
    ];

    if ($request->role === 'student') {
        $rules = array_merge($rules, [
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'paternal_surname' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'maternal_surname' => ['nullable', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'career' => 'required|string|max:200',
        ]);
    } else {
        $rules = array_merge($rules, [
            'company_name' => 'required|string|max:200',
            'sector' => 'required|string|max:100',
            'hr_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'hr_paternal' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'hr_maternal' => ['nullable', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
        ]);
    }

    $request->validate($rules, [
        'email.unique' => '¡Ups! Parece que ya registraste esta cuenta. Intenta iniciar sesión.',
        'full_name.regex' => 'El nombre solo puede contener letras y espacios.',
        'paternal_surname.regex' => 'El apellido paterno solo puede contener letras y espacios.',
        'maternal_surname.regex' => 'El apellido materno solo puede contener letras y espacios.',
        'hr_name.regex' => 'El nombre solo puede contener letras y espacios.',
        'hr_paternal.regex' => 'El apellido paterno solo puede contener letras y espacios.',
        'hr_maternal.regex' => 'El apellido materno solo puede contener letras y espacios.',
        'phone.digits' => 'El celular debe tener exactamente 8 dígitos.',
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
    Route::get('/ofertas/{id}', [AdminController::class, 'mostrarOferta'])->name('ofertas.mostrar');
    Route::put('/ofertas/{id}', [AdminController::class, 'actualizarOferta'])->name('ofertas.actualizar');

    // Reportes dinámicos
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes');

    // Logs (solo super admin)
    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    // Estadísticas
    Route::get('/estadisticas', [AdminController::class, 'estadisticas'])->name('estadisticas');

    // Respaldos
    Route::get('/respaldos', [AdminController::class, 'respaldos'])->name('respaldos');
    Route::post('/respaldos/generar', [AdminController::class, 'generarRespaldo'])->name('respaldos.generar');
    Route::get('/respaldos/descargar/{archivo}', [AdminController::class, 'descargarRespaldo'])->name('respaldos.descargar');

    // Exportar reportes
    Route::get('/reportes/exportar/{formato}', [AdminController::class, 'exportarReportes'])->name('reportes.exportar');
    Route::get('/logs/exportar/{formato}', [LogController::class, 'exportar'])->name('logs.exportar');
});

// ── Documentos ────────────────────────────────────────────────────────────────

Route::get('/documentos/{id}/ver', [App\Http\Controllers\DocumentoController::class, 'ver'])
    ->name('documentos.ver')
    ->middleware('auth');

Route::get('/documentos/{id}/archivo', [App\Http\Controllers\DocumentoController::class, 'archivo'])
    ->name('documentos.archivo')
    ->middleware('auth');

// ── Dashboards ────────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/admin', function (Request $request) {
        abort_if(Auth::user()->rol_id != 3, 403);

        $admins = Usuario::where('rol_id', 3)->count();
        $totalEstudiantes = PerfilEstudiante::count();
        $totalEmpresas = PerfilEmpresa::count();
        $totalUsuarios = $admins + $totalEstudiantes + $totalEmpresas;
        $totalOfertas = OfertaPasantia::count();
        $totalPostulaciones = Postulacion::count();

        $ofertasPorEstado = OfertaPasantia::selectRaw('estado_publicacion_id, count(*) as total')
            ->groupBy('estado_publicacion_id')->pluck('total', 'estado_publicacion_id');
        $postulacionesPorEstado = Postulacion::selectRaw('estado_postulacion_id, count(*) as total')
            ->groupBy('estado_postulacion_id')->pluck('total', 'estado_postulacion_id');

        $mesActual = now()->format('Y-m');
        $resumenMes = [
            'ofertas' => OfertaPasantia::whereRaw("to_char(fecha_inicio, 'YYYY-MM') = ?", [$mesActual])->count(),
            'usuarios' => Usuario::whereRaw("to_char(creado_en, 'YYYY-MM') = ?", [$mesActual])->count(),
            'postulaciones' => Postulacion::whereRaw("to_char(creado_en, 'YYYY-MM') = ?", [$mesActual])->count(),
            'empresas' => PerfilEmpresa::whereHas('usuario', function ($q) use ($mesActual) {
                $q->whereRaw("to_char(creado_en, 'YYYY-MM') = ?", [$mesActual]);
            })->count(),
        ];

        $ultimosLogs = RegistroAuditoria::with('usuario')
            ->latest('creado_en')->take(8)->get();

        $stats = [
            'usuarios' => $totalUsuarios,
            'estudiantes' => $totalEstudiantes,
            'empresas' => $totalEmpresas,
            'admins' => $admins,
            'ofertas' => $totalOfertas,
            'postulaciones' => $totalPostulaciones,
            'ultimos_usuarios' => Usuario::with('rol')->latest('creado_en')->take(10)->get(),
            'todas_empresas' => PerfilEmpresa::with('usuario')->orderBy('nombre_empresa')->paginate(10, ['*'], 'empresas_page'),
            'todos_estudiantes' => PerfilEstudiante::with('usuario')->orderBy('carrera')->paginate(10, ['*'], 'estudiantes_page'),
            'ofertas_activas' => OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])
                ->where('estado_publicacion_id', 2)->orderBy('id', 'desc')->paginate(8, ['*'], 'ofertas_page'),
            'ofertas_borrador' => OfertaPasantia::with(['perfilEmpresa'])
                ->where('estado_publicacion_id', 1)->count(),
            'ofertas_cerradas' => OfertaPasantia::with(['perfilEmpresa'])
                ->where('estado_publicacion_id', 3)->count(),
            'ofertas_por_estado' => $ofertasPorEstado,
            'postulaciones_por_estado' => $postulacionesPorEstado,
            'resumen_mes' => $resumenMes,
            'ultimos_logs' => $ultimosLogs,
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
        return response()->json($oferta->makeVisible(['requisitos', 'beneficios', 'vacantes_disponibles', 'duracion_semanas']));
    })->middleware('auth');

    // Student routes
    // Postulaciones
    Route::post('/postulaciones', function (Request $request) {
        $request->validate([
            'oferta_pasantia_id' => 'required|exists:ofertas_pasantia,id',
        ]);

        $estudiante = \App\Models\PerfilEstudiante::withCount(['documentos', 'habilidades'])->where('usuario_id', Auth::id())->firstOrFail();

        if ($estudiante->documentos_count === 0) {
            return back()->with('error', 'Primero debes subir al menos un documento en tu perfil antes de postular.');
        }

        if ($estudiante->habilidades_count === 0) {
            return back()->with('error', 'Primero debes registrar al menos una habilidad en tu perfil antes de postular.');
        }

        $existe = \App\Models\Postulacion::where('perfil_estudiante_id', $estudiante->id)
            ->where('oferta_pasantia_id', $request->oferta_pasantia_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya te has postulado a esta oferta.');
        }

        $post = \App\Models\Postulacion::create([
            'perfil_estudiante_id' => $estudiante->id,
            'oferta_pasantia_id' => $request->oferta_pasantia_id,
            'estado_postulacion_id' => 1,
        ]);

        $oferta = \App\Models\OfertaPasantia::with('requisitosHabilidad')->findOrFail($request->oferta_pasantia_id);

        $habilidadesEstudiante = $estudiante->habilidades->keyBy('habilidad_id');
        $pesoTotal = 0;
        $ponderadoTotal = 0;

        foreach ($oferta->requisitosHabilidad as $req) {
            $nivelEstudiante = $habilidadesEstudiante->get($req->habilidad_id)?->nivel ?? 0;
            $benefit = $req->tipo_criterio === 'benefit';
            $valorNormalizado = $benefit ? $nivelEstudiante / 5 : 1 - ($nivelEstudiante / 5);
            $peso = $req->peso ?? 0;
            $valorPonderado = $valorNormalizado * ($peso / 100);
            $ponderadoTotal += $valorPonderado;
            $pesoTotal += $peso;

            \App\Models\DetallePuntajeTopsis::create([
                'postulacion_id' => $post->id,
                'habilidad_id' => $req->habilidad_id,
                'valor_bruto' => $nivelEstudiante,
                'valor_normalizado' => round($valorNormalizado, 4),
                'valor_ponderado' => round($valorPonderado, 4),
            ]);
        }

        $puntajeTopsis = $pesoTotal > 0 ? round(($ponderadoTotal / ($pesoTotal / 100)) * 100, 2) : 0;
        $post->update(['puntaje_topsis' => $puntajeTopsis]);

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
    Route::patch('/student/habilidades/{id}/nivel', [App\Http\Controllers\StudentController::class, 'actualizarNivelHabilidad'])->name('student.habilidades.nivel');
    Route::delete('/student/habilidades/{id}', [App\Http\Controllers\StudentController::class, 'eliminarHabilidad'])->name('student.habilidades.eliminar');

    // Company profile routes
    Route::match(['post', 'patch'], '/company/perfil', [App\Http\Controllers\CompanyController::class, 'actualizarPerfil'])->name('company.perfil.actualizar');
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
