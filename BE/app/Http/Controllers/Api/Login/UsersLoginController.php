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
        try {
            // Kiểm tra xem request có email và password hay không
            if ($request->has('email') && $request->has('password')) {
                $credentials = $request->only('email', 'password');

                // Lấy thông tin người dùng với email đã cung cấp
                $user = User::where('email', $request->email)->first();

                // Nếu người dùng không tồn tại hoặc có quyền admin, từ chối đăng nhập
                if (!$user || $user->roles === UserRole::Admin) {
                    return response()->json(['error' => 'Bạn không có quyền hạn để đăng nhập.'], 403);
                }

                // Thực hiện xác thực với email và password
                if (!Auth::attempt($credentials)) {
                    return response()->json(['error' => 'Sai thông tin đăng nhập.'], 401);
                }

                // Lấy thông tin người dùng đã đăng nhập
                $user = Auth::user();

                // Tạo token
                $token = $user->createToken('API Token')->plainTextToken;

                // Trả về thông tin người dùng và token
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng nhập thành công',
                    'token' => $token,
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

            // Trường hợp thiếu email hoặc password
            return response()->json(['error' => 'Thiếu thông tin đăng nhập.'], 400);

        } catch (\Exception $e) {
            // Ghi log lỗi nếu có ngoại lệ xảy ra
            Log::error('Lỗi đăng nhập: ' . $e->getMessage());
            return response()->json(['error' => 'Lỗi server. Vui lòng thử lại sau.'], 500);
        }
    }

    // Đăng xuất
    public function logout()
    {
        try {
            Auth::logout();
            return response()->json(['message' => 'Đăng xuất thành công']);
        } catch (\Exception $e) {
            Log::error('Lỗi đăng xuất: ' . $e->getMessage());
            return response()->json(['error' => 'Không thể đăng xuất.'], 500);
        }
    }

    // Lấy thông tin người dùng hiện tại
    public function me()
    {
        try {
            $user = Auth::user();
            return response()->json($user);
        } catch (\Exception $e) {
            Log::error('Lỗi lấy thông tin người dùng: ' . $e->getMessage());
            return response()->json(['error' => 'Không thể lấy thông tin người dùng.'], 500);
        }
    }
    public function requestOtp(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', // identifier can be email or phone
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('phone', $request->identifier)
                    ->first();

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy tài khoản với thông tin này.'], 404);
        }

        // Generate a random OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP expires in 10 minutes
        $user->save();

        // Send OTP via email or SMS
        if (filter_var($request->identifier, FILTER_VALIDATE_EMAIL)) {
            // Send OTP via email
            Mail::raw("Mã OTP của bạn là: $otp", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Mã OTP để đặt lại mật khẩu');
            });
        } else {
            // Send OTP via SMS (You would use a third-party service like Twilio here)
            // Example: SMS sending logic
            // SmsService::send($user->phone, "Mã OTP của bạn là: $otp");
        }

        return response()->json(['message' => 'Mã OTP đã được gửi. Vui lòng kiểm tra tin nhắn hoặc email.']);
    }

    // Verify OTP and reset password
    public function verifyOtpAndResetPassword(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', // identifier can be email or phone
            'otp' => 'required|integer',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('phone', $request->identifier)
                    ->first();

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy tài khoản với thông tin này.'], 404);
        }

        // Check if OTP is correct and not expired
        if ($user->otp !== (int) $request->otp || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['error' => 'Mã OTP không đúng hoặc đã hết hạn.'], 400);
        }

        // Reset password
        $user->password = Hash::make($request->new_password);
        $user->otp = null; // Clear the OTP
        $user->otp_expires_at = null; // Clear OTP expiration
        $user->save();

        return response()->json(['message' => 'Mật khẩu đã được đặt lại thành công.']);
    }
}

