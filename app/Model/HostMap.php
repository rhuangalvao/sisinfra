<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HostMap extends Model
{
    protected $fillable = [
        'host_id',
        'snmp_host_id',
        'snmp_host_remote_id',
    ];

}
