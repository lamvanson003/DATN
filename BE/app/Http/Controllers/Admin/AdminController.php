<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $admin = User::getAdmin();
        return view('admin.index',compact(['admin']));
    }

    public function create()
    {
        return view('admin.create', [
            'status' => UserStatus::asSelectArray(),
        ]);
    }
    public function delete($id)
    {
        $admin = User::findorFail($id);
        $admin->status = UserStatus::Inactive;
        return redirect()->back()->with('success','Thực hiện thành công');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validate();

        $data['username'] = $data['phone'] ?? $data['username'];
        $data['roles'] = UserRole::User();
        $data['password'] = bcrypt($data['password']);

        $imagePath = '';
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/avatar'), $fileName);
            $imagePath = '/images/avatar/' . $fileName;
        }

        $data['avatar'] = $imagePath;

        User::create($data);

        return redirect()->route('admin.admin.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function edit($id){
        $admin = User::findOrFail($id);
        $status = UserStatus::asSelectArray();
        return view('admin.edit',compact('admin','status'));
    }
    public function update(UserRequest $request)
    {
        $admin = User::findOrFail($request['id']);
        
        if ($request->hasFile('new_image')) {
            if ($admin->avatar && file_exists(public_path($admin->avatar))) {
                unlink(public_path($admin->avatar));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/avatar'), $newImageName);
            $admin->avatar = 'images/avatar/' . $newImageName;
        }

        $admin->fullname = $request->input('fullname');
        $admin->status = $request->input('status');
        $admin->phone = $request->input('phone');
        $admin->email = $request->input('email');
        $admin->username = $request->input('username')??$request->input('phone');

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        $admin->save();
        return redirect()->route('admin.admin.edit', $admin->id)->with('success', 'Người dùng đã được cập nhật thành công!');
    }
}
