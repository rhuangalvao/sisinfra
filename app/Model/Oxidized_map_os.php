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
}
