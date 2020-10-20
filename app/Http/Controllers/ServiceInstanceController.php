<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostDns;
use App\Model\HostIp;
use App\Model\Password;
use App\Model\Service;
use App\Model\ServiceInstance;
use Illuminate\Http\Request;

class ServiceInstanceController extends Controller
{
    public function create(){
        $host = Host::all();
        $service = Service::all();
        $host_ip = HostIp::all();
        $host_dns = HostDns::all();
        $password = Password::all();
        return view('service_instance.create',compact('host','service','host_ip','host_dns','password'));
    }
    public function crud(){
        $service_instance = ServiceInstance::all();
        $host = Host::all();
        $service = Service::all();
        $host_ip = HostIp::all();
        $host_dns = HostDns::all();
        $password = Password::all();
        return view('service_instance.crud',compact('service_instance','host','service','host_ip','host_dns','password'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'service_id'=>'required',
            'host_ip_id'=>'required',
            'host_dns_id'=>'required',
            'descr'=>'required',
            'password_id'=>'required',
        ]);
        $service_instance = new ServiceInstance([
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
        $service_instance = ServiceInstance::find($id);
        $service_instance->delete();

        return redirect('/service_instance/crud')->with('success', 'service_instance deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $service = Service::all();
        $host_ip = Host_ip::all();
        $host_dns = HostDns::all();
        $password = Password::all();
        $service_instance = ServiceInstance::find($id);
        return view('service_instance.edit', compact('service_instance','host','service','host_ip','host_dns','password'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'service_id'=>'required',
            'host_ip_id'=>'required',
            'host_dns_id'=>'required',
            'descr'=>'required',
            'password_id'=>'required',
        ]);

        $service_instance = ServiceInstance::find($id);

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
