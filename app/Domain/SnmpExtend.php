<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 25/05/2019
 * Time: 15:35
 */

namespace App\Domain;

use Illuminate\Support\Facades\DB;


use App\SnmpHostVlan;


class SnmpExtend
{
    public function __construct(){

        $snmp = new Snmp();
        $this->snmp = $snmp;
        $common = new Common();
        $this->common = $common;
        $ipcalc = new IPCalc();
        $this->ipcalc = $ipcalc;
    }

    public function custom($ip, $community, $device_snmp_id, $function_name){

        switch ($function_name){

            //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
            case 'snmp_softwareversion':
                //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
                // softwareversion ExtremeXOS 16,15,12 (ids 2,3,4)
                if ($device_snmp_id == 2 ||
                    $device_snmp_id == 3 ||
                    $device_snmp_id == 4){
                    return $this->getSnmpVersionExtremeXOS($ip, $community);
                }
                break;

            //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
            case 'snmp_chassisid':
                //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
                // chassisid ExtremeXOS 16,15,12 (ids 2,3,4)
                if ($device_snmp_id == 2 ||
                    $device_snmp_id == 3 ||
                    $device_snmp_id == 4){
                    return $this->common->adjustMacAddrRemove8000($this->snmp->getValue($ip, $community, ".1.3.6.1.4.1.1916.1.17.1.1.7.1"));
                }
                break;

            //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
            case 'vlan_list':
                //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
                // chassisid ExtremeXOS 16,15,12 (ids 2,3,4)
                if ($device_snmp_id == 2 ||
                    $device_snmp_id == 3 ||
                    $device_snmp_id == 4){

                    $arrVlan=$this->snmp->table($ip, $community, '.1.3.6.1.4.1.1916.1.2.1.2.1', 1, 0, -1);
                    $arr=array();
                    $i=0;

                    if (is_array($arrVlan)) {
                        foreach ($arrVlan as $value) {
                            //print_r($value);
                            $arr[$i][1] = $value[1];
                            $arr[$i][2] = $value[10];
                            $arr[$i][3] = $value[2];
                            $i++;
                        }
                        return $arr;
                    }
                    else {
                        return false;
                    }

                }

                // chassisid cisco c2960X
                if ($device_snmp_id == 1){
                    $arrVlan=$this->snmp->table($ip, $community, '.1.3.6.1.4.1.9.9.46.1.3.1.1', 2, 0, -1);
                    $arr=array();
                    $i=0;
                    if (is_array($arrVlan)) {
                        foreach ($arrVlan as $key => $value) {
                            $arr[$i][1] = $key;
                            $arr[$i][2] = $key;
                            $arr[$i][3] = $value[4];
                            $i++;
                        }
                        return $arr;
                    }
                    else {
                        return false;
                    }
                }

                break;

            //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
            case 'fdb_list':
                //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
                // chassisid cisco c2960X
                if ($device_snmp_id == 1){



                    // obtem a lista de vlans
                    /*
                    $vlans=DB::table('snmp.netmap_snmpsystem_ip')
                        ->where('ip_address',$ip)
                        ->join('snmp.netmap_snmpsystem','snmp.netmap_snmpsystem.id','=','snmp.netmap_snmpsystem_ip.netmap_snmpsystem_id')
                        ->join('snmp.netmap_vlan','snmp.netmap_vlan.snmpsystem_id','=','snmp.netmap_snmpsystem.id')
                        ->select('vlan_id')
                        ->get();
                    */


                    // consulta para obter vlans de sw cisco
                    $arrVlan=$this->snmp->table($ip, $community, '.1.3.6.1.4.1.9.9.46.1.3.1.1', 2, 0, -1);
                    $vlans=array();

                    if (is_array($arrVlan)) {
                        foreach ($arrVlan as $key => $value) {
                            $vlans[] = $key;
                        }
                    }

                    //print_r($vlans);

                    $arr=array();
                    // loop nas vlans

                    //print_r($vlans);

                    $i=0;
                    foreach ($vlans as $vlan => $vlan_id){
                        //echo "id:".$vlan_id;

                            $fdb = $this->snmp->table($ip, $community . '@' . $vlan_id, Snmp::dot1dTpFdbPort, -1, 0);

                            //echo 'vlan_id:'.$vlan_id.' cmm:'.$community.PHP_EOL;
                            //print_r($fdb);
                            if (is_array($fdb)) {
                                //echo "\t Count FDB:".count($fdb);
                                // ajusta o array
                                foreach ($fdb as $value) {
                                    //print_r($value);
                                    if (array_key_exists(1, $value) && array_key_exists(2, $value)) {
                                        if (strlen($this->common->adjustMacAddr($this->common->removeSpaceQuotes($value[1]))) == 12) {
                                            $arr[$i][1] = $value[1];
                                            $arr[$i][2] = $value[2];
                                            $arr[$i][3] = $vlan_id;
                                            $i++;
                                        }
                                    }
                                }
                                //echo " i:".$i;
                                //print_r($arr);

                            }
                            //echo PHP_EOL;
                    }
                    return $arr;
                }




                // chassisid ExtremeXOS 16,15,12 (ids 2,3,4)
                if ($device_snmp_id == 2 ||
                    $device_snmp_id == 3 ||
                    $device_snmp_id == 4){


                    $fdb=$this->snmp->table($ip, $community, Snmp::extremeFdbIpFdbEntry,1,0);

                    if (is_array($fdb)){
                        //echo "\t Count FDB:".count($fdb)."\n";
                        // ajusta o array
                        //print_r($fdb);
                        $arr=array();
                        $i=0;
                        foreach ($fdb as $value) {
                            //print_r($value);
                            if (array_key_exists(3, $value) && array_key_exists(5, $value) && array_key_exists(4, $value)) {
                                if (strlen($this->common->adjustMacAddr($this->common->removeSpaceQuotes($value[3]))) == 12) {
                                    $arr[$i][1] = $value[3];
                                    $arr[$i][2] = $value[5];
                                    $arr[$i][3] = $value[4];
                                    $i++;
                                }
                            }
                        }
                        //print_r($arr);
                        return $arr;
                    }
                    else {
                        return false;
                    }
                }


                break;

            //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
            case 'iparp_list':
                //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
                // chassisid cisco c2960X
                // chassisid ExtremeXOS 16,15 (ids 2,3)
                if ($device_snmp_id == 1 ||
                    $device_snmp_id == 2 ||
                    $device_snmp_id == 3
                ) {

                    $iparp=$this->snmp->table($ip, $community, Snmp::atPhysAddress,0, array('2','3','4','5'));
                    $arr = null;
                    if (is_array($iparp)) {
                        // transforma o array resultante em um formato de acrodo com o input necessario para inserir no banco de dados
                        $i = 0;
                        foreach ($iparp as $vlan => $value) {
                            foreach ($value as $ip => $mac) {
                                if ($this->ipcalc->isIPv4($ip)){
                                    $arr[$i][1] = $mac;
                                    $arr[$i][2] = $ip;
                                    $arr[$i][3] = $vlan;
                                    $i++;
                                }
                            }
                        }
                    }


                    if (is_array($arr)){
                        return $arr;
                    }
                    else {
                        return false;
                    }

                }

                // chassisid ExtremeXOS 12 (id 4)
                if ($device_snmp_id == 4) {
                    $iparp=$this->snmp->table($ip, $community, Snmp::atPhysAddress,0, array('1','2','3','4'));
                    $arr = null;
                    if (is_array($iparp)) {
                        // transforma o array resultante em um formato de acrodo com o input necessario para inserir no banco de dados
                        $i = 0;
                        foreach ($iparp as $vlan => $value) {
                            foreach ($value as $ip => $mac) {
                                if ($this->ipcalc->isIPv4($ip)){
                                    $arr[$i][1] = $mac;
                                    $arr[$i][2] = $ip;
                                    $arr[$i][3] = $vlan;
                                    $i++;
                                }
                            }
                        }
                    }

                    if (is_array($arr)){
                        return $arr;
                    }
                    else {
                        return false;
                    }



                }
                break;




            //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
            case 'ipv6nd_list':
                //-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~
                // chassisid cisco c2960X
                // chassisid ExtremeXOS 16,15 (ids 2,3)
                if ($device_snmp_id == 1 ||
                    $device_snmp_id == 2 ||
                    $device_snmp_id == 3
                ) {

                    $iparp=$this->snmp->table($ip, $community, Snmp::ipv6NetToMediaPhysAddress,0, array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'));
                    $arr = null;
                    if (is_array($iparp)) {
                        // transforma o array resultante em um formato de acrodo com o input necessario para inserir no banco de dados
                        $i = 0;
                        foreach ($iparp as $vlan => $value) {
                            foreach ($value as $ip => $mac) {

                                $ipv6=$this->ipcalc->mountIPv6fromDec($ip);
                                if ($this->ipcalc->isIPv6($ipv6)){
                                    $arr[$i][1] = $mac;
                                    $arr[$i][2] = $ipv6;
                                    $arr[$i][3] = $vlan;
                                    $i++;
                                }
                            }
                        }
                    }


                    if (is_array($arr)){
                        return $arr;
                    }
                    else {
                        return false;
                    }

                }
                break;






        }


    }


    private function getSnmpVersionExtremeXOS($ip,$community){
        $extremePrimarySoftwareRev = $this->snmp->getValue($ip, $community, ".1.3.6.1.4.1.1916.1.1.1.13.0");
        $extremeSecondarySoftwareRev = $this->snmp->getValue($ip, $community, ".1.3.6.1.4.1.1916.1.1.1.14.0");
        $extremeImageToUseOnReboot = $this->snmp->getValue($ip, $community, ".1.3.6.1.4.1.1916.1.1.1.15.0");

        if ($extremeImageToUseOnReboot == 1) {
            return $extremePrimarySoftwareRev;
        }
        else {
            return $extremeSecondarySoftwareRev;
        }
    }
}