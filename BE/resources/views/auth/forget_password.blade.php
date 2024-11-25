@extends('auth.partial.layout')

@section('title', 'Cập nhật mật khẩu')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <form action="{{ route('forgetPassword.update', ) }}" method="POST" class="card card-md" id="login-form">
            @csrf
            <input type="hidden" name="token" value="{{ request()->get('token') }}">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Cập nhật mật khẩu</h2>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới <span style="color: red">*</span></label>
                    <input 
                        type="password" 
                        class="form-control required" 
                        placeholder="Mật khẩu" 
                        name="password"
                        id="password"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu <span style="color: red">*</span></label>
                    <input 
                        type="password" 
                        class="form-control required" 
                        placeholder="Nhập lại mật khẩu" 
                        name="password_confirmation"
                        id="password_confirmation"
                    >
                </div>
        
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Cập nhật ngay</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', function(e) {
        // Lấy giá trị từ 2 ô nhập mật khẩu
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        // Kiểm tra mật khẩu và xác nhận mật khẩu
        if (password === '' || passwordConfirmation === '') {
            e.preventDefault();
            alert('Vui lòng nhập đầy đủ mật khẩu và xác nhận mật khẩu!');
            return;
        }

        if (password !== passwordConfirmation) {
            e.preventDefault();
            alert('Mật khẩu và xác nhận mật khẩu không khớp!');
            return;
        }
    });
</script>
@endsection
