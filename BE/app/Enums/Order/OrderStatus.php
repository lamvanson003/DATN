<?php
namespace App\Enums\Order;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Pendding = 'pendding';        // Đã đặt hàng
    const Confirm = 'confirm';        // Đã xác nhận
    const Awaiting = 'awaiting'; // Đang chờ vận chuyển
    const InTransit = 'intransit';      // Đang vận chuyển
    const Delivered = 'delivered';      // Đã được giao
    const Canceled = 'canceled';      // Hủy đơn
    const Returned = 'return';      // Trả hàng

    public static function asSelectArray(): array
    {
        return [
            self::Pendding => 'Đã đặt hàng',
            self::Confirm => 'Đã xác nhận',
            self::Awaiting => 'Đang chờ vận chuyển',
            self::InTransit => 'Đang vận chuyển',
            self::Delivered => 'Đã được giao',
            self::Canceled => 'Hủy đơn',
            self::Returned => 'Trả hàng',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Pendding => 'Đã đặt hàng',
            self::Confirm => 'Đã xác nhận',
            self::Awaiting => 'Đang chờ vận chuyển',
            self::InTransit => 'Đang vận chuyển',
            self::Delivered => 'Đã được giao',
            self::Canceled => 'Hủy đơn',
            self::Returned => 'Trả hàng',
            default => 'Không xác định',
        };
    }
}
