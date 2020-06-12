<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host_param extends Model
{
    protected $fillable = [
        'host_id',
        'param_name',
        'param_value',
    ];
}
