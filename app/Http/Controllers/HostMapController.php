<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostMap;
use App\Model\SnmpHost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostMapController extends Controller
{
    public function create(){
        $host = Host::all();
        $snmp_host = SnmpHost::all();
        return view('host_map.create',compact('host','snmp_host'));
    }
    public function crud(){
        $host_maps = DB::table('host_maps')
            ->leftJoin('hosts', 'host_maps.host_id', '=', 'hosts.id')
            ->leftJoin('snmp_hosts', 'host_maps.snmp_host_id', '=', 'snmp_hosts.id')
            ->leftJoin('snmp_host_remotes', 'host_maps.snmp_host_remote_id', '=', 'snmp_host_remotes.id')
            ->select('host_maps.*', 'hosts.hostname','snmp_hosts.sysname','snmp_host_remotes.sysname as host_remote')
            ->paginate(10);
        return view('host_map.crud',compact('host_maps'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $host_maps = DB::table('host_maps')
                ->leftJoin('hosts', 'host_maps.host_id', '=', 'hosts.id')
                ->leftJoin('snmp_hosts', 'host_maps.snmp_host_id', '=', 'snmp_hosts.id')
                ->leftJoin('snmp_host_remotes', 'host_maps.snmp_host_remote_id', '=', 'snmp_host_remotes.id')
                ->select('host_maps.*', 'hosts.hostname','snmp_hosts.sysname','snmp_host_remotes.sysname as host_remote')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('snmp_hosts.sysname', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('snmp_host_remotes.sysname', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

        }elseif(isset($dataForm['entradas'])){
            $host_maps = DB::table('host_maps')
                ->leftJoin('hosts', 'host_maps.host_id', '=', 'hosts.id')
                ->leftJoin('snmp_hosts', 'host_maps.snmp_host_id', '=', 'snmp_hosts.id')
                ->leftJoin('snmp_host_remotes', 'host_maps.snmp_host_remote_id', '=', 'snmp_host_remotes.id')
                ->select('host_maps.*', 'hosts.hostname','snmp_hosts.sysname','snmp_host_remotes.sysname as host_remote')
                ->paginate($dataForm['entradas']);
        }
        else{
            $host_maps = DB::table('host_maps')
                ->leftJoin('hosts', 'host_maps.host_id', '=', 'hosts.id')
                ->leftJoin('snmp_hosts', 'host_maps.snmp_host_id', '=', 'snmp_hosts.id')
                ->leftJoin('snmp_host_remotes', 'host_maps.snmp_host_remote_id', '=', 'snmp_host_remotes.id')
                ->select('host_maps.*', 'hosts.hostname','snmp_hosts.sysname','snmp_host_remotes.sysname as host_remote')
                ->paginate(10);
        }
        return view('host_map.crud',compact('host_maps', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
//            'snmp_host_id'=>'required',
//            'snmp_host_remote_id'=>'required',
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
//            'snmp_host_id'=>'required',
//            'snmp_host_remote_id'=>'required',
        ]);

        $host_map = HostMap::find($id);

        $host_map->host_id = $request->get('host_id');
        $host_map->snmp_host_id = $request->get('snmp_host_id');
        $host_map->snmp_host_remote_id = $request->get('snmp_host_remote_id');

        $host_map->save();

        return redirect('/host_map/crud')->with('success', 'host_map editado!');
    }

}
