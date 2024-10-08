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
            <form action="{{ route('admin.product_variant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin cấu hình sản phẩm</h3>
                            </div>
                            <div class="row card-body">
                                
                                <div class="col-md-12 col-sm-12 gap-2 d-flex">
                                    <!-- storage -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Dung lượng <span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="storage" placeholder="VD: iphone-13-promax">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 gap-2 d-flex">                                   
                                    <!-- price -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Giá <span style="color: red">*</span>:</label>
                                        <input type="number" required class="form-control" name="price" placeholder="VND">
                                    </div>

                                    <!-- price sale -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Giá khuyến mãi :</label>
                                        <input type="number" required class="form-control" name="sale" placeholder="VND">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 gap-2 d-flex">                                   
                                    <!-- memory -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Gói bảo hành <span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="memory" placeholder="VD: 1năm">
                                    </div>

                                    <!-- instock -->
                                    <div class="mb-3 col-6">
                                        <label class="control-label">Nhập số lượng (cái) :</label>
                                        <input type="number" required class="form-control" name="instock" placeholder="VD: 1">
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
                            <div class="card-header" style="color: red">Chọn màu sắc</div>
                            <div class="card-body p-2">
                                <div class="form-check">
                                    <input class="form-check-input check-all" type="checkbox" name="color[]" value="red" id="colorRed">
                                    <label class="form-check-label" for="colorRed">Đỏ</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input check-all" type="checkbox" name="color[]" value="green" id="colorGreen">
                                    <label class="form-check-label" for="colorGreen">Xanh lá</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input check-all" type="checkbox" name="color[]" value="blue" id="colorBlue">
                                    <label class="form-check-label" for="colorBlue">Xanh dương</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input check-all" type="checkbox" name="color[]" value="yellow" id="colorYellow">
                                    <label class="form-check-label" for="colorYellow">Vàng</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="color[]" value="black" id="colorBlack">
                                    <label class="form-check-label" for="colorBlack">Đen</label>
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
