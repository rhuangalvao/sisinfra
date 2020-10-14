<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 25/05/2019
 * Time: 15:30
 */

namespace App\Domain;


class Snmp
{
    const sysDescr = ".1.3.6.1.2.1.1.1.0";
    const sysObjectID = ".1.3.6.1.2.1.1.2.0";
    const sysUpTime = ".1.3.6.1.2.1.1.3.0";
    const sysContact = ".1.3.6.1.2.1.1.4.0";
    const sysName = ".1.3.6.1.2.1.1.5.0";
    const sysLocation = ".1.3.6.1.2.1.1.6.0";
    const sysServices = ".1.3.6.1.2.1.1.7.0";

    const lldpRemEntry = ".1.0.8802.1.1.2.1.4.1.1";
    const lldpXMedRemInventoryEntry = ".1.0.8802.1.1.2.1.5.4795.1.3.3.1";

    const ifEntry = ".1.3.6.1.2.1.2.2.1";
    const ifXEntry = ".1.3.6.1.2.1.31.1.1.1";
    const ifName = ".1.3.6.1.2.1.31.1.1.1.1";
    const ifAlias = ".1.3.6.1.2.1.31.1.1.1.18";

    const dot1dBasePortEntry = ".1.3.6.1.2.1.17.1.4.1";

    const dot1dTpFdbPort = ".1.3.6.1.2.1.17.4.3.1";
    const extremeFdbIpFdbEntry = ".1.3.6.1.4.1.1916.1.16.2.1";

    const atPhysAddress = ".1.3.6.1.2.1.3.1.1.2";
    const ipv6NetToMediaPhysAddress = ".1.3.6.1.2.1.55.1.12.1.2";


    function table($host, $community, $oidBase, $idArrayResultPos=1, $paramIdPos=0, $valuePos=-1)
    {
        /*
        gustavo 2017-05-23
        transforma o retorno de um snmpwalk em um array

        idArrayResultPos - posicao no oid resultante para ser o ID do array de retorno. se for -1, retorna todo o oid resultante, sem o paramID. se for -2 retorna id crescente comecando em 0
        paramIdPos - posicao do parametro da MIB dentro no oid resultante. usar -1 para setar parametro unico e fixo como "1" para os casos onde nao ha parametro sobrando (EX: MAC em decimal). se for array, retorna o conjunto das posicoes informadas, na ordem informada.
        valuePos - se for -1, retorna o value mesmo. Senao, retorna a posicao no oid resultante
        */

        snmp_set_quick_print(TRUE);
        snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
        snmp_set_enum_print(1);

        $retval = array();
        $raw = false;
        //$raw = @snmprealwalk($host, $community, $oidBase, 100000, 2);
        $raw = @snmprealwalk($host, $community, $oidBase);

        //print_r($raw);

        if ($raw === false){
            //echo "nodata";
            return false; // no data
        }


        $retval=array();
        $idRes=-1;
        $paramId=-1;

        foreach ($raw as $key => $value) {
            // TODO: checar se OID vem com "." no inicio e no fim. se nao tiver, deve corrigir antes de processar

            // remove o oidBase e deixa somente o restante
            $keyStriped=str_replace($oidBase.".", "", $key);

            // converte o oidBase em array
            $arr=explode(".",$keyStriped);

            // trata o paramIdPos
            if (is_array($paramIdPos)){
                $paramId="";
                $paramIdCount=0;
                foreach ($paramIdPos as $paramIdPoskey => $paramIdPosValue) {
                    if (array_key_exists($paramIdPosValue, $arr)){
                        $paramId.=$arr[$paramIdPosValue];
                        $paramIdCount++;
                        if ($paramIdCount < count($paramIdPos)){
                            $paramId.=".";
                        }
                    }
                }
            }
            else {
                if ($paramIdPos==-1){
                    $paramId=1;
                }
                else {
                    $paramId=$arr[$paramIdPos];
                }
            }

            //define qual sera o id do array resultante
            if ($idArrayResultPos == -1){
                // usa todo o oid resultante
                if ($paramIdPos!=-1){
                    unset($arr[$paramIdPos]);
                }
                $idRes=implode(".",$arr);
            }
            elseif ($idArrayResultPos == -2) {
                // usa numeracao crescente
                $idRes++;

            }
            else {
                // usa uma parte do oid resultante
                $idRes=$arr[$idArrayResultPos];
            }




            if ($valuePos == -1){
                $valueRet=$value;
            }
            else {
                $valueRet=$arr[$valuePos];
            }

            //echo "k2:".$keyStriped." id:".$paramId." idres:".$idRes." val:".$valueRet;
            //echo "\n";

            $retval[$idRes][$paramId]=$valueRet;

            $paramId2=$paramId;
        }


        if (count($retval) == 0) return ($retval); // no data

        return($retval);
    }




    function getValue($host, $community, $oid){

        snmp_set_quick_print(TRUE);
        snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
        snmp_set_enum_print(1);


        $raw = false;
        $raw = @snmp2_get($host, $community, $oid, 100000);

        //print_r($raw);

        if ($raw === false){
            //echo "nodata";
            //throw new Exception("ERROR snmpGetValue - oid:".$oid." host:".$host.".");
            return false;
        }
        else {
            return $raw;
        }
    }
}