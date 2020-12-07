<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $fillable = [
        'id',
        'login'
    ];

    protected $hidden = [
        'password'
    ];

    public static function login(User $user)
    {
        $_SESSION["user"] = $user->only('id', 'login');
    }
}