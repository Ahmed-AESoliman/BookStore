<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Broadcast::routes(['middleware' => ['auth:sanctum']]);

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
            Route::get('/book', 'BookController@index');
            Route::get('/book/my-ads', 'BookController@getBooksToAuthUser');
            Route::get('/book/{book}', 'BookController@show');
            Route::post('/book/upload-attachment', 'BookController@uploadAttachments');
            Route::delete('/book/delete-attachment', 'BookController@deleteAttachment');
            Route::post('/book/store', 'BookController@store');
            Route::put('/book/update/{book}', 'BookController@update');
            Route::delete('/book/delete/{book}', 'BookController@delete');
            Route::get('/favorite-books', 'BookController@favoriteBooks');
            Route::post('/book/add-to-favorite/{book}', 'BookController@addBookToFavorite');
            Route::delete('/book/delete-from-favorite/{book}', 'BookController@deleteBookToFavorite');

            Route::post('/chat/create-chat-room/{book}', 'ChatController@createChatRoom');
            Route::post('/chat/send-message/{room}', 'ChatController@sendMessage');
            Route::get('/chat/rooms', 'ChatController@getChatRooms');
            Route::get('/chat/rooms/{room}', 'ChatController@getChatRoom');
            // Route::get('/chat/rooms/{room}/messages', 'ChatController@getChatRoomMessages');
        });
    }
);
