<?php
namespace App\Enums\Discount;

use BenSampo\Enum\Enum;

final class DiscountStatus extends Enum
{
    const Active = 1;          // Đang hoạt động
    const Inactive = 2;      // Không hoạt động
    const Expired = 3;        // Đã hết hạn
    const Used = 4;              // Đã sử dụng
    const Deleted = 5;        // Đã xóa

    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Không hoạt động',
            self::Expired => 'Đã hết hạn',
            self::Used => 'Đã sử dụng',
            self::Deleted => 'Đã xóa',
        ];
    }
    public static function getValues(array|string|null $keys = null): array
{
    return array_keys(self::asSelectArray());
}

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Không hoạt động',
            self::Expired => 'Đã hết hạn',
            self::Used => 'Đã sử dụng',
            self::Deleted => 'Đã xóa',
            default => 'Không xác định',
        };
    }
}
