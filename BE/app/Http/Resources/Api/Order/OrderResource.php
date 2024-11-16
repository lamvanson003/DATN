<?php

namespace App\Http\Resources\Api\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\Order\OrderStatus;
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
            'created_at' => $this->created_at->format('Y-m-d H:i:s'), 
            'note' => $this->note,
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => OrderStatus::getDescription($this->status),
            'unit' => "Cái",
            'agency' => "Shop CloudLAB",
            'TIN' => 462836,
            'order_details' => $this->order_details->map(function($item) {
                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'sale' => $item->sale,
                    'price' => $item->price,
                    'product_variant' => [
                        'id' => $item->product_variant->id,
                        'storage' => $item->product_variant->storage,
                        'sku' => $item->product_variant->sku,
                        'color' => $item->product_variant->color,
                        'name' => optional($item->product_variant->product)->name,
                    ],
                ];
            })->values(),
        ];
    }
}
