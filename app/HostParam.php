<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostParam extends Model
{
    protected $fillable = [
        'host_id',
        'param_name',
        'param_value',
        'enabled',
    ];

    public function host_id()
    {
        return $this->belongsTo('App\Host', 'host_id', 'id');
    }
}
