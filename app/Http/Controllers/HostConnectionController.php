<?php

namespace App\Http\Controllers;

use App\Model\DiscoveryProtocol;
use App\Model\HostConnection;
use App\Model\HostInterface;
use Illuminate\Http\Request;

class HostConnectionController extends Controller
{
    public function crud(){
        $host_connection = HostConnection::all();
        $host_interface = HostInterface::all();
        $discovery_protocol = DiscoveryProtocol::all();
        return view('host_connection.crud',compact('host_connection','host_interface','discovery_protocol'));
    }
}
