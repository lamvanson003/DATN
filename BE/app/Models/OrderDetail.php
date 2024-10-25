<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "order_details";

    protected $fillable = ['order_id','product_variant_id','quantity','price','sale'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}
