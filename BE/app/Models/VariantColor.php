<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantColor extends Model
{
    use HasFactory;
    protected $table='variant_colors';
    protected $fillable = ['product_variant_id','color_id'];




     // Quan hệ với bảng products
     public function ProductVariant()
     {
         return $this->belongsTo(ProductVariant::class,'product_variant_id');
     }
 
     // Quan hệ với bảng colors
     public function color()
     {
         return $this->belongsTo(Color::class);
     }
}
