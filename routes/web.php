<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'showRegister']);
Route::post('/registro', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth.usuario'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/materias', [MateriaController::class, 'index']);
    Route::get('/horarios', [HorarioController::class, 'index']);
    Route::get('/grupos', [GrupoController::class, 'index']);

});