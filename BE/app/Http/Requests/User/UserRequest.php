<?php

namespace App\Http\Requests\User;
use App\Http\Requests\BaseRequest;
use App\Enums\User\UserGender;
class UserRequest extends BaseRequest
{

    protected function methodPost()
    {
        return [
            'username' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users,phone',
            'fullname' => 'nullable|string',
            'gender' => ['required', 'in:1,2,3'],
            // or 'gender' => 'required|in:1,2,3',
            'address' => 'nullable|string',
            'password' => 'required',
            'avatar' => 'nullable|image',
            'status' => 'nullable|integer',
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
            'id' => ['required', 'exists:users,id'],
            'username' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'fullname' => 'nullable|string',
            'gender' => 'nullable|in:1,2,3',
            'address' => 'nullable|string',
            'password' => 'nullable|string',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'nullable||in:0,1,2',
        ];
    }
}
