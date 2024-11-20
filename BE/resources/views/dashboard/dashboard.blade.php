@extends('layout_admin')
@section('title', 'Dashboard')
@section('content_admin')

    @include('dashboard.scripts.chartOrder')

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
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
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Visitors</p>
                                        <h4 class="card-title">{{ $countUser }}</h4>
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
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Subscribers</p>
                                        <h4 class="card-title">{{ $countSubcription }}</h4>
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
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Product</p>
                                        <h4 class="card-title">{{ $countProduct }}</h4>
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
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Order</p>
                                        <h4 class="card-title">{{ $countOrder }}</h4>
                                    </div>
                                </div>
                            </div>
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
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">New Customers</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-list py-4">
                                @foreach ($getUser as $item)
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="{{ $item->images ?? 'assets/img/jm_denis.jpg' }}"
                                                alt="{{ $item->fullname }}" class="avatar-img rounded-circle" />
                                        </div>
                                        <div class="info-user ms-3">
                                            <div class="username">{{ $item->fullname }}</div>
                                            <div class="status">{{ $item->email }}</div>
                                        </div>

                                        <a href="{{ route('admin.user.edit', $item->id) }}">View</a>
                                        <button class="btn btn-icon btn-link btn-danger op-8">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Orders History</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
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
                                            <th scope="col">Code</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col" class="text-end">Date & Time</th>
                                            <th scope="col" class="text-end">Amount</th>
                                            <th scope="col" class="text-end">Status</th>
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
                                                    <th scope="row">
                                                        <a href="{{ route('admin.order.edit',$item->id) }}">{{ $item->code }}</a>
                                                    </th>
                                                    <td class="text-center">{{ $item->fullname }}</td>
                                                    <td class="text-end">{{ $item->created_at }}</td>
                                                    <td class="text-end">{{ number_format($item->total_price) }}</td>
                                                    <td class="text-end">
                                                        @switch($item->status)
                                                            @case(\App\Enums\Order\OrderStatus::Pending)
                                                                <span class="badge badge-secondary">
                                                                    {{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}
                                                                </span>
                                                            @break

                                                            @case(\App\Enums\Order\OrderStatus::Completed)
                                                                <span class="badge badge-success">
                                                                    {{ \App\Enums\Order\OrderStatus::getDescription($item->status) }}
                                                                </span>
                                                            @break

                                                            @default
                                                        @endswitch
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
            </div>

        </div>
    </div>
    <script>
        var orderRevenue = document.getElementById("orderRevenue").getContext("2d"),
            userRegistrationChart = document.getElementById("userRegistrationChart").getContext("2d"),
            orderCountChart = document.getElementById("orderCountChart").getContext("2d"),
            doughnutChart = document.getElementById("doughnutChart").getContext("2d");
    
        new Chart(orderRevenue, {
            type: "line",
            data: {
                labels: @json($orderRevenue['labels']),
                datasets: [
                    {
                        label: "Doanh thu",
                        data: @json($orderRevenue['revenueData']),
                        borderColor: "#59d05d",
                        pointBorderColor: "#59d05d",
                        pointBackgroundColor: "#59d05d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        borderWidth: 2,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: "bottom" },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            let value = tooltipItem.yLabel;
                            return value.toLocaleString("vi-VN") + "đ";
                        },
                    },
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                callback: function (value) {
                                    return value.toLocaleString("vi-VN") + "đ";
                                },
                            },
                        },
                    ],
                },
            },
        });

        new Chart(userRegistrationChart, {
            type: "line",
            data: {
                labels: @json($userRegistration['labels']),
                datasets: [
                    {
                        label: "Người dùng",
                        borderColor: "#ff5733",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#ff5733",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        borderWidth: 2,
                        data: @json($userRegistration['userData']),
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: "bottom" },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.yLabel + " người";
                        },
                    },
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                callback: function (value) {
                                    return value + " người";
                                },
                            },
                        },
                    ],
                },
            },
        });

        new Chart(orderCountChart, {
            type: "line",
            data: {
                labels: @json($orderCount['labels']),
                datasets: [
                    {
                        label: "Số lượng đơn hàng",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointRadius: 4,
                        backgroundColor: "transparent",
                        borderWidth: 2,
                        data: @json($orderCount['orderData']),
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: "bottom" },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.yLabel + " đơn";
                        },
                    },
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                callback: function (value) {
                                    return value + " đơn";
                                },
                            },
                        },
                    ],
                },
            },
        });
        
        new Chart(doughnutChart, {
            type: "doughnut",
            data: {
            datasets: [
                {
                data: @json($productCounts['counts']),
                backgroundColor: ["#1d7af3", "#f3545d"],
                },
            ],

            labels: @json($productCounts['labels']),
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: "bottom",
            },
            layout: {
                padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20,
                },
            },
            },
        });
    </script>
@endsection
