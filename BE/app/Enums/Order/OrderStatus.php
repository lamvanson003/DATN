<?php

namespace App\Enums\Brand;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Active = 1; 
    const Inactive = 0; 
    const Deleted = 2; 

    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
            self::Deleted => 'Đã xóa',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
            self::Deleted => 'Đã xóa',
            default => 'Không xác định',
        };
    }
}


