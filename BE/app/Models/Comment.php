<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Comment\CommentStatus;
class Comment extends Model
{
    use HasFactory;

    protected $table= 'comments';
    protected $fillable = ['images','fullname','content','product_variant_id','rating','status'];
    
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    protected $cast = [
        'status'=> CommentStatus::class,
    ];
}
