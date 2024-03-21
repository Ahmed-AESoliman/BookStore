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
            Route::put('/update-authenticated-user', 'AuthController@update');
            Route::get('/authenticated-user', 'AuthController@authenticatedUser');

            Route::get('/general-categories', 'CategoryController@generalCategories');
            Route::get('/educational-categories', 'CategoryController@educationalCategories');
            Route::get('/educational-sub-categories', 'CategoryController@educationalSubCategories');
            Route::get('/educational-subjects', 'CategoryController@educationalSubjects');
        });
    }
);
