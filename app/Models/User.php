<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at'
    ];

    public $timestamps = false;

    public static function isSender(User $user)
    {
        return $user->type === 1;
    }

    public static function isBiker(User $user)
    {
        return $user->type === 2;
    }
}
