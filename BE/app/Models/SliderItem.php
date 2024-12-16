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
        'position',
        'type',
    ];

    public function slider()
    {
        return $this->belongsTo(slider::class);
    }
    
    const TYPE_MAIN_BANNER = 'main_banner';
    const TYPE_SUB_BANNER = 'sub_banner';

    public static function getTypes()
    {
        return [
            self::TYPE_MAIN_BANNER => 'Main Banner',
            self::TYPE_SUB_BANNER => 'Sub Banner',
        ];
    }
}
