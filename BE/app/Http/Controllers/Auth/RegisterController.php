<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Laravel\Sanctum\PersonalAccessTokenResult;
use Exception;

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

            $existingUser = User::where('email', $data['email'])
            ->orWhere('phone', $data['phone'])
            ->first();

            if ($existingUser) {
                $message = 'Email hoặc số điện thoại đã tồn tại.';
                if ($existingUser->email === $data['email']) {
                    $message = 'Email đã tồn tại.';
                } elseif ($existingUser->phone === $data['phone']) {
                    $message = 'Số điện thoại đã tồn tại.';
                }
                return redirect()->route('register.index')->with('error', $message);
            }
            
            User::create([
                'username' => $data['phone']??$data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'roles' => UserRole::Admin,
                'status' => UserStatus::Pendding,
                'gender' => $data['gender'],
                'password' => bcrypt($data['password']),
            ]);
        return redirect()->route('admin.index')->with('success', 'Đăng ký thành công. Vui lòng chờ Admin DUYỆT ');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
            
    }

}
