<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\ProyectHasAreaController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\FacturaController;

// Ruta de autenticación para obtener usuario actual
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ============= RUTAS DE AUTENTICACIÓN =============
Route::post('/login', [AuthController::class, 'login']);

// ============= RUTAS DE USUARIOS =============
Route::apiResource('users', UserController::class);

// ============= RUTAS DE PROGRAMAS =============
Route::apiResource('programs', ProgramController::class);
Route::get('/programs/{id}/presupuesto', [ProgramController::class, 'mostrarPresupuesto']);

// ============= RUTAS DE ÁREAS =============
Route::apiResource('areas', AreaController::class);

// ============= RUTAS DE PROYECTOS =============
Route::apiResource('proyects', ProyectController::class);
Route::get('/proyects/{id}/presupuesto', [ProyectController::class, 'mostrarPresupuesto']);
Route::get('/proyecto/{id}/avance', [ProyectController::class, 'calcularPorcentajeAvance']);

// ============= RUTAS DE AVANCES =============
Route::apiResource('avances', AvanceController::class);

// ============= RUTAS DE RELACIÓN PROYECTO-ÁREA =============
Route::apiResource('proyecto-has-area', ProyectHasAreaController::class);

// ============= RUTAS DE CATÁLOGOS =============
Route::get('/programs-cat', [CatalogController::class, 'getPrograms']);
Route::get('/proyects-cat', [CatalogController::class, 'getProyects']);
Route::get('/areas-cat', [CatalogController::class, 'getAreas']);

// ============= RUTAS DE PROVEEDORES =============
Route::prefix('proveedores')->group(function () {
    Route::get('/', [ProveedorController::class, 'index']);
    Route::post('/', [ProveedorController::class, 'store']);
    Route::get('/{id}', [ProveedorController::class, 'show']);
    Route::put('/{id}', [ProveedorController::class, 'update']);
    Route::delete('/{id}', [ProveedorController::class, 'destroy']);
});

// ============= RUTAS DE FACTURAS =============
Route::prefix('facturas')->group(function () {
    Route::get('/', [FacturaController::class, 'index']);
    Route::post('/', [FacturaController::class, 'store']);
    Route::get('/{id}', [FacturaController::class, 'show']);
    Route::put('/{id}', [FacturaController::class, 'update']);
    Route::delete('/{id}', [FacturaController::class, 'destroy']);
});
