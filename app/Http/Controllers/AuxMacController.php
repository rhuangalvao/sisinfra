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
        $aux_mac = AuxMac::all();
        return view('aux_mac.crud',compact('aux_mac'));
    }
    public function store(Request $request){

        $request->validate([
            'mac'=>'required',
            'mfr'=>'required',
            'mfr_short'=>'required',
            'logo'=>'required',
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
        $aux_mac = AuxMac::find($id);
        return view('aux_mac.edit', compact('aux_mac'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'mac'=>'required',
            'mfr'=>'required',
            'mfr_short'=>'required',
            'logo'=>'required',
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
