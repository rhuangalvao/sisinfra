<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpHostVlan extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'vlan_index', 'vlan_id', 'vlan_name'];


    public function snmpHost()
    {
        return $this->belongsTo('App\SnmpHost');
    }
}
