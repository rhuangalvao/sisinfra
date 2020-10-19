<?php

namespace App\Http\Controllers;

use App\Model\Network;
use App\Model\NetworkType;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function create(){
        $network_type = NetworkType::all();
        return view('network.create',compact('network_type'));
    }
    public function crud(){
        $network_type = NetworkType::all();
        $network = Network::all();
        return view('network.crud',compact('network','network_type'));
    }
    public function store(Request $request){

        $request->validate([
            'network_type_id'=>'required',
            'name'=>'required',
            'descr'=>'required',
            'address'=>'required',
        ]);
        $network = new Network([
            'network_type_id' => $request->get('network_type_id'),
            'name' => $request->get('name'),
            'descr' => $request->get('descr'),
            'address' => $request->get('address'),
            'enabled' => $request->get('enabled'),
        ]);
        $network->save();
        return redirect('/network/crud')->with('success', 'network salvo!');
    }
    public function destroy($id){
        $network = Network::find($id);
        $network->delete();

        return redirect('/network/crud')->with('success', 'network deletado!');
    }
    public function edit($id){
        $network_type = NetworkType::all();
        $network = Network::find($id);
        return view('network.edit', compact('network','network_type'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'network_type_id'=>'required',
            'name'=>'required',
            'descr'=>'required',
            'address'=>'required',
        ]);

        $network = Network::find($id);

        $network->network_type_id = $request->get('network_type_id');
        $network->name = $request->get('name');
        $network->descr = $request->get('descr');
        $network->address = $request->get('address');
        $network->enabled = $request->get('enabled');

        $network->save();

        return redirect('/network/crud')->with('success', 'network editado!');
    }
}
