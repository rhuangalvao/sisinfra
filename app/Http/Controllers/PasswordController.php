<?php

namespace App\Http\Controllers;

use App\Model\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function create(){
        return view('password.create');
    }
    public function crud(){
        $passwords = Password::paginate(10);
        return view('password.crud',compact('passwords'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){
            $passwords = Password::
            where('username',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('password', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('descr', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $passwords = Password::paginate($dataForm['entradas']);
        }
        else{
            $passwords = Password::paginate(10);
        }
        return view('password.crud',compact('passwords', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'name'=>'required',
//            'descr'=>'required',
        ]);
        $password = new Password([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'name' => $request->get('name'),
            'descr' => $request->get('descr'),
        ]);
        $password->save();
        return redirect('/password/crud')->with('success', 'password salvo!');
    }
    public function destroy($id){
        $password = Password::find($id);
        $password->delete();

        return redirect('/password/crud')->with('success', 'password deletado!');
    }
    public function edit($id){
        $password = Password::find($id);
        return view('password.edit', compact('password'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'name'=>'required',
//            'descr'=>'required',
        ]);

        $password = Password::find($id);

        $password->username = $request->get('username');
        $password->password = $request->get('password');
        $password->name = $request->get('name');
        $password->descr = $request->get('descr');

        $password->save();

        return redirect('/password/crud')->with('success', 'password editado!');
    }
}
