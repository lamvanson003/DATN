@extends('layout_admin')

@section('title', 'Sản phẩm')

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
                    <a href="{{ route('admin.product.index') }}">Sản phẩm</a>
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
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Chỉnh sửa sản phẩm</h3>
                            </div>
                            <div class="row card-body">
                                <!-- Name -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tên sản phẩm<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control text-capitalize" name="name" value="{{ $product->name }}" placeholder="VD: Iphone 13 Pro Max">
                                    </div>
                                </div>
                                
                                <!-- Slug -->
                                <div class="col-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đường dẫn<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control text-capitalize" name="slug" value="{{ $product->slug }}" placeholder="VD: iphone-13-promax">
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="col-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Mô tả ngắn:</label>
                                        <input type="text" class="form-control" name="short_desc" value="{{ $product->short_desc }}" placeholder="Mô tả ngắn về sản phẩm">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Mô tả chi tiết:</label>
                                        <textarea class="form-control" name="description" rows="4" placeholder="Mô tả chi tiết về sản phẩm">{{ $product->description }}</textarea>
                                    </div>
                                </div>

                                <!-- Category ID -->
                                <div class="col-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Danh mục<span style="color: red">*</span>:</label>
                                        <select class="form-select" name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Brand ID -->
                                <div class="col-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Thương hiệu<span style="color: red">*</span>:</label>
                                        <select class="form-select" name="brand_id" required>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 gap-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Sửa">
                                    Sửa
                                </button>
                                <button type="button" class="btn btn-danger p-1-2" title="Xóa" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                    Xóa
                                </button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option {{ $key == $product->status ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body p-2">
                                <input type="file" id="fileInput" name="new_image" class="d-none" accept="image/*">
                                <input type="hidden" name="old_image" value="{{ $product->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <img id="imagePreview" src="{{ asset($product->images ?? 'images/default-image.png') }}" alt="Ảnh đại diện" style="max-width: 100%;">
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
                                        imagePreview.src = "{{ asset($product->images ?? 'images/default-image.png') }}";
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

<div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa sản phẩm này không?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

@endsection
