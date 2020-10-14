<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SnmpHost extends Model
{
    //
    protected $fillable = ['sysdescr', 'sysobjectid', 'sysuptime', 'syscontact', 'sysname', 'syslocation', 'sysservices', 'hostname', 'serialnumber', 'model', 'softwareversion', 'chassisid', 'chassisidsubtype', 'snmp_device_class_id'];

    public function snmpDeviceClass(){
        return $this->belongsTo('App\SnmpDeviceClass');
    }

    public function snmpHostAddress()
    {
        return $this->hasMany('App\SnmpHostAddress');
    }

    public function snmpHostInterface()
    {
        return $this->hasMany('App\SnmpHostInterface');
    }

    public function snmpHostRemote()
    {
        return $this->hasMany('App\SnmpHostRemote');
    }

    public function snmpHostVlan()
    {
        return $this->hasMany('App\SnmpHostVlan');
    }

    public function snmpHostFdb()
    {
        return $this->hasMany('App\SnmpHostFdb');
    }

    public function snmpHostConnection()
    {
        return $this->hasMany('App\SnmpHostConnection');
    }

    public function snmpHostIparp()
    {
        return $this->hasMany('App\SnmpHostIparp');
    }

    public function hostMap()
    {
        return $this->hasMany('App\HostMap');
    }
}
