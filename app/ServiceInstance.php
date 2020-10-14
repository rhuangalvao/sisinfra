<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceInstance extends Model
{
    protected $fillable = [
        'host_id',
        'service_id',
        'host_ip_id',
        'host_dns_id',
        'monitoring',
        'descr',
        'password_id',
    ];
    public function host_id()
    {
        return $this->belongsTo('App\Host', 'id', 'host_id');
    }
    public function service_id()
    {
        return $this->belongsTo('App\Service', 'id', 'service_id');
    }
    public function host_ip_id()
    {
        return $this->belongsTo('App\HostIp', 'id', 'host_ip_id');
    }
    public function host_dns_id()
    {
        return $this->belongsTo('App\HostDns', 'id', 'host_dns_id');
    }
}
