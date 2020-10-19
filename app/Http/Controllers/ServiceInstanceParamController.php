<?php

namespace App\Http\Controllers;

use App\Model\ServiceInstance;
use App\Model\ServiceInstanceParam;
use Illuminate\Http\Request;

class ServiceInstanceParamController extends Controller
{
    public function create(){
        $service_instance = ServiceInstance::all();
        return view('service_instance_param.create',compact('service_instance'));
    }
    public function crud(){
        $service_instance_param = ServiceInstanceParam::all();
        $service_instance = ServiceInstance::all();
        return view('service_instance_param.crud',compact('service_instance_param', 'service_instance'));
    }
    public function store(Request $request){

        $request->validate([
            'service_instance_id'=>'required',
            'param_name'=>'required',
            'param_value'=>'required',
        ]);
        $service_instance_param = new ServiceInstanceParam([
            'service_instance_id' => $request->get('service_instance_id'),
            'param_name' => $request->get('param_name'),
            'param_value' => $request->get('param_value'),
            'enabled' => $request->get('enabled'),
        ]);
        $service_instance_param->save();
        return redirect('/service_instance_param/crud')->with('success', 'service_instance_param salvo!');
    }
    public function destroy($id){
        $service_instance_param = ServiceInstanceParam::find($id);
        $service_instance_param->delete();

        return redirect('/service_instance_param/crud')->with('success', 'service_instance_param deletado!');
    }
    public function edit($id){
        $service_instance = ServiceInstance::all();
        $service_instance_param = ServiceInstanceParam::find($id);
        return view('service_instance_param.edit', compact('service_instance_param','service_instance'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'service_instance_id'=>'required',
            'param_name'=>'required',
            'param_value'=>'required',
        ]);

        $service_instance_param = ServiceInstanceParam::find($id);

        $service_instance_param->service_instance_id = $request->get('service_instance_id');
        $service_instance_param->param_name = $request->get('param_name');
        $service_instance_param->param_value = $request->get('param_value');
        $service_instance_param->enabled = $request->get('enabled');

        $service_instance_param->save();

        return redirect('/service_instance_param/crud')->with('success', 'service_instance_param editado!');
    }
}
