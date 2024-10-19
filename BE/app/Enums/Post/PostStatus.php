<?php

namespace App\Enums\Post;

use BenSampo\Enum\Enum;

final class PostStatus extends Enum
{
    const Active = 1;   
    const Inactive = 0; 
    const Draft = 2;   

   
    public static function asSelectArray(): array
    {
        return [
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Không hoạt động',
            self::Draft => 'Nháp',
        ];
    }

   
    public static function getDescription($value): string
    {
        return match ($value) {
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Không hoạt động',
            self::Draft => 'Nháp',
            default => 'Không xác định',
        };
    }
}
