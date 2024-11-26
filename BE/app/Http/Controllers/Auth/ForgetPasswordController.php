<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;
use Illuminate\Validation\Rules\Exists;

class ForgetPasswordController extends Controller
{
    public $user ; 

    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('auth.email_validate_user');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();

        $user = $this->user->where('email', $data['email'])->first();

        if ($user) {
            $user->token = bin2hex(random_bytes(20));
            $user->save();
            Mail::to($user->email)->send(new ForgetPassword($user));
            return redirect()->back()->with('success', 'Đã gửi email cập nhật mật khẩu');
        } else {
            return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống');
        }
       
    }

    public function reset()
    {
        return view('auth.forget_password');
    }

    public function update(Request $request)
    {   
        $data = $request->all();

        $user = $this->user->where('token', $data['token'])->first();

        $user = $this->user->where('token', $request->token)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['token' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        $user->password = bcrypt($data['password']);
        $user->token = null; 
        $user->save();
        return redirect()->route('admin.index')->with('success', 'Mật khẩu đã được cập nhật thành công!');
    }

}
