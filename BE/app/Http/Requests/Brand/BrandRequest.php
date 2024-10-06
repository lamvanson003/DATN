<?php

namespace App\Http\Requests\Brand;
use App\Enums\Brand\BrandStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class BrandRequest extends BaseRequest
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
            'slug' => 'nullable|string',
            'status' => 'required|integer',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }

    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'id' => ['required','exists:brands,id'],
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'required|integer',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
