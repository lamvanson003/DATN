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
        'category' => [
            'name' => optional($this->product->category)->name ?? 'Chưa có thông tin',
        ],
        'brand' => [
            'name' => optional($this->product->brand)->name ?? 'Chưa có thông tin',
        ],
        'product_variant' => [
            'id' => $this->id,
            'sold' => $this->sold,
            'instock' => $this->instock,
            'name' => $this->product->name,
            'images' => $this->product->images,
            'slug' => $this->product->slug,
            'sku' => $this->sku,
            'storage' => $this->storage,
            'sale' => $this->sale,
            'price' => $this->price,
            'images' => $this->images,
            'color' => $this->color,
            'is_flash_sale' => $this->is_flash_sale,
            'flashsale_price' => $this->flashSale->discount_price ?? null,
        ],
        'product_image_items' => $this->product->product_image_items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name ?? 'Chưa có thông tin',
                'images' => $item->images ?? 'Chưa có thông tin',
            ];
        })->values(),
    ];
}
}