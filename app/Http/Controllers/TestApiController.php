<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TestApiController extends Controller
{
    /**
     * Endpoint de prueba protegido por token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function test(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Autenticación exitosa con token.',
            'user' => $request->user(),
        ]);
    }
}
