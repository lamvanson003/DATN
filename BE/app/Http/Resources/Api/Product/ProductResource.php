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
            'product_variant' => $this->product_variant->map(function($item) {
                return [
                    'id' => $item->id,
                    'sku' => $item->sku,
                    'storage' => $item->storage,
                    'sale' => $item->sale,
                    'price' => $item->price,
                ];
            }),
        ];
    }
}
