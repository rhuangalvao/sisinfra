<?php

namespace App\Http\Controllers;

use App\Host_type;
use Illuminate\Http\Request;

class HostTypeController extends Controller
{
    public function create(){
        return view('host_type.create');
    }
    public function crud(){
        $host_type = Host_type::all();
        return view('host_type.crud',compact('host_type'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'tag_prefix'=>'required',
        ]);
        $host_type = new host_type([
            'name' => $request->get('name'),
            'tag_prefix' => $request->get('tag_prefix'),
        ]);
        $host_type->save();
        return redirect('/host_type/crud')->with('success', 'host_type salvo!');
    }
    public function destroy($id){
        $host_type = Host_type::find($id);
        $host_type->delete();

        return redirect('/host_type/crud')->with('success', 'host_type deletado!');
    }
    public function edit($id){
        $host_type = Host_type::find($id);
        return view('host_type.edit', compact('host_type'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'tag_prefix'=>'required',
        ]);

        $host_type = Host_type::find($id);

        $host_type->name = $request->get('name');
        $host_type->tag_prefix = $request->get('tag_prefix');

        $host_type->save();

        return redirect('/host_type/crud')->with('success', 'host_type editado!');
    }
}
