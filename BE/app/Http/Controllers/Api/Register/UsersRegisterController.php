<?php

namespace App\Http\Controllers\Api\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Exception;
use Illuminate\Support\Facades\Log;

class UsersRegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // Mã lỗi 422 cho validation lỗi
        }

        try {
            $data = $validator->validated();

            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'roles' => UserRole::User,
                'status' => UserStatus::Active,
                'password' => Hash::make($data['password']),
            ]);

            Auth::login($user);

            Log::info('User registered successfully', [
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'data' => $user // Trả về dữ liệu người dùng
            ], 200); // Mã thành công 200
        } catch (Exception $e) {
            Log::error('User registration error', [
                'error' => $e->getMessage(),
                'data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'An error occurred: ' . $e->getMessage(),
            ], 500); // Mã lỗi 500 cho lỗi server
        }
    }
}
