<?php

namespace App\Http\Controllers;

use App\Model\Ocs_map_os;
use App\Model\Operating_system;
use Illuminate\Http\Request;

class OcsMapOsController extends Controller
{
    public function index(){

    }
    public function create(){
        $operating_system = Operating_system::all();
        return view('ocs_map_os.create',compact('operating_system'));
    }
    public function crud(){
        $ocs_map_os = Ocs_map_os::all();
        return view('ocs_map_os.crud',compact('ocs_map_os'));
    }
    public function store(Request $request){

        $request->validate([
            'operating_system_id'=>'required',
            'ocs_os_name_match'=>'required'
        ]);
        $ocs_map_os = new Ocs_map_os([
            'operating_system_id' => $request->get('operating_system_id'),
            'ocs_os_name_match' => $request->get('ocs_os_name_match'),
        ]);
        $ocs_map_os->save();
        return redirect('/ocs_map_os/crud')->with('success', 'Ocs_map_os salvo!');
    }
    public function destroy($id){
        $ocs_map_os = Ocs_map_os::find($id);
        $ocs_map_os->delete();

        return redirect('/ocs_map_os/crud')->with('success', 'Ocs_map_os deletado!');
    }
    public function edit($id){
        $operating_system = Operating_system::all();
        $ocs_map_os = Ocs_map_os::find($id);
        return view('ocs_map_os.edit', compact('ocs_map_os','operating_system'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'operating_system_id'=>'required',
            'ocs_os_name_match'=>'required',
        ]);

        $ocs_map_os = Ocs_map_os::find($id);

        $ocs_map_os->operating_system_id = $request->get('operating_system_id');
        $ocs_map_os->ocs_os_name_match = $request->get('ocs_os_name_match');

        $ocs_map_os->save();

        return redirect('/ocs_map_os/crud')->with('success', 'Ocs_map_os editado!');
    }
}
