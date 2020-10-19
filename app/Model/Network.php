<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = [
        'network_type_id',
        'name',
        'descr',
        'address',
        'enabled',
    ];
}
