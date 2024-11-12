<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_categories';
    protected $fillable = ['name', 'slug', 'images', 'status'];


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category_post', 'category_id', 'post_id');
    }

}
