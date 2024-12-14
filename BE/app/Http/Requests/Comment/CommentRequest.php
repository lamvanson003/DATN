<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;

class CommentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => 'required|string',
            'product_variant_id' => ['nullable', 'exists:App\Models\ProductVariant,id'],
            'post_id' => ['nullable', 'exists:App\Models\Post,id'],
            'content' => 'required|string',
            'rating' => 'nullable|integer',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
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
            'id' => ['required', 'exists:comments,id'], 
            'product_variant_id' => 'nullable|exists:product_variants,id', 
            'user_id' => 'nullable|exists:users,id', 
            'fullname' => 'nullable', 
            'content' => 'nullable|string|max:1000', 
            'rating' => 'nullable|integer|min:1|max:5', 
            'status' => 'required|integer|in:0,1,2,3', 
        ];
    }


}
