<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    const Inactive = 0;        // Ngưng hoạt động
    const Active = 1;          // Đang hoạt động
    const Pendding = 2;          // Chờ duyệt

    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
            self::Inactive => 'Ngưng hoạt động',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
            default => 'Không xác định',
        };
    }
}
