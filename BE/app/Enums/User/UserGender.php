<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;

final class UserGender extends Enum
{
    const Male = 1;
    const Female = 2;
    const Other = 3;

    public static function asSelectArray(): array
    {
        return [
            self::Male => 'Nam',
            self::Female => 'Nữ',
            self::Other => 'Khác',
            default => 'Không xác định',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Male => 'Nam',
            self::Female => 'Nữ',
            self::Other => 'Khác',
            default => 'Không xác định',
        };
    }
}
