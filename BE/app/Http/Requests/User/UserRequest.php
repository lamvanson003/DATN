<?php

namespace App\Http\Requests\User;
use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{

    protected function methodPost()
    {
        return [
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users,phone',
            'fullname' => 'required|string|max:255',
            'gender' => 'required|in:1,2,3',
            'address' => 'required|string|max:255',
            'password' => 'required',
            'avatar' => 'nullable|image|max:2048',
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
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'fullname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:1,2,3',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
