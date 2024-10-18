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
                    <a href="{{ route('admin.product.index') }}">Sản phẩm</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.edit',$product->id) }}">{{ $product->name }}</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm biến thể</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.product.product_item.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">   
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin cấu hình sản phẩm</h3>
                            </div>
                            <div class="row card-body">
                                <div id="variantForms">
                                    <!-- Form biến thể 1 -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Biến thể 1</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12 col-sm-12 d-flex mb-3">
                                                <div class="me-2 flex-grow-1">
                                                    <label for="color1" class="form-label">Màu sắc <span style="color: red">*</span>:</label>
                                                    <input type="text" class="form-control" name="variants[0][color]" id="color1" placeholder="Chọn màu (VD: Xanh)">
                                                </div>
                        
                                                <div class="me-2 flex-grow-1">
                                                    <label for="storage1" class="form-label">Dung lượng <span style="color: red">*</span>:</label>
                                                    <select class="form-select" name="variants[0][storage]" id="storage1" required>
                                                        <option value="" disabled selected>Chọn dung lượng</option>
                                                        @foreach ($storages as $storage)
                                                            <option value="{{ $storage }}">{{ $storage }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                        
                                            </div>
                        
                                            <div class="mb-3">
                                                <label for="image1" class="form-label">Hình theo màu <span style="color: red">*</span>:</label>
                                                <input type="file" class="form-control" name="variants[0][image_color]" id="image1">
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12 d-flex mb-3">
                                                <div class="me-2 flex-grow-1">
                                                    <label for="price1" class="form-label">Giá <span style="color: red">*</span>:</label>
                                                    <input type="number" required class="form-control" name="variants[0][price]" id="price1" placeholder="Nhập giá" min="1000">
                                                </div>
                        
                                                <div class="me-2 flex-grow-1">
                                                    <label for="sale1" class="form-label">Khuyến mãi <span style="color: red">*</span>:</label>
                                                    <input type="number" class="form-control" name="variants[0][sale]" id="sale1" placeholder="Nhập giá khuyến mãi" min="1000">
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12 d-flex mb-3">
                                                <div class="me-2 flex-grow-1">
                                                    <label for="instock" class="form-label">Số lượng <span style="color: red">*</span>:</label>
                                                    <input type="number" required class="form-control" name="variants[0][instock]" id="instock1"  placeholder="Nhập số lượng" min="1">
                                                </div>
                        
                                                <div class="me-2 flex-grow-1">
                                                    <label for="instock" class="form-label">Gói bảo hành: <span style="color: red">*</span>:</label>
                                                    <input type="text" required class="form-control" name="variants[0][memory]" id="memory1"  placeholder="Nhập gói bảo hành">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center mb-4">
                                    <button type="button" class="btn btn-secondary" id="addVariant">Thêm biến thể</button>
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('addVariant').addEventListener('click', function() {
        const variantCount = document.querySelectorAll('#variantForms .card').length; // Đếm số lượng biến thể hiện có
        const variantForm = `
            <div class="card mb-4" id="variant${variantCount}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Biến thể ${variantCount + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeVariant(${variantCount})">Xóa</button>
                </div>
                <div class="card-body">
                    <div class="col-md-12 col-sm-12 d-flex mb-3">
                        <div class="me-2 flex-grow-1">
                            <label for="color${variantCount}" class="form-label">Màu sắc <span style="color: red">*</span>:</label>
                            <input type="text" class="form-control" name="variants[${variantCount}][color]" id="color${variantCount}" placeholder="Chọn màu (VD: Xanh)" required>
                        </div>

                        <div class="me-2 flex-grow-1">
                            <label for="storage${variantCount}" class="form-label">Dung lượng <span style="color: red">*</span>:</label>
                            <select class="form-select" name="variants[${variantCount}][storage]" id="storage${variantCount}" required>
                                <option value="" disabled selected>Chọn dung lượng</option>
                                @foreach ($storages as $storage)
                                    <option value="{{ $storage }}">{{ $storage }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image${variantCount}" class="form-label">Hình theo màu <span style="color: red">*</span>:</label>
                        <input type="file" class="form-control" name="variants[${variantCount}][image_color]" id="image${variantCount}" required>
                    </div>

                    <div class="col-md-12 col-sm-12 d-flex mb-3">
                        <div class="me-2 flex-grow-1">
                            <label for="price${variantCount}" class="form-label">Giá <span style="color: red">*</span>:</label>
                            <input type="number" required class="form-control" name="variants[${variantCount}][price]" id="price${variantCount}" placeholder="Nhập giá" min="1000">
                        </div>

                        <div class="me-2 flex-grow-1">
                            <label for="sale${variantCount}" class="form-label">Khuyến mãi:</label>
                            <input type="number" class="form-control" name="variants[${variantCount}][sale]" id="sale${variantCount}" placeholder="Nhập giá khuyến mãi" min="1000">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 d-flex mb-3">
                        <div class="me-2 flex-grow-1">
                            <label for="instock${variantCount}" class="form-label">Số lượng <span style="color: red">*</span>:</label>
                            <input type="number" class="form-control" required name="variants[${variantCount}][instock]" id="instock${variantCount}" placeholder="Nhập số lượng" min="1">
                        </div>

                        <div class="me-2 flex-grow-1">
                            <label for="memory${variantCount}" class="form-label">Gói bảo hành <span style="color: red">*</span>:</label>
                            <input type="text" class="form-control" required name="variants[${variantCount}][memory]" id="memory${variantCount}" placeholder="Nhập số lượng" min="1">
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('variantForms').insertAdjacentHTML('beforeend', variantForm);
    });

    // Hàm xóa biến thể
    function removeVariant(variantCount) {
        const variantElement = document.getElementById(`variant${variantCount}`);
        if (variantElement) {
            variantElement.remove(); 
        }
    }
</script>
@endsection
