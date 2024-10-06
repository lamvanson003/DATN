<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Illuminate\Support\Facades\Auth; 

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
            $data = $request->validated();
            $data['username'] = $data['phone']??$data['username'];
            $data['email'] = $data['email'];
            $data['phone'] = $data['phone'];
            $data['roles'] = UserRole::Admin();
            $data['status'] = UserStatus::Pendding;
            $data['password'] = bcrypt($data['password']);

            $user = User::create($data);  
            Auth::login($user);
        return redirect()->route('admin.dashboard.index')->with('success', 'Đăng ký thành công');
    }

}
