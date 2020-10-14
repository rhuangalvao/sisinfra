<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpHostFdb extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'mac_address', 'ifindex', 'vlan_index', 'count'];
}
