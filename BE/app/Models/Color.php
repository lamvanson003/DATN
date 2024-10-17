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


    // Quan hệ với bảng variant_colors
    public function variantColors()
    {
        return $this->hasMany(VariantColor::class);
    }

    // Quan hệ với bảng products qua bảng variant_colors
    public function ProductVariants()
    {
        return $this->belongsToMany(Product::class, 'variant_colors', 'color_id', 'product_variant_id');
    }

}
