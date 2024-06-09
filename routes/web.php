<?php

use App\Http\Controllers\CrearePasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('create-password', function (Request $request) {
    return view('create-password')->with([
        'email' => $request->email,
        'token' => $request->token,
    ]);;
});
Route::post('create-password', [CrearePasswordController::class, "resetPassword"])->name('password.update');

Route::get('/send-message', function () {
    $data = request()->all();

    $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true
    ]);

    // Triggering an event to Pusher
    $pusher->trigger('chat', 'message', [
        'username' => $data['username'],
        'message' => $data['message']
    ]);

    return response()->json(['status' => 'Message Sent!']);
});
