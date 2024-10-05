<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\User\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if ($user && Hash::check($validatedData['password'], $user->password)) {
            Auth::login($user);
            Log::info('Session data', ['mess' =>  Auth::login($user)]);
            if ($user->roles === UserRole::Admin) {
                $request->session()->regenerate();
                Log::info('Session data', ['mess' => $user]);
                return redirect()->intended(route('admin.dashboard.index'))
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
        return redirect()->route('admin.index')->with('success','Đăng xuất thành công');
    }
}
