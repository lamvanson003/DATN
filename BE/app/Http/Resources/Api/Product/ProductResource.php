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
                'name' => optional($this->category)->name,
            ],
            'brand' => [
                'name' =>  optional($this->brand)->name,
            ],
            'product_variant' => $this->product_variant->groupBy('storage')->map(function($item,$storage) {
                return [
                    'storage' => $storage,
                    'variants' => $item->map(function($item){
                        return[
                            'id' => $item->id,
                            'sku' => $item->sku,
                            'storage' => $item->storage,
                            'sale' => $item->sale,
                            'price' => $item->price,
                            'images' => $item->images,
                            'color' => $item->color,
                            'average_rating' => round(optional($item->comments->first())->average_rating ?? 0 , 2),
                            'total_comments' => $item->comments->first()->total_comments ?? 0,
                        ];
                    })->values()
                ];
            })->values(),
            'product_image_items' => $this->product_image_items->map(function($item){
                return [
                    'id' => $item->id,
                    'name' => $item->name??'chưa có thông tin',
                    'images' => $item->images??'chưa có thông tin',
                ];
            })->values(),
            
        ];
    }
}
