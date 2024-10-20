<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Bảng liên kết với model
    protected $table = 'products';

    // Các thuộc tính có thể điền từ request
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'images',
        'image_lists',
        'status',
        'slug',
        'short_desc',
        'description',
    ];


    // public function countProductInactive($query){
    //     $count = $query->;
    // }       

    /**
     * Quan hệ với bảng Brand (Thương hiệu)
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Quan hệ với bảng Product_variant
     */
    public function product_variant()
    {
        return $this->hasMany(ProductVariant::class,'product_id');
    }

    /**
     * Quan hệ với bảng Category (Danh mục)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_image_items()
    {
        return $this->hasMany(ProductImageItem::class,'product_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}   
