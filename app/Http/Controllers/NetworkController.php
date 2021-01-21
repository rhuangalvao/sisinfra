<?php

namespace App\Http\Controllers;

use App\Model\Network;
use App\Model\NetworkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NetworkController extends Controller
{
    public function create(){
        $network_type = NetworkType::all();
        return view('network.create',compact('network_type'));
    }
    public function crud(){
        $networks = DB::table('networks')
            ->leftJoin('network_types', 'networks.network_type_id', '=', 'network_types.id')
            ->select('networks.*', 'network_types.name as type_name')
            ->paginate(10);

        $network_type = NetworkType::all();
//        $networks = Network::paginate(10);
        return view('network.crud',compact('networks','network_type'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
            $networks = DB::table('networks')
                ->leftJoin('network_types', 'networks.network_type_id', '=', 'network_types.id')
                ->select('networks.*', 'network_types.name as type_name')
                ->where('network_types.name',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('networks.name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('networks.descr', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('networks.address', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $networks = Network::
////            where('hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
////                ->orWhere('tag', "ilike", '%'.$dataForm['pesquisa'].'%')
////                ->orWhere('domain_suffix', "ilike", '%'.$dataForm['pesquisa'].'%')
////                ->orWhere('descr', "ilike", '%'.$dataForm['pesquisa'].'%')
////                ->orWhere('obs', "ilike", '%'.$dataForm['pesquisa'].'%')
////                ->orWhere('chassis_id', "ilike", '%'.$dataForm['pesquisa'].'%')
////                ->orWhere('serial_number', "ilike", '%'.$dataForm['pesquisa'].'%')
////                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $networks = DB::table('networks')
                ->leftJoin('network_types', 'networks.network_type_id', '=', 'network_types.id')
                ->select('networks.*', 'network_types.name as type_name')
                ->paginate($dataForm['entradas']);
//            $networks = Network::paginate($dataForm['entradas']);
        }
        else{
            $networks = DB::table('networks')
                ->leftJoin('network_types', 'networks.network_type_id', '=', 'network_types.id')
                ->select('networks.*', 'network_types.name as type_name')
                ->paginate(10);
        }
        $network_type = NetworkType::all();
        return view('network.crud',compact('networks','network_type', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'network_type_id'=>'required',
            'name'=>'required',
//            'descr'=>'required',
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
//            'descr'=>'required',
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
