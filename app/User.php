<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    function books()
    {
        return $this->belongsToMany('App\Book', 'users_borrowing_books')->withTimestamps();
    }
}
