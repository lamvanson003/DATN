<?php
namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'images' => $this->images,
            'slug' => $this->slug,

            'category' => [
                'name' => optional($this->product->category)->name,
            ],
            'brand' => [
                'name' =>  optional($this->product->brand)->name,
            ],
            'product_variant' => [
                'name' =>  optional($this->product->brand)->name,
            ]
                      
        ];
    }
}
