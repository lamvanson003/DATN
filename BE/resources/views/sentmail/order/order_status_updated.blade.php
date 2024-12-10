<!DOCTYPE html>
<html>
<head>
    <title>Trạng thái đơn hàng</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #007BFF;
        }
        .header h1 {
            color: #007BFF;
            margin: 0;
        }
        .header p {
            color: #555;
        }
        .order-details, .products {
            margin-top: 20px;
        }
        .order-details h2, .products h2 {
            color: #007BFF;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
        }
        .order-details ul {
            list-style: none;
            padding: 0;
        }
        .order-details ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .products table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .products table th, .products table td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .products table th {
            background-color: #007BFF;
            color: #fff;
        }
        .products table td {
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        .footer p {
            color: #007BFF;
        }
        .highlight {
            background-color: #007BFF;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Xin chào {{ $order->fullname }},</h1>
            <p>Trạng thái đơn hàng của bạn đã được cập nhật.</p>
        </div>
        <div class="order-details">
            <h2>Chi tiết đơn hàng</h2>
            <ul>
                <li><strong>Mã đơn hàng:</strong> {{ $order->code }}</li>
                <li><strong>Trạng thái:</strong> {{ $order->status->description }}</li>
                <li><strong>Địa chỉ:</strong> {{ $order->address }}</li>
                <li><strong>Ghi chú:</strong> {{ $order->note }}</li>
                <li><strong>Tổng đơn hàng: </strong>{{ number_format($order->total_price, 0, ',', '.') }} VND</li>
            </ul>
        </div>
        <div class="products">
            <h2>Sản phẩm đã mua</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->order_details as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->product_variant->product->name }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        @if ($orderDetail->sale > 0)
                            <td>{{ number_format($orderDetail->sale, 0, ',', '.') }}</td>
                        @else{  
                            <td>{{ number_format($orderDetail->price, 0, ',', '.') }}</td>
                        }
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
        </div>
    </div>
</body>
</html>
