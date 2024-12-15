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
          <a href="#">{{ $saleItem->product_variant->product->name }} - {{ $saleItem->product_variant->storage }}</a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="page-body">
    <div class="container-xl">
        <form action="{{ route('admin.flashSale.update', $saleItem->id) }}" method="POST" id="updateForm">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="red">Chỉnh sửa {{ $saleItem->product_variant->product->name }} - {{ $saleItem->product_variant->storage }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 col-sm-12">
                                <div class="mb-3 col-12">
                                    <label class="control-label">Tên sản phẩm:</label>
                                    <input type="text" class="form-control" value="{{ $saleItem->product_variant->product->name }} - {{ $saleItem->product_variant->storage }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 d-flex mb-3">
                                <div class="me-2 flex-grow-1">
                                    <label class="control-label">Giá gốc<span style="color: red">*</span>:</label>
                                    <input required class="form-control" value="{{ number_format($saleItem->product_variant->price, 0, ',', '.') }}" readonly>
                                </div>
                                <div class="flex-grow-1">
                                    <label class="control-label">Giá khuyễn mãi:<span style="color: red">*</span>:</label>
                                    <input type="text" class="required form-control" name="discount_price" id="discount_price" value="{{ number_format($saleItem->discount_price, 0, ',', '.') }}" placeholder="VD: 10.000.000">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 d-flex mb-3">
                                <div class="me-2 flex-grow-1">
                                    <label class="control-label">Số lượng đang có (flash-sale)<span style="color: red">*</span>:</label>
                                    <input type="text" required class="form-control" value="{{ $saleItem->quantity_limit }}" readonly>
                                </div>
                                <div class="flex-grow-1">
                                    <label class="control-label">Số lượng giảm giá:<span style="color: red">*</span>:</label>
                                    <input type="text" class="required form-control" name="quantity_limit" id="quantity_limit" value="{{ $saleItem->quantity_limit }}" placeholder="VD: 5">
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
        
                    <!-- Trạng thái -->
                    <div class="card mb-3">
                        <div class="card-header">Trạng thái</div>
                        <div class="card-body">
                            <select class="form-select" name="is_active">                                
                                @foreach ($status as $key => $value)
                                    <option {{ $saleItem->is_active->value == $key ? 'selected' : '' }} value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>                                
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">Ảnh đại diện</div>
                        <div class="card-body p-2">
                            <div class="image-container" style="cursor: pointer;">
                                <img id="imagePreview" 
                                     src="{{ asset($saleItem->product_variant->images ?? 'images/default-image.png') }}" 
                                     alt="Ảnh đại diện" style="max-width: 100%;">
                            </div>
                        </div>                                                      
                    </div>
                </div>
            </div>

            <script>
                const originalPrice = {{ $saleItem->product_variant->price }};
                const maxQuantity = {{ $saleItem->quantity_limit }};
            
                const discountPriceInput = document.getElementById('discount_price');
                const quantityLimitInput = document.getElementById('quantity_limit');
            
                discountPriceInput.addEventListener('input', function (e) {
                    let value = discountPriceInput.value.replace(/\D/g, '');
            
                    if (parseInt(value) > originalPrice) {
                        value = value.slice(0, -1);
                        alert(`Giá trị giảm giá không được vượt quá giá gốc: ${originalPrice.toLocaleString()}.`);
                    }
            
                    if (value) {
                        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }
                    discountPriceInput.value = value;
                });
            
                quantityLimitInput.addEventListener('input', function (e) {
                    let quantityValue = quantityLimitInput.value.replace(/\D/g, '');
            
                    if (parseInt(quantityValue) > maxQuantity) {
                        quantityValue = quantityValue.slice(0, -1);
                        alert(`Số lượng giảm giá không được vượt quá số lượng tồn kho: ${maxQuantity}.`);
                    }
            
                    if (quantityValue) {
                        quantityValue = quantityValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }
                    quantityLimitInput.value = quantityValue;
                });
            </script>
            
            <script>
                document.getElementById('updateForm').addEventListener('submit', function (e) {
                    const discountPriceInput = document.getElementById('discount_price');
                    discountPriceInput.value = discountPriceInput.value.replace(/\./g, '');
                });
            </script>
        </form>
    </div>
</div>
</div>
@endsection