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

    /**
     * Quan hệ với bảng Brand (Thương hiệu)
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Quan hệ với bảng Category (Danh mục)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Lấy danh sách hình ảnh từ cột image_lists (giả sử lưu dưới dạng JSON)
     */
    public function getImageListsAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * Thiết lập hình ảnh danh sách (image_lists)
     */
    public function setImageListsAttribute($value)
    {
        $this->attributes['image_lists'] = json_encode($value);
    }
}
