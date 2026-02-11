<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): Response
    {
        return response([
            'message' => 'Login correcto',
            'user' => $request->user(),
        ]);
    }
}
