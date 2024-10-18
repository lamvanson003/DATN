<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            // product
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|integer',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            // image_items
            'image_items' => 'nullable|array', 
            'image_items.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', 

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
            'id' => ['required', 'exists:products,id'],
            'name' => 'nullable|string|max:255',
            'slug' => [
                'nullable', 'string', 'max:255',
                Rule::unique('products', 'slug')->ignore($this->id)
            ],
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|integer',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'old_image' => 'nullable|string',
        ];
    }

}
