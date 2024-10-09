<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant_Color extends Model
{
    use HasFactory;
    protected $table=['variant_colors'];
    protected $fillable = ['product_variant_id','color_id'];

    public function productVariant()
    {
        return $this->hasMany(Product_Variant::class, 'variant_color_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
