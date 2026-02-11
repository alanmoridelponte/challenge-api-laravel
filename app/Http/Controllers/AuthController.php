<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): Response|\Illuminate\Http\JsonResponse
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $user = auth()->user();
        $token = 'dummy-token';

        return response([
            'message' => 'Login correcto',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
