<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\OfertaPasantia;
use App\Models\Usuario;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;
use App\Models\Carrera;

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

// ── Autenticación ─────────────────────────────────────────────────────────────

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'correo' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->rol_id == 3)
            return redirect()->route('dashboard.admin');
        if ($user->rol_id == 2)
            return redirect()->route('dashboard.company');
        return redirect()->route('dashboard.student');
    }

    return back()->withErrors([
        'correo' => 'Las credenciales no coinciden en nuestro sistema.',
    ]);
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ── Registro ──────────────────────────────────────────────────────────────────

Route::get('/seleccion', function () {
    return view('auth.seleccion');
})->name('seleccion');

Route::get('/registro', function (Request $request) {
    $rol = $request->query('rol', 'student');
    return view('auth.registro', compact('rol'));
})->name('registro');

Route::post('/registro', [RegisterController::class, 'store'])->name('registro.store');

// ── Dashboards (protegidos) ───────────────────────────────────────────────────

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/admin', function () {
        abort_if(Auth::user()->rol_id != 3, 403);
        $stats = [
            'usuarios' => Usuario::count(),
            'empresas' => PerfilEmpresa::count(),
            'estudiantes' => PerfilEstudiante::count(),
            'ofertas' => OfertaPasantia::count(),
            'postulaciones' => Postulacion::count(),
            'ultimos_usuarios' => Usuario::latest('creado_en')->take(10)->get(),
        ];
        return view('dashboards.dashboard_admin', compact('stats'));
    })->name('dashboard.admin');

    Route::get('/dashboard/company', function () {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->first() ?? PerfilEmpresa::find(1);
        $ofertas = OfertaPasantia::where('perfil_empresa_id', $empresa->id)->get();
        return view('dashboards.dashboard_company', compact('empresa', 'ofertas'));
    })->name('dashboard.company');

    Route::get('/dashboard/student', function () {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->first() ?? PerfilEstudiante::find(1);
        $postulaciones = Postulacion::where('perfil_estudiante_id', $estudiante->id)->get();
        return view('dashboards.dashboard_student', compact('estudiante', 'postulaciones'));
    })->name('dashboard.student');

});

// ── Fallback auth routes ──────────────────────────────────────────────────────
require __DIR__ . '/auth.php';