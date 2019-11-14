<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Lend_Book extends Model
{
    protected $fillable = [
        'user_id', 'book_id',
    ];
    protected $table = 'borrowing';
}
