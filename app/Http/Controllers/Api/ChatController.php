<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRoomCollection;
use App\Http\Resources\ChatRoomMessageCollection;
use App\Interfaces\ChatRepositoryInterface;
use App\Models\Book;
use App\Models\ChatRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * @var ChatRepositoryInterface
     */
    private ChatRepositoryInterface $chatRepository;

    public function __construct(ChatRepositoryInterface $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function createChatRoom(Book $book): JsonResponse
    {
        return $this->chatRepository->createChatRoom($book);
    }


    public function sendMessage(Request $request, ChatRoom $room): JsonResponse
    {
        $request->validate(['content' => 'required|string|max:255']);
        return $this->chatRepository->sendMessage($request->get('content'), $room);
    }

    public function getChatRooms(Request $request): ChatRoomCollection
    {
        return $this->chatRepository->getChatRooms($request);
    }

    public function getChatRoom(ChatRoom $room): JsonResponse
    {
        return $this->chatRepository->getChatRoom($room);
    }
    public function getChatRoomMessages(ChatRoom $room): ChatRoomMessageCollection
    {
        return $this->chatRepository->getChatRoomMessages($room);
    }
}
