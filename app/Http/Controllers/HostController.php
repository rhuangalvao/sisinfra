<?php

namespace App\Http\Controllers;

use App\Model\AuxVendor;
use App\Model\Host;
use App\Model\OperatingSystem;
use App\Model\HostType;
use App\Model\HostStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostController extends Controller
{
    public function create(){
        $operating_systems = OperatingSystem::all();
        $host_types = HostType::all();
        $host_status = HostStatus::all();
        $aux_vendors = AuxVendor::all();
        return view('host.create',compact('operating_systems','host_types','host_status','aux_vendors'));
    }
    public function crud(){

        $hosts = DB::table('hosts')
            ->leftJoin('operating_systems', 'hosts.os_id', '=', 'operating_systems.id')
            ->leftJoin('host_types','hosts.host_type_id','=','host_types.id')
            ->leftJoin('host_statuses','hosts.status_id','=','host_statuses.id')
            ->leftJoin('aux_vendors','hosts.aux_vendor_id','=','aux_vendors.id')
            ->select('hosts.*','operating_systems.name as os_name', 'host_types.name as type_name', 'host_statuses.status', 'aux_vendors.name as vendor_name')
            ->paginate(10);
//        dd($hosts);
//        $hosts = Host::paginate(10);
        $operating_systems = OperatingSystem::all();
        $host_types = HostType::all();
        $host_status = HostStatus::all();
        $aux_vendors = AuxVendor::all();
        return view('host.crud',compact('hosts', 'operating_systems','host_types','host_status','aux_vendors'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $hosts = DB::table('hosts')
                ->leftJoin('operating_systems', 'hosts.os_id', '=', 'operating_systems.id')
                ->leftJoin('host_types','hosts.host_type_id','=','host_types.id')
                ->leftJoin('host_statuses','hosts.status_id','=','host_statuses.id')
                ->leftJoin('aux_vendors','hosts.aux_vendor_id','=','aux_vendors.id')
                ->select('hosts.*','operating_systems.name as os_name', 'host_types.name as type_name', 'host_statuses.status', 'aux_vendors.name as vendor_name')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('hosts.tag', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('hosts.domain_suffix', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('hosts.descr', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('hosts.obs', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('hosts.chassis_id', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('hosts.serial_number', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('operating_systems.name',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_types.name',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_statuses.status',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('aux_vendors.name',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//        $hosts = Host::
//            where('hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
//            ->orWhere('tag', "ilike", '%'.$dataForm['pesquisa'].'%')
//            ->orWhere('domain_suffix', "ilike", '%'.$dataForm['pesquisa'].'%')
//            ->orWhere('descr', "ilike", '%'.$dataForm['pesquisa'].'%')
//            ->orWhere('obs', "ilike", '%'.$dataForm['pesquisa'].'%')
//            ->orWhere('chassis_id', "ilike", '%'.$dataForm['pesquisa'].'%')
//            ->orWhere('serial_number', "ilike", '%'.$dataForm['pesquisa'].'%')
//            ->paginate($dataForm['entradas']);

        }elseif(isset($dataForm['entradas'])){
            $hosts = DB::table('hosts')
                ->leftJoin('operating_systems', 'hosts.os_id', '=', 'operating_systems.id')
                ->leftJoin('host_types','hosts.host_type_id','=','host_types.id')
                ->leftJoin('host_statuses','hosts.status_id','=','host_statuses.id')
                ->leftJoin('aux_vendors','hosts.aux_vendor_id','=','aux_vendors.id')
                ->select('hosts.*','operating_systems.name as os_name', 'host_types.name as type_name', 'host_statuses.status', 'aux_vendors.name as vendor_name')
                ->paginate($dataForm['entradas']);
//            $hosts = Host::paginate($dataForm['entradas']);
        }
        else{
            $hosts = DB::table('hosts')
                ->leftJoin('operating_systems', 'hosts.os_id', '=', 'operating_systems.id')
                ->leftJoin('host_types','hosts.host_type_id','=','host_types.id')
                ->leftJoin('host_statuses','hosts.status_id','=','host_statuses.id')
                ->leftJoin('aux_vendors','hosts.aux_vendor_id','=','aux_vendors.id')
                ->select('hosts.*','operating_systems.name as os_name', 'host_types.name as type_name', 'host_statuses.status', 'aux_vendors.name as vendor_name')
                ->paginate(10);
//            $hosts = Host::paginate(10);
        }
        $operating_systems = OperatingSystem::all();
        $host_types = HostType::all();
        $host_status = HostStatus::all();
        $aux_vendors = AuxVendor::all();
        return view('host.crud',compact('hosts','operating_systems','host_types','host_status','aux_vendors', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'os_id'=>'required',
            'host_type_id'=>'required',
            'status_id'=>'required',
            'tag'=>'required',
            'hostname'=>'required',

        ]);
        $host = new Host([
            'os_id' => $request->get('os_id'),
            'host_type_id' => $request->get('host_type_id'),
            'status_id' => $request->get('status_id'),
            'tag' => $request->get('tag'),
            'hostname' => $request->get('hostname'),
            'domain_suffix' => $request->get('domain_suffix'),
            'descr' => $request->get('descr'),
            'obs' => $request->get('obs'),
            'chassis_id' => $request->get('chassis_id'),
            'monitoring' => $request->get('monitoring'),
            'enabled' => $request->get('enabled'),
            'serial_number' => $request->get('serial_number'),
            'aux_vendor_id' => $request->get('aux_vendor_id'),
        ]);
        $host->save();
        return redirect('/host/crud')->with('success', 'Host salvo!');
    }
    public function destroy($id){
        $host = Host::find($id);
        $host->delete();

        return redirect('/host/crud')->with('success', 'Host deletado!');
    }
    public function edit($id){
        $operating_systems = OperatingSystem::all();
        $host_types = HostType::all();
        $host_status = HostStatus::all();
        $hosts = Host::find($id);
        $aux_vendors = AuxVendor::all();
        return view('host.edit', compact('hosts','operating_systems','host_types','host_status','aux_vendors'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'os_id'=>'required',
            'host_type_id'=>'required',
            'status_id'=>'required',
            'tag'=>'required',
            'hostname'=>'required',

        ]);

        $host = Host::find($id);

        $host->os_id = $request->get('os_id');
        $host->host_type_id = $request->get('host_type_id');
        $host->status_id = $request->get('status_id');
        $host->tag = $request->get('tag');
        $host->hostname = $request->get('hostname');
        $host->domain_suffix = $request->get('domain_suffix');
        $host->descr = $request->get('descr');
        $host->obs = $request->get('obs');
        $host->chassis_id = $request->get('chassis_id');
        $host->monitoring = $request->get('monitoring');
        $host->enabled = $request->get('enabled');
        $host->serial_number = $request->get('serial_number');
        $host->aux_vendor_id = $request->get('aux_vendor_id');

        $host->save();

        return redirect('/host/crud')->with('success', 'Host editado!');
    }

}
