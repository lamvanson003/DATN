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
                      
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tiêu đề bài viết<span style="color: red">*</span>:</label>
                                        <input type="text" class="required form-control" id="title" name="title" value="{{ $post->title }}" placeholder="Nhập tiêu đề bài viết">
                                    </div>
                                </div>

                      
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đường dẫn (Slug)<span style="color: red">*</span>:</label>
                                        <input type="text" class="required form-control"  id="slug" name="slug" value="{{ $post->slug }}" placeholder="Nhập slug" readonly>
                                    </div>
                                </div>

          
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Nội dung<span style="color: red">*</span>:</label>
                                        <textarea class="required form-control" name="content" rows="5" placeholder="Nhập nội dung bài viết">{{ $post->content }}</textarea>
                                    </div>
                                </div>
                 
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Ngày sửa<span style="color: red">*</span>:</label>
                                        <input type="datetime-local" class="required form-control" name="posted_at" value="{{ $post->posted_at }}" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">

                        <div class="card mb-3">
                            <div class="card-header">Lưu</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Lưu">
                                    Lưu
                                </button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="required form-select" name="status">
                                    @foreach (\App\Enums\Post\PostStatus::asSelectArray() as $key => $value)
                                        <option value="{{ $key }}" {{ $post->status->value == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Nổi bậc</div>
                            <div class="card-body p-2">
                                <label class="form-check form-switch">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" class="form-check-input" 
                                        name="is_featured" value="1" 
                                        data-parsley-multiple="is_featured"
                                        {{ $post->is_featured->value == 1 ? 'checked' : '' }}/>
                                    <span class="form-check-label">Bật bài viết nổi bậc</span>
                                </label>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body p-2">
                                <input type="file" id="fileInput" name="new_image" class="d-none" accept="image/*">
                                <input type="hidden" name="old_image" value="{{ $post->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <img id="imagePreview"
                                        src="{{ asset($post->images ?? 'images/default-image.png') }}"
                                        alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Danh mục <span style="color: red">*</span>:</div>
                            <div class="card-body">
                                <div class="checkbox-list">
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input class=" required form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                            {{ $post->categories && in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
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
    document.addEventListener('DOMContentLoaded', function() {
        function loadFile(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                imagePreview.src = URL.createObjectURL(file);
            } else {
                imagePreview.src = "{{ asset($post->images ?? 'images/default-image.png') }}";
            }
        }

        document.querySelector('.image-container').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', loadFile);
    });
</script>
@endsection
