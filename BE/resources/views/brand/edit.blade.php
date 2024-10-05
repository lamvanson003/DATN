@extends('layout_admin')
@section('title','Chỉnh sửa thương hiệu')
@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
          <h3 class="fw-bold mb-3">DataTables</h3>
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
              <a href="#">Brand</a>
            </li>
            <li class="separator">
              <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.brand.index') }}">DS danh mục</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
              </li>
            <li class="nav-item">
              <a href="#">Chỉnh sửa thương hiệu</a>
            </li>
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Đặt phương thức là PUT để cập nhật -->
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin thương hiệu</h3>
                            </div>
                            <div class="row card-body">
                                <!-- name -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tên thương hiệu:</label>
                                        <input type="text" required class="form-control" name="name" placeholder="Tên thương hiệu" value="{{ $brand->name }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description" class="control-label">Mô tả:</label>
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ $brand->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Cập nhật">
                                    Cập nhật
                                </button>
                            </div>
                        </div>
            
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}" {{ $brand->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body p-2">
                                <input type="file" id="fileInput" name="images" class="d-none" accept="image/*">
                                <input type="hidden" name="images" id="imageUrl" value="{{ $brand->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <img id="imagePreview" src="{{ asset($brand->images) }}" alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>                            
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                function loadFile(event) {
                                    const imagePreview = document.getElementById('imagePreview');
                                    const file = event.target.files[0];
                        
                                    if (file) {
                                        // Kiểm tra kiểu tệp
                                        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                        if (!validTypes.includes(file.type)) {
                                            alert('Vui lòng chọn một tệp hình ảnh hợp lệ (JPG, PNG, GIF).');
                                            return;
                                        }
                        
                                        // Tạo URL blob cho hình ảnh đã chọn
                                        imagePreview.src = URL.createObjectURL(file);
                                    } else {
                                        imagePreview.src = "{{ asset($brand->images) }}"; // Hiển thị lại ảnh cũ nếu không có ảnh mới
                                        document.getElementById('imageUrl').value = '{{ $brand->images }}'; 
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
