<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostMap extends Model
{
    protected $fillable = [
        'snmp_host_id',
        'snmp_host_remote_id',
    ];

}
