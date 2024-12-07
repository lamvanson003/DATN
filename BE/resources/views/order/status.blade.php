@extends('layout_admin')

@section('title', 'Đơn hàng')

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
            <div class="d-flex align-items-center">
              <h4 class="card-title">Đơn hàng {{$title}}</h4>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="fontTable display table table-hover fix_table">
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
                        @if ($item->status->value == \App\Enums\Order\OrderStatus::Delivered)
                            
                        @endif
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
                      <td>
                        @if ($item->status->value == \App\Enums\Order\OrderStatus::InTransit)
                            <span>Đang giao</span>
                        @elseif ($item->status->value == \App\Enums\Order\OrderStatus::Canceled)
                            <form action="{{ route('admin.order.delete', $item->id) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </form>
                        @elseif ($item->status->value == \App\Enums\Order\OrderStatus::Returned)
                            <form action="{{ route('admin.order.returnConfirm', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fa fa-check"></i> Xác nhận trả lại
                                </button>
                            </form>
                        @else
                            <form action="{{route('admin.order.changeStatus',$item->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="confirm">
                                <button type="submit" class="btn-icon btn-success btn">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                        @endif
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
