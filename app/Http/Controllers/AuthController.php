<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validated();

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales inválidas',
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'message' => 'Login exitoso',
            'user' => auth('api')->user(),
            'token' => $token,
        ]);
    }
}
