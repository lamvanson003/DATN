<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $fillable = ['images','color'];
    public $timestamps = false;
    public function variantColors()
    {
        return $this->hasMany(Variant_Color::class, 'color_id');
    }
}
