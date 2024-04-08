<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = auth()->user()->id == $this->buyer_id ? $this->book->owner->name : $this->buyer->name;
        return [
            'id' => $this->id,
            'name' => $name,
            'book' => new SingleBookResource($this->book)
        ];
    }
}
