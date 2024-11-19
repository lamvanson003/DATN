<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;

final class NotificationTypes extends Enum
{
    const All = 1;
    const Customer = 2;

    /**
     * Get the enum as a select array.
     */
    public static function asSelectArray(): array
    {
        return [
            self::All => 'All',
            self::Customer => 'Customer',
        ];
    }
    public static function getDescription($value): string
    {
        return match ($value) {
            self::All => 'Thông báo tất cả',
            self::Customer => 'Thông báo khách hàng',
            default => 'Không xác định',
        };
    }
}
