<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostConnection;
use App\Model\HostMap;
use App\Model\HostStatus;
use App\Model\HostType;
use App\Model\OperatingSystem;
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

        $host_ifjoin = DB::table('hosts')
            ->join('host_interfaces', 'hosts.id', '=', 'host_interfaces.host_id')
            ->select('hosts.host_type_id', 'hosts.tag', 'hosts.hostname', 'hosts.chassis_id', 'host_interfaces.id', 'host_interfaces.host_id', 'host_interfaces.portid')
            ->where('host_interfaces.host_id','<','10')
            ->get();
//        dd($host_ifjoin);
        $host_connection = HostConnection::all();
//        $query = DB::table('host_interfaces')
//            ->join('hosts', 'hosts.id', '=', 'host_interfaces.host_id')
//            ->rightJoin('host_connections','host_connections.host_interface_id_a','=','host_interfaces.id')
//            ->select('host_connections.host_interface_id_b','hosts.host_type_id', 'hosts.tag', 'hosts.hostname', 'hosts.chassis_id', 'host_interfaces.id', 'host_interfaces.host_id', 'host_interfaces.portid')
//            ->get();
        $host = Host::
            where('id','<', '30')
            ->get();
        $host_map = HostMap::
            where('id','<', '30')
            ->get();
//        $host = Host::all();
//        $host_map = HostMap::all();
        $host_type = HostType::all();
        $busca = null;
        return view('welcome',compact('host','host_map','host_type', 'busca', 'host_ifjoin','host_connection'));
}

    public function search(Request $request){

//        $host = Host::all();
        $host = Host::
        where('id','<', '30')
            ->get();
//        $snmp_host_connections = SnmpHostConnection::all();
//        $host_map = HostMap::all();
        $host_map = HostMap::
        where('id','<', '30')
            ->get();
        $host_type = HostType::all();
        $busca = $request->pesquisa;

        $host_ifjoin = DB::table('hosts')
            ->join('host_interfaces', 'hosts.id', '=', 'host_interfaces.host_id')
            ->select('hosts.host_type_id', 'hosts.tag', 'hosts.hostname', 'hosts.chassis_id', 'host_interfaces.id', 'host_interfaces.host_id', 'host_interfaces.portid')
            ->where('host_interfaces.host_id','<','10')
            ->get();

        $host_connection = HostConnection::all();
//        $query = DB::table('host_interfaces')
//            ->join('hosts', 'hosts.id', '=', 'host_interfaces.host_id')
//            ->join('host_connections','host_connections.host_interface_id_a','=','host_interfaces.id')
//            ->select('host_connections.host_interface_id_b','hosts.host_type_id', 'hosts.tag', 'hosts.hostname', 'hosts.chassis_id', 'host_interfaces.id', 'host_interfaces.host_id', 'host_interfaces.portid')
//            ->get();
        return view('welcome',compact('host','host_map','host_type','busca', 'host_ifjoin','host_connection'));
    }

    public function infos(Request $request){
        $hosts = Host::all();
        $operating_system = OperatingSystem::all();
        $host_type = HostType::all();
        $host_status = HostStatus::all();
        $infos = $request->infohost;
        return view('infos', compact('hosts', 'operating_system', 'host_type', 'host_status', 'infos'));
    }
}
