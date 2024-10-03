<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest; 
use App\Enums\User\UserRole;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login'); 
    }

    

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->roles === 1) {
            dd('admin');
            return redirect()->route('admin.dashboard.index');
        } else {
            dd('user');
            Auth::logout();
            return redirect()->back()->withInput()->with('error', 'Bạn không có quyền truy cập.');
        }
    }
    dd('fail');
    return redirect()->back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác.');
}

    
}

