<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostIpController extends Controller
{
    public function create(){
        $hosts = Host::all();
        return view('host_ip.create',compact('hosts'));
    }
    public function crud(){

        $host_ips = DB::table('host_ips')
            ->leftJoin('hosts', 'host_ips.host_id', '=', 'hosts.id')
            ->select('host_ips.*', 'hosts.hostname')
            ->paginate(10);

//        $host_ips = HostIp::paginate(10);
        $hosts = Host::all();
        return view('host_ip.crud',compact('host_ips','hosts'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $host_ips = DB::table('host_ips')
                ->leftJoin('hosts', 'host_ips.host_id', '=', 'hosts.id')
                ->select('host_ips.*', 'hosts.hostname')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_ips.ip_address', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_ips.mask', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_ips.gateway', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_ips.version', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_ips.mac_address', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $host_ips = HostIp::
//            where('host_id',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('ip_address', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('mask', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('gateway', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('version', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('mac_address', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $host_ips = DB::table('host_ips')
                ->leftJoin('hosts', 'host_ips.host_id', '=', 'hosts.id')
                ->select('host_ips.*', 'hosts.hostname')
                ->paginate($dataForm['entradas']);
//            $host_ips = HostIp::paginate($dataForm['entradas']);
        }
        else{
            $host_ips = DB::table('host_ips')
                ->leftJoin('hosts', 'host_ips.host_id', '=', 'hosts.id')
                ->select('host_ips.*', 'hosts.hostname')
                ->paginate(10);
//            $host_ips = HostIp::paginate(10);
        }
        $hosts = Host::all();
        return view('host_ip.crud',compact('host_ips','hosts', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'ip_address'=>'required',
            'mask'=>'required',
//            'gateway'=>'required',
            'version'=>'required',
//            'mac_address'=>'required',
        ]);
        $host_ip = new HostIp([
            'host_id' => $request->get('host_id'),
            'ip_address' => $request->get('ip_address'),
            'mask' => $request->get('mask'),
            'gateway' => $request->get('gateway'),
            'version' => $request->get('version'),
            'mac_address' => $request->get('mac_address'),
            'is_main' => $request->get('is_main'),
        ]);
        $host_ip->save();
        return redirect('/host_ip/crud')->with('success', 'host_ip salvo!');
    }
    public function destroy($id){
        $host_ip = HostIp::find($id);
        $host_ip->delete();

        return redirect('/host_ip/crud')->with('success', 'host_ip deletado!');
    }
    public function edit($id){
        $hosts = Host::all();
        $host_ips = HostIp::find($id);
        return view('host_ip.edit', compact('host_ips','hosts'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'ip_address'=>'required',
            'mask'=>'required',
//            'gateway'=>'required',
            'version'=>'required',
//            'mac_address'=>'required',
        ]);

        $host_ip = HostIp::find($id);

        $host_ip->host_id = $request->get('host_id');
        $host_ip->ip_address = $request->get('ip_address');
        $host_ip->mask = $request->get('mask');
        $host_ip->gateway = $request->get('gateway');
        $host_ip->version = $request->get('version');
        $host_ip->mac_address = $request->get('mac_address');
        $host_ip->is_main = $request->get('is_main');

        $host_ip->save();

        return redirect('/host_ip/crud')->with('success', 'host_ip editado!');
    }
}
