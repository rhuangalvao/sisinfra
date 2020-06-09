<?php

namespace App\Http\Controllers;

use App\Host_dns;
use Illuminate\Http\Request;

class HostDnsController extends Controller
{
    public function create(){
        return view('host_dns.create');
    }
    public function crud(){
        $host_dns = Host_dns::all();
        return view('host_dns.crud',compact('host_dns'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'name'=>'required',
            'version'=>'required',
        ]);
        $host_dns = new Host_dns([
            'host_id' => $request->get('host_id'),
            'name' => $request->get('name'),
            'version' => $request->get('version'),
        ]);
        $host_dns->save();
        return redirect('/host_dns/crud')->with('success', 'host_dns salvo!');
    }
    public function destroy($id){
        $host_dns = Host_dns::find($id);
        $host_dns->delete();

        return redirect('/host_dns/crud')->with('success', 'host_dns deletado!');
    }
    public function edit($id){
        $host_dns = Host_dns::find($id);
        return view('host_dns.edit', compact('host_dns'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'name'=>'required',
            'version'=>'required',
        ]);

        $host_dns = Host_dns::find($id);

        $host_dns->host_id = $request->get('host_id');
        $host_dns->name = $request->get('name');
        $host_dns->version = $request->get('version');

        $host_dns->save();

        return redirect('/host_dns/crud')->with('success', 'host_dns editado!');
    }
}
