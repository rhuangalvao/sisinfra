<?php

namespace App\Http\Controllers;

use App\Model\Service_dependency;
use App\Service_instance;
use Illuminate\Http\Request;

class ServiceDependencyController extends Controller
{
    public function create(){
        $service_instance = Service_instance::all();
        return view('service_dependency.create',compact('service_instance'));
    }
    public function crud(){
        $service_dependency = Service_dependency::all();
        return view('service_dependency.crud',compact('service_dependency'));
    }
    public function store(Request $request){

        $request->validate([
            'service_instance_id'=>'required',
            'service_instance_id_dep'=>'required'
        ]);
        $service_dependency = new Service_dependency([
            'service_instance_id' => $request->get('service_instance_id'),
            'service_instance_id_dep' => $request->get('service_instance_id_dep')
        ]);
        $service_dependency->save();
        return redirect('/service_dependency/crud')->with('success', 'Service_dependency salvo!');
    }
    public function destroy($id){
        $service_dependency = Service_dependency::find($id);
        $service_dependency->delete();

        return redirect('/service_dependency/crud')->with('success', 'Service_dependency deletado!');
    }
    public function edit($id){
        $service_instance = Service_instance::all();
        $service_dependency = Service_dependency::find($id);
        return view('service_dependency.edit', compact('service_dependency', 'service_instance'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'service_instance_id'=>'required',
            'service_instance_id_dep'=>'required'
        ]);

        $service_dependency = Service_dependency::find($id);

        $service_dependency->service_instance_id = $request->get('service_instance_id');
        $service_dependency->service_instance_id_dep = $request->get('service_instance_id_dep');

        $service_dependency->save();

        return redirect('/service_dependency/crud')->with('success', 'Service_dependency editado!');
    }
}
