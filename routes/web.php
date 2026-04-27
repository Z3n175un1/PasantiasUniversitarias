<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registro/tipo-cuenta', function () {
    return view('acctype');
})->name('account.type');

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

Route::get('/sobrenosotros', function () {
    return view('acerca');
})->name('acerca');

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

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

require __DIR__.'/auth.php';
