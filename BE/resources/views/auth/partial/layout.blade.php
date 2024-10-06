<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/register.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />
</head>
<body class="border-top-wide d-flex flex-column justify-content-center">
    @if(session('success'))
        <div class="jq-toast-wrap top-right alert-success border-0">
            <div class="jq-toast-single jq-has-icon jq-icon-success " style="text-align: left;/* display: block; */">
                <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 2.6s ease-in;-o-transition: width 2.6s ease-in;transition: width 2.6s ease-in;background-color: #9EC600;"></span>
                <span class="close-jq-toast-single">×</span>
                <h2 class="jq-toast-heading">Thông báo</h2>
                {{ session('success') }}
            </div>
        </div>    
    @endif
    @if(session('error'))
        <div class="jq-toast-wrap top-right alert-success border-0">
            <div class="jq-toast-single jq-has-icon jq-icon-error " style="text-align: left;/* display: block; */">
                <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 2.6s ease-in;-o-transition: width 2.6s ease-in;transition: width 2.6s ease-in;background-color: #c63500;"></span>
                <span class="close-jq-toast-single">×</span>
                <h2 class="jq-toast-heading">Thông báo</h2>
                {{ session('error') }}
            </div>
        </div>
    @endif    
    
    @yield('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successNotification = document.querySelector('.alert-success');
            var errorNotification = document.querySelector('.alert-danger');

            if (successNotification) {
                showToast(successNotification, '.jq-toast-loader', 2600); 
            }

            if (errorNotification) {
                showToast(errorNotification, '.jq-toast-loader', 2600); 
        }});

        function showToast(notification, loaderSelector, duration) {
            const loader = notification.querySelector(loaderSelector);
            notification.style.display = 'block';
        
            
            loader.style.width = '0%';
            setTimeout(() => {
                loader.style.width = '100%';
            }, 10); 
              
            setTimeout(() => {
                notification.style.display = 'none'; 
            }, duration); 
        }
    </script>    
</body>
</html>
