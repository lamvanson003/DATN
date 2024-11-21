<?php

namespace App\Http\Requests\Slider;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'desc' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'status' => 'required|integer',
        ];
    }
}
