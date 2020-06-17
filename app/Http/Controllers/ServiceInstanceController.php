<?php

namespace App\Http\Controllers;

use App\Host;
use App\Host_dns;
use App\Host_ip;
use App\Model\Service;
use App\Service_instance;
use Illuminate\Http\Request;

class ServiceInstanceController extends Controller
{
    public function create(){
        $host = Host::all();
        $service = Service::all();
        $host_ip = Host_ip::all();
        $host_dns = Host_dns::all();
        return view('service_instance.create',compact('host','service','host_ip','host_dns'));
    }
    public function crud(){
        $service_instance = Service_instance::all();
        return view('service_instance.crud',compact('service_instance'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'service_id'=>'required',
            'host_ip_id'=>'required',
            'host_dns_id'=>'required',
            'descr'=>'required',
            'password_id'=>'required',
            'monitoring'=>'required',
        ]);
        $service_instance = new service_instance([
            'host_id' => $request->get('host_id'),
            'service_id' => $request->get('service_id'),
            'host_ip_id' => $request->get('host_ip_id'),
            'host_dns_id' => $request->get('host_dns_id'),
            'descr' => $request->get('descr'),
            'password_id' => $request->get('password_id'),
            'monitoring' => $request->get('monitoring'),
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
        $host = Host::all();
        $service = Service::all();
        $host_ip = Host_ip::all();
        $host_dns = Host_dns::all();
        $service_instance = Service_instance::find($id);
        return view('service_instance.edit', compact('service_instance','host','service','host_ip','host_dns'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'service_id'=>'required',
            'host_ip_id'=>'required',
            'host_dns_id'=>'required',
            'descr'=>'required',
            'password_id'=>'required',
            'monitoring'=>'required',
        ]);

        $service_instance = Service_instance::find($id);

        $service_instance->host_id = $request->get('host_id');
        $service_instance->service_id = $request->get('service_id');
        $service_instance->host_ip_id = $request->get('host_ip_id');
        $service_instance->host_dns_id = $request->get('host_dns_id');
        $service_instance->descr = $request->get('descr');
        $service_instance->password_id = $request->get('password_id');
        $service_instance->monitoring = $request->get('monitoring');

        $service_instance->save();

        return redirect('/service_instance/crud')->with('success', 'service_instance editado!');
    }
}
