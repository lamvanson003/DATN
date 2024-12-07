@extends('layout_admin')

@section('title', 'Thêm Mã Giảm Giá')

@section('content_admin')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
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
                    <a href="{{ route('admin.discount.index') }}">Mã Giảm Giá</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm Mã Giảm Giá</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.discount.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center text-danger">Thông Tin Mã Giảm Giá</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Mã Giảm Giá<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required" name="code" id="code" value="{{ old('code') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Số lượng phiếu giảm giá<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control required" name="amount" id="amount" value="{{ old('amount') }}">
                                        </div>
                                    </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Loại Giảm Giá<span class="text-danger">*</span></label>
                                        <select class="form-select required" name="type" id="discount_type">
                                            @foreach (\App\Enums\Discount\DiscountType::asSelectArray() as $key => $value)
                                                <option value="{{ (int) $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <!-- Input cho giảm giá tiền mặt (VND) -->
                                            <div id="discount_money" class="d-none">
                                                <label class="form-label">@lang('Giá trị giảm') (VND)</label>
                                                <input type="number" class="form-control" name="discount_value" id="discount_value"
                                                    placeholder="VD: 30000" />
                                            </div>

                                            <!-- Input cho giảm giá phần trăm (%) -->
                                            <div id="discount_percent" >
                                                <label class="form-label">@lang('Giá trị giảm') (%)</label>
                                                <input type="number" class="form-control" name="discount_value" id="percent_value"
                                                    placeholder="VD: 5%" />
                                            </div>
                                        </div>
                                    </div>

    
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="date_start" class="form-label">Ngày Bắt Đầu<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control required" name="date_start" id="date_start" value="{{ old('date_start') }}">        
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="date_end" class="form-label">Ngày Kết Thúc<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control required" name="date_end" id="date_end" value="{{ old('date_end') }}">       
                                        </div>
                                    </div>
    
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">Mô Tả</label>
                                            <textarea class="form-control" name="desc" id="desc" rows="3">{{ old('desc') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary w-100 p-1-2" title="Thêm">
                                    Thêm
                                </button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body p-2">
                                    <label for="status" class="form-label">Trạng Thái<span class="text-danger">*</span></label>
                                    <select class="form-select required" name="status" id="status">
                                        @foreach (\App\Enums\Discount\DiscountStatus::asSelectArray() as $key => $value)
                                            <option value="{{ (int) $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@include('discount.scripts.script')
@endsection
