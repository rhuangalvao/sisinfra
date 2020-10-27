<?php

namespace App\Http\Controllers;

use App\Model\OperatingSystem;
use Illuminate\Http\Request;

class OperatingSystemController extends Controller
{
    public function create(){
        return view('operating_system.create');
    }
    public function crud(){
        $operating_systems = OperatingSystem::paginate(10);
        return view('operating_system.crud',compact('operating_systems'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'version'=>'required'
        ]);
        $operating_system = new OperatingSystem([
            'name' => $request->get('name'),
            'version' => $request->get('version'),
        ]);
        $operating_system->save();
        return redirect('/operating_system/crud')->with('success', 'operating_system salvo!');
    }
    public function destroy($id){
        $operating_system = OperatingSystem::find($id);
        $operating_system->delete();

        return redirect('/operating_system/crud')->with('success', 'operating_system deletado!');
    }
    public function edit($id){
        $operating_system = OperatingSystem::find($id);
        return view('operating_system.edit', compact('operating_system'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'version'=>'required'
        ]);

        $operating_system = OperatingSystem::find($id);

        $operating_system->name = $request->get('name');
        $operating_system->version = $request->get('version');

        $operating_system->save();

        return redirect('/operating_system/crud')->with('success', 'operating_system editado!');
    }
}
