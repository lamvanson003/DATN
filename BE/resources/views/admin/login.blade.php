<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />
</head>
<body class="border-top-wide d-flex flex-column justify-content-center">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <img src="{{ asset('admin/assets/img/blogpost.jpg') }}" class="custom_avatar" width="200" alt="Logo">
            </div>
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('admin.login.post') }}" method="POST" class="card card-md">
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
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>