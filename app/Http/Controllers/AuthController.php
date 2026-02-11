<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): Response
    {
        return $token;
    }
}
