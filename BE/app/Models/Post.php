<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ActiveStatus;
use App\Enums\Is_featured;
class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'images',
        'views',
        'status',
        'user_id',
        'posted_at',
        'is_featured',
    ];

    protected $casts = [
        'status'=> ActiveStatus::class,
        'is_featured'=> Is_featured::class,
    ];

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category_post', 'post_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
