@extends('layout_admin')
@section('title','Flash sale')
@section('content_admin')
<style>
    .table th {
    background-color: #f8f9fa;
    text-align: center;
    }

    .table td {
        text-align: center;
    }

    .table input {
        margin-top: 5px;
    }
    .table input:focus-visible{
        color: red
    }

    .table input[type="checkbox"] {
        margin-top: 10px;
    }
    .flashsale .card-header{
        background-color: #161b2c;
    }
    .flashsale .card-header> label{
        color: #ffffff !important;
    }

    .table-responsive table {
        width: 100%;
        table-layout: fixed; 
    }

    .table-responsive th, 
    .table-responsive td {
        text-align: center; 
        vertical-align: middle; 
        font-size: 12px
    }

    .table-responsive input.form-control {
        width: 100%; 
        padding: 5px; 
        box-sizing: border-box; 
        font-size: 12px
    }

    .table-responsive .form-control[disabled] {
        background-color: #f5f5f5; 
        color: #333; 
    }
    .fix-checkbox{
        width: 30px !important
    }
    .fix-image {
        width: 50px; 
        height: 50px; 
        object-fit: cover; 
    }

</style>
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
                <a href="{{ route('admin.flashSale.index') }}">DS Flash sale</a>
            </li>
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.flashSale.store')}}" method="POST" >
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Thêm Flash sale  <i class="fas fa-bolt text-danger"></i></h3>
                            </div>
                            <div class="lashsale">
                                <!-- Chọn biến thể sản phẩm và giá giảm -->
                                    <div class="card-header">
                                        <label for="product_variants">Biến thể sản phẩm:</label>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table id="add-row" class="fontTable display table table-hover fix_table">
                                              <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Tên</th>
                                                    <th>Biến thể</th>
                                                    <th>Giá gốc</th>
                                                    <th class="text-danger">Giá giảm</th>
                                                    <th>Số lượng</th>
                                                    <th class="fix-checkbox"></th>
                                                </tr>
                                              </thead>
                                                <tbody>
                                                    @foreach ($productVariants as $variant)
                                                        <tr>
                                                            <td><img class="fix-image" src="{{ $variant->images }}" alt=""></td>
                                                            <td>
                                                                <a href="{{ route('admin.product.edit',
                                                                $variant->product->id) }}">
                                                                {{ $variant->product->name }}
                                                                <span class="d-none">{{ $variant->product->category->name }}</span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.product.product_item.edit',[
                                                                $variant->product->id,$variant->id]) }}">
                                                                {{ $variant->sku }} - {{ $variant->color }}
                                                                </a>
                                                                ({{ $variant->storage }})
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"  
                                                                name="price"
                                                                disabled
                                                                value="{{ number_format($variant->price, 0, ',', '.') }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control formatPrice" 
                                                                    name="discount_price[{{ $variant->id }}]" placeholder="Giảm giá">

                                                            </td>
                                                            <td>
                                                                <span class="text-left">
                                                                    Còn lại: {{ $variant->instock }}
                                                                    <input type="hidden" name="instock" value="{{ $variant->instock }}">
                                                                </span>
                                                                <input class="form-control" type="number" value="1" name="quantity_limit[{{ $variant->id }}]" placeholder="VD:1">
                                                            </td>                                                            
                                                            <td class="fix-checkbox">
                                                                <input class="checkbox" type="checkbox" name="selected_variants[]" value="{{ $variant->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                              
                                            </table>
                                          </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" id="submitButton" class="btn btn-primary p-1-2" title="Thêm">
                                    Thêm
                                </button>
                            </div>
                        </div>

                        <!-- Trạng thái -->
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body">
                                <select class="form-select" name="is_active">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                        </div>

                        <!-- Thời gian bắt đầu -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-calendar-minus pr-1"></i>
                                Ngày-Giờ bắt đầu</div>
                            <div class="card-body">
                                <input type="datetime-local" class="form-control required" name="start_time" id="" >                            
                            </div>
                        </div>

                        <!-- Thời gian kết thúc -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-calendar-minus pr-1"></i>
                                Ngày-Giờ kết thúc</div>
                            <div class="card-body">
                                <input type="datetime-local" class="form-control required" name="end_time" id="" >                            
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>    
        </div>
    </div>   
</div>

@endsection
