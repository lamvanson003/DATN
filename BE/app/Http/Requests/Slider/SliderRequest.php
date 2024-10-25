<?php

namespace App\Http\Requests\Slider;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:255',
            'status' => 'required|integer',
        ];
    }
}
