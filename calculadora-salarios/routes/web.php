<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [CalculadoraController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Inicio / Calculadora salario
    Route::get('/', [CalculadoraController::class, 'index'])
        ->name('salario.index');

    Route::post('/calcular-salario',
        [CalculadoraController::class, 'calcularSalario'])
        ->name('salario.calcular');

    // Prestaciones
    Route::get('/prestaciones',
        [CalculadoraController::class, 'prestacionesIndex'])
        ->name('prestaciones.index');

    Route::post('/calcular-prestaciones',
        [CalculadoraController::class, 'calcularPrestaciones'])
        ->name('prestaciones.calcular');

    // Historial
    Route::get('/historial',
        [CalculadoraController::class, 'historial'])
        ->name('historial');

    Route::get('/historial/{id}/edit',
        [CalculadoraController::class, 'edit'])
        ->name('historial.edit');

    Route::put('/historial/{id}',
        [CalculadoraController::class, 'update'])
        ->name('historial.update');

    Route::delete('/historial/{id}',
        [CalculadoraController::class, 'destroy'])
        ->name('historial.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';