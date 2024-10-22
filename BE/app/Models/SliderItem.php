<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    use HasFactory;
    protected $table = 'slider_items';

    protected $fillable = [
        'slider_id',
        'title', 
        'images',
        'posittion',
    ];

    public function slider()
    {
        return $this->belongsTo(slider::class);
    }
}
