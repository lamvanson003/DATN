<?php

namespace App\Http\Requests\Slider;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required|string|max:255|regex:/^[\p{L}\p{N}\s]+$/u',
            'desc' => 'nullable|string|max:255|regex:/^[\p{L}\p{N}\s]+$/u',
            'status' => 'required|integer',
        ];
    }

    protected function methodPut()
    {
        return [
            'name' => 'required|string|max:255|regex:/^[\p{L}\p{N}\s]+$/u',
            'desc' => 'nullable|string|max:255|regex:/^[\p{L}\p{N}\s]+$/u',
            'status' => 'required|integer',
        ];
    }

}
