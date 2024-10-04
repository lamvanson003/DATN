<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/admin/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon"/>
    @include('partial.link')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('partial.sidebar')
      <!-- End Sidebar -->
       @include('partial.header') 
       
        @yield('content_admin')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
@include('partial.footer')