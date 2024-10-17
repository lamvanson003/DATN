<?php 
// resources/lang/vi/enums.php
use App\Enums\Category\CategoryStatus;

return [
    CategoryStatus::class => [
        CategoryStatus::Active => 'Hoạt động',
        CategoryStatus::Inactive => 'Ngưng hoạt động',
        CategoryStatus::Deleted => 'Đã xóa',
    ],
];