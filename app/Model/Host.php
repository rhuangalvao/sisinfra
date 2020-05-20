<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = [
        'os_id',
        'host_type_id',
        'status_id',
        'tag',
        'hostname',
        'domain_suffix',
        'descr',
        'obs',
        'chassis_id'
    ];

}
