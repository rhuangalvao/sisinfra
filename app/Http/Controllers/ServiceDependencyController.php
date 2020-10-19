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
        $service_dependency = ServiceDependency::all();
        return view('service_dependency.crud',compact('service_dependency'));
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
