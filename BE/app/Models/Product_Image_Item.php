<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Product_Image_Item extends Model
{
    use HasFactory;
    protected $table = 'product_image_items';

    protected $fillable = [
        'product_id',
        'name',
        'image',
        'description',
        'status',
    ];

    protected $casts = [
        'status'=> Status::class,
    ];
}
