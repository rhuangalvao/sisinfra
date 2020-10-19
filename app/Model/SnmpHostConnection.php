<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SnmpHostConnection extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'remote_chassisid', 'remote_portid',
        'remote_portidsubtype', 'remote_portdescr', 'local_portid', 'count'];
}
