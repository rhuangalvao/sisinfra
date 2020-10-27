<?php

namespace App\Http\Controllers;

use App\Model\NetworkType;
use Illuminate\Http\Request;

class NetworkTypeController extends Controller
{
    public function create(){
        return view('network_type.create');
    }
    public function crud(){
        $network_types = NetworkType::paginate(10);
        return view('network_type.crud',compact('network_types'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'descr'=>'required',
        ]);
        $network_type = new NetworkType([
            'name' => $request->get('name'),
            'descr' => $request->get('descr'),
        ]);
        $network_type->save();
        return redirect('/network_type/crud')->with('success', 'network_type salvo!');
    }
    public function destroy($id){
        $network_type = NetworkType::find($id);
        $network_type->delete();

        return redirect('/network_type/crud')->with('success', 'network_type deletado!');
    }
    public function edit($id){
        $network_type = NetworkType::find($id);
        return view('network_type.edit', compact('network_type'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'descr'=>'required',
        ]);

        $network_type = NetworkType::find($id);

        $network_type->name = $request->get('name');
        $network_type->descr = $request->get('descr');

        $network_type->save();

        return redirect('/network_type/crud')->with('success', 'network_type editado!');
    }
}
