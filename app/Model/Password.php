<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $fillable = [
        'username',
        'password',
        'name',
        'descr',
    ];
}
