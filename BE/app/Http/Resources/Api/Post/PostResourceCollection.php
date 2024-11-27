<?php
namespace App\Http\Resources\Api\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResourceCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'images' => $this->images,
            'posted_at' => $this->posted_at,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'user' => [
                'fullname' => optional($this->user)->fullname,
            ],
            'categories' => $this->categories->map(function ($item){
                return [
                    'name' => $item->name,
                ];
            })
        ];
    }
}
