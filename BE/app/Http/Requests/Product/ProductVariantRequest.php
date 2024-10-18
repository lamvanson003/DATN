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
            
            // variants
            'variants' => 'required|array',
            'variants.*.storage' => 'required|string',
            'variants.*.color' => 'required|string',
            'variants.*.price' => 'required|integer',
            'variants.*.sale' => 'nullable|integer',
            'variants.*.memory' => 'nullable|string',
            'variants.*.instock' => 'required|integer',
            
            'variants.*.image_color' => 'nullable|array',
            'variants.*.image_color' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
