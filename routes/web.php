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

// Rutas para usuarios autenticados
Route::middleware(['auth.usuario'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    //Materias: admin gestiona, maestro y alumno solo ven
    Route::get('/materias', [MateriaController::class, 'index']);
    Route::middleware(['rol:admin'])->group(function () {
        Route::get('/materias/create', [MateriaController::class, 'create']);
        Route::post('/materias', [MateriaController::class, 'store']);
        Route::get('/materias/{id}/edit', [MateriaController::class, 'edit']);
        Route::put('/materias/{id}', [MateriaController::class, 'update']);
        Route::delete('/materias/{id}', [MateriaController::class, 'destroy']);
    });

    //Horarios: igual que materias
    Route::get('/horarios', [HorarioController::class, 'index']);
    Route::middleware(['rol:admin'])->group(function () {
        Route::get('/horarios/create', [HorarioController::class, 'create']);
        Route::post('/horarios', [HorarioController::class, 'store']);
        Route::get('/horarios/{id}/edit', [HorarioController::class, 'edit']);
        Route::put('/horarios/{id}', [HorarioController::class, 'update']);
        Route::delete('/horarios/{id}', [HorarioController::class, 'destroy']);
    });

    //Grupos: igual que materias
    Route::get('/grupos', [GrupoController::class, 'index']);
    Route::middleware(['rol:admin'])->group(function () {
        Route::get('/grupos/create', [GrupoController::class, 'create']);
        Route::post('/grupos', [GrupoController::class, 'store']);
        Route::get('/grupos/{id}/edit', [GrupoController::class, 'edit']);
        Route::put('/grupos/{id}', [GrupoController::class, 'update']);
        Route::delete('/grupos/{id}', [GrupoController::class, 'destroy']);
    });

    //Inscripciones: solo alumnos se inscriben
    Route::get('/inscripciones', [InscripcionController::class, 'index']);
    Route::middleware(['rol:alumno'])->group(function () {
        Route::post('/inscribirse/{grupo}', [InscripcionController::class, 'store']);
        Route::delete('/inscripciones/{id}', [InscripcionController::class, 'destroy']);
    });

    //Calificaciones: admin y maestro editan, alumno solo ve
    Route::get('/calificaciones', [CalificacionController::class, 'index']);
    Route::middleware(['rol:admin,maestro'])->group(function () {
        Route::get('/calificaciones/{id}/edit', [CalificacionController::class, 'edit']);
        Route::put('/calificaciones/{id}', [CalificacionController::class, 'update']);
    });

});