<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTokenController extends Controller
{
    /**
     * Emitir un token de API tras autenticación de usuario.
     */
    public function issueToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Revocar el token actual.
     */
    public function revokeToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Token revoked successfully']);
    }

    /**
     * Revocar todos los tokens del usuario autenticado.
     */
    public function revokeAllTokens(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'All tokens revoked successfully']);
    }
}
