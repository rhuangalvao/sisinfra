<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpDeviceClassSysoid extends Model
{
    //
    public function deviceClass(){
        return $this->belongsTo('App\SnmpDeviceClass');
    }

    public function snmpFunction()
    {
        return $this->belongsTo('App\SnmpFunction');
    }
}
