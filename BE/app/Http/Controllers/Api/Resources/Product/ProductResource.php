<?php
namespace App\Http\Controllers\Api\Resources\Product;

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
            'sku' => $this->sku,
            'name' => optional($this->product)->name,
            'category' => optional($this->product->category)->name,
            'brand' => optional($this->product->brand)->name,
            'sale' => $this->sale ?? 'chưa có giá KM',
            'price' => $this->price,            
        ];
    }
}
