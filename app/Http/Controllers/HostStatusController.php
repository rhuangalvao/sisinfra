<?php

namespace App\Http\Controllers;

use App\Model\HostStatus;
use Illuminate\Http\Request;

class HostStatusController extends Controller
{
    public function create(){
        return view('host_status.create');
    }
    public function crud(){
        $host_statuses = HostStatus::paginate(10);
        return view('host_status.crud',compact('host_statuses'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
            $host_statuses = HostStatus::
            where('status',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $host_statuses = HostStatus::paginate($dataForm['entradas']);
        }
        else{
            $host_statuses = HostStatus::paginate(10);
        }
        return view('host_status.crud',compact('host_statuses', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'status'=>'required',
        ]);
        $host_status = new HostStatus([
            'status' => $request->get('status'),
        ]);
        $host_status->save();
        return redirect('/host_status/crud')->with('success', 'host_status salvo!');
    }
    public function destroy($id){
        $host_status = HostStatus::find($id);
        $host_status->delete();

        return redirect('/host_status/crud')->with('success', 'host_status deletado!');
    }
    public function edit($id){
        $host_status = HostStatus::find($id);
        return view('host_status.edit', compact('host_status'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'status'=>'required',
        ]);

        $host_status = HostStatus::find($id);

        $host_status->status = $request->get('status');

        $host_status->save();

        return redirect('/host_status/crud')->with('success', 'host_status editado!');
    }
}
