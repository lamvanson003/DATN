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
     * Quan hệ với bảng Color (Màu sắc)
     * Một biến thể có thể có nhiều màu sắc (Many-to-Many)
     */
    public function colors()
    {
        return $this->belongsToMany(Product_Variant_Color::class, 'product_variant_color', 'product_variant_id', 'color_id');
    }


}
