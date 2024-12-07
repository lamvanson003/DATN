@extends('layout_admin')
@section('title', 'Đơn hàng')>

@push('libs-css')
<link rel="stylesheet" href="{{ asset('/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/select2/css/select2-bootstrap-5-theme.min.css') }}">
@endpush


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
          <a href="{{ route('admin.order.index') }}">Đơn hàng </a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
              <h4 class="card-title col-md-5">Tất cả đơn hàng</h4>
              <div id="form-action">
                <div class="form-select-lg mb-3 d-flex justify-content-end">
                  <select name="status" id="" class="form-select">
                    @foreach ($status as $key => $value)
                      <option value="{{ $key }}">{{ \App\Enums\Order\OrderStatus::getDescription($key) }}</option>
                    @endforeach
                  </select>
                  <button type="button" class="btn btn-primary" id="basic-addon2" 
                  data-route="{{ route('admin.order.updateIndex') }}">
                    Duyệt
                </button>
                
                </div>
              </div>
            </div>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="fontTable display table table-hover fix_table">
                <thead>
                  <tr>
                    <th >
                    </th>
                    <th>Mã</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày tạo</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $item)
                    <tr>
                      <td >
                        <input id="checkBox" type="checkbox" name="id[]" class="check-item" value="{{ $item->id }}">
                      </td>
                      <td><a href="{{route('admin.order.edit',$item->id)}}">{{ $item->code }}</a></td>
                      <td>
                        @if (isset($item->user))
                          <a href="{{ route('admin.user.edit', $item->user->id) }}">
                              {{ $item->user->fullname }}
                          </a>
                        @else
                            {{ $item->fullname }} 
                        @endif
                      </td> 
                      <td>
                        <span class="red">{{number_format($item->total_price)}}</span>
                      </td>
                      <td>
                        {{$item->created_at}}
                      </td>
                      <td><a href="">{{ $item->paymentMethod->name }}</a></td>
                      <td>
                        @switch($item->status->value)
                            @case(\App\Enums\Order\OrderStatus::Pending)
                                <span class="badge rounded-pill badge-secondary">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break

                            @case(\App\Enums\Order\OrderStatus::Confirm)
                              <span class="badge rounded-pill badge-primary">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break

                            @case(\App\Enums\Order\OrderStatus::Awaiting)
                              <span class="badge rounded-pill badge-warning">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break   

                            @case(\App\Enums\Order\OrderStatus::InTransit)
                             <span class="badge rounded-pill badge-info">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break 

                            @case(\App\Enums\Order\OrderStatus::Delivered)
                             <span class="badge rounded-pill badge-success">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break 

                            @case(\App\Enums\Order\OrderStatus::Canceled)
                             <span class="badge rounded-pill badge-danger">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break 

                            @case(\App\Enums\Order\OrderStatus::Returned)
                             <span class="badge rounded-pill badge-black">{{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}</span>
                            @break 

                            @default
                              <span class="badge rounded-pill badge-secondary">Không xác định</span>
                        @endswitch
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
  </div>
</div>

@push('libs-js')
    <script src="{{ asset('/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/select2/js/i18n/vi.js') }}"></script>
@endpush

@push('custom-js')
@include('order.scripts')
@endpush
@endsection
