<?php

namespace App\Http\Requests\Post;

use App\Enums\Post\PostStatus; // Giả sử bạn có enum cho trạng thái bài viết
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class PostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug', // Đảm bảo slug là duy nhất
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:post_categories,id', // Kiểm tra category_id có tồn tại trong bảng post_categories
            'status' => ['required', new Enum(PostStatus::class)], // Sử dụng enum cho trạng thái
            'user_id' => 'required|exists:users,id', // Kiểm tra user_id có tồn tại trong bảng users
            'posted_at' => 'required|datetime-local', // Đảm bảo posted_at là một ngày hợp lệ
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
            'id' => ['required', 'exists:posts,id'], 
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . request()->id, 
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:post_categories,id', 
            'status' => ['required', new Enum(PostStatus::class)], 
            'user_id' => 'required|exists:users,id', 
            'posted_at' => 'required|date', 
        ];
    }
}
