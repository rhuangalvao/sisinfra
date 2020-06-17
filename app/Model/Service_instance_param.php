<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_instance_param extends Model
{
    protected $fillable = [
        'service_instance_id',
        'param_name',
        'param_value',
        'enabled',
    ];
    public function service_instance_id()
    {
        return $this->belongsTo('App\Model\Service_instance', 'id', 'service_instance_id');
    }
}

