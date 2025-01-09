<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasilloController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// Rutas de autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {
    // Rutas para obtener el usuario actual
    Route::get('/user', function (Request $request) {
        return $request->user()->load('role');
    });

    // Rutas para productos
    Route::get('/pasillos', [PasilloController::class, 'index']);
    Route::get('/pasillos/{id}/productos', [ProductosController::class, 'filterByPasillo']);
    Route::post('/productos', [ProductosController::class, 'store']);  // POST para crear un producto
    Route::patch('/productos/{id}/stock', [ProductosController::class, 'updateStock']); // Ruta para actualizar el stock

    // Rutas para roles y usuarios
    
});
Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
