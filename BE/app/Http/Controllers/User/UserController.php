<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Enums\User\UserStatus;
use Exception;
use App\Http\Requests\User\UserRquest;
use App\Models\User;
use App\Enums\User\UserRole;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = User::getUser();
        $status = UserStatus::asSelectArray();
        return view('user.index', compact(
            [
                'user',
                'status'
            ]
        ));
    }

    public function create()
    {
        return view('user.create', [
            'status' => UserStatus::asSelectArray(),
        ]);
    }

    public function store(UserRequest $request)
    {   
        try {
            $imagePath = '';
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/avatar'), $fileName);
                $imagePath = '/images/avatar/' . $fileName;
            }
            User::create([
                'username' => $request->username ?? $request->phone ,
                'roles' =>  UserRole::User(),
                'password' => bcrypt($request['password']),
                'avatar' => $imagePath,
                'email' => $request->email,
                'fullname' => $request->fullname,
                'address' => $request->address,
                'phone' => $request->phone,
                'gender' => $request->gender,
            ]);

            return redirect()->route('admin.user.index')->with('success', 'Người dùng đã được tạo thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
        
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $status = UserStatus::asSelectArray();
        return view('user.edit',compact('user','status'));
    }
    public function update(UserRequest $request)
    {
        $user = User::findOrFail($request['id']);
        
        if ($request->hasFile('new_image')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/avatar'), $newImageName);
            $user->avatar = 'images/avatar/' . $newImageName;
        }

        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username')??$user->username;
        $user->status = $request->input('status');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        return redirect()->route('admin.user.edit', $user->id)->with('success', 'Người dùng đã được cập nhật thành công!');
    }
}
