<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Enums\User\UserRole;
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

        if (Auth::user()->roles === UserRole::Admin) {
            return $next($request);
        }
        return redirect()->route('some.other.route')->with('error', 'Bạn không có quyền truy cập.');
    }

    return redirect()->guest(route('admin.login.index'))->with('error', __('Vui lòng đăng nhập để thực hiện'));
}

}