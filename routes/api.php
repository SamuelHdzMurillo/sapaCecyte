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




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//RUTAS DE USUARIO
Route::apiResource('users', UserController::class);
//LOGIN DE USARIO 
Route::post('/login', [AuthController::class, 'login']);
//RUTAS DE PROGRAMAS
Route::apiResource('programs', ProgramController::class);
//RUTAS DE AREAS
Route::apiResource('areas', AreaController::class);
//RUTAS DE PROYECTOS
Route::apiResource('proyects', ProyectController::class);
Route::get('/proyects/{id}/presupuesto', [ProyectController::class, 'mostrarPresupuesto']);
//muestra cuanto del presupuesto lleva consumido 
Route::get('/proyecto/{id}/avance', [ProyectController::class, 'calcularPorcentajeAvance']);

Route::get('/programs/{id}/presupuesto', [ProgramController::class, 'mostrarPresupuesto']);
//RUTAS DE AVANCE  PROYECTOSSSSS
Route::apiResource('avances', AvanceController::class);
//RUTAS PIVOTE DE PROYECTO CON AREA
Route::apiResource('proyecto-has-area', ProyectHasAreaController::class);

// Rutas API para obtener los programas, proyectos y áreas
Route::get('/programs-cat', [CatalogController::class, 'getPrograms']);
Route::get('/proyects-cat', [CatalogController::class, 'getProyects']);
Route::get('/areas-cat', [CatalogController::class, 'getAreas']);