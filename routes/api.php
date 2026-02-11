<?php

use Illuminate\Support\Facades\Route;


Route::apiResource('articles', App\Http\Controllers\ArticleController::class);

Route::apiResource('categories', App\Http\Controllers\CategoryController::class);

Route::apiResource('users', App\Http\Controllers\UserController::class);
