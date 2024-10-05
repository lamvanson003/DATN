@extends('auth.partial.layout')

@section('title', 'Trang đăng nhập')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <img src="{{ asset('admin/assets/img/blogpost.jpg') }}" class="custom_avatar" width="200" alt="Logo">
        </div>
        <form action="{{ route('admin.login') }}" method="POST" class="card card-md">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Đăng nhập</h2>
                <div class="mb-3">
                    <label class="form-label">Email <span style="color: red">*</span></label>
                    <input type="email" required class="form-control" placeholder="Email" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" required class="form-control" placeholder="Mật khẩu" name="password">
                </div>
                <span class="register">
                    <a href="{{ route('register.index')}}">Đăng ký tài khoản</a>
                </span>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
