<?php

namespace App\Http\Controllers;

use App\DataTables\HostInterfaceDataTable;
use App\Model\DiscoveryProtocol;
use App\Model\HostInterface;
use App\Model\Host;
use App\Model\SnmpHostInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HostInterfaceController extends Controller
{
    public function index(HostInterfaceDataTable $dataTable)
    {
//        return datatables()->make(DB::table('host_interfaces'))->toJson();
        return $dataTable->render('host_interface.index');
    }
//    public function index(Request $request)
//    {
//        if ($request->ajax()) {
//            $data = HostInterface::all();
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//
//                    $action = '
//                        <a class="btn btn-success" id="edit-user" data-toggle="modal" data-id='.$row->id.'>Edit </a>
//                        <meta name="csrf-token" content="{{ csrf_token() }}">
//                        <a id="delete-user" data-id='.$row->id.' class="btn btn-danger delete-user">Delete</a>';
//
//                    return $action;
//
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//
//        return view('host_interface.index');
//    }

    public function create(){
        $host = Host::all();
        $snmp_host_interface = SnmpHostInterface::all();
        $discovery_protocol = DiscoveryProtocol::all();
        return view('host_interface.create',compact('host','snmp_host_interface', 'discovery_protocol'));
    }
    public function crud(){

        $host_interfaces = DB::table('host_interfaces')
            ->leftJoin('hosts', 'host_interfaces.host_id', '=', 'hosts.id')
            ->leftJoin('discovery_protocols', 'host_interfaces.discovery_protocol_id', '=', 'discovery_protocols.id')
            ->leftJoin('snmp_host_interfaces', 'host_interfaces.snmp_host_interface_id', '=', 'snmp_host_interfaces.id')
            ->select('host_interfaces.*', 'hosts.hostname','discovery_protocols.name as protocol_name','snmp_host_interfaces.ifname as snmp_ifname')
            ->paginate(10);

//        $host_interfaces = HostInterface::paginate(10);
        $snmp_host_interface = SnmpHostInterface::all();
        $discovery_protocol = DiscoveryProtocol::all();
        $host = Host::all();

//        $host_interfaces = HostInterface::all();
//        $datatable =  Datatables::of($host_interfaces);
//        return $datatable->blacklist(['action'])->make(true);
//        return view('host_interface.crud',compact('datatable','host','snmp_host_interface', 'discovery_protocol'));

        return view('host_interface.crud',compact('host_interfaces','host','snmp_host_interface', 'discovery_protocol'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $host_interfaces = DB::table('host_interfaces')
                ->leftJoin('hosts', 'host_interfaces.host_id', '=', 'hosts.id')
                ->leftJoin('discovery_protocols', 'host_interfaces.discovery_protocol_id', '=', 'discovery_protocols.id')
                ->leftJoin('snmp_host_interfaces', 'host_interfaces.snmp_host_interface_id', '=', 'snmp_host_interfaces.id')
                ->select('host_interfaces.*', 'hosts.hostname','discovery_protocols.name as protocol_name','snmp_host_interfaces.ifname as snmp_ifname')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.ifname', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.iftype', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.ifspeed', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.ifindex', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.ifoperstatus', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.ifalias', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_interfaces.portid', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('discovery_protocols.name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('snmp_host_interfaces.ifname', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $host_interfaces = HostInterface::
//            where('host_id',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('ifname', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('iftype', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('ifspeed', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('ifindex', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('ifoperstatus', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('ifalias', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('portid', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $host_interfaces = DB::table('host_interfaces')
                ->leftJoin('hosts', 'host_interfaces.host_id', '=', 'hosts.id')
                ->leftJoin('discovery_protocols', 'host_interfaces.discovery_protocol_id', '=', 'discovery_protocols.id')
                ->leftJoin('snmp_host_interfaces', 'host_interfaces.snmp_host_interface_id', '=', 'snmp_host_interfaces.id')
                ->select('host_interfaces.*', 'hosts.hostname','discovery_protocols.name as protocol_name','snmp_host_interfaces.ifname as snmp_ifname')
                ->paginate($dataForm['entradas']);
//            $host_interfaces = HostInterface::paginate($dataForm['entradas']);
        }
        else{
            $host_interfaces = DB::table('host_interfaces')
                ->leftJoin('hosts', 'host_interfaces.host_id', '=', 'hosts.id')
                ->leftJoin('discovery_protocols', 'host_interfaces.discovery_protocol_id', '=', 'discovery_protocols.id')
                ->leftJoin('snmp_host_interfaces', 'host_interfaces.snmp_host_interface_id', '=', 'snmp_host_interfaces.id')
                ->select('host_interfaces.*', 'hosts.hostname','discovery_protocols.name as protocol_name','snmp_host_interfaces.ifname as snmp_ifname')
                ->paginate(10);
//            $host_interfaces = HostInterface::paginate(10);
        }
        $snmp_host_interface = SnmpHostInterface::all();
        $discovery_protocol = DiscoveryProtocol::all();
        $host = Host::all();
        return view('host_interface.crud',compact('host_interfaces','host','snmp_host_interface', 'discovery_protocol', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
//            'ifname'=>'required',
//            'iftype'=>'required',
//            'ifspeed'=>'required',
//            'ifindex'=>'required',
//            'ifoperstatus'=>'required',
//            'ifalias'=>'required',
//            'portid'=>'required',
            'is_mgmt'=>'required',
            'discovery_protocol_id'=>'required',
//            'snmp_host_interface_id'=>'required',
        ]);
        $host_interface = new HostInterface([
            'host_id' => $request->get('host_id'),
            'ifname' => $request->get('ifname'),
            'iftype' => $request->get('iftype'),
            'ifspeed' => $request->get('ifspeed'),
            'ifindex' => $request->get('ifindex'),
            'ifoperstatus' => $request->get('ifoperstatus'),
            'ifalias' => $request->get('ifalias'),
            'portid' => $request->get('portid'),
            'is_mgmt' => $request->get('is_mgmt'),
            'discovery_protocol_id' => $request->get('discovery_protocol_id'),
            'snmp_host_interface_id' => $request->get('snmp_host_interface_id'),
        ]);
        $host_interface->save();
        return redirect('/host_interface/crud')->with('success', 'host_interface salvo!');
    }
    public function destroy($id){
        $host_interface = HostInterface::find($id);
        $host_interface->delete();

        return redirect('/host_interface/crud')->with('success', 'host_interface deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $snmp_host_interface = SnmpHostInterface::all();
        $discovery_protocol = DiscoveryProtocol::all();
        $host_interface = HostInterface::find($id);
        return view('host_interface.edit', compact('host_interface','host','snmp_host_interface', 'discovery_protocol'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
//            'ifname'=>'required',
//            'iftype'=>'required',
//            'ifspeed'=>'required',
//            'ifindex'=>'required',
//            'ifoperstatus'=>'required',
//            'ifalias'=>'required',
//            'portid'=>'required',
            'is_mgmt'=>'required',
            'discovery_protocol_id'=>'required',
//            'snmp_host_interface_id'=>'required',
        ]);

        $host_interface = HostInterface::find($id);

        $host_interface->host_id = $request->get('host_id');
        $host_interface->ifname = $request->get('ifname');
        $host_interface->iftype = $request->get('iftype');
        $host_interface->ifspeed = $request->get('ifspeed');
        $host_interface->ifindex = $request->get('ifindex');
        $host_interface->ifoperstatus = $request->get('ifoperstatus');
        $host_interface->ifalias = $request->get('ifalias');
        $host_interface->portid = $request->get('portid');
        $host_interface->is_mgmt = $request->get('is_mgmt');
        $host_interface->discovery_protocol_id = $request->get('discovery_protocol_id');
        $host_interface->snmp_host_interface_id = $request->get('snmp_host_interface_id');

        $host_interface->save();

        return redirect('/host_interface/crud')->with('success', 'host_interface editado!');
    }
}
