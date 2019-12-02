<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'description',
    ];
    protected $table = 'books';

    function users()
    {
        return $this->belongsToMany('App\User', 'users_borrowing_books');
    }
}
