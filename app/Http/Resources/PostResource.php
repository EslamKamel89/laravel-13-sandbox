<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        /** @var Post $post */
        $post = $this;
        return [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'published' => $post->published,
            'status' => $post->status->value,
            'metadata' => $post->metadata,
            'user' => [
                'id' => $post->user->id,
                'name' => $post->user->name,
                'email' => $post->user->email,
            ],
            'likedByUsers' => UserResource::collection($this->whenLoaded('likedByUsers')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
