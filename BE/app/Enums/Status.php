<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    const Active = 1; // Hoạt động
    const Inactive = 0; // Ngưng hoạt động

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
