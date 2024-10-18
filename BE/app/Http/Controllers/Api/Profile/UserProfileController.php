<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class UserProfileController extends Controller
{
    public function __construct()
    {
        // Apply the auth middleware to all methods in this controller
        $this->middleware('auth:sanctum');
    }

    /**
     * Xử lý cả hiển thị và cập nhật thông tin người dùng
     */
    public function index(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Xử lý GET request: Hiển thị thông tin người dùng
        if ($request->isMethod('get')) {
            return response()->json([
                'success' => true,
                'data' => [
                    'fullname' => $user->fullname,
                    'email' => $user->email,
                    'username' => $user->username,
                    'gender' => $user->gender,
                    'phone' => $user->phone,
                    'avatar' => $user->avatar,
                    'address' => $user->address,
                ]
            ], 200);
        }

        // Xử lý POST/PATCH request: Cập nhật thông tin người dùng
        if ($request->isMethod('post') || $request->isMethod('patch')) {
            $validator = Validator::make($request->all(), [
                'fullname' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'gender' => 'nullable|string|in:1,2,3',
                'phone' => 'nullable|string|max:15',
                'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            try {
                $data = $validator->validated();

                // Cập nhật thông tin cá nhân
                if (isset($data['fullname'])) {
                    $user->fullname = $data['fullname'];
                }

                if (isset($data['email'])) {
                    $user->email = $data['email'];
                }

                if (isset($data['username'])) {
                    $user->username = $data['username'];
                }

                if (isset($data['gender'])) {
                    $user->gender = $data['gender'];
                }

                if (isset($data['phone'])) {
                    $user->phone = $data['phone'];
                }

                if (isset($data['address'])) {
                    $user->address = $data['address'];
                }

                if (isset($data['password'])) {
                    $user->password = Hash::make($data['password']);
                }

                // Xử lý ảnh đại diện (avatar)
                if ($request->hasFile('avatar')) {
                    $avatarPath = $request->file('avatar')->store('avatars', 'public');
                    $user->avatar = $avatarPath;
                }

                $user->save();

                Log::info('User profile updated successfully', [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'updated_at' => now(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully',
                    'data' => $user
                ], 200);
            } catch (Exception $e) {
                Log::error('User profile update error', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred: ' . $e->getMessage(),
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Method not allowed',
        ], 405); // Mã lỗi cho phương thức không hợp lệ
    }
}
