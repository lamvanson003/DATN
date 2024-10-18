<?php

namespace App\Http\Requests\PostCategory;

use App\Enums\PostCategory\PostCategoryStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class PostCategoryRequest extends BaseRequest
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
            'slug' => 'required|string|max:255|unique:post_categories,slug', 
            'description' => 'nullable|string',
            'status' => ['required', new Enum(PostCategoryStatus::class)], 
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'id' => ['required', 'exists:post_categories,id'], 
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug,' . request()->id, 
            'description' => 'nullable|string',
            'status' => ['required', new Enum(PostCategoryStatus::class)], 
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
