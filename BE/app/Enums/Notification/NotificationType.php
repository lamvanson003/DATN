<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;

final class NotificationType extends Enum
{
      
    const VOUCHER = 'voucher'; 
    const ORDER = 'order'; 
    const Updated = 'updated'; 

   
    public static function asSelectArray(): array
    {
        return [
            self::VOUCHER => 'Thông báo khuyến mãi',
            self::ORDER => 'Thông báo đơn hàng',
            self::Updated => 'Thông báo cập nhật',
        ];
    }

   
    public static function getDescription($value): string
    {
        return match ($value) {
            self::VOUCHER => 'Thông báo khuyến mãi',
            self::ORDER => 'Thông báo đơn hàng',
            self::Updated => 'Thông báo cập nhật',
            default => 'Không xác định',
        };
    }
}
