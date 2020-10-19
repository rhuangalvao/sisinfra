<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SnmpHostAddress extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'address', 'snmp_cmm_id', 'enabled'];

    public function snmpCmm(){
        return $this->belongsTo('App\SnmpCmm');
    }

    public function snmpHost(){
        return $this->belongsTo('App\SnmpHost');
    }
}
