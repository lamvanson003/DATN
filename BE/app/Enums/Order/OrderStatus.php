<?php
namespace App\Enums\Order;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Pending = 'pending';        // Chờ xử lý
    const Confirm = 'confirm';        // Đã xác nhận
    const Awaiting = 'awaiting'; // Đang chờ vận chuyển
    const InTransit = 'intransit';      // Đang vận chuyển
    const Delivered = 'delivered';      // Đã được giao
    const Canceled = 'canceled';      // Hủy đơn
    const Returned = 'return';      // Trả hàng
    const Deleted = 'deleted';      // Đã xóa
    const Completed = 'completed';      // Đã thanh toán

    public static function asSelectArray(): array
    {
        return [
            self::Pending => 'Chờ xử lý',
            self::Confirm => 'Đã xác nhận',
            self::Awaiting => 'Đang chờ vận chuyển',
            self::InTransit => 'Đang vận chuyển',
            self::Delivered => 'Đã được giao',
            self::Canceled => 'Hủy đơn',
            self::Returned => 'Trả hàng',
            self::Deleted => 'Đã xóa',
            self::Completed => 'Đã thanh toán',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Pending => 'Chờ xử lý',
            self::Confirm => 'Đã xác nhận',
            self::Awaiting => 'Đang chờ vận chuyển',
            self::InTransit => 'Đang vận chuyển',
            self::Delivered => 'Đã được giao',
            self::Canceled => 'Hủy đơn',
            self::Returned => 'Trả hàng',
            self::Deleted => 'Đã xóa',
            self::Completed => 'Đã thanh toán',
            default => 'Không xác định',
        };
    }
}
