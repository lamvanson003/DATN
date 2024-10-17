<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Illuminate\Support\Facades\Log; // Import Log

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
{
    if (Auth::check()) {

        if (Auth::user()->roles === UserRole::Admin && Auth::user()->status->value === UserStatus::Active ) {
            return $next($request);
        }
        return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập.');
    }

    return redirect()->route('admin.index')->with('error', ('Vui lòng đăng nhập để thực hiện'));
}

}
