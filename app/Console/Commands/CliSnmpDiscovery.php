<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Domain\SnmpDiscovery;
use App\Domain\Ping;

class CliSnmpDiscovery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snmp:discovery 
    {--job=} 
    {--exec=} 
    {--execsingle=} 
    {--exec-all : execute all discovery methods}
    {--ip=} 
    {--community=} 
    {--sync=} 
    {--addhost=} 
    {--list=} 
    {--syncConn : sync discovery host connections and interfaces}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SNMP Discovery';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $snmpDiscovery = new SnmpDiscovery();

        if ($this->option('syncConn')) {

            //$snmpDiscovery->setHostFromSnmp();

            $snmpDiscovery->setHostConnection();
        }


        //$ping = new Ping();
        //echo $ping->ping('177.101.17.22');



        /*

        $snmpDiscovery->setSnmpHost('172.19.21.13', 'public2');

        //print_r($snmpDiscovery->getSnmpHostType(11));

        //$snmpHostAddress = \App\SnmpHostAddress::find(15);
        //$snmpDiscovery->setSnmpHostIparp($snmpHostAddress, 6);

        //$snmpDiscovery->interfaceAdjustPortId();
        */




        if ($this->option('exec-all')) {

            // discovery novos hosts - a cada 6h
            $snmpDiscovery->execSnmpHost(false);

            // remote - run a cada 15 min
            $snmpDiscovery->execSnmpHostDiscovery('remote', false);

            // interface - a cada 24h
            $snmpDiscovery->execSnmpHostDiscovery('interface', false);

            // vlan - a cada 6h
            $snmpDiscovery->execSnmpHostDiscovery('vlan', false);

            // fdb - a cada 10 min
            $snmpDiscovery->execSnmpHostDiscovery('fdb', false);

            // connection - a cada 15 min
            $snmpDiscovery->execSnmpHostDiscovery('connection', false, 2);

            // iparp - a cada 15 min
            $snmpDiscovery->execSnmpHostDiscovery('iparp', false);

            // ipv6nd - a cada 15 min
            $snmpDiscovery->execSnmpHostDiscovery('ipv6nd', false);
        }


    }
}
