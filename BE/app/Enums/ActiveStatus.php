<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ActiveStatus extends Enum
{
    const Active = 'active'; // Hoạt động
    const Inactive = 'inactive'; // Ngưng hoạt động

    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Hoạt động',
            self::Inactive => 'Ngưng hoạt động',
        };
    }
}
