<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceInstanceParam extends Model
{
    protected $fillable = [
        'service_instance_id',
        'param_name',
        'param_value',
        'enabled',
    ];
    public function service_instance_id()
    {
        return $this->belongsTo('App\ServiceInstance', 'id', 'service_instance_id');
    }
}
