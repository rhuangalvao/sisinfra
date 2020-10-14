<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NetworkType extends Model
{
    protected $fillable = [
        'name',
        'descr',
    ];
}
