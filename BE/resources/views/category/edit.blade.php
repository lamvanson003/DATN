@extends('layout_admin')
@section('title','Danh mục')
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
              <a href="{{ route('admin.category.index') }}">Danh mục</a>
            </li>
            <li class="separator">
              <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
              <a href="#">Chỉnh sửa</a>
            </li>
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$category->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Chỉnh sửa danh mục</h3>
                            </div>
                            <div class="row card-body">
                                <!-- name -->
                                <div class="col-md-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-5">
                                        <label class="control-label">Tên danh mục<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="name" value="{{ $category->name }}" placeholder="VD: Điện thoại">
                                    </div>
                                    <div class="mb-3 col-5">
                                        <label class="control-label">Đường dẫn<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="slug" value="{{ $category->slug }}" placeholder="VD: dien-thoai">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description" class="control-label">Mô tả:</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Nhập mô tả">
                                            {{ $category->description}}
                                        </textarea>
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
                                        <option {{ $key == $category->status->value ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
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
                                <input type="hidden" name="old_image" value="{{ $category->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <!-- Hình ảnh đại diện ban đầu -->
                                    <img id="imagePreview" 
                                         src="{{ asset($category->images ?? 'images/default-image.png') }}" 
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
                                        // Hiển thị preview hình ảnh mới
                                        imagePreview.src = URL.createObjectURL(file);
                                    } else {
                                        // Hiển thị lại hình ảnh cũ nếu không có file được chọn
                                        imagePreview.src = "{{ asset($category->images ?? 'images/default-image.png') }}";
                                    }
                                }
                            
                                // Khi người dùng click vào image-container thì mở chọn file
                                document.querySelector('.image-container').addEventListener('click', function() {
                                    document.getElementById('fileInput').click();
                                });
                            
                                // Khi file được chọn, thực hiện loadFile để cập nhật preview
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