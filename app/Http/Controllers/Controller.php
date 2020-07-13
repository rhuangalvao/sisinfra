<?php

namespace App\Http\Controllers;

use App\Host;
use App\Model\Service_dependency;
use App\Service_instance;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome(){
        $service_instance = Service_instance::all();
        $service_dependency = Service_dependency::all();
        return view('welcome',compact('service_instance','service_dependency'));
    }

    public function search(Request $request){
        $service_instance = Service_instance::all();
        $service_dependency = Service_dependency::all();

        $busca = $request->pesquisa;

//        $dispositivos = DB::table('service_instances')
//                        ->join('service_dependencies', 'service_instances.id','=','service_dependencies.service_instance_id')
//                        ->select('service_instances.*','service_dependencies.*')
//                        ->get();

        return view('search',compact('service_dependency','service_instance','busca'));
    }
}
