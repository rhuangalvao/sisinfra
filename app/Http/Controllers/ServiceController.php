<?php

namespace App\Http\Controllers;

use App\Model\Service;
use App\Model\ServiceGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function create(){
        $service_group = ServiceGroup::all();
        return view('service.create',compact('service_group'));
    }
    public function crud(){
        $services = DB::table('services')
            ->leftJoin('service_groups', 'services.service_group_id', '=', 'service_groups.id')
            ->select('services.*', 'service_groups.name as group_name')
            ->paginate(10);

//        $services = Service::paginate(10);
        $service_group = ServiceGroup::all();
        return view('service.crud',compact('services', 'service_group'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
            $services = DB::table('services')
                ->leftJoin('service_groups', 'services.service_group_id', '=', 'service_groups.id')
                ->select('services.*', 'service_groups.name as group_name')
                ->where('services.name',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('services.daemon_name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('services.protocol', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('services.port', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('service_groups.name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $services = Service::
//            where('name',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('daemon_name', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('protocol', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('port', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $services = DB::table('services')
                ->leftJoin('service_groups', 'services.service_group_id', '=', 'service_groups.id')
                ->select('services.*', 'service_groups.name as group_name')
                ->paginate($dataForm['entradas']);
//            $services = Service::paginate($dataForm['entradas']);
        }
        else{
            $services = DB::table('services')
                ->leftJoin('service_groups', 'services.service_group_id', '=', 'service_groups.id')
                ->select('services.*', 'service_groups.name as group_name')
                ->paginate(10);
//            $services = Service::paginate(10);
        }
        $service_group = ServiceGroup::all();
        return view('service.crud',compact('services', 'service_group', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
//            'daemon_name'=>'required',
//            'protocol'=>'required',
//            'port'=>'required',
//            'service_group_id'=>'required'
        ]);
        $service = new Service([
            'name' => $request->get('name'),
            'daemon_name' => $request->get('daemon_name'),
            'protocol' => $request->get('protocol'),
            'port' => $request->get('port'),
            'service_group_id' => $request->get('service_group_id'),
        ]);
        $service->save();
        return redirect('/service/crud')->with('success', 'Service salvo!');
    }
    public function destroy($id){
        $service = Service::find($id);
        $service->delete();

        return redirect('/service/crud')->with('success', 'Service deletado!');
    }
    public function edit($id){
        $service_group = ServiceGroup::all();
        $service = Service::find($id);
        return view('service.edit', compact('service','service_group'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
//            'daemon_name'=>'required',
//            'protocol'=>'required',
//            'port'=>'required',
//            'service_group_id'=>'required'
        ]);

        $service = Service::find($id);

        $service->name = $request->get('name');
        $service->daemon_name = $request->get('daemon_name');
        $service->protocol = $request->get('protocol');
        $service->port = $request->get('port');
        $service->service_group_id = $request->get('service_group_id');

        $service->save();

        return redirect('/service/crud')->with('success', 'Service editado!');
    }
}
