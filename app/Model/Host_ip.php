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

    public function host_id()
    {
        return $this->belongsTo('App\Model\Host', 'host_id', 'id');
    }
}
