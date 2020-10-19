<?php

namespace App\Http\Controllers;

use App\Model\HostInterface;
use App\Model\Host;
use Illuminate\Http\Request;

class HostInterfaceController extends Controller
{
    public function create(){
        $host = Host::all();
        return view('host_interface.create',compact('host'));
    }
    public function crud(){
        $host_interface = HostInterface::all();
        $host = Host::all();
        return view('host_interface.crud',compact('host_interface','host'));
    }
    public function store(Request $request){

        $request->validate([
            'host_id'=>'required',
            'ifname'=>'required',
            'iftype'=>'required',
            'ifspeed'=>'required',
            'ifindex'=>'required',
            'ifoperstatus'=>'required',
            'ifalias'=>'required',
            'portid'=>'required',
            'is_mgmt'=>'required',
            'discovery_protocol_id'=>'required',
        ]);
        $host_interface = new HostInterface([
            'host_id' => $request->get('host_id'),
            'ifname' => $request->get('ifname'),
            'iftype' => $request->get('iftype'),
            'ifspeed' => $request->get('ifspeed'),
            'ifindex' => $request->get('ifindex'),
            'ifoperstatus' => $request->get('ifoperstatus'),
            'ifalias' => $request->get('ifalias'),
            'portid' => $request->get('portid'),
            'is_mgmt' => $request->get('is_mgmt'),
            'discovery_protocol_id' => $request->get('discovery_protocol_id'),
        ]);
        $host_interface->save();
        return redirect('/host_interface/crud')->with('success', 'host_interface salvo!');
    }
    public function destroy($id){
        $host_interface = HostInterface::find($id);
        $host_interface->delete();

        return redirect('/host_interface/crud')->with('success', 'host_interface deletado!');
    }
    public function edit($id){
        $host = Host::all();
        $host_interface = HostInterface::find($id);
        return view('host_interface.edit', compact('host_interface','host'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'host_id'=>'required',
            'ifname'=>'required',
            'iftype'=>'required',
            'ifspeed'=>'required',
            'ifindex'=>'required',
            'ifoperstatus'=>'required',
            'ifalias'=>'required',
            'portid'=>'required',
            'is_mgmt'=>'required',
            'discovery_protocol_id'=>'required',
        ]);

        $host_interface = HostInterface::find($id);

        $host_interface->host_id = $request->get('host_id');
        $host_interface->ifname = $request->get('ifname');
        $host_interface->iftype = $request->get('iftype');
        $host_interface->ifspeed = $request->get('ifspeed');
        $host_interface->ifindex = $request->get('ifindex');
        $host_interface->ifoperstatus = $request->get('ifoperstatus');
        $host_interface->ifalias = $request->get('ifalias');
        $host_interface->portid = $request->get('portid');
        $host_interface->is_mgmt = $request->get('is_mgmt');
        $host_interface->discovery_protocol_id = $request->get('discovery_protocol_id');

        $host_interface->save();

        return redirect('/host_interface/crud')->with('success', 'host_interface editado!');
    }
}
