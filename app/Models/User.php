<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email' ,
        'address',
        'password' ,
        'role',
        'status',
    ];

    // Accessor để tạo attribute 'name'
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
