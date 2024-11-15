<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Exception;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Đảm bảo xác thực
    }

    public function index(Request $request)
    {
        $user = Auth::user(); // Lấy người dùng đã xác thực

        if ($request->isMethod('get')) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'fullname' => $user->fullname,
                    'email' => $user->email,
                    'username' => $user->username,
                    'gender' => $user->gender,
                    'phone' => $user->phone,
                    'avatar' => $user->avatar ? url(Storage::url($user->avatar)) : null,
                    'address' => $user->address,
                ]
            ], 200);
        }

        if ($request->isMethod('post') || $request->isMethod('patch')) {
            // Xác định các quy tắc xác thực
            $validator = Validator::make($request->all(), [
                'fullname' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'gender' => 'nullable|string|in:1,2,3',
                'phone' => 'nullable|string|max:15',
                'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp|max:2048',
                'address.street' => 'nullable|string|max:255',
                'address.ward' => 'nullable|string|max:255',
                'address.district' => 'nullable|string|max:255',
                'address.province' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422); // Trả về lỗi xác thực
            }

            try {
                $data = $validator->validated(); // Lấy dữ liệu đã xác thực

                // Cập nhật các trường của người dùng
                if (isset($data['fullname'])) $user->fullname = $data['fullname'];
                if (isset($data['email'])) $user->email = $data['email'];
                if (isset($data['username'])) $user->username = $data['username'];
                if (isset($data['gender'])) $user->gender = $data['gender'];
                if (isset($data['phone'])) $user->phone = $data['phone'];
                if (isset($data['address'])) $user->address = $data['address'];
                if (isset($data['password'])) $user->password = Hash::make($data['password']); // Mã hóa mật khẩu

                if (isset($data['address'])) {
                    // Tạo chuỗi địa chỉ từ các trường con
                    $address = '';

                    if (isset($data['address']['street'])) {
                        $address .= $data['address']['street'] . ', ';
                    }
                    if (isset($data['address']['ward'])) {
                        $address .= $data['address']['ward'] . ', ';
                    }
                    if (isset($data['address']['district'])) {
                        $address .= $data['address']['district'] . ', ';
                    }
                    if (isset($data['address']['province'])) {
                        $address .= $data['address']['province'];
                    }

                    // Lưu chuỗi địa chỉ vào cột address
                    $user->address = rtrim($address, ', '); // Loại bỏ dấu phẩy thừa ở cuối
                }

                // Xử lý tải lên avatar
                if ($request->hasFile('avatar')) {
                    // Xóa avatar cũ nếu có
                    if ($user->avatar) {
                        Storage::disk('public')->delete($user->avatar); // Xóa avatar cũ
                    }

                    // Lưu avatar mới và cập nhật vào mô hình người dùng
                    $avatarPath = $request->file('avatar')->store('images/avatars', 'public');
                    $user->avatar = $avatarPath;
                }

                $user->save(); // Lưu người dùng đã cập nhật

                Log::info('User profile updated successfully', [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'updated_at' => now(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully',
                    'data' => [
                        'fullname' => $user->fullname,
                        'email' => $user->email,
                        'username' => $user->username,
                        'gender' => $user->gender,
                        'phone' => $user->phone,
                        'avatar' => $user->avatar ? url(Storage::url($user->avatar)) : null,
                        'address' => [
                            'street' => $user->street,
                            'ward' => $user->ward,
                            'district' => $user->district,
                            'province' => $user->province,
                        ],                    ]
                ], 200);
            } catch (Exception $e) {
                Log::error('User profile update error', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id,
                    'request_data' => $request->all(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the profile: ' . $e->getMessage(),
                ], 500); // Trả về lỗi tổng quát
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Method not allowed',
        ], 405); // Phản hồi khi phương thức không được phép
    }
}
