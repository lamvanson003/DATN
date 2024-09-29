<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;

final class SliderType extends Enum
{
    const Hot_Deal = 'hot-deal';        // Hot - deal 
    const Sale = 'sale';          // Khuyến mãi
    const Hot = 'hot';       // Nổi bậc
    const Other = 'other';       // Khác
}
