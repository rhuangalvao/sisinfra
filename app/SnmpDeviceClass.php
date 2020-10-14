<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpDeviceClass extends Model
{
    //
    public function auxVendor(){
        return $this->belongsTo('App\AuxVendor');
    }

    public function hostType(){
        return $this->belongsTo('App\HostType');
    }

    public function operatingSystem(){
        return $this->belongsTo('App\OperatingSystem');
    }

    public function SnmpDeviceClassSysdescr()
    {
        return $this->hasMany('App\SnmpDeviceClassSysdescr');
    }

    public function SnmpDeviceClassSysoid()
    {
        return $this->hasMany('App\SnmpDeviceClassSysoid');
    }

    public function snmpHost()
    {
        return $this->hasMany('App\SnmpHost');
    }
}
