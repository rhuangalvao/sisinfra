<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostInterface extends Model
{
    protected $fillable = [
        'host_id',
        'ifname',
        'iftype',
        'ifspeed',
        'ifindex',
        'ifoperstatus',
        'ifalias',
        'portid',
        'is_mgmt',
        'discovery_protocol_id',
    ];

    public function hostId()
    {
        return $this->belongsTo('App\Host', 'host_id', 'id');
    }
    public function discoveryProtocol()
    {
        return $this->belongsTo('App\DiscoveryProtocol', 'discovery_protocol_id', 'id');
    }
}
