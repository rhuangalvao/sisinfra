<?php

namespace App\Http\Controllers;

use App\Service_instance;
use Illuminate\Http\Request;

class ServiceInstanceController extends Controller
{
    public function create(){
        return view('service_instance.create');
    }
    public function crud(){
        $service_instance = Service_instance::all();
        return view('service_instance.crud',compact('service_instance'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id',
            'service_id',
            'host_ip_id',
            'host_dns_id',
            'descr',
            'password_id',
        ]);
        $service_instance = new service_instance([
            'host_id' => $request->get('host_id'),
            'service_id' => $request->get('service_id'),
            'host_ip_id' => $request->get('host_ip_id'),
            'host_dns_id' => $request->get('host_dns_id'),
            'descr' => $request->get('descr'),
            'password_id' => $request->get('password_id'),
        ]);
        $service_instance->save();
        return redirect('/service_instance/crud')->with('success', 'service_instance salvo!');
    }
    public function destroy($id){
        $service_instance = Service_instance::find($id);
        $service_instance->delete();

        return redirect('/service_instance/crud')->with('success', 'service_instance deletado!');
    }
    public function edit($id){
        $service_instance = Service_instance::find($id);
        return view('service_instance.edit', compact('service_instance'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id',
            'service_id',
            'host_ip_id',
            'host_dns_id',
            'descr',
            'password_id',
        ]);

        $service_instance = Service_instance::find($id);

        $service_instance->host_id = $request->get('host_id');
        $service_instance->service_id = $request->get('service_id');
        $service_instance->host_ip_id = $request->get('host_ip_id');
        $service_instance->host_dns_id = $request->get('host_dns_id');
        $service_instance->descr = $request->get('descr');
        $service_instance->password_id = $request->get('password_id');

        $service_instance->save();

        return redirect('/service_instance/crud')->with('success', 'service_instance editado!');
    }
}
