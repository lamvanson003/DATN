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
            'sku' => $this->sku,
            'sale' => $this->sale ?? 'chưa có giá KM',
            'price' => $this->price,
            'memory' => $this->memory,
            'instock' => $this->instock,
            'storage' => $this->storage,

            'product' => [
                'id' =>  optional($this->product)->id ,
                'name' =>  optional($this->product)->name ,
                'images' =>  optional($this->product)->images ,
                'slug' =>  optional($this->product)->slug ,
                'short_desc' =>  optional($this->product)->short_desc,
                'description' =>  optional($this->product)->description,
                'status' =>  optional($this->product)->status,

                'brand' => [
                            'name' => optional($this->product->brand)->name,
                        ],
                'category' => [
                            'name' => optional($this->product->category)->name,
                        ],
                'product_image_items' => $this->product->product_image_items->map(function($item) {
                    return [
                        'name' => $item->name,
                        'position' => $item->posittion,
                        'images' => $item->images,
                    ];
                }),
                'colors' => $this->product->variantColor->map(function($variantColor) {
                    return [
                        'id' => $variantColor->color->id,
                        'name' => $variantColor->color->name,
                        'images' => $variantColor->color->images,
                    ];
                }),

            ]
            
        ];
    }
}
