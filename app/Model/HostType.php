<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HostType extends Model
{
    protected $fillable = [
        'name',
        'tag_prefix',
    ];
}