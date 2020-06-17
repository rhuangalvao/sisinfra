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
        return $this->belongsTo('App\Model\Operating_system', 'os_id', 'id');
    }
    public function host_type_id()
    {
        return $this->belongsTo('App\Model\Host_type', 'host_type_id', 'id');
    }
    public function status_id()
    {
        return $this->belongsTo('App\Model\Host_status', 'status_id', 'id');
    }

}
