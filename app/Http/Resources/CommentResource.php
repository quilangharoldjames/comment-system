<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
          'id' => $this->id,
          'author' => $this->author,
          'body' => $this->body,
          'depth' => $this->depth,
          'replies' => CommentResource::collection($this->replies),
          'parent_id' => $this->parent_id,
          'posted' => $this->created_at->diffForHumans()
        ];
    }
}
