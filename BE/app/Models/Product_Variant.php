<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Variant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = ['product_id','sku','storage','price','sale','memory','sold','instock',];

    /**
     * Quan hệ với bảng Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class,'id');
    }

}
