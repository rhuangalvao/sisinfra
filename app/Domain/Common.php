<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 25/05/2019
 * Time: 15:15
 */

namespace App\Domain;


class Common
{

    // Common: funcoes de manipulacao de strings e arrays


    const HOST_TYPE_SWITCH = 5;

    public function getHostTypeSwitch(){
        return self::HOST_TYPE_SWITCH;
    }


    // TODO: rever local dessa funcao
    function getSisinfraParamGlobal($param_name){

        $query=DB::table('sisinfra_params')->where('param_name',$param_name)->get();

        if ($query->count() > 0){
            return $query->first()->param_value;
        }
        else {
            return false;
        }
    }








    public function removeSpaceQuotes($str){
        // gustavo 2017-03-21
        // remove espacos e aspas duplas da string
        $ret=str_replace(" ","",(str_replace("\"","",$str)));

        if (!empty($ret)){
            return $ret;
        }
        else {
            return null;
        }

    }

    public function removeQuotes($str){
        // gustavo 2017-03-21
        // remove aspas duplas da string
        $ret=str_replace("\"","",$str);

        if (!empty($ret)){
            return $ret;
        }
        else {
            return null;
        }
    }

    public function adjustMacAddr($str){
        // gustavo 2017-05-08
        // ajusta mac addr removendo todos os caracteres indesejados
        //return strtoupper(str_replace(":","",$str));
        return strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $str));
    }

    public function isMacAddr($mac)
    {
        return (preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $mac) == 1);

        /*
        if (filter_var($mac, FILTER_VALIDATE_MAC)) {
            return true;
        }
        else {
            return false;
        }
        */

    }
    public function adjustMacAddrRemove8000($str){
        // gustavo 2017-06-10
        // remove valores 80 00 que vem de retorno da string do chassis_id do XOS

        $mac=$this->adjustMacAddr($str);

        if (strlen($mac) == 12){
            return $mac;
        }
        else {
            if (strlen($mac) > 12){
                if (substr($mac,0,4) == "8000"){
                    //echo substr($mac,4);
                    return substr($mac,4);
                }
            }
            else {
                return null;
            }
        }
    }

    public function adjustLldpChassisId($chassisIdSubType, $chassisId){
        // gustavo 2017-03-21
        // ajusta chassisID via LLDP

        /*
        interfaceAlias 	(1),
 		portComponent 	(2),
 		macAddress 	(3),
 		networkAddress 	(4),
 		interfaceName 	(5),
 		agentCircuitId 	(6),
 		local 	(7)
        */

        //echo "adjust-lldp:".$chassisIdSubType." ".$chassisId."\n";
        switch (trim($chassisIdSubType)){
            case '4':
                //endereco MAC
                return $this->adjustMacAddr($chassisId);
                break;
            case '5':
                //id
                return $this->removeSpaceQuotes($chassisId);

            default:
                return $chassisId;
                break;
        }

    }

    public function getArrayData($key, $arr){
        if (array_key_exists($key, $arr)){
            return $arr[$key];
        }
        else {
            return null;
        }
    }

    function array_key_increase($arr, $num_ini=1000){
        // aumenta os valores das chaves de determinado array, iniciando em num_ini
        $ret=array();
        if(is_array($arr)){
            foreach ($arr as $key => $value){
                foreach ($value as $key2 => $value2){
                    $ret[$key][$num_ini+$key2]=$value2;
                }
            }
            return $ret;
        }
        else {
            return $arr;
        }
    }

    function array_merge2($arr,$ins) {
        // funde 2 arrays mantendo os valores das chaves de cada um
        if(is_array($arr))
        {
            if(is_array($ins)) foreach($ins as $k=>$v)
            {
                if(isset($arr[$k])&&is_array($v)&&is_array($arr[$k]))
                {
                    $arr[$k] = $this->array_merge2($arr[$k],$v);
                }
                else {
                    // This is the new loop :)
                    while (isset($arr[$k]))
                        $k++;
                    $arr[$k] = $v;
                }
            }
        }
        elseif(!is_array($arr)&&(strlen($arr)==0||$arr==0))
        {
            $arr=$ins;
        }
        return($arr);
    }

    function getStringBetweenBrackets($string){
        // gustavo - 2018-01-19
        // retorna a primeira ocorrencia entre [] de uma string
        preg_match_all("/\[([^\]]*)\]/", $string, $matches);
        return $matches[1][0];

    }

    function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
        if (!defined('SATURDAY')) define('SATURDAY', 6);
        if (!defined('SUNDAY')) define('SUNDAY', 0);
        // Array of all public festivities
        $publicHolidays = array('01-01', '04-21', '05-01', '09-07', '10-12', '11-02', '11-15', '12-25');
        // The Patron day (if any) is added to public festivities
        if ($patron) {
            $publicHolidays[] = $patron;
        }
        /*
         * Array of all Easter Mondays in the given interval
         */
        $yearStart = date('Y', strtotime($date1));
        $yearEnd   = date('Y', strtotime($date2));
        for ($i = $yearStart; $i <= $yearEnd; $i++) {
            $easter = date('Y-m-d', easter_date($i));
            list($y, $m, $g) = explode("-", $easter);
            $monday = mktime(0,0,0, date($m), date($g)+1, date($y));
            $easterMondays[] = $monday;
        }
        $start = strtotime($date1);
        $end   = strtotime($date2);
        $workdays = 0;
        for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
            $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
            $mmgg = date('m-d', $i);
            if ($day != SUNDAY &&
                !in_array($mmgg, $publicHolidays) &&
                !in_array($i, $easterMondays) &&
                !($day == SATURDAY && $workSat == FALSE)) {
                $workdays++;
            }
        }
        return intval($workdays);
    }


}