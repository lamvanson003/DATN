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
            self::Percent => 'Giảm giá theo phần trăm',
            self::Fixed => 'Giảm giá cố định',
        ];
    }
    public static function getValues(array|string|null $keys = null): array
{
    return array_keys(self::asSelectArray());
}
    public static function getDescription($value): string
    {
        return match ($value) {
            self::Percent => 'Giảm giá theo phần trăm',
            self::Fixed => 'Giảm giá cố định',
            default => 'Không xác định',
        };
    }
}
