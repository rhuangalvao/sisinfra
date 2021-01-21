<?php

namespace App\Http\Controllers;

use App\Model\Host;
use App\Model\HostParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostParamController extends Controller
{
    public function create(){
        $host = Host::all();
        return view('host_param.create',compact('host'));
    }
    public function crud(){

        $host_params = DB::table('host_params')
            ->leftJoin('hosts', 'host_params.host_id', '=', 'hosts.id')
            ->select('host_params.*', 'hosts.hostname')
            ->paginate(10);
//        $host_params= HostParam::paginate(10);
        $host = Host::all();
        return view('host_param.crud',compact('host_params','host'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $host_params = DB::table('host_params')
                ->leftJoin('hosts', 'host_params.host_id', '=', 'hosts.id')
                ->select('host_params.*', 'hosts.hostname')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_params.param_name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_params.param_value', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $host_params = HostParam::
//            where('host_id',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('param_name', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('param_value', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $host_params = DB::table('host_params')
                ->leftJoin('hosts', 'host_params.host_id', '=', 'hosts.id')
                ->select('host_params.*', 'hosts.hostname')
                ->paginate($dataForm['entradas']);
//            $host_params = HostParam::paginate($dataForm['entradas']);
        }
        else{
            $host_params = DB::table('host_params')
                ->leftJoin('hosts', 'host_params.host_id', '=', 'hosts.id')
                ->select('host_params.*', 'hosts.hostname')
                ->paginate(10);
        }
        $host = Host::all();
        return view('host_param.crud',compact('host_params','host', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'param_name'=>'required',
            'param_value'=>'required',
        ]);
        $host_param = new HostParam([
            'host_id' => $request->get('host_id'),
            'param_name' => $request->get('param_name'),
            'param_value' => $request->get('param_value'),
            'enabled' => $request->get('enabled'),
        ]);
        $host_param->save();
        return redirect('/host_param/crud')->with('success', 'host_param salvo!');
    }
    public function destroy($id){
        $host_param = HostParam::find($id);
        $host_param->delete();

        return redirect('/host_param/crud')->with('success', 'host_param deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $host_param = HostParam::find($id);
        return view('host_param.edit', compact('host_param','host'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'param_name'=>'required',
            'param_value'=>'required',
        ]);

        $host_param = HostParam::find($id);

        $host_param->host_id = $request->get('host_id');
        $host_param->param_name = $request->get('param_name');
        $host_param->param_value = $request->get('param_value');
        $host_param->enabled = $request->get('enabled');

        $host_param->save();

        return redirect('/host_param/crud')->with('success', 'host_param editado!');
    }
}
