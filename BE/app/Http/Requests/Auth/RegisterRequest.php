<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'email' => 'required|email',
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
        ];
    }
}
