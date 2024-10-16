<?php

namespace App\Enums\Comment;

use BenSampo\Enum\Enum;

final class CommentStatus extends Enum
{
    const Approved = 1; // Đã duyệt
    const Pending = 0; // Chờ duyệt
    const Rejected = 2; // Bị từ chối
    const Spam = 3; // Spam
    const Deleted = 4; // Đã xóa (thêm vào đây)

    public static function asSelectArray(): array
    {
        return [
            self::Approved => 'Đã duyệt',
            self::Pending => 'Chờ duyệt',
            self::Rejected => 'Bị từ chối',
            self::Spam => 'Spam',
            self::Deleted => 'Đã xóa', 
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Approved => 'Đã duyệt',
            self::Pending => 'Chờ duyệt',
            self::Rejected => 'Bị từ chối',
            self::Spam => 'Spam',
            self::Deleted => 'Đã xóa', 
            default => 'Không xác định',
        };
    }
}
