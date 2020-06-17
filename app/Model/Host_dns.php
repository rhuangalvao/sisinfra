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
}
