<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "post_title" => $this->title,
            "post_description" => $this->description,
            "slug" => $this->slug,
            "image" => asset("images/posts/" . $this->image),
            "created_at" => $this->created_at->format('Y-m-d'),
            "updated_at" => $this->updated_at->format('Y-m-d'),
            "created_by" => $this->user_id,
            "owner" => new CreatorResource($this->user)
        ];
    }
}
