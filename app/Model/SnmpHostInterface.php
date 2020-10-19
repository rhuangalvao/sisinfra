<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SnmpHostInterface extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'ifindex', 'ifdescr', 'iftype',
        'ifspeed', 'ifphysaddress', 'ifadminstatus', 'ifoperstatus',
        'ifname', 'ifalias', 'portid', 'is_trunk'];
}
