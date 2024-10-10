<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Illuminate\Support\Facades\Auth; 
use Exception;
use Illuminate\Auth\Events\Validated;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            
            User::create([
                'username' => $data['phone']??$data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'roles' => UserRole::Admin,
                'status' => UserStatus::Pendding,
                'password' => bcrypt($data['password']),
            ]);
        return redirect()->route('admin.index')->with('success', 'Đăng ký thành công. Vui lòng chờ Admin DUYỆT ');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
            
    }

}
