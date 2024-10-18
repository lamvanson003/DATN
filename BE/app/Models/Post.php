<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'images',
        'views',
        'status',
        'category_id',
        'user_id',
        'posted_at'
    ];


    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
