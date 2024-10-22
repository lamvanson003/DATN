@extends('layout_admin')
@section('title','Thêm Danh Mục Bài Viết')
@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
          <h3 class="fw-bold mb-3">Thêm Danh Mục Bài Viết</h3>
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
              <a href="{{ route('admin.post_category.index') }}">Danh mục bài viết</a>
            </li>
            <li class="separator">
              <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
              <a href="#">Thêm danh mục</a>
            </li>
          </ul>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.post_category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin danh mục bài viết</h3>
                            </div>
                            <div class="row card-body">

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tên danh mục<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="name" placeholder="VD: Công nghệ">
                                    </div>
                                </div>

                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đường dẫn<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="slug" placeholder="VD: cong-nghe">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Mô tả:</label>
                                        <textarea class="form-control" name="description" placeholder="VD: Mọi thông tin về công nghệ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="status">
                                    @foreach ($statuses as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện <span style="color: red">*</span></div>
                            <div class="card-body p-2">
                                <input required type="file" id="fileInput" name="images" class="d-none" accept="image/*">
                                <div class="image-container" style="cursor: pointer;" onclick="document.getElementById('fileInput').click();">
                                    <img id="imagePreview" src="{{ asset('/images/default-image.png') }}" alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Thêm">
                                    Thêm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
    </div>   
</div>

@endsection
