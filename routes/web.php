<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auths/login', [App\Http\Controllers\AuthController::class, 'login']);
