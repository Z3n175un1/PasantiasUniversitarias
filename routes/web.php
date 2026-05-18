<?php

//dependencias de controladores
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

//ruta de dashboard para estudiantes autenticados
Route::get('/dashboard', function () {
    return view('dash_est');
})->middleware(['auth', 'verified'])->name('dashboard');
// Alias to match route names in the view
Route::get('/student/dashboard', function () {
    return redirect()->route('dashboard');
})->name('student.dashboard');



// Public routes for viewing offers
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
Route::view('/terminos-y-condiciones', 'terminos-cond')->name('terms');

Route::get('/about', function () {
    return view('acerca');
})->name('about');
Route::get('/busqueda', function () {
    return view('busqueda');
})->name('busqueda');


Route::get('/notices', function(){
    return view('notices'); 
})->name('notices');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/privacidad', function () {
    return view('priva');
})->name('priva');

Route::get('/comufunciona', function () {
    return view('comfun');
})->name('comfun');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // System management routes
    Route::resource('offers', OfferController::class)->except(['index', 'show']);
    Route::resource('companies', CompanyController::class);
    Route::resource('students', StudentController::class);
    Route::resource('applications', ApplicationController::class);
});

// Route::middleware(['auth', 'admin'])
//     ->prefix('admin')
//     ->group(function () {
// Public routes
Route::view('/', 'welcome')->name('home');
Route::view('/registro/tipo-cuenta', 'acctype')->name('account.type');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    // Alias for student dashboard
    Route::get('/student/dashboard', function () {
        return redirect()->route('dashboard');
    })->name('student.dashboard');
});

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
Route::view('/terminos-y-condiciones', 'terminos-cond')->name('terms');
Route::view('/sobrenosotros', 'acerca')->name('acerca');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/privacidad', 'priva')->name('priva');
Route::view('/comufunciona', 'comfun')->name('comfun');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('offers', OfferController::class)->except(['index', 'show']);
    Route::resource('companies', CompanyController::class);
    Route::resource('students', StudentController::class);
    Route::resource('applications', ApplicationController::class);
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
});

require __DIR__.'/auth.php';
