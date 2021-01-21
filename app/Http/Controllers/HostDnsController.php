<?php

namespace App\Http\Controllers;

use App\Model\HostDns;
use App\Model\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostDnsController extends Controller
{
    public function create(){
        $host = Host::all();
        return view('host_dns.create',compact('host'));
    }
    public function crud(){

        $host_dnss = DB::table('host_dns')
            ->leftJoin('hosts', 'host_dns.host_id', '=', 'hosts.id')
            ->select('host_dns.*', 'hosts.hostname')
            ->paginate(10);
//        $host_dnss = HostDns::paginate(10);
        $hosts = Host::all();
        return view('host_dns.crud',compact('host_dnss','hosts'));
    }
    public function search(Request $request){
        $dataForm = $request->except('_token');
        if (isset($dataForm['pesquisa'])){

            $host_dnss = DB::table('host_dns')
                ->leftJoin('hosts', 'host_dns.host_id', '=', 'hosts.id')
                ->select('host_dns.*', 'hosts.hostname')
                ->where('hosts.hostname',"ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_dns.name', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->orWhere('host_dns.version', "ilike", '%'.$dataForm['pesquisa'].'%')
                ->paginate($dataForm['entradas']);

//            $host_dnss = HostDns::
//            where('host_id',"ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('name', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->orWhere('version', "ilike", '%'.$dataForm['pesquisa'].'%')
//                ->paginate($dataForm['entradas']);
        }elseif(isset($dataForm['entradas'])){
            $host_dnss = DB::table('host_dns')
                ->leftJoin('hosts', 'host_dns.host_id', '=', 'hosts.id')
                ->select('host_dns.*', 'hosts.hostname')
                ->paginate($dataForm['entradas']);
//            $host_dnss = HostDns::paginate($dataForm['entradas']);
        }
        else{
            $host_dnss = DB::table('host_dns')
                ->leftJoin('hosts', 'host_dns.host_id', '=', 'hosts.id')
                ->select('host_dns.*', 'hosts.hostname')
                ->paginate(10);
//            $host_dnss = HostDns::paginate(10);
        }
        $hosts = Host::all();
        return view('host_dns.crud',compact('host_dnss','hosts', 'dataForm'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'name'=>'required',
            'version'=>'required',
        ]);
        $host_dns = new HostDns([
            'host_id' => $request->get('host_id'),
            'name' => $request->get('name'),
            'version' => $request->get('version'),
            'is_main' => $request->get('is_main'),
        ]);
        $host_dns->save();
        return redirect('/host_dns/crud')->with('success', 'host_dns salvo!');
    }
    public function destroy($id){
        $host_dns = HostDns::find($id);
        $host_dns->delete();

        return redirect('/host_dns/crud')->with('success', 'host_dns deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $host_dns = HostDns::find($id);
        return view('host_dns.edit', compact('host_dns','host'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'name'=>'required',
            'version'=>'required',
        ]);

        $host_dns = HostDns::find($id);

        $host_dns->host_id = $request->get('host_id');
        $host_dns->name = $request->get('name');
        $host_dns->version = $request->get('version');
        $host_dns->is_main = $request->get('is_main');

        $host_dns->save();

        return redirect('/host_dns/crud')->with('success', 'host_dns editado!');
    }
}
