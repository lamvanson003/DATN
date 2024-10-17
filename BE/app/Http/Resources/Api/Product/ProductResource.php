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
                'slug' => optional($this->category)->slug,
                'name' => optional($this->category)->name,
            ],
            'brand' => [
                'slug' =>  optional($this->brand)->slug,
                'name' =>  optional($this->brand)->name,
            ],
            'product_variant' => $this->product_variant->map(function($item) {
                return [
                    'id' => $item->id,
                    'sku' => $item->sku,
                    'storage' => $item->storage,
                    'sale' => $item->sale,
                    'price' => $item->price,
                    'colors' => $item->variantColor->map(function($variantColor) {
                        return [
                            'id' => $variantColor->id,
                            'color' => $variantColor->color->name,
                        ];
                    }),
                    'average_rating' => round(optional($item->comments->first())->average_rating ?? 0 , 2),
                    'total_comments' => $item->comments->first()->total_comments ?? 0,
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
