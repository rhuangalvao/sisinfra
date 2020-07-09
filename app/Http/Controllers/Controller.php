<?php

namespace App\Http\Controllers;

use App\Host;
use App\Model\Service_dependency;
use App\Service_instance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome(){
        $host = Host::all();
        $service_instance = Service_instance::all();
        $service_dependency = Service_dependency::all();
        return view('welcome',compact('host','service_instance','service_dependency'));
    }
}
