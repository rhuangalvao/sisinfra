<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpHostIparp extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'ip_address', 'mac_address', 'vlan_index', 'count', 'version'];
}
