@extends('auth.partial.layout')

@section('title', 'Trang đăng ký')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <form id="register-form" action="{{ route('register.store') }}" method="POST" class="card card-md">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Đăng Ký</h2>
        
                <div class="mb-3">
                    <label class="form-label">Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control required" name="email" placeholder="Email">
                </div>
        
                <div class="mb-3">
                    <label class="form-label">Điện thoại <span style="color: red">*</span></label>
                    <input type="text" class="form-control required" name="phone" placeholder="Số điện thoại">
                </div>
        
                <div class="mb-3">
                    <label class="form-label">Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" class="form-control required" name="password" placeholder="Mật khẩu">
                </div>
        
                <div class="mb-3">
                    <label class="form-label">Xác Nhận Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" class="form-control required" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                </div>
        
                <div class="mb-3">
                    <label class="form-label">Giới tính <span style="color: red">*</span></label>
                    <div>
                        <label>
                            <input type="radio" name="gender" value="1"> Nam
                        </label>
                        <label class="ms-3">
                            <input type="radio" name="gender" value="2"> Nữ
                        </label>
                        <label class="ms-3">
                            <input type="radio" name="gender" value="3" checked> Khác
                        </label>
                    </div>
                </div>

                <span class="register">
                    <a href="{{ route('admin.index')}}">Đăng nhập ngay!</a>
                </span>
        
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
