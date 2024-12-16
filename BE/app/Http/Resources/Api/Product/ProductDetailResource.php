<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Log;

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
            'name' => $this->name,
            'images' => $this->images,
            'slug' => $this->slug,
            'short_desc' => $this->short_desc,
            'description' => $this->description,
            'category' => [
                'slug' => optional($this->category)->slug,
                'name' => optional($this->category)->name,
            ],
            'brand' => [
                'slug' =>  optional($this->brand)->slug,
                'name' =>  optional($this->brand)->name,
            ],
            'product_variant' => $this->product_variant->groupBy('storage')->map(function($items, $storage) {
                return [
                    'storage' => $storage,
                    'variants' => $items->map(function($item) {
                        $flashSale = null;

                        if ($item->is_flash_sale) {
                            $flashSale = SaleItem::where('product_variant_id', $item->id)->first();
                        }

                        return [
                            'id' => $item->id,
                            'is_flash_sale' => $item->is_flash_sale,
                            'flashSale_price' => $flashSale->discount_price ?? null,
                            'start_time' => $flashSale->flashSale->start_time ?? null,
                            'end_time' => $flashSale->flashSale->end_time ?? null,
                            'percent' => (!is_null($flashSale) && $flashSale->discount_price < $item->price && $item->price > 0)
                                ? round((($item->price - $flashSale->discount_price) / $item->price) * 100)
                                : null,
                            'sku' => $item->sku,
                            'sale' => $item->sale,
                            'price' => $item->price,
                            'instock' => $item->instock,
                            'sold' => $item->sold,
                            'soldFlashSale' => $flashSale->sold ?? null,
                            'quantity_limit' => $flashSale->quantity_limit ?? null,
                            'color' => $item->color,
                            'images' => $item->images,
                            'average_rating' => round(optional($item->comments->first())->average_rating, 2) ?? 'No ratings',
                            'comments' => round(optional($item->comments->first())->comments, 2) ?? 'No ratings',
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
            }),
        ];
    }

}