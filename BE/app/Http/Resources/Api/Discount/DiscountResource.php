<?php

namespace App\Http\Resources\Api\Discount;


use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'discount_value' => $this->discount_type == 'percent' 
                ? $this->discount_value . '%' 
                : $this->discount_value, 
            'discount_type' => $this->discount_type,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
        ];
    }
}
