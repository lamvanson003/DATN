<?php
namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
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
            'storage' => $this->storage,
            'id' => $this->id,
            'sku' => $this->sku,
            'storage' => $this->storage,
            'sale' => $this->sale,
            'price' => $this->price,
            'images' => $this->images,
            'color' => $this->color,
            'instock' => $this->instock,
            'sold' => $this->sold,
            'is_flash_sale' => $this->is_flash_sale,
            'percent' => (!is_null($this->sale) && $this->sale < $this->price && $this->price > 0)
                    ? round((($this->price - $this->sale) / $this->price) * 100)
                    : null,
            'average_rating' => round(optional($this->comments->first())->average_rating ?? 0 , 2),
            'total_comments' => $this->comments->first()->total_comments ?? 0,
            
            'product' => [
                'name' => $this->product->name,
                'images' => $this->product->images,
                'slug' => $this->product->slug,
            ],
                   
            'category' => [
               'name' => $this->product->category ? $this->product->category->name : null,
            ],
            'brand' => [
                'name' =>  optional($this->product->brand)->name,
            ],
            'product_image_items' => $this->product->product_image_items->map(function($item){
                return [
                    'id' => $item->id,
                    'name' => $item->name??'chưa có thông tin',
                    'images' => $item->images??'chưa có thông tin',
                ];
            })->values(),
            
        ];
    }
}
