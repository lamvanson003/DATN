<!DOCTYPE html>
<html>
<head>
    <title>Trạng thái đơn hàng</title>
</head>
<body>
    <h1>Xin chào {{ $order->fullname }},</h1>
    <p>Trạng thái đơn hàng của bạn đã được cập nhật.</p>
    <p><strong>Chi tiết đơn hàng:</strong></p>
    <ul>
        <li><strong>Mã đơn hàng:</strong> {{ $order->code }}</li>
        <li><strong>Trạng thái mới:</strong> {{ $order->status->description }}</li>
        <li><strong>Địa chỉ:</strong> {{ $order->address }}</li>
        <li><strong>Ghi chú:</strong> {{ $order->note }}</li>
    </ul>
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
</body>
</html>
