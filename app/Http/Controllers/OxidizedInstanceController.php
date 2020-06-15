<?php

namespace App\Http\Controllers;

use App\Model\Oxidized_instance;
use Illuminate\Http\Request;

class OxidizedInstanceController extends Controller
{
    public function create(){
        return view('oxidized_instance.create');
    }
    public function crud(){
        $oxidized_instance = Oxidized_instance::all();
        return view('oxidized_instance.crud',compact('oxidized_instance'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'url'=>'required'
        ]);
        $oxidized_instance = new Oxidized_instance([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
        ]);
        $oxidized_instance->save();
        return redirect('/oxidized_instance/crud')->with('success', 'Oxidized_instance salvo!');
    }
    public function destroy($id){
        $oxidized_instance = Oxidized_instance::find($id);
        $oxidized_instance->delete();

        return redirect('/oxidized_instance/crud')->with('success', 'Oxidized_instance deletado!');
    }
    public function edit($id){
        $oxidized_instance = Oxidized_instance::find($id);
        return view('oxidized_instance.edit', compact('oxidized_instance'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'url'=>'required'
        ]);

        $oxidized_instance = Oxidized_instance::find($id);

        $oxidized_instance->name = $request->get('name');
        $oxidized_instance->url = $request->get('url');

        $oxidized_instance->save();

        return redirect('/oxidized_instance/crud')->with('success', 'Oxidized_instance editado!');
    }
}
