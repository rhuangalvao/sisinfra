<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostIp;
use Illuminate\Http\Request;

class HostIpController extends Controller
{
    public function create(){
        $hosts = Host::all();
        return view('host_ip.create',compact('hosts'));
    }
    public function crud(){
        $host_ips = HostIp::paginate(10);
        $hosts = Host::all();
        return view('host_ip.crud',compact('host_ips','hosts'));
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
