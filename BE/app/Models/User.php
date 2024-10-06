<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\User\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\User\UserRole;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'avatar'
    ];
    
    public function hasRole($role)
    {
        return $this->roles === $role;
    }

    public function scopeGetUser($query){
        return $query->where('roles',UserRole::User)->orderBy('id','desc')->get();
    }

    public function scopeGetAdmin($query){
        return $query->where('roles',UserRole::Admin)
                    ->orderBy('id','desc')->get();
    }
    
    protected $casts = [
        'status' => UserStatus::class,
    ];
}
