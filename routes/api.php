<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(
    ['namespace' => 'App\Http\Controllers\Api'],
    function () {
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
        Route::post('/password/create', 'AuthController@resetPassword');
        Route::post('/password/reset-password', 'AuthController@resend');
        Route::post('/password/resend-password-create', 'AuthController@resend');
        Route::post('/refresh-token', 'AuthController@refreshToken');

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::delete('/logout', 'AuthController@logout');
        });
    }
);