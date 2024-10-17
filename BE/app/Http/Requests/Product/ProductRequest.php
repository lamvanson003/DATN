<?php

namespace App\Http\Requests\Product;

use App\Enums\Product\ProductStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            //product
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|integer',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 

            // color
            'color' => 'required|array',
            'color.*' => 'integer|exists:colors,id',

            // image_items
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'image_items' => 'nullable|array', 
            'image_items*.' => 'string|image|mimes:jpeg,png,jpg,gif|max:2048', 

            // variant

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
            'id' => ['required', 'exists:products,id'],
            'name' => 'nullable|string|max:255',
            'slug' => ['nullable','string','max:255',Rule::unique('products', 'slug')->ignore($this->id)], 
            'short_desc' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_image' => 'nullable|string', 
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'slug' => 'Tên sản phẩm là bắt buộc.',
    //         'slug.required' => 'Slug sản phẩm là bắt buộc.',
    //         'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
    //         'brand_id.required' => 'Thương hiệu sản phẩm là bắt buộc.',
    //         'color_id.required' => 'Màu sắc là bắt buộc.',
    //         'color_id.array' => 'Màu sắc phải là một mảng.',
    //         'color_id.*.integer' => 'Mỗi màu sắc phải là một số nguyên.',
    //         'color_id.*.exists' => 'Màu sắc không tồn tại.',
    //     ];
    // }
}
