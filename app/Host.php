<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = [
        'os_id',
        'host_type_id',
        'status_id',
        'tag',
        'hostname',
        'domain_suffix',
        'descr',
        'obs',
        'chassis_id',
        'monitoring',
        'enabled',
    ];

    public function os_id()
    {
        return $this->belongsTo('App\OperatingSystem', 'os_id', 'id');
    }
    public function host_type_id()
    {
        return $this->belongsTo('App\HostType', 'host_type_id', 'id');
    }
    public function status_id()
    {
        return $this->belongsTo('App\HostStatus', 'status_id', 'id');
    }
}
