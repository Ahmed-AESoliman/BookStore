<?php

use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{id}', function ($user, $id) {
    $room=ChatRoom::where('id',$id)->first();
    if ($user->id == $room->book->owner_id || $user->id == $room->buyer_id) {
        return true;
    }
    return false;
});
