<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Comment\CommentStatus;
class Comment extends Model
{
    use HasFactory;

    protected $table= 'comments';
    protected $fillable = ['content','user_id','product_variant_id','rating','status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    protected $cast = [
        'status'=> CommentStatus::class,
    ];
}
