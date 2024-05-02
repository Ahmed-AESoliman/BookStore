<?php

namespace App\Repositories;

use App\Events\NewMessageAdd;
use App\Http\Resources\ChatRoomCollection;
use App\Http\Resources\ChatRoomMessageCollection;
use App\Http\Resources\ChatRoomResource;
use App\Http\Responses\ApiResponse;
use App\Interfaces\ChatRepositoryInterface;
use App\Models\Book;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatRepository implements ChatRepositoryInterface
{
    public function createChatRoom(Book $book): JsonResponse
    {
        $user = auth()->user();
        if ($user->id !== $book->owner_id) {
            try {
                $room = ChatRoom::firstOrCreate([
                    'buyer_id' => $user->id,
                    'book_id' => $book->id,
                ]);
                return ApiResponse::success(new ChatRoomResource($room), 'room created', 201);
            } catch (\Exception $e) {
                return ApiResponse::error($e->getMessage());
            }
        }
        return ApiResponse::error("can't create chat room for your book");
    }

    public function sendMessage(string $content, ChatRoom $room): JsonResponse
    {
        $user = auth()->user();

        if ($user->id !== $room->book->owner_id && $user->id !== $room->buyer_id) {
            return ApiResponse::error("You are not authorized to send messages in this chat room");
        }
        try {
            $data = [
                'content' => $content,
                'room_id' => $room->id,
                'sender_id' => $user->id,
                // 'buyer_id' => $room->buyer_id,
            ];
           $message= Message::create($data);
            $room->update(['status' => true]);
            $this->sendNotificationToOther($message);
            return ApiResponse::success(null, 'Message sent successfully', 201);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }
    public function getChatRooms(Request $request): ChatRoomCollection
    {
        $user = auth()->user();
        $rooms = ChatRoom::where('buyer_id', $user->id)

            ->orWhereHas('book', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('status', true)
            ->with(['book'=>function ($q){
                $q->withTrashed();
            }])
            ->paginate($request->input('page_size'));
            // dd($rooms);
        return new ChatRoomCollection($rooms);
    }
    public function getChatRoom(ChatRoom $room): JsonResponse
    {
        $user = auth()->user();

        if ($user->id !== $room->book->owner_id && $user->id !== $room->buyer_id) {
            return ApiResponse::error("You are not authorized to enter in this chat room");
        }
        return ApiResponse::success(new ChatRoomResource($room));
    }

    public function getChatRoomMessages(ChatRoom $room): ChatRoomMessageCollection
    {
        $user = auth()->user();
        if ($user->id !== $room->book->owner_id && $user->id !== $room->buyer_id) {
            return ApiResponse::error("You are not authorized to enter in this chat room");
        }
        return new ChatRoomMessageCollection($room->messages);
    }

    private function sendNotificationToOther(Message $message) : void {

        // TODO move this event broadcast to observer
        broadcast(new NewMessageAdd($message))->toOthers();


    }
}
