<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class ProductVariantRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'product_id' => 'required|integer',
            'storage' => 'required|string',
            'price' => 'required|integer',
            'sale' => 'nullable|integer',
            'memory' => 'nullable|string',
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
            'id' => ['required', 'exists:product_variants,id'],
            'storage' => 'required|string',
            'price' => 'required|integer',
            'sale' => 'nullable|integer',
            'memory' => 'nullable|string',
            'instock' => 'required|integer',
        ];
    }
}
