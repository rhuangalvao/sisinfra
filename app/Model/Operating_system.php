<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Operating_system extends Model
{
    protected $fillable = [
        'name',
        'version',
    ];
}
