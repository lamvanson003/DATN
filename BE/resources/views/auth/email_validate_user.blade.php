@extends('auth.partial.layout')

@section('title', 'Kiểm tra tài khoản')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <img src="{{ asset('admin/assets/img/kaiadmin/logoSentMail.png') }}" class="custom_avatar mb-3" width="200" alt="Logo">
        </div>
        <form action="{{ route('forgetPassword.checkEmail') }}" method="POST" class="card card-md">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Cập nhật mật khẩu</h2>
                <div class="mb-3">
                    <label class="form-label">Email <span style="color: red">*</span></label>
                    <input 
                        type="email" 
                        class="form-control required" 
                        placeholder="Email" 
                        name="email"
                    >
                </div>

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <span class="register text-primary">
                        Vui lòng nhập vào địa chỉ Email để được hỗ trợ.
                    </span>
                </div>
        
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Gửi</button>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection
