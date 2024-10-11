<?php

namespace App\Http\Requests\Product;

use App\Enums\Product\ProductStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|integer',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'color' => 'required|array',
            'color.*' => 'integer|exists:colors,id'
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_image' => 'nullable|string', 
             'color' => 'required|array',
            'color.*' => 'integer|exists:colors,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'slug' => 'Tên sản phẩm là bắt buộc.',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'slug.required' => 'Slug sản phẩm là bắt buộc.',
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'brand_id.required' => 'Thương hiệu sản phẩm là bắt buộc.',
            'color_id.required' => 'Màu sắc là bắt buộc.',
            'color_id.array' => 'Màu sắc phải là một mảng.',
            'color_id.*.integer' => 'Mỗi màu sắc phải là một số nguyên.',
            'color_id.*.exists' => 'Màu sắc không tồn tại.',
        ];
    }
}
