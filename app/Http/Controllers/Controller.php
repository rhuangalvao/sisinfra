<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostType;
use App\Model\SnmpHostConnection;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome(){

        $host = Host::all();
        $snmp_host_connections = SnmpHostConnection::all();
        $host_type = HostType::all();
        $busca = null;
        return view('welcome',compact('host','snmp_host_connections','host_type', 'busca'));
    }

    public function search(Request $request){

        $host = Host::all();
        $snmp_host_connections = SnmpHostConnection::all();
        $host_type = HostType::all();
        $busca = $request->pesquisa;
        return view('welcome',compact('host','snmp_host_connections','host_type','busca'));
    }
}
