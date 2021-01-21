<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostDns;
use App\Model\HostIp;
use App\Model\Password;
use App\Model\Service;
use App\Model\ServiceInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $service_instances = DB::table('service_instances')
            ->leftJoin('hosts', 'service_instances.host_id', '=', 'hosts.id')
            ->leftJoin('services', 'service_instances.service_id', '=', 'services.id')
            ->leftJoin('host_ips', 'service_instances.host_ip_id', '=', 'host_ips.id')
            ->leftJoin('host_dns', 'service_instances.host_dns_id', '=', 'host_dns.id')
            ->leftJoin('passwords', 'service_instances.password_id', '=', 'passwords.id')
            ->select('service_instances.*','hosts.hostname', 'services.name as service_name', 'host_ips.ip_address', 'host_dns.name as dns_name','passwords.name as password_name')
            ->paginate(10);

//        $service_instances = ServiceInstance::paginate(10);
        $host = Host::all();
        $service = Service::all();
        $host_ip = HostIp::all();
        $host_dns = HostDns::all();
        $password = Password::all();
        return view('service_instance.crud',compact('service_instances','host','service','host_ip','host_dns','password'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $service_instances = DB::table('service_instances')
                ->leftJoin('hosts', 'service_instances.host_id', '=', 'hosts.id')
                ->leftJoin('services', 'service_instances.service_id', '=', 'services.id')
                ->leftJoin('host_ips', 'service_instances.host_ip_id', '=', 'host_ips.id')
                ->leftJoin('host_dns', 'service_instances.host_dns_id', '=', 'host_dns.id')
                ->leftJoin('passwords', 'service_instances.password_id', '=', 'passwords.id')
                ->select('service_instances.*','hosts.hostname', 'services.name as service_name', 'host_ips.ip_address', 'host_dns.name as dns_name','passwords.name as password_name')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('services.protocol', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_ips.ip_address', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_dns.name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('service_instances.descr', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('passwords.name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $service_instances = Host::
//            where('host_id',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('service_id', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('host_ip_id', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('host_dns_id', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('descr', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('password_id', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);

        }elseif(isset($dataForm['entradas'])){
            $service_instances = DB::table('service_instances')
                ->leftJoin('hosts', 'service_instances.host_id', '=', 'hosts.id')
                ->leftJoin('services', 'service_instances.service_id', '=', 'services.id')
                ->leftJoin('host_ips', 'service_instances.host_ip_id', '=', 'host_ips.id')
                ->leftJoin('host_dns', 'service_instances.host_dns_id', '=', 'host_dns.id')
                ->leftJoin('passwords', 'service_instances.password_id', '=', 'passwords.id')
                ->select('service_instances.*','hosts.hostname', 'services.name as service_name', 'host_ips.ip_address', 'host_dns.name as dns_name','passwords.name as password_name')
                ->paginate($dataForm['entradas']);
//            $service_instances = Host::paginate($dataForm['entradas']);
        }
        else{
            $service_instances = DB::table('service_instances')
                ->leftJoin('hosts', 'service_instances.host_id', '=', 'hosts.id')
                ->leftJoin('services', 'service_instances.service_id', '=', 'services.id')
                ->leftJoin('host_ips', 'service_instances.host_ip_id', '=', 'host_ips.id')
                ->leftJoin('host_dns', 'service_instances.host_dns_id', '=', 'host_dns.id')
                ->leftJoin('passwords', 'service_instances.password_id', '=', 'passwords.id')
                ->select('service_instances.*','hosts.hostname', 'services.name as service_name', 'host_ips.ip_address', 'host_dns.name as dns_name','passwords.name as password_name')
                ->paginate(10);
//            $service_instances = Host::paginate(10);
        }
        $host = Host::all();
        $service = Service::all();
        $host_ip = HostIp::all();
        $host_dns = HostDns::all();
        $password = Password::all();
        return view('service_instance.crud',compact('service_instances','host','service','host_ip','host_dns','password', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'service_id'=>'required',
//            'host_ip_id'=>'required',
//            'host_dns_id'=>'required',
//            'descr'=>'required',
            'password_id'=>'required',
        ]);
        if($request->get('host_ip_id')!=null){
            $service_instance = new ServiceInstance([
                'host_id' => $request->get('host_id'),
                'service_id' => $request->get('service_id'),
                'host_ip_id' => $request->get('host_ip_id'),
                'host_dns_id' => null,
                'descr' => $request->get('descr'),
                'password_id' => $request->get('password_id'),
                'monitoring' => $request->get('monitoring'),
            ]);
        }else{
            $service_instance = new ServiceInstance([
                'host_id' => $request->get('host_id'),
                'service_id' => $request->get('service_id'),
                'host_ip_id' => null,
                'host_dns_id' => $request->get('host_dns_id'),
                'descr' => $request->get('descr'),
                'password_id' => $request->get('password_id'),
                'monitoring' => $request->get('monitoring'),
            ]);
        }

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
        $host_ip = HostIp::all();
        $host_dns = HostDns::all();
        $password = Password::all();
        $service_instance = ServiceInstance::find($id);
        return view('service_instance.edit', compact('service_instance','host','service','host_ip','host_dns','password'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'service_id'=>'required',
//            'host_ip_id'=>'required',
//            'host_dns_id'=>'required',
//            'descr'=>'required',
            'password_id'=>'required',
        ]);

        $service_instance = ServiceInstance::find($id);

        if($request->get('host_ip_id')!=null) {
            $service_instance->host_id = $request->get('host_id');
            $service_instance->service_id = $request->get('service_id');
            $service_instance->host_ip_id = $request->get('host_ip_id');
            $service_instance->host_dns_id = null;
            $service_instance->descr = $request->get('descr');
            $service_instance->password_id = $request->get('password_id');
            $service_instance->monitoring = $request->get('monitoring');
        }else{
            $service_instance->host_id = $request->get('host_id');
            $service_instance->service_id = $request->get('service_id');
            $service_instance->host_ip_id = null;
            $service_instance->host_dns_id = $request->get('host_dns_id');
            $service_instance->descr = $request->get('descr');
            $service_instance->password_id = $request->get('password_id');
            $service_instance->monitoring = $request->get('monitoring');
        }
        $service_instance->save();

        return redirect('/service_instance/crud')->with('success', 'service_instance editado!');
    }
}
