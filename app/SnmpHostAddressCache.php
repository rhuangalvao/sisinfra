<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpHostAddressCache extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'address', 'snmp_cmm_id', 'status'];

    public function snmpCmm(){
        return $this->belongsTo('App\SnmpCmm');
    }
}
