<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;

final class NotificationReadAt extends Enum
{
    const Read = 2;   
    const Not_Read = 1; 

   
    public static function asSelectArray(): array
    {
        return [
            self::Read => 'Đã đọc',
            self::Not_Read => 'Chưa đọc',
        ];
    }

   
    public static function getDescription($value): string
    {
        return match ($value) {
            self::Read => 'Đã đọc',
            self::Not_Read => 'Chưa đọc',
            default => 'Không xác định',
        };
    }
}
