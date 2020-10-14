<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostConnection extends Model
{
    protected $fillable = [
        'host_interface_id_a',
        'host_interface_id_b',
        'connection_status',
        'discovery_protocol_id',
    ];

    public function hostInterfaceA()
    {
        return $this->belongsTo('App\HostInterface', 'host_interface_id_a', 'id');
    }
    public function hostInterfaceB()
    {
        return $this->belongsTo('App\HostInterface', 'host_interface_id_b', 'id');
    }
    public function discoveryProtocol()
    {
        return $this->belongsTo('App\DiscoveryProtocol', 'discovery_protocol_id', 'id');
    }
}
