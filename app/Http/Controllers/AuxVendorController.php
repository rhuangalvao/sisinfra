<?php

namespace App\Http\Controllers;

use App\Model\AuxVendor;
use Illuminate\Http\Request;

class AuxVendorController extends Controller
{
    public function create(){
        return view('aux_vendor.create');
    }
    public function crud(){
        $aux_vendors = AuxVendor::paginate(10);
        return view('aux_vendor.crud',compact('aux_vendors'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
        ]);
        $aux_vendor = new AuxVendor([
            'name' => $request->get('name'),
        ]);
        $aux_vendor->save();
        return redirect('/aux_vendor/crud')->with('success', 'aux_vendor salvo!');
    }
    public function destroy($id){
        $aux_vendor = AuxVendor::find($id);
        $aux_vendor->delete();

        return redirect('/aux_vendor/crud')->with('success', 'aux_vendor deletado!');
    }
    public function edit($id){
        $aux_vendors = AuxVendor::find($id);
        return view('aux_vendor.edit', compact('aux_vendors'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
        ]);

        $aux_vendor = AuxVendor::find($id);

        $aux_vendor->name = $request->get('name');

        $aux_vendor->save();

        return redirect('/aux_vendor/crud')->with('success', 'aux_vendor editado!');
    }
}
