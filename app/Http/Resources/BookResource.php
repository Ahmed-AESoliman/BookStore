<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'city' => $this->city,
            'town' => $this->town,
            'price' => $this->price . 'EGP',
            'exchangable' => $this->exchangable,
            'negationable' => $this->negationable,
            'state' => $this->state,
            'owner' => [
                'name' => $this->owner->name,
                'phone' => $this->owner->mobile_number,
            ],
            'category' => $this->category?->name,
            // 'sub_category' => $this->subCategory?->name,
            // 'subject' => $this->subject?->name,
            'image' => $this->attachments->pluck('file_path')->toArray()
        ];
    }
}
