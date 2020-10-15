<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 25/05/2019
 * Time: 15:31
 */

namespace App\Domain;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


use App\Host;
use App\HostInterface;
use App\HostIp;
use App\HostMap;
use App\SnmpCmm;
use App\SnmpHost;
use App\SnmpHostAddress;
use App\SnmpDeviceClass;
use App\SnmpDeviceClassSysoid;
use App\SnmpDeviceClassSysdescr;
use App\SnmpHostRemote;
use App\SnmpHostInterface;
use App\SnmpHostVlan;
use App\SnmpHostFdb;
use App\SnmpHostConnection;
use App\SnmpHostIparp;
use App\Network;
use App\SnmpHostAddressCache;
use function Psy\debug;
use Carbon\Carbon;

/*
use sisinfra\NetmapDevice;
use sisinfra\NetmapDeviceConnection;
use sisinfra\NetmapSnmpSystem;
use sisinfra\NetmapSnmpSystemIp;
use sisinfra\NetmapDeviceInterfaces;
use sisinfra\NetmapVlan;
use sisinfra\NetmapFdb;
use sisinfra\NetmapIparp;
use sisinfra\NetmapIpv6nd;
*/


class SnmpDiscovery
{


    private $common;
    private $snmp;
    private $snmpExtend;
    private $ipCalc;

    const discoveryProtocolLLDP = 2;

    const hostTypeRouter = 6;
    const hostTypeSwitch = 5;
    const hostTypePhone = 7;
    const hostTypeAccessPoint = 8;
    const hostStatusProd = 1;
    const discoveryProtocolSnmp = 6;

    public function __construct(){

        $common = new Common();
        $this->common = $common;

        $snmp = new Snmp();
        $this->snmp = $snmp;

        $snmpExtend = new SnmpExtend();
        $this->snmpExtend = $snmpExtend;

        $ipCalc = new IPCalc();
        $this->ipCalc = $ipCalc;

        /*
        $this->ipcalc = $ipcalc;
        $this->snmp = $snmp;
        $this->common = $common;
        $this->snmpExtend = $snmpExtend;
        $this->ping = $ping;
        */
    }




    /*
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    funcoes GET e auxiliares
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    */


    function getClassBySysOid($ip,$community, $sysOid){
        // 2019-05-26 gustavo
        // v2.0
        // tenta obter a classe do SnmpHost via Sysoid

        $objects = SnmpDeviceClassSysoid::where('oid', $sysOid)->get();


        if ($objects->count() > 0) {
            // se retornar resultado, loop nas funcoes para obter a classe

            foreach ($objects as $object){
                $data = $this->common->removeQuotes($this->getSnmpDataMap($ip, $community, $object->snmp_device_class_id, $object->function_name));

                //print_r($data);

                //echo 'data:'.$data.' regex:'.$snmp_function->regex.PHP_EOL;
                //echo 'regex'.preg_match($snmp_function->regex, $data, $match).PHP_EOL;
                if (strlen($object->regex)>0) {
                    if (preg_match($object->regex, $data, $match)) {
                        return $object->device_snmp_class_id;
                    }
                }
                else {
                    // se regex é vazia, presume match all. retorna o device sem precisar comparar
                    return $object->device_snmp_class_id;
                }
            }
        } else {
            return false;
        }
    }



    function getSnmpDataMap($ip, $community, $snmp_device_class_id, $function_name, $table=false)
    {
        // gustavo 2017-11-22
        // obtem dados das funcoes parametrizadas de acordo com o snmp_device_class
        //

        $snmp_function = DB::table('snmp_functions')
            ->join('snmp_device_class_functions', 'snmp_device_class_functions.snmp_function_id', 'snmp_functions.id')
            ->where('snmp_device_class_functions.function_name', $function_name)
            ->where('snmp_device_class_functions.snmp_device_class_id', $snmp_device_class_id)
            ->get();

        //$snmp_function = SnmpFunction::where()

        if ($snmp_function->count() > 0) {

            // o valor netmap_function_snmp_id 10 é reservado para chamadas de funcoes customizadas,
            // onde nao eh possivel com apenas um snmpget+regex retornar o valor necessario
            if ($snmp_function->first()->snmp_function_id == 10){
                return $this->snmpExtend->custom($ip, $community, $snmp_device_class_id, $function_name);
            }

            if ($snmp_function->first()->regex){
                // se possui regex, nao pode ser tabela
                $snmp_value=$this->snmp->getValue($ip,$community,$snmp_function->first()->oid);
                preg_match($snmp_function->first()->regex, $snmp_value, $match);
                if (array_key_exists(1, $match)){
                    return $match[1];
                }
                else {
                    return false;
                }

            }
            else {
                if ($table){
                    // obtem os 3 dados do banco, ou usa defaults
                    if ($snmp_function->first()->p1 != null || $snmp_function->first()->p1 != 1){
                        $idArrayResultPos=$snmp_function->first()->p1;
                    }
                    else {
                        $idArrayResultPos=1;
                    }

                    if ($snmp_function->first()->p2 != null || $snmp_function->first()->p2 != 0){
                        $paramIdPos=$snmp_function->first()->p2;
                    }
                    else {
                        $paramIdPos=0;
                    }

                    if ($snmp_function->first()->p3 != null || $snmp_function->first()->p3 != -1){
                        $valuePos=$snmp_function->first()->p3;
                    }
                    else {
                        $valuePos=-1;
                    }

                    return $this->snmp->table($ip,$community,$snmp_function->first()->oid, $idArrayResultPos, $paramIdPos, $valuePos);
                }
                else {
                    // se nao for table, retorna somente o valor
                    return $this->snmp->getValue($ip,$community,$snmp_function->first()->oid);
                }
            }
        }
        else {
            return false;
        }
    }


    function getClassBySysdescr($string){
        // gustavo 2017-11-20
        // v2.0 2019-05-26
        // tenta obter a classe do device via regex a partir do snmp-sysdescr

        $devices_sysdescr = SnmpDeviceClassSysdescr::orderBy('order', 'asc')->get();
        //DB::table('snmp.device_snmp_type_regex')->orderBy('order', 'asc')->get();
        foreach ($devices_sysdescr as $device_sysdescr) {
            if ($device_sysdescr->regex) {
                $regex = preg_match($device_sysdescr->regex, $string);
                if ($regex > 0) {
                    $snmp_device_class = SnmpDeviceClass::where('id', $device_sysdescr->snmp_device_class_id)->get()->first();
                    return $snmp_device_class;
                }
            }
        }
        return false;
    }

    function getSnmpHostType($snmp_host_id){
        // Gustavo 2017-11-12
        if (is_numeric($snmp_host_id)){

            //echo "SN:".$snmp_host_id;
            $snmpHost = SnmpHost::find($snmp_host_id);
            if ($snmpHost->count() > 0){
                if ($snmpHost->snmp_device_class_id){
                    return $snmpHost->snmpDeviceClass->host_type_id;
                }
                else {
                    // host nao possui snmp_device_class_id (nao foi reconhecido pelo sistema, nao eh possivel fazer queries snmp para obter dados dele)
                    return false;
                }

            }
            else {
                // nao ha snmphosts na tabela
                return false;
            }
        }
        else {
            // o snmp_host_id informano nao eh numerico
            return false;
        }

    }






    public function interfaceAdjustPortId(){
        // gustavo 2019-05-26
        // ajusta port_id no database para normalizar os dados informados por alguns tipos de switches

        //$interfaces=DB::table('snmp.netmap_deviceinterfaces')->get();

        $interfaces = SnmpHostInterface::all();

        foreach($interfaces as $interface){
            if ($interface->portid == null){
                $ifdescr=$interface->ifdescr;
                Log::debug('interfacesAdjustPortId id_interface:'.$interface->id);

                $adjust=false;
                // GigabitEthernet1/0/xx
                if (strpos($ifdescr, 'GigabitEthernet') === 0){

                    $arr = explode('/', $ifdescr);

                    if (array_key_exists(0, $arr)
                        && array_key_exists(1, $arr)
                        && array_key_exists(2, $arr)
                    ){
                        if ($arr[0]=='GigabitEthernet1' && $arr[1]=='0'){
                            //print_r($arr);
                            $data['portid']=$arr[2];
                            $int=SnmpHostInterface::where('id', $interface->id)->update($data);
                            Log::debug('interfacesAdjustPortId'.' insert/update:'.$int);
                            $adjust=true;
                        }
                    }
                }

                // ex: X460-48t Port 3
                if (!$adjust) {
                    $arr = explode(' ', $ifdescr);
                    if (array_key_exists(0, $arr)
                        && array_key_exists(1, $arr)
                        && array_key_exists(2, $arr)
                    ) {
                        if (strlen($arr[0]) == 8 && $arr[1] == 'Port') {
                            $data['portid'] = $arr[2];
                            $int = SnmpHostInterface::where('id', $interface->id)->update($data);
                            Log::debug('interfacesAdjustPortId' . ' insert/update:' . $int);
                            $adjust = true;

                        }
                    }
                }



            }
        }

    }





    /*
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    funcoes SET
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    */


    function setSnmpHost($ip, $community){
        // 2017-12-20 Gustavo
        // add/update SnmpHost dado endereço/community

        $snmp_device_class_id = null;
        $data = array();
        $find=array();
        $host_type_id = 0;

        Log::debug('setSnmpHost: address:('.$ip.') community:('.$community.')');

        // obtem o sysobjectid
        $data['sysobjectid'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysObjectID));


        if ($data['sysobjectid']) {
            // se obteve o sysobjectid, tenta obter os outros parametros

            $data['sysname'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysName));
            $data['sysdescr'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysDescr));
            $data['sysuptime'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysUpTime));
            $data['syscontact'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysContact));
            $data['syslocation'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysLocation));
            $data['sysservices'] = $this->common->removeQuotes($this->snmp->getValue($ip, $community, Snmp::sysServices));


            // tenta identificar o device
            // tenta primeiro via OID
            // depois via string do sysdescr

            $snmp_device_class_id=$this->getClassBySysOid($ip, $community, $data['sysobjectid']);

            if ($snmp_device_class_id){
                // identificou via oid
                Log::debug('setSnmpHost:'.'('.$ip .')'.' identificado device via OID:'.$snmp_device_class_id);

            }
            else {
                // identifica via string do sysdescr
                if ($this->getClassBySysdescr($data['sysdescr'])){
                    $snmp_device_class_id=$this->getClassBySysdescr($data['sysdescr'])->id;
                    Log::debug('setSnmpHost:'.'('.$ip .')'.' identificado device via string:'.$snmp_device_class_id);
                }
            }

            if ($snmp_device_class_id){
                // se o device foi identificado, tenta obter os dados complementares via funcao datamap
                $data['hostname'] = $this->common->removeQuotes($this->getSnmpDataMap($ip, $community, $snmp_device_class_id, 'snmp_hostname'));
                $data['serialnumber'] = $this->common->removeQuotes($this->getSnmpDataMap($ip, $community, $snmp_device_class_id, 'snmp_serialnumber'));
                $data['model'] = $this->common->removeQuotes($this->getSnmpDataMap($ip, $community, $snmp_device_class_id, 'snmp_model'));
                $data['softwareversion'] = $this->common->removeQuotes($this->getSnmpDataMap($ip, $community, $snmp_device_class_id, 'snmp_softwareversion'));
                $data['chassisid'] = $this->common->removeQuotes($this->getSnmpDataMap($ip, $community, $snmp_device_class_id, 'snmp_chassisid'));

                $data['snmp_device_class_id']=$snmp_device_class_id;

                if (!empty($data['chassisid'])){
                    $find['chassisid']=$data['chassisid'];
                }
                if (!empty($data['serialnumber'])) {
                    $find['serialnumber'] = $data['serialnumber'];
                }
            }



            // se nao encontrou o tipo do device, faz o find com base nos parametros abaixo
            if (array_key_exists('chassisid',$find)==false && array_key_exists('chassisid',$find)==false) {
                $find['sysname'] = $data['sysname'];
                $find['sysobjectid'] = $data['sysobjectid'];
                $find['sysdescr'] = $data['sysdescr'];
            }

            //print_r($data);
            $snmpHost=null;


            $snmp_device_class=SnmpDeviceClass::where('id', $snmp_device_class_id);
            if ($snmp_device_class->count() > 0){
                // se encontrou device class, ele deve ser SWITCH
                $host_type_id = $snmp_device_class->first()->host_type_id;
                if ($host_type_id == self::hostTypeSwitch){
                    // insert/update o novo host
                    $snmpHost = SnmpHost::updateOrCreate($find, $data);
                    //echo 'insert/update:'.$snmpSystem.PHP_EOL;

                    //$netmap_snmpsystem_id=json_decode($return);
                    Log::debug('setSnmpHost:'.'('.$ip .')'.'add/update:'.$snmpHost->id);

                    // insert/update Community
                    // TODO: remover hardcoded snmp v2c
                    $snmp_cmm=SnmpCmm::where('community_name', $community)->first();

                    $findIP['snmp_host_id']=$snmpHost->id;
                    $dataIP['address']=$ip;
                    $dataIP['snmp_cmm_id']=$snmp_cmm->id;
                    $dataIP['enabled']=true;
                    $snmpHostAddress = SnmpHostAddress::updateOrCreate($findIP, $dataIP);

                    //print_r($snmpHostAddress);
                    Log::debug('setSnmpHost:'.'('.$ip .')'.'add/update snmpHostAddr id:'.$snmpHostAddress->id);

                    //echo "class id:".$snmp_device_class_id;
                    //echo $snmp_device_class->name;
                    $snmp_device_class_name = $snmp_device_class->first()->name;

                    //echo " name:".$snmp_device_class_name.PHP_EOL;
                    Log::notice('setSnmpHost add/update ip:'.$ip.' cmm:'.$community.' deviceClass:'.$snmp_device_class_name);

                }
            }



        }

        // refaz o array para add no cache
        $findIP=array();
        $dataIP=array();
        $snmp_cmm=SnmpCmm::where('community_name', $community)->first();
        $findIP['address']=$ip;
        $findIP['snmp_cmm_id']=$snmp_cmm->id;

        if (!array_key_exists('sysname',$data)){
            Log::info('setSnmpHost:'.$ip.' nao possui snmp na cmm:'.$community);

            // add no cache -> cmm nao identificada
            $dataIP['status']=0;
            SnmpHostAddressCache::updateOrCreate($findIP, $dataIP);

        }
        else {

            // add no cache - cmm identificada
            // para o cache nao importa se o device_class foi identificado ou nao, importa so a cmm snmp
            $dataIP['status']=1;
            SnmpHostAddressCache::updateOrCreate($findIP, $dataIP);

            if (!$snmp_device_class_id){
                Log::info('setSnmpHost:'.'device type nao identificado');
            }
        }


    }

    function setSnmpHostRemote($snmpHostAddress, $discoveryProtocol=2){
        // Gustavo 2017-11-12
        // add device a partir da tabela LLDP/CDP/EDP dos switches
        // TODO: CDP e EDP

        //echo 'host_id'.$snmpHostAddress->snmp_host_id;

        // somente executa se for switch, pois os protocolos LLDP/CDP/EDP estao implementados somente neles
        if ($this->getSnmpHostType($snmpHostAddress->snmp_host_id) == $this->common->getHostTypeSwitch()) {

            $devicesLLDP = ($this->snmp->table($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, Snmp::lldpRemEntry, 2, 0));
            $devicesLLDPX = $this->common->array_key_increase($this->snmp->table($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, Snmp::lldpXMedRemInventoryEntry, 2, 0));
            $devices = $this->common->array_merge2($devicesLLDP, $devicesLLDPX);

            if (is_array($devices)){
                Log::info('setSnmpHostRemote:'. $snmpHostAddress->address . ' ' . $snmpHostAddress->snmpCmm->community_name . ' count:' . count($devices));
                //print_r($devices);

                if (count($devices)>0) {
                    if (is_array($devices)) {
                        // loop na lista de devices e adiciona no banco
                        foreach ($devices as $device) {
                            $find=array();
                            $data=array();

                            //Log::debug('setDevice:'.print_r($device, true));

                            // se lldpxmed remote serial está definido (normalmente em telefones), usa ele
                            if ($this->common->removeQuotes($this->common->getArrayData(1004,$device))){
                                $find['lldpxmed_rem_serial']=$this->common->removeQuotes($this->common->getArrayData(1004,$device));
                                $find['lldpxmed_rem_mfgname']=$this->common->removeQuotes($this->common->getArrayData(1005,$device));
                            }
                            // senao, verifica se o chassisidsubtype=4 (mac addr)
                            elseif ($this->common->removeQuotes($this->common->getArrayData(4,$device)) == 4) {
                                $find['chassisidsubtype']=$this->common->removeQuotes($this->common->getArrayData(4,$device));
                                $find['chassisid']=$this->common->removeQuotes($this->common->adjustLldpChassisId($this->common->getArrayData(4,$device),$this->common->getArrayData(5,$device)));
                            }
                            // senao, verifica se o chassisidsubtype != 5 e usa chassis_id+remote_sysname
                            elseif ($this->common->removeQuotes($this->common->getArrayData(4,$device)) != 5) {
                                $find['sysname']=$this->common->removeQuotes($this->common->getArrayData(9,$device));
                                $find['chassisid']=$this->common->removeQuotes($this->common->adjustLldpChassisId($this->common->getArrayData(4,$device),$this->common->getArrayData(5,$device)));
                            }
                            // senao usa chassisidsubtype_chassisid (provavelmente nao vai dar match com nada em host_map
                            else {
                                $find['chassisidsubtype']=$this->common->removeQuotes($this->common->getArrayData(4,$device));
                                $find['chassisid']=$this->common->removeQuotes($this->common->adjustLldpChassisId($this->common->getArrayData(4,$device),$this->common->getArrayData(5,$device)));
                            }


                            $data['chassisidsubtype']=$this->common->removeQuotes($this->common->getArrayData(4,$device));
                            $data['chassisid']=$this->common->removeQuotes($this->common->adjustLldpChassisId($this->common->getArrayData(4,$device),$this->common->getArrayData(5,$device)));
                            $data['sysname']=$this->common->removeQuotes($this->common->getArrayData(9,$device));
                            $data['sysdesc']=$this->common->removeQuotes($this->common->getArrayData(10,$device));
                            $data['syscapsupported']= $this->common->removeQuotes($this->common->getArrayData(11,$device));
                            $data['syscapenabled']=$this->common->removeQuotes($this->common->getArrayData(12,$device));
                            $data['discovery_protocol_id']=self::discoveryProtocolLLDP; //lldp
                            $data['lldpxmed_rem_hw']=$this->common->removeQuotes($this->common->getArrayData(1001,$device));
                            $data['lldpxmed_rem_fw']=$this->common->removeQuotes($this->common->getArrayData(1002,$device));
                            $data['lldpxmed_rem_sw']=$this->common->removeQuotes($this->common->getArrayData(1003,$device));
                            $data['lldpxmed_rem_serial']=$this->common->removeQuotes($this->common->getArrayData(1004,$device));
                            $data['lldpxmed_rem_mfgname']=$this->common->removeQuotes($this->common->getArrayData(1005,$device));
                            $data['lldpxmed_rem_model']=$this->common->removeQuotes($this->common->getArrayData(1006,$device));
                            $data['lldpxmed_rem_assetid']=$this->common->removeQuotes($this->common->getArrayData(1007,$device));
                            $data['snmp_host_id']=$snmpHostAddress->snmp_host_id;

                            //print_r($find);
                            //print_r($data);

                            $snmpSystemIp = SnmpHostRemote::updateOrCreate($find, $data);

                            Log::notice('setSnmpHostRemote:'. $snmpHostAddress->address . ' ' . $snmpHostAddress->snmpCmm->community_name.' insert/update chassisid:'.$data['chassisid']) ;

                            Log::debug('setSnmpHostRemote:'. $snmpHostAddress->address . ' ' . $snmpHostAddress->snmpCmm->community_name.' insert/update:'.$snmpSystemIp);

                        }
                    }
                }
            }
            else {
                Log::debug('setSnmpHostRemote:'. $snmpHostAddress->address . ' ' . $snmpHostAddress->snmpCmm->community_name.' empty array');
            }


        }
    }




    function setSnmpHostInterface($snmpHostAddress){
        // Gustavo 2017-11-12
        // obtem dados das interfaces e add no database

        Log::notice('setsnmpHostInterface:'.$snmpHostAddress->address);
        $interfaces=array();
        //$this->snmp->table($snmpHostAddress->ip_address, $snmpHostAddress->community, Snmp::lldpRemEntry, 2, 0)
        $interfaces=$this->snmp->table($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, Snmp::ifEntry,1,0);
        if (is_array($interfaces)){
            foreach ($interfaces as $interface) {
                //print_r($interface);

                $find=array();
                $data=array();

                $find['snmp_host_id']=$snmpHostAddress->snmp_host_id;
                $find['ifindex']=$interface[1];

                $data['ifdescr']=$this->common->removeQuotes($interface[2]);
                $data['iftype']=$interface[3];
                $data['ifspeed']=$interface[5];
                $data['ifphysaddress']=$this->common->removeSpaceQuotes($interface[6]);
                $data['ifadminstatus']=$interface[7];
                $data['ifoperstatus']=$interface[8];

                $int=SnmpHostInterface::updateOrCreate($find, $data);
                Log::debug('setsnmpHostInterface:'. $snmpHostAddress->ip_address . ' ' . $snmpHostAddress->community.' insert/update:'.$int);

            }
            //echo count($interfaces);
        }

    }

    function setSnmpHostInterfaceParam($snmpHostAddress, $paramName, $oid, $idArrayResultPos=-2, $paramIdPos=0){
        // Gustavo 2017-11-12
        // obtem dados complementares das interfaces para add no database

        Log::notice('setInterfacesAddParam ip:'.$snmpHostAddress->address.' paramName:'.$paramName);

        $ifparam = $this->snmp->table($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, $oid,$idArrayResultPos, $paramIdPos);

        if (is_array($ifparam)) {
            foreach ($ifparam as $param) {
                $ifindex=null;
                $value=null;


                // port_id precisa alterar os dados, pois o retorno no array é diferente
                if ($paramName == 'port_id'){
                    if (array_key_exists(2, $param)){
                        $ifindex=$param[2];
                    }
                    if (array_key_exists(1, $param)){
                        $value=$param[1];
                    }
                }
                else {
                    $ifindex=key($param);
                    $value=$param[key($param)];
                }


                if ($ifindex != null){
                    //print_r($param);
                    $find['snmp_host_id']=$snmpHostAddress->snmp_host_id;
                    $find['ifindex']=$ifindex;
                    $data[$paramName]=$this->common->removeQuotes($value);
                    $int=SnmpHostInterface::updateOrCreate($find, $data);
                    Log::debug('setInterfacesAddParam:'. $snmpHostAddress->address . ' ' .'insert/update:'.$int);

                }
            }
            //echo count($ifparam);
        }
        //}


    }

    public function setSnmpHostVlan($snmpHostAddress){
        // Gustavo 2017-11-12
        // obtem dados das vlans

        Log::notice('setSnmpHostVlan ip:'.$snmpHostAddress->address);

        $arrVlan=$this->getSnmpDataMap($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, $snmpHostAddress->snmpHost->snmp_device_class_id, 'vlan_list');
        //print_r($arrVlan);

        if (is_array($arrVlan)){
            foreach ($arrVlan as $vlan) {
                $find=array();
                $data=array();

                $find['snmp_host_id']=$snmpHostAddress->snmp_host_id;
                $find['vlan_index']=$vlan[1];

                $data['vlan_id']=$vlan[2];
                $data['vlan_name']=$this->common->removeQuotes($vlan[3]);
                $int=SnmpHostVlan::updateOrCreate($find, $data);
                Log::debug('setSnmpHostVlan:'. $snmpHostAddress->address . ' ' .'insert/update:'.$int);
            }
        }

        //}
    }

    public function setSnmpHostFdb($snmpHostAddress){
        // Gustavo 2017-11-12
        // obtem os enderecos mac da fdb

        Log::notice('setSnmpHostFdb ip:'.$snmpHostAddress->address);

        $arrFdb=$this->getSnmpDataMap($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name,
                                        $snmpHostAddress->snmpHost->snmp_device_class_id, 'fdb_list');
        //print_r($arrFdb);



        if (is_array($arrFdb)){
            //echo "fdb count:".count($arrFdb).PHP_EOL;
            foreach ($arrFdb as $fdb) {
                $find=array();
                $data=array();

                // varifica se existem todas as chaves no array antes de adicionar
                if (array_key_exists(1, $fdb) && array_key_exists(2, $fdb) && array_key_exists(3, $fdb)){
                    $find['snmp_host_id']=$snmpHostAddress->snmp_host_id;
                    $find['mac_address']=$this->common->removeSpaceQuotes($fdb[1]);
                    $find['ifindex']=$fdb[2];
                    $find['vlan_index']=$fdb[3];

                    $data['mac_address']=$this->common->removeSpaceQuotes($fdb[1]);
                    $int=SnmpHostFdb::updateOrCreate($find, $data);
                    Log::debug('setSnmpHostFdb:'. $snmpHostAddress->address . ' ' .'insert/update:'.$int);
                }
                else {
                    Log::debug('setSnmpHostFdb:'. $snmpHostAddress->address . ' ' .' not add - missing values:'.print_r($fdb, true));
                }


            }
        }
        //}
    }

    public function setSnmpHostConnection($snmpHostAddress,$discoveryProtocol=2)
    {
        // Gustavo 2017-11-12
        // obtem as conexoes via LLDP
        // TODO: cdp e edp

        Log::notice('setSnmpHostConnection:'.$snmpHostAddress->address);

        if ($discoveryProtocol == self::discoveryProtocolLLDP){
            $lldpNeighbor=$this->snmp->table($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, Snmp::lldpRemEntry,2,0);

            if (is_array($lldpNeighbor)){
                $i=0;
                foreach ($lldpNeighbor as $key=>$value) {
                    //Log::debug('setLLDPConnection:'.print_r($value, 1));
                    if (array_key_exists(4, $value)
                        && array_key_exists(5, $value)
                        && array_key_exists(6, $value)
                        && array_key_exists(7, $value)
                        && array_key_exists(10, $value)
                    )
                    {
                        $i++;
                        $find['remote_chassisid']=$this->common->adjustLldpChassisId($value[4],$value[5]);
                        $find['remote_portidsubtype']=$this->common->removeQuotes($value[6]);
                        $find['remote_portid']=$this->common->removeQuotes($value[7]);
                        $find['snmp_host_id']=$snmpHostAddress->snmp_host_id;
                        $find['local_portid']=$key;

                        //print_r($find);
                        $data['remote_portdesc']=$this->common->removeQuotes($value[10]);
                        $data['discovery_protocol_id']=$discoveryProtocol;

                        $int=SnmpHostConnection::updateOrCreate($find, $data);
                        Log::debug('setSnmpHostConnection:'. $snmpHostAddress->address . ' ' .'insert/update:'.$int);

                    }
                }
            }
        }
    }

    public function setSnmpHostIparp($snmpHostAddress, $version){
        // Gustavo 2017-11-12
        // obtem os dados ip/mac da tabela arp(ipv4) e ND(ipv6)

        Log::notice('setSnmpHostIparp ip (v'.$version.'):'.$snmpHostAddress->address);

        if ($version == 6){
            $function_name='ipv6nd_list';

        }
        else {
            $function_name='iparp_list';
        }

        $arrIP=$this->getSnmpDataMap($snmpHostAddress->address, $snmpHostAddress->snmpCmm->community_name, $snmpHostAddress->snmpHost->snmp_device_class_id, $function_name);

        if (is_array($arrIP)){
            foreach ($arrIP as $ips) {
                $find=array();
                $data=array();

                // verifica se existem todas as chaves no array antes de adicionar
                if (array_key_exists(1, $ips) && array_key_exists(2, $ips) && array_key_exists(3, $ips)){
                    $find['snmp_host_id']=$snmpHostAddress->snmp_host_id;
                    $find['mac_address']=$this->common->removeSpaceQuotes($ips[1]);
                    $find['ip_address']=$this->common->removeQuotes($ips[2]);
                    $find['vlan_index']=$this->common->removeQuotes($ips[3]);

                    $data['mac_address']=$this->common->removeSpaceQuotes($ips[1]);
                    $data['version']=$version;

                    $int=SnmpHostIparp::updateOrCreate($find, $data);
                    Log::debug('setSnmpHostIparp (v'.$version.'):'. $snmpHostAddress->address . ' ' .'insert/update:'.$int);
                }

            }
        }
        //}
    }




    function setHostFromSnmp(){
        // insere novo host, a partir das tabelas snmp_host e snmp_host_remotes

        $snmpHosts = SnmpHost::all();

        // insere hosts da tabela snmp_hosts

        foreach($snmpHosts as $snmpHost){
            // 1 - insere snmp_host somente insere se chassis_id for consistente
            if (strlen($this->common->adjustMacAddr($snmpHost->chassisid)) == 12){
                echo $snmpHost->hostname.PHP_EOL;

                // 1.1 - sync na tabela hosts
                $data=array();
                $find=array();

                $data['os_id'] = $snmpHost->snmpDeviceClass()->get()->first()->operating_system_id;
                $data['host_type_id'] = $snmpHost->snmpDeviceClass()->get()->first()->host_type_id;
                $data['status_id'] = self::hostStatusProd;
                $data['tag'] = explode(".",$snmpHost->sysname)[0];
                $data['hostname'] = $snmpHost->sysname;
                $data['descr'] = $snmpHost->sysdescr;
                $data['chassis_id'] = $this->common->adjustMacAddr($snmpHost->chassisid);
                $data['serial_number'] = $snmpHost->serialnumber;
                $data['aux_vendor_id'] = $snmpHost->snmpDeviceClass()->get()->first()->aux_vendor_id;

                $find['tag']=$data['tag'];
                $find['chassis_id']=$data['chassis_id'];

                $host=Host::updateOrCreate($find, $data);

                echo "HOST ID:".$host->id.PHP_EOL;
                // 1.2 - sync em host_map
                $data=array();
                $find=array();
                $data['host_id']=$host->id;
                $data['snmp_host_id']=$snmpHost->id;
                $find['host_id']=$data['host_id'];

                HostMap::updateOrCreate($find, $data);

                // 1.3 - sync em host_interfaces
                $snmpHostInterfaces = SnmpHostInterface::where('snmp_host_id',$snmpHost->id)->where('iftype', 6)->get();


                foreach($snmpHostInterfaces as $snmpHostInterface){
                    $data=array();
                    $find=array();
                    $data['host_id']=$host->id;
                    $data['ifname']=$snmpHostInterface->ifname;
                    $data['iftype']=$snmpHostInterface->iftype;
                    $data['ifspeed']=$snmpHostInterface->ifspeed;
                    $data['ifindex']=$snmpHostInterface->ifindex;
                    $data['ifooperstatus']=$snmpHostInterface->ifoperstatus;
                    $data['ifalias']=$snmpHostInterface->ifalias;
                    $data['portid']=$snmpHostInterface->portid;
                    $data['discovery_protocol_id']=self::discoveryProtocolSnmp;

                    $find['host_id']=$data['host_id'];
                    $find['ifindex']=$data['ifindex'];

                    $interface=HostInterface::updateOrCreate($find, $data);

                }

                // 1.4 - sync na tabela host_ips
                $snmpHostAddress = SnmpHostAddress::where('snmp_host_id',$snmpHost->id)->get()->first();

                // checar ipv4 ou ipv6
                $version = $this->ipCalc->IPversion($snmpHostAddress->address);
                // se o ip é valido, insere
                if ($version){
                    $data=array();
                    $find=array();

                    $data['host_id']=$host->id;
                    $data['ip_address']=$snmpHostAddress->address;
                    $mask=32;
                    if ($version==6){
                        $mask=128;
                    }
                    $data['mask']=$mask;
                    $data['version']=$version;

                    $find['host_id']=$data['host_id'];
                    $find['ip_address']=$data['ip_address'];

                    $hostIp=HostIP::updateOrCreate($find, $data);

                }

            }

        }



        // 2 - insere hosts da tabela snmp_host_remotes
        $snmpHostRemotes = SnmpHostRemote::all();

        foreach($snmpHostRemotes as $snmpHostRemote){

            if ($snmpHostRemote->sysname){
                $class_id=$this->getClassBySysdescr($snmpHostRemote->sysdesc);
                if ($class_id){
                    echo "\t".$snmpHostRemote->sysname." ".$class_id->name.PHP_EOL;

                    // 2.1 - sync na tabela hosts
                    $data=array();
                    $find=array();

                    $data['os_id'] = $class_id->operating_system_id;
                    $data['host_type_id'] = $class_id->host_type_id;
                    $data['status_id'] = self::hostStatusProd;
                    $data['tag'] = explode(".",$snmpHostRemote->sysname)[0];
                    $data['hostname'] = $snmpHostRemote->sysname;
                    $data['descr'] = $snmpHostRemote->sysdesc;

                    $data['chassis_id']=null;
                    if ($snmpHostRemote->chassisidsubtype == 4){
                        $data['chassis_id'] = $this->common->adjustMacAddr($snmpHostRemote->chassisid);
                    }
                    if ($snmpHostRemote->chassisidsubtype == 5){
                        // HARDCODED - CORRIGIR
                        // class_id Cisco IP Phone
                        if (
                            $class_id->id == 8 ||
                            $class_id->id == 9 ||
                            $class_id->id == 10
                        ){
                            // remove a string "SEP" e obtem o endereço MAC
                            $data['chassis_id']=$this->common->adjustMacAddr(substr(explode(".",$snmpHostRemote->sysname)[0], 3));
                        }

                        // class_id Aastra IP Phone
                        if ($class_id->id == 11){
                            $data['chassis_id']=$this->common->adjustMacAddr($snmpHostRemote->lldpxmed_rem_serial);
                            $data['tag']=$data['chassis_id'];
                            $data['descr']=$snmpHostRemote->lldpxmed_rem_hw." ".$snmpHostRemote->lldpxmed_rem_sw;
                        }
                    }

                    $data['serial_number'] = $snmpHostRemote->lldpxmed_rem_serial;
                    $data['aux_vendor_id'] = $class_id->aux_vendor_id;

                    //$find['tag']=$data['tag'];
                    $find['chassis_id']=$data['chassis_id'];

                    // insere somente se possui chassis_id
                    if (!is_null($data['chassis_id'])){
                        $host=Host::updateOrCreate($find, $data);

                        // 2.2 - sync em host_map
                        $data=array();
                        $find=array();

                        $data['host_id']=$host->id;
                        $data['snmp_host_remote_id']=$snmpHostRemote->id;
                        $find['host_id']=$data['host_id'];
                        HostMap::updateOrCreate($find, $data);


                        // 2.3 - sync em host_interfaces

                        // HARDCODED - CORRIGIR
                        // Class_id Cisco IP Phone, Aastra IP Phone, Cisco AP, Ciaco AP 2700
                        if (
                            $class_id->id == 8 ||
                            $class_id->id == 9 ||
                            $class_id->id == 10 ||
                            $class_id->id == 11 ||
                            $class_id->id == 12 ||
                            $class_id->id == 13
                        ){
                            $data=array();
                            $find=array();
                            $data['host_id']=$host->id;
                            $data['ifindex']="P0";
                            $data['portid']="0";
                            $data['discovery_protocol_id']=self::discoveryProtocolSnmp;

                            $find['host_id']=$data['host_id'];
                            $find['ifindex']=$data['ifindex'];

                            $interface=HostInterface::updateOrCreate($find, $data);

                        }
                    }
                }
                else {
                    echo "No class_id:".$snmpHostRemote->sysname.PHP_EOL;
                }
            }
        }
    }



    function setHostConnection(){
        $connections = SnmpHostConnection::all();

        foreach($connections as $connection){

            $host_b_chassisid=null;
            $host_b_port=null;

            $snmp_host_a=$connection->snmp_host_id;
            $snmp_host_a_port=$connection->local_portid;


            $host_a = SnmpHost::where('id', $connection->snmp_host_id)->get()->first();

            $interface_a = SnmpHostInterface::where('snmp_host_id', $connection->snmp_host_id)->where('portid',$snmp_host_a_port)->get();
            $interface_a_ifdescr=null;
            $interface_a_id=null;
            if (count($interface_a) > 0){
                $interface_a_id=$interface_a->first()->id;
                $interface_a_ifdescr=$interface_a->first()->ifdescr;
            }




            $remote_chassisid=$this->common->adjustMacAddr($connection->remote_chassisid);
            $host_b_port=$connection->remote_portid;

            switch ($connection->remote_portidsubtype){
                case '1':
                case '2':
                case '4':
                case '5':
                    // SNMP OID - interfaceAlias = 1
                    // SNMP OID - portComponent = 2
                    // SNMP OID - networkAddress = 4
                    // SNMP OID - interfaceName = 5
                    //      normalmente switch retorna com tipo 5
                    // SNMP OID - agentCircuitId = 6

                    if ($this->common->isMacAddr($remote_chassisid)){
                        $host_b_chassisid=$remote_chassisid;
                    }

                    if (is_null($host_b_port)){
                        $host_b_port="P0";
                    }

                    break;

                case '3':
                    // SNMP OID - macAddress = 3
                    // pode ser LLDP windows (chassisid = portid)
                    // pode ser telefone aastra (chassisid no portid)

                    if ($this->common->isMacAddr($remote_chassisid)){
                        $host_b_chassisid=$remote_chassisid;
                    }
                    else {
                        // se o chassisid esta no portid
                        $data = $this->common->adjustMacAddr($connection->remote_portid);
                        if ($this->common->isMacAddr($data)){
                            $host_b_chassisid=$data;
                            $host_b_port="P0";
                        }
                        break;
                    }


                    // se o portid ajustado for igual ao chassisid, define porta manualmente
                    if ($this->common->adjustMacAddr($connection->remote_portid) == $remote_chassisid){
                        $host_b_port="P0";
                    }
                    else {
                        if (is_null($host_b_port)){
                            $host_b_port="P0";
                        }
                    }

                    break;

                case '7':
                    // SNMP OID - local = 7
                    //      normalmente os telefones cisco retornam com esse tipo

                    if ($this->common->isMacAddr($remote_chassisid)){
                        $host_b_chassisid=$remote_chassisid;

                        if (is_null($host_b_port)){
                            $host_b_port="P0";
                        }
                    }
                    else {
                        // o remote chassis_id nao é um endereco mac
                        $data = explode(":",$connection->remote_portid);

                        if ($this->common->isMacAddr($data[0])){
                            $host_b_chassisid=$data[0];
                            $host_b_port="P0";
                        }


                    }
                    break;
            }

            $host_b_id=null;
            $host_b_chassisid=$this->common->adjustMacAddr($host_b_chassisid);
            $host_b = Host::where('chassis_id', $host_b_chassisid)->get();
            if (count($host_b) > 0){
                $host_b_id=$host_b->first()->id;
            }



            echo "HOST_A:".substr($host_a->sysname, 0, 20).
                " PORT (".$interface_a_id."):".$interface_a_ifdescr.
                "\t\t\t -> \t\t\t".
                "HOST_B chassis_id:".$host_b_chassisid.
                " PORT:".$host_b_port.
                " HOST_ID:".$host_b_id.
                PHP_EOL;
        }
    }














    /*
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    funcoes EXEC
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    */




    public function execSnmpHost($job=true)
    {
        // Gustavo 2017-11-12
        // Percorre as redes cadastradas e verifica se possui dispositivo que responde na community SNMP



        $networks =  Network::where('enabled', true)->orderBy('id', 'asc')->get();
        $last_community = null;

        //print_r($networks);

        // loop nas redes
        foreach ($networks as $net) {

            // loop nos IPs de cada rede
            $ips = $this->ipCalc->cidrAll($net->address);
            //print_r($ips);
            foreach ($ips as $ip) {

                //echo $ip. " ";
                $cmm=null;
                $check=false;

                // se endereço ja possui query valida, nao faz loop nas cmm.
                $hostAddress = SnmpHostAddress::where('address', $ip)->with('snmpCmm');
                if (count($hostAddress->get()) > 0){
                   // echo "HOST IP ";
                    $cmm=$hostAddress->first()->snmpCmm->community_name;
                    $check=true;
                }
                else {
                    // senao, verifica cache
                    $cache=SnmpHostAddressCache::where('address', $ip);

                    if (count($cache->get()) > 0){
                        // consulta cache 1 - verificar respostas que tem status = 1

                        if ($cache->first()->status == 1){
                            //echo "CACHE ";
                            $cache=SnmpHostAddressCache::where('address', $ip)->with('snmpCmm');
                            $cmm=$cache->first()->snmpCmm->community_name;
                            $check=true;
                        }
                        else {
                            // consulta cache - nao busca em hosts que nao responderam snmp recentemente
                            foreach ($cache->get() as $host){
                                $last_check = new Carbon($host->updated_at);
                                $past = Carbon::now()->subHours(24);

                                if ($last_check->lessThan($past)){
                                    $check=true;
                                }
                            }
                        }
                    }
                    else {
                        // nao tem registro no cache, executa o check
                        $check=true;
                    }
                }



                // se passou pelos criterios para realizar a checagem
                if ($check){


                    // se ja possui CMM definida, nao faz loop
                    if ($cmm){
                        if ($job){
                            Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm);
                            dispatch(new JobSnmpsystem($ip, $cmm));
                        }
                        else {
                            //Log::info("execSnmpHost:" . $ip . " community:" . $cmm->community_name);
                            $this->setSnmpHost($ip, $cmm);
                        }
                    }

                    // senao, faz loop nas CMMs definidas
                    else {
                        // loop nas cmms
                        $cmms = SnmpCmm::get();
                        foreach ($cmms as $cmm) {
                            if ($job){
                                Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                                dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                            }
                            else {
                                //Log::info("execSnmpHost:" . $ip . " community:" . $cmm->community_name);
                                $this->setSnmpHost($ip, $cmm->community_name);
                            }
                        }
                    }
                }
            }
        }
    }


    public function execSnmpHostDiscovery($discovery_type, $job=true, $discoveryProtocol=null)
    {
        // Gustavo 2017-11-12
        // Percorre os hosts encontrados e executa o job informado

        $address =  SnmpHostAddress::where('enabled', true)->orderBy('id', 'asc')->get();


        foreach ($address as $addr) {
            switch ($discovery_type){
                case 'remote':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setSnmpHostRemote($addr, $discoveryProtocol);
                    }
                    break;


                case 'interface':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setsnmpHostInterface($addr);

                        $this->setSnmpHostInterfaceParam($addr, 'ifalias', SNMP::ifAlias);
                        $this->setSnmpHostInterfaceParam($addr, 'ifname', SNMP::ifName);
                        $this->setSnmpHostInterfaceParam($addr, 'port_id', SNMP::dot1dBasePortEntry, 1);
                        $this->interfaceAdjustPortId();
                    }
                    break;

                case 'vlan':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setSnmpHostVlan($addr);
                    }
                    break;

                case 'fdb':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setSnmpHostFdb($addr);
                    }
                    break;

                case 'connection':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setSnmpHostConnection($addr, $discoveryProtocol);
                    }
                    break;

                case 'iparp':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setSnmpHostIparp($addr, 4);
                    }
                    break;

                case 'ipv6nd':
                    if ($job){
                        //Log::info("Created new job: JobSnmpHost ip:" . $ip . " community:" . $cmm->community_name);
                        //dispatch(new JobSnmpsystem($ip, $cmm->community_name));
                    }
                    else {
                        $this->setSnmpHostIparp($addr, 6);
                    }
                    break;
            }
        }
    }




    /*
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    NAO REFATORADO ABAIXO
    ^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~^~
    */


    public function drawMap(){
        $snmpsystem_id=268;


        $nodes=array();
        $node[0]='sw'.$snmpsystem_id;
        $i=1;

        $connections=DB::table('snmp.netmap_deviceconnections')->where('snmpsystem_id', $snmpsystem_id)->get();
        foreach ($connections as $connection){


            $device = DB::table('snmp.netmap_device')
                ->where('chassis_id', $connection->remote_netmap_chassisid)
                ->get();

            if ($device->count() > 0){
                $node[$i]='dev'.$device->first()->chassis_id;

                $interface=DB::table('snmp.netmap_deviceinterfaces')
                    ->where('snmpsystem_id', $snmpsystem_id)
                    ->where('port_id',$connection->local_portid)
                    ->get();

                if ($interface->count() > 0){
                    $edge[$i]['from']=0;
                    $edge[$i]['to']=$i;
                    $edge[$i]['label']=$interface->first()->ifdescr;
                }

                $i++;
            }




            // se portidsubtype=5 (mac addr), tenta encontrar o outro lado pelo chassisid
            //if ($connection->remote_portidsubtype=='5') {
            //    $device = DB::table('snmp.netmap_device')
            //        //->where('chassis_idsubtype', '5')
            //        ->where('chassis_id', $connection->remote_netmap_chassisid)
            //        ->get()->first();
            //}
            //if ($connection->remote_portidsubtype=='7') {
            //    $device = DB::table('snmp.netmap_device')
            //        //->where('chassis_idsubtype', '7')
            //        ->where('chassis_id', $connection->remote_netmap_chassisid)
            //        ->get()->first();
            //}

            // echo 'DEVICE (snmpsystem_id):'.$snmpsystem_id.' Local PORT:'.$connection->local_portid.' REMOTE netmap ID:'.$device->id.' REMOTE_sysname:'.$device->remote_sysname.PHP_EOL;



        }


        // var nodes = new vis.DataSet([
        //    {id: 1, label: 'Node 1'},
        //   {id: 2, label: 'Node 2'},
        //    {id: 3, label: 'Node 3'},
        //    {id: 4, label: 'Node 4'},
        //    {id: 5, label: 'Node 5'}
        //  ]);


        $printNode="var nodes = new vis.DataSet([";
        $j=0;
        foreach ($node as $key=>$value){
            $printNode .= "{id: ".$key.", label: '".$value."'}";
            $j++;
            if ($j < $i){
                $printNode .= ",
                ";
            }


        }
        $printNode .="]);";

        echo $printNode.PHP_EOL;



        //  var edges = [
        //    {from: 1, to: 2, label: 'middle',     font: {align: 'middle'}},
        //    {from: 1, to: 3, label: 'top',        font: {align: 'top'}},
        //    {from: 2, to: 4, label: 'horizontal', font: {align: 'horizontal'}},
        //    {from: 2, to: 5, label: 'bottom',     font: {align: 'bottom'}}
        //  ];


        $printEdge="var edges = [";
        $j=0;
        foreach ($edge as $key=>$value){
            $printEdge .= "{from : ".$value['from'].", to: ".$value['to'].", label: '".$value['label']."'}";
            $j++;
            if ($j < ($i-1)){
                $printEdge .= ",
                ";
            }
        }
        $printEdge .= "];";

        echo $printEdge.PHP_EOL;
        //print_r($node);
        //print_r($edge);
    }



}
