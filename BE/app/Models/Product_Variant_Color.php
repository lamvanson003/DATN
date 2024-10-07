<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Variant_Color extends Model
{
    use HasFactory;

    protected $table = 'product_variant_colors';

    protected $fillable = [
        'variant_id',
        'color',
        'images',
    ];
    /**
     * Quan hệ với bảng Product_variant
     */
    public function product_variant()
    {
        return $this->belongsToMany(Product_Variant::class, 'product_variant_color', 'color_id', 'product_variant_id');
    }


}
