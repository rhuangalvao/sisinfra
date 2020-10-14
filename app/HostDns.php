<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostDns extends Model
{
    protected $fillable = [
        'host_id',
        'name',
        'is_main',
        'version',
    ];

    public function host_id()
    {
        return $this->belongsTo('App\Host', 'host_id', 'id');
    }
}
