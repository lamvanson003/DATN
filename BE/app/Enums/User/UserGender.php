<?php

namespace App\Enums\User;

enum UserGender: int {

    case Male = 1;
    case Female = 2;
    case Other = 3;

    public static function asSelectArray(): array
    {
        return [
            self::Male => 'Nam',
            self::Female => 'Nữ',
            self::Other => 'Khác',
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
