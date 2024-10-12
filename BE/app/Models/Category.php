<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Category\CategoryStatus;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name','images','description','status' ,'slug'];

    public function scopeCategory($query){
        return $query->orderBy('id','desc')->get();
    }

    protected $casts = [
        'status' => CategoryStatus::class
    ];
}
