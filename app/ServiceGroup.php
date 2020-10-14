<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    protected $fillable = [
        'name',
        'descr'
    ];
}
