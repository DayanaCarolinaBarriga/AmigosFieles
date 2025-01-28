<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdoptanteController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\AdopcionController;




Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/animales', App\Http\Controllers\AnimaleController::class);
Route::resource('/adoptantes', App\Http\Controllers\AdoptanteController::class);
Route::resource('/adopciones', App\Http\Controllers\AdopcioneController::class);
Route::resource('/gastos', App\Http\Controllers\GastoController::class);
Route::resource('users', UserController::class);
Route::resource('/tipo-gasto', App\Http\Controllers\TipoGastoController::class);
Route::resource('/especies-animale', App\Http\Controllers\EspeciesAnimaleController::class);
Route::resource('/seguimientoadopcione', App\Http\Controllers\SeguimientoAdopcioneController::class);
Route::resource('/visitasseguimiento', App\Http\Controllers\VisitasSeguimientoController::class);


Route::prefix('informes')->group(function () {
    Route::get('filters', [AnimaleController::class, 'filters'])->name('informes.filters');
    Route::get('generate-pdf', [AnimaleController::class, 'generatePdf'])->name('informes.generatePdf');
});



// Para la recuperación de contraseñas
Route::get('password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Para el restablecimiento de contraseñas
Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');


