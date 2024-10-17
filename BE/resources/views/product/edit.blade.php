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
                    <a href="#" class="text-capitalize">{{ $product->name }}</a>
                </li>
            </ul>
        </div>
    </div>
       
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin sản phẩm và Thông tin Biến thể</h3>
                            </div>
                            <div class="card-body"> 
                                <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                            Thông tin sản phẩm
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                            Thông tin biến thể
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                        @include('product.form.editProduct')
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                        @include('product.form.editProductVariant')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 d-flex gap-2">
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
                                        <option {{ $key == $product->status ? 'selected' : '' }}  value="{{ $key }}">
                                            {{ $value }}
                                        </option>
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
                                    <img id="imagePreview" 
                                         src="{{ asset($product->images ?? 'images/default-image.png') }}" 
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


@endsection
