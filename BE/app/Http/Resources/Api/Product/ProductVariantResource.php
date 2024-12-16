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
            'id' => optional($this->product)->id,
            'images' => $this->product->images,
            'name' => $this->product->name,
            'slug' => $this->product->slug,
            'category' => [
                'name' => optional($this->product->category)->name ?? 'Chưa có thông tin',
            ],
            'brand' => [
                'name' => optional($this->product->brand)->name ?? 'Chưa có thông tin',
            ],
            'product_variant' =>
                [
                    [   
                        'storage' => $this->storage,
                        'variants' => [
                            [
                                'id' => $this->id,
                                'sku' => $this->sku,
                                'storage' => $this->storage,
                                'sale' => $this->sale,
                                'price' => $this->price,
                                'images' => $this->images,
                                'color' => $this->color,
                                'instock' => $this->instock,
                                'is_flash_sale' => $this->is_flash_sale,
                                'sold' => $this->sold,
                                'is_flash_sale' => $this->is_flash_sale,
                                'percent' => (!is_null($this->sale) && $this->sale < $this->price && $this->price > 0)
                                        ? round((($this->price - $this->sale) / $this->price) * 100)
                                        : null,
                                'average_rating' => round(optional($this->comments->first())->average_rating ?? 0 , 2),
                                'total_comments' => $this->comments->first()->total_comments ?? 0,
                            ]
                        ]
                    ]
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