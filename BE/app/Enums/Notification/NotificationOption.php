<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;

final class NotificationOption extends Enum
{
    const All = 1;
    const One = 2;

    /**
     * Get the enum as a select array.
     */
    public static function asSelectArray(): array
    {
        return [
            self::All => 'All',
            self::One => 'One',
        ];
    }
    public static function getDescription($value): string
    {
        return match ($value) {
            self::All => 'Cho tất cả',
            self::One => 'Cho một người',
            default => 'Không xác định',
        };
    }
}
