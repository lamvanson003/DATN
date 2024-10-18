@extends('layout_admin')
@section('title', 'Chỉnh Sửa Bài Viết')
@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Chỉnh Sửa Bài Viết</h3>
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
                    <a href="{{ route('admin.post.index') }}">Bài Viết</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Chỉnh Sửa Bài Viết</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông Tin Bài Viết</h3>
                            </div>
                            <div class="row card-body">
                                <!-- Tiêu đề bài viết -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tiêu đề bài viết<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="title" value="{{ $post->title }}" placeholder="Nhập tiêu đề bài viết">
                                    </div>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đường dẫn (Slug)<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="slug" value="{{ $post->slug }}" placeholder="Nhập slug">
                                    </div>
                                </div>

                                <!-- Nội dung -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Nội dung<span style="color: red">*</span>:</label>
                                        <textarea required class="form-control" name="content" rows="5" placeholder="Nhập nội dung bài viết">{{ $post->content }}</textarea>
                                    </div>
                                </div>

                                <!-- Ảnh đại diện -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Ảnh đại diện:</label>
                                        <input type="file" class="form-control" name="images" accept="image/*">
                                        @if ($post->images)
                                            <img src="{{ asset('storage/' . $post->images) }}" alt="Ảnh hiện tại" style="max-width: 100%; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>

                                <!-- Ngày đăng -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Ngày sửa<span style="color: red">*</span>:</label>
                                        <input type="datetime-local" required class="form-control" name="posted_at" value="{{ $post->posted_at instanceof \Carbon\Carbon ? $post->posted_at->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                </div>

                                <!-- Danh mục -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Danh mục<span style="color: red">*</span>:</label>
                                        <select required class="form-select" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                    @foreach (\App\Enums\Post\PostStatus::asSelectArray() as $key => $value)
                                        <option value="{{ $key }}" {{ $post->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Button lưu -->
                        <div class="card mb-3">
                            <div class="card-header">Lưu</div>
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
