<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
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
    return redirect('/');
});

// ── Registro ──────────────────────────────────────────────────────────────────

Route::get('/seleccion', function () {
    return view('auth.seleccion');
})->name('seleccion');

Route::get('/register/{rol}', function ($rol) {
    if (!in_array($rol, ['student', 'company']))
        abort(404);
    return view('auth.register', compact('rol'));
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

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
            'ultimos_usuarios' => Usuario::latest('creado_en')->take(10)->get(),
        ];
        return view('dashboards.dashboard_admin', compact('stats'));
    })->name('dashboard.admin');

    Route::get('/dashboard/company', function () {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->first();
        $ofertas = OfertaPasantia::where('perfil_empresa_id', $empresa->id)->get();
        return view('dashboards.dashboard_company', compact('empresa', 'ofertas'));
    })->name('dashboard.company');

    Route::get('/dashboard/student', function () {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->first();
        $postulaciones = Postulacion::where('perfil_estudiante_id', $estudiante->id)->get();
        return view('dashboards.dashboard_student', compact('estudiante', 'postulaciones'));
    })->name('dashboard.student');

});