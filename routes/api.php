<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\AvanceController;




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

//RUTAS DE PROYECTOSSSSS
Route::apiResource('avances', AvanceController::class);