<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ocs_map_os extends Model
{
    protected $fillable = [
        'operating_system_id',
        'ocs_os_name_match',
    ];
}
