@extends('layout_admin')
@section('title', 'Dashboard')
@section('content_admin')
@push('libs-css')
<link rel="stylesheet" href="{{ asset('/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/select2/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
@include('dashboard.scripts.chartOrder')

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">CloudLab</h3>
                </div>
                {{-- <div class="ms-md-auto py-2 py-md-0">
          <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
          <a href="#" class="btn btn-primary btn-round">Add Customer</a>
        </div> --}}
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                                <div class="row align-items-center position-relative">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Khách hàng</p>
                                            <h4 class="card-title">{{ $countUser }}</h4>
                                        </div>
                                    </div>
                                    <div class="position-absolute text-end bottom-0">
                                        <a href="{{ route('admin.user.index') }}">Xem</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center position-relative">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Sản phẩm</p>
                                        <h4 class="card-title">{{ $countProduct }}</h4>
                                    </div>
                                </div>

                                <div class="position-absolute text-end bottom-0">
                                    <a href="{{ route('admin.product.index') }}">Xem</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center position-relative">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng đơn hàng</p>
                                        <h4 class="card-title">{{ $countOrder }}</h4>
                                    </div>
                                </div>
                                <div class="position-absolute text-end bottom-0">
                                    <a href="{{ route('admin.order.index') }}">Xem</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Đơn hàng hôm nay</p>
                                        <h4 class="card-title">{{ $countOrderToday }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fa fa-money-bill-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng doanh thu:</p>
                                        <h5 class="card-title">
                                            {{ number_format($getTotalpriceOrder, 0, ',', '.') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Đơn hàng gần đây</div>
                            <div class="card-tools">
                                <div class="dropdown" id="viewAll">
                                    <a href="{{ route('admin.order.index') }}">
                                        Xem tất cả
                                    </a>
                                </div>
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
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="fontTable table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Chọn</th>
                                        <th scope="col">Mã</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col" class="text-center">Thời gian đặt hàng</th>
                                        <th scope="col" class="text-end">Tổng tiền</th>
                                        <th scope="col" class="text-end">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($getOrder->isEmpty())
                                        <tr>
                                            <td colspan="5">No data available in table</td>
                                        </tr>
                                    @else
                                        @foreach ($getOrder as $item)
                                            <tr>
                                                <td >
                                                    <input id="checkBox" type="checkbox" name="id[]" class="check-item" value="{{ $item->id }}">
                                                  </td>
                                                <th scope="row">
                                                    <a href="{{ route('admin.order.edit',$item->id) }}">{{ $item->code }}</a>
                                                </th>
                                                <td class="text-center">{{ $item->fullname }}</td>
                                                <td class="text-center">{{ $item->address }}</td>
                                                <td class="text-center">{{ $item->created_at }}</td>
                                                <td class="text-center">{{ number_format($item->total_price) }}</td>
                                                <td class="text-center">
                                                    <span class="badge rounded-pill badge-primary">
                                                        {{ \App\Enums\Order\OrderStatus::getDescription($item->status->value) }}
                                                    </span>
                                                </td>                                                
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Doanh thu theo tháng</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="orderRevenue"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Lượng đơn hàng theo tháng</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="orderCountChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Lượng người đăng ký theo tháng</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="userRegistrationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">Thống kê sản phẩm</div>
                      </div>
                      <div class="card-body">
                        <div class="chart-container">
                          <canvas id="doughnutChart"></canvas>
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
    @include('dashboard.scripts.chartOrder')
    @include('dashboard.scripts.script')
    @endpush
@endsection
