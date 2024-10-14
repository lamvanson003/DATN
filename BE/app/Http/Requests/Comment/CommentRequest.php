<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            'product_variant_id' => 'required|exists:product_variants,id', 
            'user_id' => 'required|exists:users,id', 
            'content' => 'required|string|max:1000', 
            'rating' => 'required|integer|min:1|max:5', 
            'status' => 'required|integer|in:0,1,2,3', 
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
            'content' => 'nullable|string|max:1000', 
            'rating' => 'nullable|integer|min:1|max:5', 
            'status' => 'required|integer|in:0,1,2,3', 
        ];
    }


}
