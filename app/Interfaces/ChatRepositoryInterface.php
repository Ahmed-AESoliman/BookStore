<?php

namespace App\Interfaces;

use App\Http\Resources\ChatRoomCollection;
use App\Http\Resources\ChatRoomMessageCollection;
use App\Models\Book;
use App\Models\ChatRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ChatRepositoryInterface
{
    public function createChatRoom(Book $book): JsonResponse;
    public function sendMessage(string $content, ChatRoom $room): JsonResponse;
    public function getChatRooms(Request $request): ChatRoomCollection;
    public function getChatRoom(ChatRoom $room): JsonResponse;
    public function getChatRoomMessages(ChatRoom $room): ChatRoomMessageCollection;
}
