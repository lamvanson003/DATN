<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Notification\{NotificationStatus,NotificationReadAt,NotificationType};

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['user_id','title','message','type','status','read_at'];

    protected $casts= [
        'status' => NotificationStatus::class,
        'read_at' => NotificationReadAt::class,
        'type' => NotificationType::class,
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
