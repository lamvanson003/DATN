<?php

namespace App\Enums\Product;

use BenSampo\Enum\Enum;

final class ProductStatus extends Enum
{
    const Active = 1; // Hoạt động
    const Inactive = 0; // Ngưng hoạt động
    const Deleted = 2; // Đã xóa

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
