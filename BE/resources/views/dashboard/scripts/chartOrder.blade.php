<script src="{{ asset('/admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="{{ asset('/admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script>
    var orderRevenue = document.getElementById("orderRevenue").getContext("2d"),
        userRegistrationChart = document.getElementById("userRegistrationChart").getContext("2d"),
        orderCountChart = document.getElementById("orderCountChart").getContext("2d"),
        doughnutChart = document.getElementById("doughnutChart").getContext("2d");
        bestSale = document.getElementById("bestSale").getContext("2d");
        orderDailyChart = document.getElementById("orderDailyChart").getContext("2d");
        orderYearlyChart = document.getElementById("orderYearlyChart").getContext("2d");

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
                        return Math.round(tooltipItem.yLabel) + " người";
                    },
                },
            },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            callback: function (value) {
                                return Math.round(value) + " người";
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
                    label: "Tổng đơn hàng theo tháng",
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

    new Chart(bestSale, {
        type: "line",
        data: {
            labels: @json($products['labels']),
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
                    data: @json($products['orderData']),
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: "bottom" },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        let bestProducts = @json($products['bestProducts']);
                        let monthIndex = tooltipItem.index;
                        let productName = bestProducts[monthIndex] || "Không xác định";
                        let value = tooltipItem.yLabel;
                        return `${value} đơn - ${productName}`;
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

    new Chart(orderDailyChart, {
        type: "bar",
        data: {
            labels: @json($ordersByWeek['labels']),
            datasets: [
                {
                    label: "Tổng đơn hàng theo tuần",
                    data: @json($ordersByWeek['data']),
                    backgroundColor: [
                        "#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF", "#FF9F40", "#FF5733",
                    ],
                    borderColor: "#ccc",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return Math.round(value);
                        },
                    },
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: { position: "bottom" },
            },
        },
    });

    new Chart(orderYearlyChart, {
        type: "bar",
        data: {
            labels: @json($ordersByYear['yearlyOrders']->pluck('year')),
            datasets: [
                {
                    label: "Tổng đơn hàng theo năm",
                    data: @json($ordersByYear['yearlyOrders']->pluck('total_orders')),
                    backgroundColor: "#59d05d",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: "bottom" },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            callback: function (value) {
                                return Math.round(value) + " đơn";
                            },
                        },
                    },
                ],
            },
        },
    });

</script>
