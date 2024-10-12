<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant_Color extends Model
{
    use HasFactory;
    protected $table='variant_colors';
    protected $fillable = ['product_id','color_id'];




     // Quan hệ với bảng products
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
 
     // Quan hệ với bảng colors
     public function color()
     {
         return $this->belongsTo(Color::class);
     }
}
