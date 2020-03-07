<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    protected $table = 'lends';

    protected $fillable = [
        'user_id', 'book_id',
    ];
}
