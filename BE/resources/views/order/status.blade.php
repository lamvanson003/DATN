@extends('layout_admin')

@section('title', 'Đơn hàng')

@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">CloudLab.Net</h3>
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
            <div class="d-flex align-items-center">
              <h4 class="card-title">Đơn hàng {{$title}}</h4>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="display table table-hover fix_table">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Admin Xác nhận</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Mã</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Admin Xác nhận</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($order as $item)
                    <tr>
                      <td><a href="{{ route('admin.order.edit', $item->id) }}">{{ $item->code }}</a></td>
                      <td>
                        @if ($item->user)
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
                      <td>
                        @switch($item->status)
                            @case(\App\Enums\Order\OrderStatus::Pending)
                                <span class="badge rounded-pill badge-secondary">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break

                            @case(\App\Enums\Order\OrderStatus::Confirm)
                              <span class="badge rounded-pill badge-primary">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break

                            @case(\App\Enums\Order\OrderStatus::Awaiting)
                              <span class="badge rounded-pill badge-warning">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break   

                            @case(\App\Enums\Order\OrderStatus::InTransit)
                             <span class="badge rounded-pill badge-info">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break 

                            @case(\App\Enums\Order\OrderStatus::Delivered)
                             <span class="badge rounded-pill badge-success">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break 

                            @case(\App\Enums\Order\OrderStatus::Canceled)
                             <span class="badge rounded-pill badge-danger">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break 

                            @case(\App\Enums\Order\OrderStatus::Returned)
                             <span class="badge rounded-pill badge-dark">{{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}</span>
                            @break 

                            @default
                              <span class="badge rounded-pill badge-secondary">Không xác định</span>
                        @endswitch
                      </td>
                      <td>
                        <form action="{{route('admin.order.changeStatus',$item->id)}}" method="post">
                          @csrf
                          <input type="hidden" name="status" value="confirm">
                          <button type="submit" class="btn-icon btn-success btn" data-bs-toggle="modal" >
                            <i class="fa fa-check"></i>
                          </button>
                        </form>
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
@endsection
