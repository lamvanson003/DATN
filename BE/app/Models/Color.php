<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use App\Models\Product_Variant;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $fillable = ['images','name','status'];
    public $timestamps = false;
    
    protected $casts = [
        'status' => Status::class
    ];

    // Quan hệ với bảng ProductVariant thông qua VariantColors
    public function productVariants()
    {
        return $this->belongsToMany(Product_Variant::class, 'variant_colors', 'color_id', 'product_variant_id');
    }
    public function variantColors()
    {
        return $this->hasMany(Variant_Color::class, 'color_id');
    }

}
