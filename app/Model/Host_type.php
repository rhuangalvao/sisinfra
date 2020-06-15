<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host_type extends Model
{
    protected $fillable = [
        'name',
        'tag_prefix',
    ];
}
