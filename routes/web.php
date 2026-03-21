<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'showRegister']);
Route::post('/registro', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth.usuario'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // TODO con resource
    Route::resource('materias', MateriaController::class);
    Route::resource('horarios', HorarioController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('calificaciones', CalificacionController::class);


    Route::post('/inscribirse/{grupo}', [InscripcionController::class, 'store']);

    Route::get('/calificaciones', [CalificacionController::class, 'index']);
    Route::get('/calificaciones/{id}/edit', [CalificacionController::class, 'edit']);
    Route::put('/calificaciones/{id}', [CalificacionController::class, 'update']);
});