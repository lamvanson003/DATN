<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Enums\User\UserRole;

class UsersloginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('email') && $request->has('password')) {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = Auth::user();

            if ($user->roles === UserRole::Admin) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect_url' => route('admin.dashboard.index'),
                ]);
            } elseif ($user->roles === UserRole::User) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                ]);
            }

            Auth::logout();
            return response()->json(['error' => 'You do not have access.'], 403);
        }


        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }
}
