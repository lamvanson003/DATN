@extends('layout_admin')
@section('title', 'Chỉnh Sửa Danh Mục Bài Viết')
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
                    <a href="{{ route('admin.post_category.index') }}">Danh Mục Bài Viết</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Chỉnh Sửa Danh Mục</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.post_category.update', $postCategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông Tin Danh Mục</h3>
                            </div>
                            <div class="row card-body">
                                <!-- Tên danh mục -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tên danh mục<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="name" value="{{ $postCategory->name }}" placeholder="Nhập tên danh mục">
                                    </div>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đường dẫn (Slug)<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="slug" value="{{ $postCategory->slug }}" placeholder="Nhập slug">
                                    </div>
                                </div>

                                <!-- Ảnh đại diện -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Ảnh đại diện:</label>
                                        <input type="file" class="form-control" name="images" accept="image/*">
                                        @if ($postCategory->images)
                                            <img src="{{ asset('storage/' . $postCategory->images) }}" alt="Ảnh hiện tại" style="max-width: 100%; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <!-- Trạng thái -->
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="status">
                                    @foreach (\App\Enums\PostCategory\PostCategoryStatus::asSelectArray() as $key => $value)
                                        <option value="{{ $key }}" {{ $postCategory->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Button lưu -->
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Lưu">
                                    Lưu
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
