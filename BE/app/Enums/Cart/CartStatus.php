<?php
namespace App\Enums;

use BenSampo\Enum\Enum;

final class CartStatus extends Enum
{
    const Pending = 'pending';         // Giỏ hàng đang chờ
    const Confirmed = 'confirmed';     // Giỏ hàng đã xác nhận
    const Paid = 'paid';               // Giỏ hàng đã thanh toán
    const Canceled = 'canceled';       // Giỏ hàng đã bị hủy
    const Failed = 'failed';           // Thanh toán thất bại
    const Abandoned = 'abandoned';     // Giỏ hàng bị bỏ dở
    const Completed = 'completed';     // Đơn hàng hoàn tất
    const Returned = 'returned';       // Đơn hàng đã trả hàng

    /**
     * Dùng để trả về mảng cho dropdown hoặc select box
     */
    public static function asSelectArray(): array
    {
        return [
            self::Pending => 'Đang chờ',
            self::Confirmed => 'Đã xác nhận',
            self::Paid => 'Đã thanh toán',
            self::Canceled => 'Đã hủy',
            self::Failed => 'Thanh toán thất bại',
            self::Abandoned => 'Bị bỏ dở',
            self::Completed => 'Hoàn tất',
            self::Returned => 'Đã trả hàng',
        ];
    }

    /**
     * Trả về mô tả tương ứng cho từng giá trị
     */
    public static function getDescription($value): string
    {
        return match ($value) {
            self::Pending => 'Giỏ hàng đang chờ',
            self::Confirmed => 'Giỏ hàng đã xác nhận',
            self::Paid => 'Giỏ hàng đã thanh toán',
            self::Canceled => 'Giỏ hàng đã bị hủy',
            self::Failed => 'Thanh toán thất bại',
            self::Abandoned => 'Giỏ hàng bị bỏ dở',
            self::Completed => 'Đơn hàng hoàn tất',
            self::Returned => 'Đơn hàng đã trả hàng',
            default => 'Trạng thái không xác định',
        };
    }
}
