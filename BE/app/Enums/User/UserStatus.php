<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    const Inactive = 0;        // Không hoạt động
    const Active = 1;          // Đang hoạt động
    const Suspended = 2;       // Bị đình chỉ
    const PendingApproval = 3; // Chờ duyệt  
}
