<?php

namespace App\Http\Controllers;

use App\Model\DiscoveryProtocol;
use App\Model\HostConnection;
use App\Model\HostInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostConnectionController extends Controller
{
    public function crud(){
//        $host_face = DB::table('hosts')
//            ->join('host_interfaces', 'hosts.id', '=', 'host_interfaces.host_id')
//            ->select('hosts.*', 'host_interfaces.portid','host_interfaces.id')
//            ->get();
        $host_connections = HostConnection::paginate(10);
        $host_interfaces = HostInterface::all();
        $discovery_protocols = DiscoveryProtocol::all();
        return view('host_connection.crud',compact('host_connections','host_interfaces','discovery_protocols'));
    }
}
