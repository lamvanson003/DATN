<?php

namespace App\Http\Requests\slider;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class SliderItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'status' => 'required|integer',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            // image_items
            'image_items' => 'nullable|array', 
            'image_items.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
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
