<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostMap;
use App\Model\SnmpHost;
use Illuminate\Http\Request;

class HostMapController extends Controller
{
    public function create(){
        $host = Host::all();
        $snmp_host = SnmpHost::all();
        return view('host_map.create',compact('host','snmp_host'));
    }
    public function crud(){
        $host_map = HostMap::all();
        $host = Host::all();
        $snmp_host = SnmpHost::all();
        return view('host_map.crud',compact('host_map','host','snmp_host'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'snmp_host_id'=>'required',
            'snmp_host_remote_id'=>'required',
        ]);
        $host_map = new HostMap([
            'host_id' => $request->get('host_id'),
            'snmp_host_id' => $request->get('snmp_host_id'),
            'snmp_host_remote_id' => $request->get('snmp_host_remote_id'),
        ]);
        $host_map->save();
        return redirect('/host_map/crud')->with('success', 'host_map salvo!');
    }
    public function destroy($id){
        $host_map = HostMap::find($id);
        $host_map->delete();

        return redirect('/host_map/crud')->with('success', 'host_map deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $snmp_host = SnmpHost::all();
        $host_map = HostMap::find($id);
        return view('host_map.edit', compact('host_map','host','snmp_host'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'snmp_host_id'=>'required',
            'snmp_host_remote_id'=>'required',
        ]);

        $host_map = HostMap::find($id);

        $host_map->host_id = $request->get('host_id');
        $host_map->snmp_host_id = $request->get('snmp_host_id');
        $host_map->snmp_host_remote_id = $request->get('snmp_host_remote_id');

        $host_map->save();

        return redirect('/host_map/crud')->with('success', 'host_map editado!');
    }

}
