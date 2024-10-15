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
            'images' => $this->images,
            'slug' => $this->slug,
            'short_desc' => $this->short_desc,
            'description' => $this->description,

            'brand' => [
                'slug' => optional($this->brand)->slug,
                'name' => optional($this->brand)->name,
            ],
            'category' => [
                'slug' => optional($this->category)->slug,
                'name' => optional($this->category)->name,
            ],

            'product_variant' => $this->product_variant->map(function ($item) {
                return [
                    'id' =>  $item->id,
                    'sku' => $item->sku,
                    'sale' => $item->sale ?? 'chưa có giá KM',
                    'price' => $item->price,
                    'memory' => $item->memory,
                    'instock' => $item->instock,
                    'storage' => $item->storage,

                ];
            }),

            'product_image_items' => $this->product_image_items->map(function ($item) {
                return [
                    'name' => $item->name,
                    'position' => $item->posittion,
                    'images' => $item->images,
                ];
            }),
            'colors' => $this->variantColor->map(function ($variantColor) {
                return [
                    'id' => $variantColor->color->id,
                    'name' => $variantColor->color->name,
                    'images' => $variantColor->color->images,
                ];
            }),

        ];
    }
}
