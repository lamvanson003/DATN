@extends('layout_admin')

@section('title', 'Biến thể sản phẩm')

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
                    <a href="{{ route('admin.product.edit',$product_variant->product->id) }}">{{ $product_variant->product->name }}</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.product_item.index',$product_variant->product->id) }}">DS biến thể</a>
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
            <form action="{{ route('admin.product.product_item.update',$product_variant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">   
                <input type="hidden" name="id" value="{{ $product_variant->id }}">   
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin cấu hình sản phẩm</h3>
                            </div>
                            <div class="row card-body">
                                
                                <div class="col-md-12 col-sm-12 gap-2 d-flex">
                                    <!-- sku -->
                                    <div class="mb-3 col-6">  
                                        <label class="control-label">Sku<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" value="{{ $product_variant->sku }}" name="sku" placeholder="VD: NO:130000 " disabled>
                                    </div>
                                    <!-- storage -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Dung lượng <span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" value="{{ $product_variant->storage }}"  name="storage" placeholder="VD: iphone-13-promax">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 gap-2 d-flex">                                   
                                    <!-- price -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Giá <span style="color: red">*</span>:</label>
                                        <input type="text" value="{{ $product_variant->price }}"  required class="form-control" name="price" placeholder="VND">
                                    </div>

                                    <!-- price sale -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Giá khuyến mãi :</label>
                                        <input type="text" value="{{ $product_variant->sale }}" class="form-control" name="sale" placeholder="VND">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 gap-2 d-flex">                                   
                                    <!-- memory -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Gói bảo hành <span style="color: red">*</span>:</label>
                                        <input type="text" value="{{ $product_variant->memory }}"  required class="form-control" name="memory" placeholder="VD: 1năm">
                                    </div>

                                    <!-- instock -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Nhập số lượng (cái) :</label>
                                        <input min="1" max="50" type="number" required class="form-control" value="{{ $product_variant->instock }}"  name="instock" placeholder="VD: 1">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 gap-2 d-flex">                                   
                                    <!-- Sold -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Lượt bán <span style="color: red">*</span>:</label>
                                        <input type="text" value="{{ $product_variant->sold ?? '<span class="badge text-danger">Chưa có lượt mua</span>'}}"  disabled class="form-control" name="sold" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Thêm">
                                    Cập nhật
                                </button>

                                <a class="btn btn-danger p-1-2" href="{{ route('admin.product.product_item.delete',
                                [$product_variant->product->id,$product_variant->id]) }}">
                                   Xóa
                                </a>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option {{ $key == $product_variant->status ? 'selected' : '' }}  value="{{ $key }}">
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
                                <input type="hidden" name="old_image" value="{{ $product_variant->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <img id="imagePreview" 
                                         src="{{ asset($product_variant->images ?? 'images/default-image.png') }}" 
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
                                        imagePreview.src = "{{ asset($product_variant->images ?? 'images/default-image.png') }}";
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
