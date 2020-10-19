<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SnmpHostRemote extends Model
{
    //
    protected $fillable = ['snmp_host_id', 'chassisidsubtype', 'chassisid', 'sysname',
        'sysdesc', 'syscapsupported', 'syscapenabled', 'lldpxmed_rem_hw',
        'lldpxmed_rem_fw', 'lldpxmed_rem_sw', 'lldpxmed_rem_serial', 'lldpxmed_rem_mfgname',
        'lldpxmed_rem_model', 'lldpxmed_rem_assetid', 'discovery_protocol'];
}
