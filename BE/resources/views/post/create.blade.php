@extends('layout_admin')

@section('title', 'Thêm Bài Viết Mới')

@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
          <h3 class="fw-bold mb-3">Thêm Bài Viết Mới</h3>
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
              <a href="{{ route('admin.post.index') }}">Bài viết</a>
            </li>
            <li class="separator">
              <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
              <a href="#">Thêm bài viết mới</a>
            </li>
          </ul>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h3 class="mb-0 strong text-center">Thông Tin Bài Viết</h3>
                </div>
                <div class="row card-body">

                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">Tiêu đề<span style="color: red">*</span>:</label>
                            <input type="text" required class="form-control" name="title" placeholder="VD: Công nghệ">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">Slug<span style="color: red">*</span>:</label>
                            <input type="text" required class="form-control" name="slug" placeholder="VD: cong-nghe">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">Nội dung<span style="color: red">*</span>:</label>
                            <textarea class="form-control" name="content" rows="5" placeholder="Nội dung bài viết..." required>{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">Thời gian đăng<span style="color: red">*</span>:</label>
                            <input type="datetime-local" required class="form-control" name="posted_at" value="{{ old('posted_at') }}">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="mb-3">
                            <label class="control-label">Người tạo bài viết<span style="color: red">*</span>:</label>
                            <input type="text" class="form-control" name="user_fullname" value="{{ Auth::user()->fullname }}" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card mb-3">
                <div class="card-header">Đăng</div>
                <div class="card-body p-2">
                    <button type="submit" class="btn btn-primary p-1-2" title="Thêm">
                        Thêm
                    </button>
                </div>
            </div>

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
                <div class="card-header">Danh mục</div>
                <div class="card-body p-2">
                    <div class="checkbox-list">
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}"
                            {{ is_array(old('category_id')) && in_array($category->id, old('category_id')) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $category->name }}</label>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>

            <!-- Ảnh đại diện -->
            <div class="card mb-3">
                <div class="card-header">Ảnh đại diện <span style="color: red">*</span></div>
                <div class="card-body p-2">
                    <input required type="file" id="fileInput" name="images" class="d-none" accept="image/*">
                    <div class="image-container" style="cursor: pointer;" onclick="document.getElementById('fileInput').click();">
                        <img id="imagePreview" src="{{ asset('/images/default-image.png') }}" alt="Ảnh đại diện" style="max-width: 100%;">
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

        </div>
    </div>   
</div>

<script>
document.getElementById('fileInput').addEventListener('change', function(event){
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('imagePreview').src = e.target.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>
@endsection
