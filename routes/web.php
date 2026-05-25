<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\OfertaPasantia;
use App\Models\Usuario;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;

// ── Rutas públicas ────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/explora', function () {
    $ofertas = OfertaPasantia::with(['ubicacion', 'perfilEmpresa'])->get();
    return view('explora', compact('ofertas'));
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
    return view('auth.login');
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

        if ($usuario->rol_id == 3)
            return redirect('/dashboard/admin');
        if ($usuario->rol_id == 2)
            return redirect('/dashboard/company');
        return redirect('/dashboard/student');
    }

    return back()->withErrors(['correo' => 'Credenciales incorrectas'])->withInput();
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
})->name('logout');

// ── Registro ──────────────────────────────────────────────────────────────────

// Página de selección
Route::get('/seleccion', function () {
    return view('auth.seleccion');
})->name('seleccion');

// MOSTRAR formulario (GET) - ¡ESTA FALTABA!
Route::get('/register/{rol}', function ($rol) {
    if (!in_array($rol, ['student', 'company'])) {
        abort(404);
    }
    return view('auth.register', compact('rol'));
})->name('register')->where('rol', 'student|company');

// PROCESAR registro (POST) - Solo una vez
Route::post('/register', function (Request $request) {
    $request->validate([
        'email' => 'required|email|unique:usuarios,correo',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:student,company',
    ]);

    $rolId = $request->role === 'student' ? 1 : 2;

    if ($request->role === 'student') {
        $nombreCompleto = trim($request->full_name . ' ' . $request->paternal_surname . ' ' . $request->maternal_surname);
    } else {
        $nombreCompleto = trim($request->hr_name . ' ' . $request->hr_paternal . ' ' . $request->hr_maternal);
    }

    $usuario = Usuario::create([
        'rol_id' => $rolId,
        'nombre' => $nombreCompleto,
        'correo' => $request->email,
        'contrasena_hash' => Hash::make($request->password),
        'activo' => true,
    ]);

    if ($request->role === 'student') {
        PerfilEstudiante::create([
            'usuario_id' => $usuario->id,
            'universidad' => 'Por completar',
            'carrera' => $request->career,
            'anio_graduacion' => null,
            'biografia' => null,
        ]);
    } else {
        PerfilEmpresa::create([
            'usuario_id' => $usuario->id,
            'nombre_empresa' => $request->company_name,
            'industria' => $request->sector,
            'sitio_web' => null,
            'verificada' => false,
        ]);
    }

    Auth::login($usuario);

    if ($usuario->rol_id == 2) {
        return redirect('/dashboard/company')->with('success', '¡Bienvenida empresa!');
    }
    return redirect('/dashboard/student')->with('success', '¡Bienvenido estudiante!');
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
        return view('dashboards.dashboard_admin', compact('stats'));
    })->name('dashboard.admin');

    Route::get('/dashboard/company', function () {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->first();

        if (!$empresa) {
            return redirect('/login')->with('error', 'Perfil de empresa no encontrado.');
        }

        $ofertas = OfertaPasantia::where('perfil_empresa_id', $empresa->id)->get();
        return view('dashboards.dashboard_company', compact('empresa', 'ofertas'));
    })->name('dashboard.company');

    Route::get('/dashboard/student', function () {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->first();

        if (!$estudiante) {
            return redirect('/login')->with('error', 'Perfil de estudiante no encontrado.');
        }

        $postulaciones = Postulacion::where('perfil_estudiante_id', $estudiante->id)->get();
        return view('dashboards.dashboard_student', compact('estudiante', 'postulaciones'));
    })->name('dashboard.student');

});

// ── Pasantías ─────────────────────────────────────────────────────────────────

Route::get('/pasantia/{id}', function ($id) {
    // Solo mostrar ofertas activas públicamente
    $oferta = OfertaPasantia::where('id', $id)
        ->whereHas('estadoPublicacion', function($q) {
            $q->where('nombre', 'abierta'); // Solo mostrar abiertas
        })
        ->with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])
        ->firstOrFail();
    
    return view('pasantias.show', compact('oferta'));
})->name('pasantia.show');