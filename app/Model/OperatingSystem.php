<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OperatingSystem extends Model
{
    protected $fillable = [
        'name',
        'version',
    ];
}
