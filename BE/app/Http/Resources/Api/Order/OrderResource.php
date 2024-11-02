<?php

namespace App\Http\Resources\Api\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'code' => $this->code,
            'created_at' => $this->created_at,
            'description' => $this->description,
            'product_variant' => $this->product_variant->map(function($items) {
                return [
                        'id' => $items->id,
                        'sku' => $items->sku,
                        'sale' => $items->sale,
                        'price' => $items->price,
                        'color' => $items->color,
                        'images' => $items->images,
                    ];
            })->values(),
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
