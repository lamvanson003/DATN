<?php

namespace App\Enums\Post;

use BenSampo\Enum\Enum;

final class PostStatus extends Enum
{
    const Published = 1;
    const Draft = 2;
}
