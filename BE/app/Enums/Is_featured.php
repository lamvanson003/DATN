<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Is_featured extends Enum
{
    const Is_featured = 1; 
    const Default = 0; 

    public static function asSelectArray(): array
    {
        return [
            self::Is_featured => 'Nổi bậc',
            self::Default => 'Ngưng hoạt động',
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Is_featured => 'Nổi bậc',
            self::Default => 'Ngưng hoạt động',
        };
    }
}
