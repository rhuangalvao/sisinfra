<?php

namespace App\Http\Controllers;

use App\Model\Oxidized_map_os;
use Illuminate\Http\Request;

class OxidizedMapOsController extends Controller
{
    public function create(){
        return view('oxidized_map_os.create');
    }
    public function crud(){
        $oxidized_map_os = Oxidized_map_os::all();
        return view('oxidized_map_os.crud',compact('oxidized_map_os'));
    }
    public function store(Request $request){

        $request->validate([
            'oxidized_instance_id'=>'required',
            'operating_system_id'=>'required',
            'oxidized_os'=>'required'
        ]);
        $oxidized_map_os = new Oxidized_map_os([
            'oxidized_instance_id' => $request->get('oxidized_instance_id'),
            'operating_system_id' => $request->get('operating_system_id'),
            'oxidized_os' => $request->get('oxidized_os'),
        ]);
        $oxidized_map_os->save();
        return redirect('/oxidized_map_os/crud')->with('success', 'Oxidized_map_os salvo!');
    }
    public function destroy($id){
        $oxidized_map_os = Oxidized_map_os::find($id);
        $oxidized_map_os->delete();

        return redirect('/oxidized_map_os/crud')->with('success', 'Oxidized_map_os deletado!');
    }
    public function edit($id){
        $oxidized_map_os = Oxidized_map_os::find($id);
        return view('oxidized_map_os.edit', compact('oxidized_map_os'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'oxidized_instance_id'=>'required',
            'operating_system_id'=>'required',
            'oxidized_os'=>'required'
        ]);

        $oxidized_map_os = Oxidized_map_os::find($id);

        $oxidized_map_os->oxidized_instance_id = $request->get('oxidized_instance_id');
        $oxidized_map_os->operating_system_id = $request->get('operating_system_id');
        $oxidized_map_os->oxidized_os = $request->get('oxidized_os');

        $oxidized_map_os->save();

        return redirect('/oxidized_map_os/crud')->with('success', 'Oxidized_map_os editado!');
    }
}
