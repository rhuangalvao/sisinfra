<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service_dependency extends Model
{
    protected $fillable = [
        'service_instance_id',
        'service_instance_id_dep'
    ];
    public function service_instance_id()
    {
        return $this->belongsTo('App\Model\Service_instance', 'id', 'service_instance_id');
    }
}
