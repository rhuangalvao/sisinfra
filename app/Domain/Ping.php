<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 29/10/2019
 * Time: 17:52
 */

namespace App\Domain;


class Ping
{

    function ping($host, $ttl=255, $timeout=10) {
        $latency = false;
        $ttl = escapeshellcmd($ttl);
        $timeout = escapeshellcmd($timeout);
        $host = escapeshellcmd($host);

        $exec_string = '/bin/ping -n -c 1 -t ' . $ttl . ' -W ' . $timeout . ' ' . $host . ' 2>&1';

        exec($exec_string, $output, $return);

        // Strip empty lines and reorder the indexes from 0 (to make results more
        // uniform across OS versions).
        //$this->commandOutput = implode('', $output);
        $output = array_values(array_filter($output));
        // If the result line in the output is not empty, parse it.
        if (!empty($output[1])) {
            // Search for a 'time' value in the result line.
            $response = preg_match("/time(?:=|<)(?<time>[\.0-9]+)(?:|\s)ms/", $output[1], $matches);
            // If there's a result and it's greater than 0, return the latency.
            if ($response > 0 && isset($matches['time'])) {
                $latency = round($matches['time'], 4);
            }
        }
        print_r($output);
        return $latency;
    }

}
