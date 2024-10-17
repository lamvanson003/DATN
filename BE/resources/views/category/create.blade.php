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
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thêm danh mục</h3>
                            </div>
                            <div class="row card-body">
                                <!-- name -->
                                <div class="col-md-12 col-sm-12 d-flex gap-2">
                                    <div class="mb-3 col-5">
                                        <label class="control-label">Tên danh mục<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="name" placeholder="VD: Điện thoại">
                                    </div>
                                    <div class="mb-3 col-5">
                                        <label class="control-label">Đường dẫn<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="slug"  placeholder="VD: dien-thoai">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description" class="control-label">Mô tả:</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Nhập mô tả">
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
                                    Thêm
                                </button>
                            </div>
                        </div>
            
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện <span style="color: red">*</span></div>
                            <div class="card-body p-2">
                                <input required type="file" id="fileInput" name="images" class="d-none" accept="image/*">
                                <input type="hidden" name="images" id="imageUrl" value="">
                                <div class="image-container" style="cursor: pointer;">
                                    <img id="imagePreview" src="{{  asset('/images/default-image.png')}}" alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </form>    
        </div>
    </div>   
</div>
@endsection