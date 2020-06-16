<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_instance_param extends Model
{
    protected $fillable = [
        'service_instance_id',
        'param_name',
        'param_value',
    ];
}

