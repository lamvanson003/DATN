<?php

namespace App\Http\Requests\FlashSale;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class FlashSaleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'selected_variants' => 'required|array', 
            'selected_variants.*' => 'exists:product_variants,id',
            'discount_price' => 'nullable|array',
            'discount_price.*' => 'nullable|numeric|min:0',
            'quantity_limit' => 'nullable|array',
            'quantity_limit.*' => 'nullable|integer|min:1',
            'is_active' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'instock' => 'required|integer',
        ];
    }

    /**
     * Get the validation rules that apply to the PUT request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'discount_price' => 'required|numeric|min:0',
            'quantity_limit' => 'required|integer|min:1|max:127',
            'is_active' => 'required|integer',
        ];
    }

}
