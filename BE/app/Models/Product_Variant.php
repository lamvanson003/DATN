<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Variant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'sku',
        'storage',
        'color',
        'price',
        'sale',
        'memory',
        'sold',
        'instock',
    ];

    public function scopeGetIdByProduct($query,$productId){
        return $query->where('product_id',$productId)
        ->orderBy('id','desc')->get();
    }

    /**
     * Quan hệ với bảng Product
     */
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Quan hệ với bảng trung gian variantColor
     */
    public function variantColor()
    {
        return $this->belongsTo(Variant_Color::class, 'variant_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'variant_colors', 'product_variant_id', 'color_id');
    }

}
