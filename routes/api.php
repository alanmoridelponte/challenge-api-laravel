<?php

use Illuminate\Support\Facades\Route;


Route::post('auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('articles', App\Http\Controllers\ArticleController::class);

    Route::apiResource('categories', App\Http\Controllers\CategoryController::class);

    Route::apiResource('users', App\Http\Controllers\UserController::class);
});