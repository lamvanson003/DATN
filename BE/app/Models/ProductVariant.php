<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = ['product_id','sku','storage','price','sale','memory','sold','instock','color','images','status'];

    /**
     * Quan hệ với bảng Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
