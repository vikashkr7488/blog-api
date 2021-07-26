<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class PostResource extends JsonResource
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
			'user_id' => $this->user_id,
			'title' => $this->title,
			'description' => $this->description,
			'image' => $this->image,
			'comments' => CommentResource::collection(Comment::where('post_id', $this->id)->get()),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
    }
}
