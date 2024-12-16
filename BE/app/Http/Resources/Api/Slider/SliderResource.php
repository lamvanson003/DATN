<?php
namespace App\Http\Resources\Api\Slider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'sliderItem' => $this->slider_items->map(function ($item){
                return[
                    'id' => $item->id,
                    'images' => $item->images,
                ];
            })
        ];
    }
}
