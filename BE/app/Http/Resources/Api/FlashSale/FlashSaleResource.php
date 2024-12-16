<?php
namespace App\Http\Resources\Api\FlashSale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleResource extends JsonResource
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
        'id' => $this->product_variant->product->id,
        'quantity_limit' => $this->quantity_limit,
        'soldFlashsale' => $this->sold,
        'discount_price' => $this->discount_price,
        'is_active' => $this->is_active,
        'name' => $this->product_variant->product->name,
        'images' => $this->product_variant->product->images,
        'slug' => $this->product_variant->product->slug,
        'category' => [
            'name' => optional($this->product_variant->product->category)->name ?? 'Chưa có thông tin',
        ],
        'start_time' => optional($this->flashSale)->start_time,
        'end_time' => optional($this->flashSale)->end_time,
        'brand' => [
            'name' => optional($this->product_variant->product->brand)->name ?? 'Chưa có thông tin',
        ],
        'product_variant' =>[
            $this->whenLoaded('product_variant', function () {
                return [
                    'id' => optional($this->product_variant)->id,
                    'sku' => optional($this->product_variant)->sku,
                    'storage' => optional($this->product_variant)->storage,
                    'sale' => optional($this->product_variant)->sale,
                    'price' => optional($this->product_variant)->price,
                    'images' => optional($this->product_variant)->images,
                    'color' => optional($this->product_variant)->color,
                    'instock' => optional($this->product_variant)->instock,
                    'is_flash_sale' => optional($this->product_variant)->is_flash_sale,
                    'sold' => optional($this->product_variant)->sold,
                    
                ];
            }),
        ],

        'product_image_items' => $this->product_variant->product->product_image_items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name ?? 'Chưa có thông tin',
                'images' => $item->images ?? 'Chưa có thông tin',
            ];
        })->values(),
    ];
}

}