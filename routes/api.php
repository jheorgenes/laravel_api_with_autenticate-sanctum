<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'The API is running.',
    ], 200);
});

/**
 * Rotas Resource API de Client
 * Contem todas as rotas CRUD da tabela Client
 */
Route::apiResource('clients', ClientController::class);
