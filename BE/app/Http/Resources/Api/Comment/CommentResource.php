<?php

namespace App\Http\Resources\Api\Comment;


use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rating' => $this->rating,
            'product_variant_id ' => $this->product_variant_id ,
            'content' => $this->content,
            'fullname' => $this->fullname,
            'images' => json_decode($this->images),
            'created_at' =>$this->created_at->format('d-m-Y') ,
        ];
    }
}