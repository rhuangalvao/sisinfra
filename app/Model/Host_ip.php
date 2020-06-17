<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host_ip extends Model
{
    protected $fillable = [
        'host_id',
        'ip_address',
        'mask',
        'gateway',
        'version',
        'mac_address',
        'is_main',
    ];
}
