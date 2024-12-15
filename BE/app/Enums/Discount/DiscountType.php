<?php

namespace App\Enums\Discount;

use BenSampo\Enum\Enum;

final class DiscountType extends Enum
{
    const Percent = 1; // Giảm giá theo phần trăm
    const Fixed = 2;   // Giảm giá cố định

    public static function asSelectArray(): array
    {
        return [
            self::Fixed => 'Tiền mặt',
            self::Percent => 'Phần trăm',
        ];
    }
    public static function getValues(array|string|null $keys = null): array
    {
        return array_keys(self::asSelectArray());
    }
    public static function getDescription($value): string
    {
        return match ($value) {
            self::Fixed => 'Tiền mặt',
            self::Percent => 'Phần trăm',
            default => 'Không xác định',
        };
    }
}
