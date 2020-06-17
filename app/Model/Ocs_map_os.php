<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ocs_map_os extends Model
{
    protected $fillable = [
        'operating_system_id',
        'ocs_os_name_match',
    ];
    public function operating_system_id()
    {
        return $this->belongsTo('App\Model\Operating_system', 'operating_system_id', 'id');
    }
}
