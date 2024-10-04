<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Category\CategoryStatus;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name','image','description','status' ,'slug'];

    public function scopeCategory($query){
        return $query->where('status',CategoryStatus::Active)->get();
    }

    protected $casts = [
        'status' => CategoryStatus::class
    ];
}
