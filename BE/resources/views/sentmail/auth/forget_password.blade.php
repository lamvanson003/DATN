<!DOCTYPE html>
<html>
<head>
    <title>Cập nhật mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .content h1 {
            font-size: 22px;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button {
            background: #e5e7f4;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #a0a7d4;
        }
        .footer {
            font-size: 12px;
            color: #888888;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <img src="{{ asset('admin/assets/img/kaiadmin/logoSentMail.png') }}" alt="Logo">
    </div>
    <div class="content">
        <h1>Xin chào, {{ $user->fullname ?? $user->phone }}</h1>
        <p>Bạn đã yêu cầu cập nhật mật khẩu cho tài khoản của mình.</p>
        <p>Vui lòng nhấp vào liên kết bên dưới để đặt lại mật khẩu:</p>
        <div class="button-container">
            <a href="{{ route('forgetPassword.reset', ['token' => $user->token]) }}" class="button ">
                Đặt lại mật khẩu
            </a>
        </div>
        <p>Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này.</p>
    </div>
    <div class="footer">
        <p>Trân trọng,<br>CloudLab</p>
        <p>Chúng tôi cam kết bảo mật thông tin của bạn.</p>
    </div>
</div>

</body>
</html>
