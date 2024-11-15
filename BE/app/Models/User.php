<?php

namespace App\Models;

use App\Enums\User\UserStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
use App\Enums\User\UserRole;
use App\Enums\User\UserGender;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'username',
        'fullname',
        'gender',
        'email',
        'phone',
        'address',
        'token',
        'password',
        'roles',
        'avatar',
        'status',
        'device_token'
    ];

    public function scopeGetUser($query){
        return $query->where('roles', UserRole::User)->orderBy('id','desc')->get();
    }

    public function scopeGetAdmin($query){
        return $query->where('roles', UserRole::Admin)
                    ->orderBy('id','desc')->get();
    }

    protected $casts = [
        'status' => UserStatus::class,
        'gender' => UserGender::class,
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
