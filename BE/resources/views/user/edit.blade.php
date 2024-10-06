@extends('layout_admin')
@section('title','Khách hàng')
@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
          <h3 class="fw-bold mb-3">CloudLab</h3>
          <ul class="breadcrumbs mb-3">
            <li class="nav-home">
              <a href="{{ route('admin.dashboard.index') }}">
                <i class="icon-home"></i>
              </a>
            </li>
            <li class="separator">
              <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.user.index') }}">DS khách hàng</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
              </li>
            <li class="nav-item">
              <a href="#">Sửa thông tin</a>
            </li>
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin khách hàng</h3>
                            </div>
                            <div class="row card-body">
                                <!-- fullname -->
                                <div class="col-md-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-6 ">
                                        <label class="control-label">Tên khách hàng<span class="required_feild">*</span>:</label>
                                        <input type="text" required class="form-control" value="{{ $user->fullname }}" name="fullname" placeholder="Tên khách hàng">
                                    </div>
                                {{-- Email --}}
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Email<span class="required_feild">*</span>:</label>
                                        <input type="email" required class="form-control" value="{{ $user->email }}" name="email" placeholder="Nhập Email">
                                    </div>
                                </div>
                                {{-- Phone --}}
                                <div class="col-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-6">
                                        <label for="phone" class="control-label">Số điện thoại<span class="required_feild">*</span>:</label>
                                        <input class="form-control" type="number" id="phone" value="{{ $user->phone }}" name="phone" placeholder="Số điện thoại"></input>
                                    </div>
                                {{-- Username --}}
                                    <div class="mb-3 col-6">
                                        <label for="username" class="control-label">Tên đăng nhập:</label>
                                        <input class="form-control" type="text" id="username" value="{{ $user->username }}" name="username" placeholder="Tên đăng nhập"></input>
                                    </div>
                                                                      
                                </div>
                                {{-- password --}}
                                <div class="col-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-6">
                                        <label for="password" class="control-label" >Mật khẩu <span class="required_feild">*</span>:</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập Mật khẩu"></input>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="password_confirmation" class="control-label">Xác nhận mật khẩu <span class="required_feild">*</span>:</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập Mật khẩu"></input>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-6">
                                        <label for="gender" class="form-label">Giới tính:</label>
                                        <select name="gender" id="gender" class="form-select">
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                            <option value="3">Khác</option>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-4">
                                        <label for="tinhthanh" class="control-label">Tỉnh/Thành phố:</label>
                                        <select id="tinhthanh" class="form-select p-2">
                                            <option value="">--Chọn Tỉnh/Thành phố--</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="huyen" class="control-label">Huyện/Quận::</label>
                                        <select id="huyen" class="form-select">
                                            <option value="">--Chọn Huyện/Quận--</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="xa" class="control-label">Phường/Xã:</label>
                                        <select id="xa" class="form-select">
                                            <option value="">--Chọn Phường/Xã--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Sửa">
                                    Sửa
                                </button>
                            </div>
                        </div>
            
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option {{ $key == $user->status->value ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body p-2">
                                <!-- Input ẩn để chọn file -->
                                <input type="file" id="fileInput" name="new_image" class="d-none" accept="image/*">
                                <!-- Input ẩn để lưu URL hình ảnh ban đầu -->
                                <input type="hidden" name="old_image" value="{{ $user->avatar }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <!-- Hình ảnh đại diện ban đầu -->
                                    <img id="imagePreview" 
                                         src="{{ asset($user->avatar ?? 'images/default-image.png') }}" 
                                         alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>                                                      
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                function loadFile(event) {
                                    const imagePreview = document.getElementById('imagePreview');
                                    const file = event.target.files[0];
                                    
                                    if (file) {
                                        imagePreview.src = URL.createObjectURL(file);
                                    } else {
                                        imagePreview.src = "{{ asset($user->avatar ?? 'images/default-image.png') }}";
                                    }
                                }
                                document.querySelector('.image-container').addEventListener('click', function() {
                                    document.getElementById('fileInput').click();
                                });
                            
                                document.getElementById('fileInput').addEventListener('change', loadFile);
                            });
                       </script>
                    </div>                    
                </div>
            </form>    
        </div>
    </div>   
</div>
@endsection