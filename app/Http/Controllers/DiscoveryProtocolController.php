<?php

namespace App\Http\Controllers;

use App\Model\DiscoveryProtocol;
use Illuminate\Http\Request;

class DiscoveryProtocolController extends Controller
{
    public function create(){
        return view('discovery_protocol.create');
    }
    public function crud(){
        $discovery_protocol = DiscoveryProtocol::all();
        return view('discovery_protocol.crud',compact('discovery_protocol'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'order'=>'required',
        ]);
        $discovery_protocol = new DiscoveryProtocol([
            'name' => $request->get('name'),
            'order' => $request->get('order'),
        ]);
        $discovery_protocol->save();
        return redirect('/discovery_protocol/crud')->with('success', 'discovery_protocol salvo!');
    }
    public function destroy($id){
        $discovery_protocol = DiscoveryProtocol::find($id);
        $discovery_protocol->delete();

        return redirect('/discovery_protocol/crud')->with('success', 'discovery_protocol deletado!');
    }
    public function edit($id){
        $discovery_protocol = DiscoveryProtocol::find($id);
        return view('discovery_protocol.edit', compact('discovery_protocol'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'order'=>'required',
        ]);

        $discovery_protocol = DiscoveryProtocol::find($id);

        $discovery_protocol->name = $request->get('name');
        $discovery_protocol->order = $request->get('order');

        $discovery_protocol->save();

        return redirect('/discovery_protocol/crud')->with('success', 'discovery_protocol editado!');
    }
}