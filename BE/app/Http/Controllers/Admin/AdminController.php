<?php

namespace App\Http\Controllers\Admin;

use App\Enums\User\UserGender;
use App\Http\Controllers\Controller;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
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
        $admin->delete();
        return redirect()->back()->with('success','Thực hiện thành công');
    }

    public function store(UserRequest $request)
    {   
        $data = $request->validated();
        $baseUrl = url()->to('/');
        $data['username'] = $request['phone'] ?? $request['username'];
        $data['roles'] = UserRole::Admin;
        $data['password'] = bcrypt($request['password']);

        $imagePath = '';
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/avatar'), $fileName);
            $imagePath = $baseUrl.'/images/avatar/' . $fileName;
        }

        $data['avatar'] = $imagePath;
        $data['email'] = $request['email'];
        $data['phone'] = $request['phone'];
        $data['status'] = UserStatus::Pendding;

        User::create($data);

        return redirect()->route('admin.admin.index')->with('success', 'Thêm thành công.');
    }

    public function edit($id){
        $admin = User::findOrFail($id);
        $status = UserStatus::asSelectArray();
        $gender = UserGender::asSelectArray();
        return view('admin.edit',compact('admin','status','gender'));
    }

    public function update(UserRequest $request)
    {
        $data = $request->validated();

        $admin = User::findOrFail($data['id']);

        $baseUrl = url()->to('/');
        if ($request->hasFile('new_image')) {
            if ($admin->avatar && file_exists(public_path($admin->avatar))) {
                unlink(public_path($admin->avatar));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/avatar'), $newImageName);
            $admin->avatar = $baseUrl.'/images/avatar/' . $newImageName;
        }
          
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        }else {
            $data['password'] = $admin->password;
        }

        $admin->update([
            'fullname' => $data['fullname'],
            'status' => $data['status'],
            'phone' => $data['phone'],
            'address' => $data['address']??$admin->address,
            'email' => $data['email'],
            'username' => $data['username']??$request['phone'],
            'password' => $data['password'],
            'avatar' => $admin->avatar,
        ]);

        return redirect()->route('admin.admin.edit', $admin->id)->with('success', 'Cập nhật thành công!');
    }


    public function profile($admin_id){
        $admin = User::findOrFail($admin_id);
        $status = UserStatus::asSelectArray();
        $gender = UserGender::asSelectArray();
        return view('admin.profile',compact('admin','status','gender'));
    }
}