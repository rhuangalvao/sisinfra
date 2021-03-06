<?php

namespace App\Http\Controllers;

use App\Host;
use App\Host_ip;
use Illuminate\Http\Request;

class HostIpController extends Controller
{
    public function create(){
        $host = Host::all();
        return view('host_ip.create',compact('host'));
    }
    public function crud(){
        $host_ip = Host_ip::all();
        return view('host_ip.crud',compact('host_ip'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'ip_address'=>'required',
            'mask'=>'required',
            'gateway'=>'required',
            'version'=>'required',
            'mac_address'=>'required',
        ]);
        $host_ip = new Host_ip([
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
        $host_ip = Host_ip::find($id);
        $host_ip->delete();

        return redirect('/host_ip/crud')->with('success', 'host_ip deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $host_ip = Host_ip::find($id);
        return view('host_ip.edit', compact('host_ip','host'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'ip_address'=>'required',
            'mask'=>'required',
            'gateway'=>'required',
            'version'=>'required',
            'mac_address'=>'required',
        ]);

        $host_ip = Host_ip::find($id);

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
