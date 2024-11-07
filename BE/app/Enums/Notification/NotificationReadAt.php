<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;

final class NotificationReadAt extends Enum
{
    const Read = 1;   
    const Pending = 2; 
    const Draft = 3;   

   
    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Xuất bản',
            self::Pending => 'Chờ xuất bản',
            self::Draft => 'Nháp',
        ];
    }

   
    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Xuất bản',
            self::Pending => 'Chờ xuất bản',
            self::Draft => 'Nháp',
            default => 'Không xác định',
        };
    }
}
