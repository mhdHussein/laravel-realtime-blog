<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'slug' => $this->slug,
            'replies' => ReplyResource::collection($this->replies),
            'reply_count' => $this->replies->count(),
            'path' => $this->path,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => $this->user->name,
            'user_id' => $this->user_id
        ];
    }
}
