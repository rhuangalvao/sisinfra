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
        'monitoring',
    ];
    public function host_id()
    {
        return $this->belongsTo('App\Model\Host', 'id', 'host_id');
    }
    public function service_id()
    {
        return $this->belongsTo('App\Model\Service', 'id', 'service_id');
    }
    public function host_ip_id()
    {
        return $this->belongsTo('App\Model\Host_ip', 'id', 'host_ip_id');
    }
    public function host_dns_id()
    {
        return $this->belongsTo('App\Model\Host_dns', 'id', 'host_dns_id');
    }
}
