<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'daemon_name',
        'protocol',
        'port',
        'service_group_id'
    ];

    public function service_group_id()
    {
        return $this->belongsTo('App\ServiceGroup', 'service_group_id', 'id');
    }
}
