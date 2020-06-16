<?php

namespace App\Http\Controllers;

use App\Model\Service_group;
use Illuminate\Http\Request;

class ServiceGroupController extends Controller
{
    public function create(){
        return view('service_group.create');
    }
    public function crud(){
        $service_group = Service_group::all();
        return view('service_group.crud',compact('service_group'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'descr'=>'required'
        ]);
        $service_group = new Service_group([
            'name' => $request->get('name'),
            'descr' => $request->get('descr')
        ]);
        $service_group->save();
        return redirect('/service_group/crud')->with('success', 'Service_group salvo!');
    }
    public function destroy($id){
        $service_group = Service_group::find($id);
        $service_group->delete();

        return redirect('/service_group/crud')->with('success', 'Service_group deletado!');
    }
    public function edit($id){
        $service_group = Service_group::find($id);
        return view('service_group.edit', compact('service_group'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'descr'=>'required'
        ]);

        $service_group = Service_group::find($id);

        $service_group->name = $request->get('name');
        $service_group->descr = $request->get('descr');

        $service_group->save();

        return redirect('/service_group/crud')->with('success', 'Service_group editado!');
    }
}
