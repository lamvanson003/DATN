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
            'username' => 'required|string|max:255|unique:users,username,' ,
            'email' => 'required|string|email|max:255|unique:users,email,' ,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', ['errors' => $validator->errors()]);
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            if (User::where('email', $request->email)->exists()) {
                Log::error('Email already exists:', ['email' => $request->email]);
                return response()->json(['success' => false, 'error' => 'Email already exists'], 409);
            }

            if ($request->phone && User::where('phone', $request->phone)->exists()) {
                Log::error('Phone number already exists:', ['phone' => $request->phone]);
                return response()->json(['success' => false, 'error' => 'Phone number already exists'], 409);
            }

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'roles' => UserRole::User,
                'status' => UserStatus::Active,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);
            Log::info('User registered successfully:', ['user_id' => $user->id]);

            return response()->json(['success' => true, 'data' => $user], 200);

        } catch (Exception $e) {
            Log::error('Registration error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all(),
            ]);
            return response()->json(['success' => false, 'error' => 'An error occurred during registration.'], 500);
        }
    }
}
