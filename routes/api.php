<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiTokenController;

// Ruta pública para emitir tokens
Route::post('/tokens/create', [ApiTokenController::class, 'issueToken']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Obtener el usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Revocar token actual
    Route::post('/tokens/revoke', [ApiTokenController::class, 'revokeToken']);

    // Revocar todos los tokens
    Route::post('/tokens/revoke-all', [ApiTokenController::class, 'revokeAllTokens']);

    // Endpoint de prueba para test con token
    Route::get('/test-api', [\App\Http\Controllers\TestApiController::class, 'test']);

    // Otras rutas protegidas...
});
