<?php

namespace App\Http\Controllers;

use App\Model\ServiceGroup;
use Illuminate\Http\Request;

class ServiceGroupController extends Controller
{
    public function create(){
        return view('service_group.create');
    }
    public function crud(){
        $service_groups = ServiceGroup::paginate(10);
        return view('service_group.crud',compact('service_groups'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'descr'=>'required'
        ]);
        $service_group = new ServiceGroup([
            'name' => $request->get('name'),
            'descr' => $request->get('descr')
        ]);
        $service_group->save();
        return redirect('/service_group/crud')->with('success', 'Service_group salvo!');
    }
    public function destroy($id){
        $service_group = ServiceGroup::find($id);
        $service_group->delete();

        return redirect('/service_group/crud')->with('success', 'Service_group deletado!');
    }
    public function edit($id){
        $service_group = ServiceGroup::find($id);
        return view('service_group.edit', compact('service_group'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'descr'=>'required'
        ]);

        $service_group = ServiceGroup::find($id);

        $service_group->name = $request->get('name');
        $service_group->descr = $request->get('descr');

        $service_group->save();

        return redirect('/service_group/crud')->with('success', 'Service_group editado!');
    }
}
