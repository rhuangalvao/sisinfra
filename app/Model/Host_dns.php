<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host_dns extends Model
{
    protected $fillable = [
        'host_id',
        'name',
        'version',
        'is_main'
    ];

    public function host_id()
    {
        return $this->belongsTo('App\Model\Host', 'host_id', 'id');
    }
}
