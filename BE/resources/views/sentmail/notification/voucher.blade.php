<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
        }
        .header {
            background: #000000;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
        }
        .header p {
            margin: 10px 0 0;
            font-size: 14px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content img {
            max-width: 100%;
            height: auto;
        }
        .content h2 {
            font-size: 24px;
            margin: 20px 0 10px;
        }
        .content p {
            font-size: 16px;
            color: #555555;
            margin: 10px 0 20px;
        }

        a{ 
            color: #ffffff !important
        }
        .button {
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <p>{{  $notification->created_at }}</p>
            <h1>{{  $notification->title }}</h1>
            <p>Điều kiện và điều khoản áp dụng</p>
        </div>
        <div class="content">
            <img src="https://via.placeholder.com/500x300" alt="Product Image">
            <h2>{{ $notification->title }}</h2>
            <p>{{ $notification->message }}</p>
            @if($url)
                <a href="{{ $url }}" class="button">Khám phá ngay</a>
            @endif
        </div>
    </div>
</body>
</html>
