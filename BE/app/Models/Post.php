<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
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
        return $this->belongsToMany(PostCategory::class, 'post_category_post', 'post_id', 'category_id');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
