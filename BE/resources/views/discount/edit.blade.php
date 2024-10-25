@extends('layout_admin')
@section('title', 'Chỉnh sửa mã giảm giá')
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
                    <a href="{{ route('admin.discount.index') }}">Mã giảm giá</a>
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
            <form action="{{ route('admin.discount.update', $discount->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $discount->id }}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3 class="mb-0 strong">Chỉnh sửa mã giảm giá</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Mã<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="code" value="{{ $discount->code }}" placeholder="VD: DISCOUNT2024">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Giá trị giảm<span style="color: red">*</span>:</label>
                                        <input type="number" required class="form-control" name="discount_value" value="{{ $discount->discount_value }}" placeholder="VD: 100">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Ngày bắt đầu<span style="color: red">*</span>:</label>
                                        <input type="date" name="date_start" class="form-control" required 
                                            value="{{ \Carbon\Carbon::createFromFormat('d/m/Y', $discount->date_start)->format('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Ngày kết thúc<span style="color: red">*</span>:</label>
                                        <input type="date" name="date_end" class="form-control" required 
                                            value="{{ \Carbon\Carbon::createFromFormat('d/m/Y', $discount->date_end)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="control-label">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="desc" rows="5" placeholder="Nhập mô tả">{{ $discount->desc }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 text-center">
                                <button type="submit" class="btn btn-primary p-2" title="Cập nhật">Cập nhật</button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                            <select required class="form-select" name="status" id="status">
                            @foreach (\App\Enums\Discount\DiscountStatus::asSelectArray() as $key => $value)
                                <option value="{{ (int) $key }}" {{ $discount->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Loại</div>
                            <div class="card-body p-2">
                            <select required class="form-select" name="type">
                            @foreach (\App\Enums\Discount\DiscountType::asSelectArray() as $key => $value)
                                <option value="{{ (int) $key }}" {{ $discount->type == $key ? 'selected' : '' }}>{{ $value }}</option>
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
@endsection
