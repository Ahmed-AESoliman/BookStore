<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "content" => $this->content,
            "buyer_id" => $this->room->buyer_id,
            "seller_id" => $this->room->book->owner_id,
            "time" => $this->created_at->format('d M Y h:i a'),
        ];
    }
}
