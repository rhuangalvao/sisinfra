<?php

namespace App\Http\Controllers;

use App\Model\AuxMac;
use Illuminate\Http\Request;

class AuxMacController extends Controller
{
    public function create(){
        return view('aux_mac.create');
    }
    public function crud(){
        $aux_macs = AuxMac::paginate(10);
        return view('aux_mac.crud',compact('aux_macs'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
            $aux_macs = AuxMac::
            where('mac',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('mfr', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('mfr_short', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('logo', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $aux_macs = AuxMac::paginate($dataForm['entradas']);
        }
        else{
            $aux_macs = AuxMac::paginate(10);
        }
        return view('aux_mac.crud',compact('aux_macs', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'mac'=>'required',
            'mfr'=>'required',
        ]);
        $aux_mac = new AuxMac([
            'mac' => $request->get('mac'),
            'mfr' => $request->get('mfr'),
            'mfr_short' => $request->get('mfr_short'),
            'logo' => $request->get('logo'),
        ]);
        $aux_mac->save();
        return redirect('/aux_mac/crud')->with('success', 'aux_mac salvo!');
    }
    public function destroy($id){
        $aux_mac = AuxMac::find($id);
        $aux_mac->delete();

        return redirect('/aux_mac/crud')->with('success', 'aux_mac deletado!');
    }
    public function edit($id){
        $aux_macs = AuxMac::find($id);
        return view('aux_mac.edit', compact('aux_macs'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'mac'=>'required',
            'mfr'=>'required',

        ]);

        $aux_mac = AuxMac::find($id);

        $aux_mac->mac = $request->get('mac');
        $aux_mac->mfr = $request->get('mfr');
        $aux_mac->mfr_short = $request->get('mfr_short');
        $aux_mac->logo = $request->get('logo');

        $aux_mac->save();

        return redirect('/aux_mac/crud')->with('success', 'aux_mac editado!');
    }
}
