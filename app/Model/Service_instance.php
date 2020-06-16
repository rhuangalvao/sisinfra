<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_instance extends Model
{
    protected $fillable = [
        'host_id',
        'service_id',
        'host_ip_id',
        'host_dns_id',
        'descr',
        'password_id',
    ];
}
