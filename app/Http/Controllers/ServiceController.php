<?php

namespace App\Http\Controllers;

use App\Model\Service;
use App\Model\ServiceGroup;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function create(){
        $service_group = ServiceGroup::all();
        return view('service.create',compact('service_group'));
    }
    public function crud(){
        $service = Service::all();
        $service_group = ServiceGroup::all();
        return view('service.crud',compact('service', 'service_group'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'daemon_name'=>'required',
            'protocol'=>'required',
            'port'=>'required',
            'service_group_id'=>'required'
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
            'daemon_name'=>'required',
            'protocol'=>'required',
            'port'=>'required',
            'service_group_id'=>'required'
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
