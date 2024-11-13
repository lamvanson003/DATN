@extends('auth.partial.layout')

@section('title', 'Trang đăng nhập')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <img src="{{ asset('admin/assets/img/blogpost.jpg') }}" class="custom_avatar" width="200" alt="Logo">
        </div>
        <form action="{{ route('admin.login') }}" method="POST" class="card card-md">
            <input type="hidden" name="device_token" id="device_token">
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

<!-- Import Firebase SDK dưới dạng module -->
<script type="module">
    // Import Firebase SDKs
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
    import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";
    
    // Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyADoX7jz4ESYSVmYozwKRCyCSiMKgKrQoM",
        authDomain: "app-tmdt-97150.firebaseapp.com",
        projectId: "app-tmdt-97150",
        storageBucket: "app-tmdt-97150.appspot.com",
        messagingSenderId: "925256118208",
        appId: "1:925256118208:web:47e23b8d635065e0b7e225",
        measurementId: "G-BJCL2E7522"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);
    
    // Get device token
    getToken(messaging, { vapidKey: 'BIV6tWvfebfZKSNVZqgpkWY2EzVWbheWq1u0fIMomXhAaXYewyNKMEKWTyhIO7EcqgBiBGbXwLzxVVyblc2-dDQ' }) // Add VAPID Key
        .then((token) => {
            if (token) {
                console.log("Device token:", token);
                document.getElementById('device_token').value = token; // Set token in form input
            } else {
                console.log("No registration token available.");
            }
        })
        .catch((error) => {
            console.error("Error getting device token:", error);
        });
</script>
@endsection
