<?php
namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'category' => [
                'name' => optional($this->category)->name,
            ],
            'brand' => [
                'id' => optional($this->brand)->id,
                'name' => optional($this->brand)->name,
            ],
            'product_variants' => $this->product_variant->map(function ($variant) {
                return [
                    'id' => $variant->id,
                    'sku' => $variant->sku,
                    'images' => $variant->images,
                    'storage' => $variant->storage,
                    'color' => $variant->color,
                    'price' => $variant->price,
                    'sale' => $variant->sale,
                    'percent' => (!is_null($variant->sale) && $variant->sale < $variant->price && $variant->price > 0)
                        ? round((($variant->price - $variant->sale) / $variant->price) * 100)
                        : null,
                    'instock' => $variant->instock,
                    'sold' => $variant->sold,
                    'is_flash_sale' => $variant->is_flash_sale,
                    'average_rating' => round(optional($variant->comments->first())->average_rating ?? 0, 2),
                    'total_comments' => $variant->comments->first()->total_comments ?? 0,
                ];
            })->values(),
            'images' => $this->images,
        ];
    }
}
