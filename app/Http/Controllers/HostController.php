<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\OperatingSystem;
use App\Model\HostType;
use App\Model\HostStatus;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function create(){
        $operating_system = OperatingSystem::all();
        $host_type = HostType::all();
        $host_status = HostStatus::all();
        return view('host.create',compact('operating_system','host_type','host_status'));
    }
    public function crud(){
        $host = Host::all();
        $operating_system = OperatingSystem::all();
        $host_type = HostType::all();
        $host_status = HostStatus::all();
        return view('host.crud',compact('host', 'operating_system','host_type','host_status'));
    }
    public function store(Request $request){

        $request->validate([
            'os_id'=>'required',
            'host_type_id'=>'required',
            'status_id'=>'required',
            'tag'=>'required',
            'hostname'=>'required',
            'domain_suffix'=>'required',
            'descr'=>'required',
            'obs'=>'required',
            'chassis_id'=>'required',
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
        $operating_system = OperatingSystem::all();
        $host_type = HostType::all();
        $host_status = HostStatus::all();
        $host = Host::find($id);
        return view('host.edit', compact('host','operating_system','host_type','host_status'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'os_id'=>'required',
            'host_type_id'=>'required',
            'status_id'=>'required',
            'tag'=>'required',
            'hostname'=>'required',
            'domain_suffix'=>'required',
            'descr'=>'required',
            'obs'=>'required',
            'chassis_id'=>'required',
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

        $host->save();

        return redirect('/host/crud')->with('success', 'Host editado!');
    }

}
