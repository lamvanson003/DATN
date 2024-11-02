<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DefaultStatus extends Enum
{
    const Active = 1; // Hoạt động
    const Inactive = 0; // Ngưng hoạt động
    const Deleted = 3; // Đã xóa

    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
            self::Deleted => 'Đã xóa
',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
            self::Deleted => 'Đã xóa',
        };
    }
}
