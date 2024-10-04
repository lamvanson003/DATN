<?php

namespace App\Http\Requests\Category;
use App\Enums\Category\CategoryStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class CategoryRequest extends BaseRequest
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
            'description' => 'nullable|string',
            'status' => 'required|integer',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }
}
