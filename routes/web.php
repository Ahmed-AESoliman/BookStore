<?php

use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

Route::get('/', function () {
    return view('welcome');
});
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
