<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;

final class NotificationType extends Enum
{
    const ORDER = 'order';   
    const VOUCHER = 'voucher'; 

   
    public static function asSelectArray(): array
    {
        return [
            self::ORDER => 'Thông báo đơn hàng',
            self::VOUCHER => 'Thông báo khuyến mãi',
        ];
    }

   
    public static function getDescription($value): string
    {
        return match ($value) {
            self::ORDER => 'Thông báo đơn hàng',
            self::VOUCHER => 'Thông báo khuyến mãi',
            default => 'Không xác định',
        };
    }
}
