<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'short_desc' => $this->short_desc,
            'description' => $this->description,
            'category' => [
                'slug' => optional($this->category)->slug,
                'name' => optional($this->category)->name,
            ],
            'brand' => [
                'slug' =>  optional($this->brand)->slug,
                'name' =>  optional($this->brand)->name,
            ],
            'product_variant' => $this->product_variant->groupBy('storage')->map(function($items, $storage) {
                return [
                    'storage' => $storage,
                    'variants' => $items->map(function($item) {
                        return [
                            'id' => $item->id,
                            'sku' => $item->sku,
                            'sale' => $item->sale,
                            'price' => $item->price,
                            'color' => $item->color,
                            'images' => $item->images,
                            'average_rating' => round(optional($item->comments->first())->average_rating, 2) ?? 'No ratings',
                        ];
                    })
                ];
            }),
            'product_image_items' => $this->product_image_items->map(function($item){
                return [
                    'id' => $item->id,
                    'name' => $item->name??'chưa có thông tin',
                    'images' => $item->images??'chưa có thông tin',
                ];
            }),
        ];
    }
}
