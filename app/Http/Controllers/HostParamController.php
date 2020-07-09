<?php

namespace App\Http\Controllers;

use App\Host;
use App\Host_param;
use Illuminate\Http\Request;

class HostParamController extends Controller
{
    public function create(){
        $host = Host::all();
        return view('host_param.create',compact('host'));
    }
    public function crud(){
        $host_param = Host_param::all();
        return view('host_param.crud',compact('host_param'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'param_name'=>'required',
            'param_value'=>'required',
        ]);
        $host_param = new host_param([
            'host_id' => $request->get('host_id'),
            'param_name' => $request->get('param_name'),
            'param_value' => $request->get('param_value'),
            'enabled' => $request->get('enabled'),
        ]);
        $host_param->save();
        return redirect('/host_param/crud')->with('success', 'host_param salvo!');
    }
    public function destroy($id){
        $host_param = Host_param::find($id);
        $host_param->delete();

        return redirect('/host_param/crud')->with('success', 'host_param deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $host_param = Host_param::find($id);
        return view('host_param.edit', compact('host_param','host'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'param_name'=>'required',
            'param_value'=>'required',
        ]);

        $host_param = Host_param::find($id);

        $host_param->host_id = $request->get('host_id');
        $host_param->param_name = $request->get('param_name');
        $host_param->param_value = $request->get('param_value');
        $host_param->enabled = $request->get('enabled');

        $host_param->save();

        return redirect('/host_param/crud')->with('success', 'host_param editado!');
    }
}
