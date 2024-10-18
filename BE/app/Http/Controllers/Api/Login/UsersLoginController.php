<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Enums\User\UserRole;

class UsersLoginController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra xem request có email và password hay không
        if ($request->has('email') && $request->has('password')) {
            $credentials = $request->only('email', 'password');

            // Thử đăng nhập với email và password
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Lấy thông tin người dùng đã đăng nhập
            $user = Auth::user();

            // Tạo token
            $token = $user->createToken('API Token')->plainTextToken;

            // Kiểm tra quyền của người dùng
            if ($user->roles === UserRole::Admin) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'token' => $token,  // Trả về token
                    'redirect_url' => route('admin.dashboard.index'),
                    'user_data' => [
                        'fullname' => $user->fullname,
                        'email' => $user->email,
                        'username' => $user->username,
                        'gender' => $user->gender,
                        'phone' => $user->phone,
                        'avatar' => $user->avatar,
                        'address' => $user->address,
                    ]
                ]);
            } elseif ($user->roles === UserRole::User) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'token' => $token,  // Trả về token
                    'user_data' => [
                        'fullname' => $user->fullname,
                        'email' => $user->email,
                        'username' => $user->username,
                        'gender' => $user->gender,
                        'phone' => $user->phone,
                        'avatar' => $user->avatar,
                        'address' => $user->address,
                    ]
                ]);
            }

            // Nếu không có quyền phù hợp, đăng xuất người dùng
            Auth::logout();
            return response()->json(['error' => 'You do not have access.'], 403);
        }

        // Nếu không có thông tin đăng nhập trong request
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.',
        ], 401);
    }

    // Hàm logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Hàm me: Lấy thông tin người dùng đã đăng nhập
    public function me()
    {
        return response()->json(Auth::user());
    }
}

