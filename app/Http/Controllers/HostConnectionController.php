<?php

namespace App\Http\Controllers;

use App\Model\DiscoveryProtocol;
use App\Model\HostConnection;
use App\Model\HostInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostConnectionController extends Controller
{
    public function create(){

        $host_connections = HostConnection::all();
        $host_interface = HostInterface::all();
        $discovery_protocol = DiscoveryProtocol::all();
        return view('host_connection.create',compact('host_connections','host_interface','discovery_protocol'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
//            $host_connections = HostConnection::
//                where('host_interface_id_a',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('host_interface_id_b', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('connection_status', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('discovery_protocol_id', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);

            $host_connections = DB::table('host_connections')
                ->leftJoin('host_interfaces', 'host_connections.host_interface_id_a', '=', 'host_interfaces.id')
                ->leftJoin('discovery_protocols', 'host_connections.discovery_protocol_id', '=', 'discovery_protocols.id')
                ->select('host_connections.*', 'host_interfaces.ifname', 'discovery_protocols.name')
                ->where('host_interfaces.ifname',"ilike",'%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interface_id_b', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('connection_status', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('discovery_protocols.name',"ilike",'%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $host_connections = DB::table('host_connections')
                ->leftJoin('host_interfaces', 'host_connections.host_interface_id_a', '=', 'host_interfaces.id')
                ->leftJoin('discovery_protocols', 'host_connections.discovery_protocol_id', '=', 'discovery_protocols.id')
                ->select('host_connections.*', 'host_interfaces.ifname', 'discovery_protocols.name')
                ->paginate($dataForm['entradas']);
//            $host_connections = HostConnection::paginate($dataForm['entradas']);
        }
        else{
//            $host_connections = HostConnection::paginate(10);
            $host_connections = DB::table('host_connections')
                ->leftJoin('host_interfaces', 'host_connections.host_interface_id_a', '=', 'host_interfaces.id')
                ->leftJoin('discovery_protocols', 'host_connections.discovery_protocol_id', '=', 'discovery_protocols.id')
                ->select('host_connections.*', 'host_interfaces.ifname', 'discovery_protocols.name')
                ->paginate(10);
        }
        $host_interfaces = HostInterface::all();
        $discovery_protocols = DiscoveryProtocol::all();

        return view('host_connection.crud',compact('host_connections','host_interfaces','discovery_protocols', 'dataForm'));
    }

    public function store(Request $request){

        $request->validate([
            'host_interface_id_a'=>'required',
            'host_interface_id_b'=>'required',
            'discovery_protocol_id'=>'required',
        ]);
        $host_connections = new HostConnection([
            'host_interface_id_a' => $request->get('host_interface_id_a'),
            'host_interface_id_b' => $request->get('host_interface_id_b'),
            'connection_status' => $request->get('connection_status'),
            'discovery_protocol_id' => $request->get('discovery_protocol_id'),
        ]);
        $host_connections->save();
        return redirect('/host_connection/crud')->with('success', 'host_connections salvo!');
    }

    public function destroy($id){
        $host_dns = HostConnection::find($id);
        $host_dns->delete();

        return redirect('/host_connection/crud')->with('success', 'host_connection deletado!');
    }

    public function crud(){
//        $host_face = DB::table('hosts')
//            ->join('host_interfaces', 'hosts.id', '=', 'host_interfaces.host_id')
//            ->select('hosts.*', 'host_interfaces.portid','host_interfaces.id')
//            ->get();
        $host_connections = DB::table('host_connections')
            ->leftJoin('host_interfaces', 'host_connections.host_interface_id_a', '=', 'host_interfaces.id')
            ->leftJoin('discovery_protocols', 'host_connections.discovery_protocol_id', '=', 'discovery_protocols.id')
            ->select('host_connections.*', 'host_interfaces.ifname', 'discovery_protocols.name')
            ->paginate(10);
//        dd($host_connections);

//        $host_connections = HostConnection::paginate(10);
        $host_interfaces = HostInterface::all();
        $discovery_protocols = DiscoveryProtocol::all();
        return view('host_connection.crud',compact('host_connections','host_interfaces'));
    }
}
