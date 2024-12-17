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
        // Validate input
        $request->validate([
            'email' => 'required|email', // Email phải hợp lệ
        ]);

        // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Email không tồn tại trong hệ thống.'], 404);
        }

        // Tạo mã OTP ngẫu nhiên
        $otp = rand(100000, 999999);

        // Lưu mã OTP và thời gian hết hạn vào cơ sở dữ liệu
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP có hiệu lực trong 10 phút
        $user->save();

        // Gửi OTP qua email
        $this->sendOtpEmail($user, $otp);

        // Trả về thông báo đã gửi OTP
        return response()->json(['message' => 'Mã OTP đã được gửi đến email của bạn.']);
    }


    public function sendOtpEmail($user, $otp)
    {
        $mailData = [
            'otp' => $otp
        ];

        // Gửi email OTP
        Mail::send([], [], function (Message $message) use ($user, $otp) {
            $message->to($user->email)
                    ->subject('Mã OTP để đặt lại mật khẩu')
                    ->setBody("Mã OTP của bạn là: {$otp}")
                    ->from('trantony030@gmail.com', 'CloudLAB'); // Cấu hình gửi email từ địa chỉ này
        });
    }

    // Verify OTP and reset password
    public function verifyOtpAndResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|integer',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Email không tồn tại trong hệ thống.'], 404);
        }

        // Kiểm tra mã OTP có đúng và chưa hết hạn không
        if ($user->otp !== (int) $request->otp || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['error' => 'Mã OTP không đúng hoặc đã hết hạn.'], 400);
        }

        // Đặt lại mật khẩu
        $user->password = bcrypt($request->new_password);
        $user->otp = null; // Xóa OTP
        $user->otp_expires_at = null; // Xóa thời gian hết hạn OTP
        $user->save();

        return response()->json(['message' => 'Mật khẩu đã được đặt lại thành công.']);
    }

}

