@extends('layout_admin')
@section('title','Danh mục')
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
              <a href="{{ route('admin.order.index') }}">DS Đơn hàng</a>
            </li>
            <li class="separator">
              <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
              <a href="#">{{$order->code}}</a>
            </li>
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$order->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            {{-- <div class="card-header justify-content-center"> --}}
                                {{-- <h3 class="mb-0 strong text-center">Chỉnh sửa danh mục</h3> --}}
                            {{-- </div> --}}
                            <div class="row card-body">
                                <!-- name -->
                                <div class="col-md-6 col-12">
                                    <div class="mb-3 ">
                                        <label class="control-label">Mã đơn<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="code" value="{{ $order->code }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">Ngày tạo<span style="color: red">*</span>:</label>
                                        <input type="datetime" required class="form-control" name="created_at" value="{{ $order->created_at }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">Khách hàng<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="fullname" value="{{ $order->fullname }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">Số điện thoại<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="phone" value="{{ $order->phone }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="control-label">Số điện thoại<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="phone" value="{{ $order->phone }}">
                                    </div>
                                </div>

                                <div class="col-12 col-mb-3">
                                        <label class="control-label">Địa chỉ<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="address" value="{{ $order->address }}">
                                </div>

                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
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
                                        <option {{ $key == $order->status ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
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