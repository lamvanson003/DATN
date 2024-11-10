<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    
    protected $table = "flash_sale_items";
    protected $fillable = ['product_variant_id','flash_sale_id','discount_price','quantity_limit'];


    public function flashsale(){
        return $this->belongsTo(FlashSale::class,'flash_sale_id');
    }
    
    public function product_variant(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}
