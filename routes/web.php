<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');
Route::post('reset-password/{token}', [NewPasswordController::class, 'store'])
    ->name('password.update');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/{nombre}/{id_anuncio}', [WelcomeController::class, 'show'])->name('anuncio');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Redirige al usuario a los anuncios después de hacer login
    Route::get('/dashboard', function () {
        return redirect()->route('anuncios.index');
    })->name('dashboard');

    Route::resource('anuncios', AnuncioController::class);

    Route::post('anuncios/{anuncio}/cambiar-estado', [AnuncioController::class, 'cambiarEstado'])->name('anuncios.cambiarEstado');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('administracion')->middleware('auth')->group(function () {
        Route::get('/', [AdministracionController::class, 'index'])->name('administracion.index');
        Route::get('/permitir/{anuncio}', [AdministracionController::class, 'permitir'])->name('administracion.permitir');
        Route::get('/denegar/{anuncio}', [AdministracionController::class, 'denegar'])->name('administracion.denegar');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/administracion', [AdministracionController::class, 'index'])->name('administracion.index');
    });
});

require __DIR__ . '/auth.php';
