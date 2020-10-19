<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SnmpFunction extends Model
{
    //
    public function classFunction()
    {
        return $this->hasMany('App\SnmpDeviceClassFunction');
    }

    public function classSysoid()
    {
        return $this->hasMany('App\SnmpDeviceClassSysoid');
    }
}
