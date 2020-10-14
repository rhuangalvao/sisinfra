<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 25/05/2019
 * Time: 15:36
 */

namespace App\Domain;

use SebastianBergmann\CodeCoverage\Report\PHP;

class IPCalc
{

    public function cidrToRange($cidr)
    {
        $range = array();
        $cidr = explode('/', $cidr);
        $range[0] = long2ip((ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1]))));
        $range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$cidr[1])) - 1);
        return $range;
    }

    public function cidrAll($ip_addr_cidr)
    {
        $ip_arr = explode("/", $ip_addr_cidr);
        $bin = "";


        if ($ip_arr[1] == '32') {
            $ret[0] = $ip_arr[0];
            return $ret;
        }

        for ($i = 1; $i <= 32; $i++) {
            $bin .= $ip_arr[1] >= $i ? '1' : '0';
        }

        $ip_arr[1] = bindec($bin);

        $ip = ip2long($ip_arr[0]);
        $nm = $ip_arr[1];
        $nw = ($ip & $nm);
        $bc = $nw | ~$nm;
        $bc_long = ip2long(long2ip($bc));

        for ($zm = 1; ($nw + $zm) <= ($bc_long - 1); $zm++) {
            $ret[] = long2ip($nw + $zm);
        }
        return $ret;
    }

    public function IPversion($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return 4;
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return 6;
        } else {
            return false;
        }

    }

    public function isIPv4($ip){
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function isIPv6($ip){
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        }
        else {
            return false;
        }
    }



    public function mountIPv6fromDec($ip){
        // gustavo 2017-11-08
        // monta IPv6 a partir de decimal

        //ex: 40.4.31.4.0.0.7.53.0.0.0.0.0.0.0.1 => 2804:1f04:0000:0735:0000:0000:0000:0001
        //ex: 254.128.0.0.0.0.0.0.2.176.225.255.254.94.90.103 => fe80:0000:0000:0000:02b0:e1ff:fe5e:5a67

        $arrIPv6=explode('.',$ip);
        //print_r($arrIPv6);
        $ipv6=null;
        $j=1;
        foreach ($arrIPv6 as $octet){
            $ipv6 .= str_pad(dechex($octet),2,'0', STR_PAD_LEFT);
            if ((($j % 2) == 0) && ($j != 16)){
                $ipv6 .=":";
            }
            $j++;
        }

        return $ipv6;
    }


}