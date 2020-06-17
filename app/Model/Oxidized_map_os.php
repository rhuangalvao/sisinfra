<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Oxidized_map_os extends Model
{
    protected $fillable = [
        'oxidized_instance_id',
        'operating_system_id',
        'oxidized_os'
    ];
    public function oxidized_instance_id()
    {
        return $this->belongsTo('App\Model\Oxidized_instance', 'oxidized_instance_id', 'id');
    }
    public function operating_system_id()
    {
        return $this->belongsTo('App\Model\Operating_system', 'operating_system_id', 'id');
    }
}
