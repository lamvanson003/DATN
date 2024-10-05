@extends('auth.partial.layout')

@section('title', 'Trang đăng ký')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <form action="{{ route('register.store') }}" method="POST" class="card card-md">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Đăng Ký</h2>
                <div class="mb-3">
                    <label class="form-label">Email <span style="color: red">*</span></label>
                    <input type="email" required class="form-control" placeholder="Email" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone <span style="color: red">*</span></label>
                    <input type="number" required class="form-control" placeholder="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" required class="form-control" placeholder="Mật khẩu" name="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Xác Nhận Mật khẩu <span style="color: red">*</span></label>
                    <input type="password" required class="form-control" placeholder="Mật khẩu" name="password_confirmation">
                </div>
                <span class="register">
                    <a href="{{ route('admin.index') }}">Đăng nhập</a>
                </span>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
