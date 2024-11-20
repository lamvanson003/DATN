<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {   
        Log::info('messsss',['mess'=> $request]);
        $validatedData = $request->validated();
        if (Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ])) {
            $user = Auth::user();
            if ($user->roles == UserRole::Admin && $user->status->value === UserStatus::Active) {
                if ($request->has('device_token')) {

                    $user = User::findOrfail($user->id);
                    $user->device_token = $request->input('device_token');
                    $user->save();
                    
                }

                return redirect()->route('admin.dashboard.index')
                    ->with('success', 'Đăng nhập thành công');
            }

            Auth::logout();
            return back()->with('error', 'Bạn không có quyền truy cập.');
        }

        return back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.index')->with('success', 'Đăng xuất thành công');
    }
}
