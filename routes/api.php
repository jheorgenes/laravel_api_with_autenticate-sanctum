<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return ApiResponse::success("The API is running.");
})->middleware('auth:sanctum');

/**
 * Rotas Resource API de Client
 * Contem todas as rotas CRUD da tabela Client
 */
Route::apiResource('clients', ClientController::class)->middleware('auth:sanctum');

// auth routes
Route::post('login', [AuthController::class, 'login']);
