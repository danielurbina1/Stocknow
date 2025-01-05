<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasilloController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user()->load('role');
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pasillos', [PasilloController::class, 'index']);
    Route::get('/pasillos/{id}/productos', [ProductosController::class, 'filterByPasillo']); // Nueva ruta para filtrar productos por pasillo
    Route::post('/productos/store', [ProductosController::class, 'store']);
});
Route::apiResource('roles', RoleController::class);
Route::apiResource('users', UserController::class);

