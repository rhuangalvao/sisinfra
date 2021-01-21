<?php

namespace App\Http\Controllers;

use App\Model\ServiceDependency;
use App\Model\ServiceInstance;
use Illuminate\Http\Request;

class ServiceDependencyController extends Controller
{
    public function create(){
        $service_instance = ServiceInstance::all();
        return view('service_dependency.create',compact('service_instance'));
    }
    public function crud(){
        $service_dependencies = ServiceDependency::paginate(10);
        $service_instance = ServiceInstance::all();
        return view('service_dependency.crud',compact('service_dependencies','service_instance'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
            $service_dependencies = ServiceDependency::
            where('service_instance_id',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('service_instance_id_dep', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $service_dependencies = ServiceDependency::paginate($dataForm['entradas']);
        }
        else{
            $service_dependencies = ServiceDependency::paginate(10);
        }
        $service_instance = ServiceInstance::all();
        return view('service_dependency.crud',compact('service_dependencies','service_instance', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'service_instance_id'=>'required',
            'service_instance_id_dep'=>'required'
        ]);
        $service_dependency = new ServiceDependency([
            'service_instance_id' => $request->get('service_instance_id'),
            'service_instance_id_dep' => $request->get('service_instance_id_dep')
        ]);
        $service_dependency->save();
        return redirect('/service_dependency/crud')->with('success', 'Service_dependency salvo!');
    }
    public function destroy($id){
        $service_dependency = ServiceDependency::find($id);
        $service_dependency->delete();

        return redirect('/service_dependency/crud')->with('success', 'Service_dependency deletado!');
    }
    public function edit($id){
        $service_instance = ServiceInstance::all();
        $service_dependency = ServiceDependency::find($id);
        return view('service_dependency.edit', compact('service_dependency', 'service_instance'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'service_instance_id'=>'required',
            'service_instance_id_dep'=>'required'
        ]);

        $service_dependency = ServiceDependency::find($id);

        $service_dependency->service_instance_id = $request->get('service_instance_id');
        $service_dependency->service_instance_id_dep = $request->get('service_instance_id_dep');

        $service_dependency->save();

        return redirect('/service_dependency/crud')->with('success', 'Service_dependency editado!');
    }
}
