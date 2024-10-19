<?php

namespace App\Enums\PostCategory;

use BenSampo\Enum\Enum;

final class PostCategoryStatus extends Enum
{
    const Active = 1; // Đang hoạt động
    const Inactive = 0; // Không hoạt động
    const Deleted = 2; // Đã xóa

    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Không hoạt động',
            self::Deleted => 'Đã xóa',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Không hoạt động',
            self::Deleted => 'Đã xóa',
            default => 'Không xác định',
        };
    }
}
