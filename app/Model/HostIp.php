<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HostIp extends Model
{
    protected $fillable = [
        'host_id',
        'ip_address',
        'mask',
        'gateway',
        'version',
        'is_main',
        'mac_address',
    ];

    public function host_id()
    {
        return $this->belongsTo('App\Host', 'host_id', 'id');
    }
}
