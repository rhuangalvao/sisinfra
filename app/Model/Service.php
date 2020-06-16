<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'daemon_name',
        'protocol',
        'port',
        'service_group_id'
    ];
}
