<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Pasillo;
use App\Http\Controllers\PasilloController;
use App\Http\Controllers\ProductosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pasillos', [PasilloController::class, 'index']);
    Route::post('/productos/store', [ProductosController::class, 'store']);
});
