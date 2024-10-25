<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Discount\DiscountStatus; 
use App\Enums\Discount\DiscountType; 
use Carbon\Carbon;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_value',
        'date_start',
        'date_end',
        'desc',
        'type',  
        'status',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'status' => DiscountStatus::class,
        'type' => DiscountType::class,      
    ];

    public function getStatusAttribute($value)
    {
        return DiscountStatus::getDescription($value);
    }
    
    public function getTypeAttribute($value)
    {
        return DiscountType::getDescription($value);
    }

    public function getDateStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null; 
    }

    public function getDateEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null; 
    }
}
