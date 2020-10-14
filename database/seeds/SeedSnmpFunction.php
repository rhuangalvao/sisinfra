<?php

use Illuminate\Database\Seeder;

class SeedSnmpFunction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert =
            [
                ['id' => 1, 'function_name' => 'vlan_list', 'oid_name' => 'extremeVlanIfEntry', 'oid' => '.1.3.6.1.4.1.1916.1.2.1.2.1', 'descr' => 'lista de VLANs sw extreme', 'p1' => 1, 'p2' => 0, 'p3' => -1, 'regex' => '' ],
                ['id' => 2, 'function_name' => 'vlan_list', 'oid_name' => 'vtpVlanEntry', 'oid' => '.1.3.6.1.4.1.9.9.46.1.3.1.1', 'descr' => 'lista de VLANs sw cisco', 'p1' => 2, 'p2' => 0, 'p3' => -1, 'regex' => '' ],
                ['id' => 3, 'function_name' => 'fdb_list', 'oid_name' => 'extremeFDB', 'oid' => '', 'descr' => 'Extreme FDB', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 4, 'function_name' => 'fdb_list', 'oid_name' => 'ciscoFDB', 'oid' => '', 'descr' => 'Cisco FDB', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 5, 'function_name' => 'iparp_list', 'oid_name' => 'extreme', 'oid' => '', 'descr' => 'Extreme IPARP', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 6, 'function_name' => 'iparp_list', 'oid_name' => 'cisco', 'oid' => '', 'descr' => 'Cisco IPARP', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 7, 'function_name' => 'iparp_list', 'oid_name' => 'extreme15227', 'oid' => '', 'descr' => 'Extreme IPARP v15227', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 8, 'function_name' => 'snmp_sysname', 'oid_name' => 'cisco', 'oid' => '.1.3.6.1.4.1.9.2.1.3.0', 'descr' => 'ciscoSystem hostName', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 9, 'function_name' => 'snmp_serialnumber', 'oid_name' => 'cisco', 'oid' => '.1.3.6.1.4.1.9.5.1.3.1.1.26.1', 'descr' => 'ciscoStackMib moduleSerialNumberStringName', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 10, 'function_name' => 'snmp_model', 'oid_name' => 'cisco', 'oid' => '.1.3.6.1.4.1.9.5.1.3.1.1.17.1', 'descr' => 'ciscoStackMibmoduleModel', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 11, 'function_name' => 'snmp_vendor', 'oid_name' => 'cisco', 'oid' => '', 'descr' => '', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 12, 'function_name' => 'snmp_software_version', 'oid_name' => 'cisco', 'oid' => '.1.3.6.1.4.1.9.5.1.3.1.1.20.1', 'descr' => 'ciscoStackMib moduleSwVersion', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 13, 'function_name' => 'snmp_chassis_id', 'oid_name' => 'cisco', 'oid' => '.1.3.6.1.4.1.9.9.500.1.2.1.1.7.1001', 'descr' => 'ciscoStackwiseMib cswSwitchMacAddress', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 14, 'function_name' => 'snmp_sysname', 'oid_name' => 'extreme', 'oid' => '', 'descr' => '', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 15, 'function_name' => 'snmp_serialnumber', 'oid_name' => 'extreme', 'oid' => '.1.3.6.1.4.1.1916.1.1.1.16.0', 'descr' => 'extremeSystemMib extremeSystemID', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 16, 'function_name' => 'snmp_model', 'oid_name' => 'extreme', 'oid' => '', 'descr' => '', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 17, 'function_name' => 'snmp_vendor', 'oid_name' => 'extreme', 'oid' => '', 'descr' => '', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 18, 'function_name' => 'snmp_software_version', 'oid_name' => 'extreme', 'oid' => '', 'descr' => '', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 19, 'function_name' => 'snmp_chassis_id', 'oid_name' => 'extreme', 'oid' => '.1.3.6.1.4.1.1916.1.17.1.1.7.1', 'descr' => 'DEPRECATED extremeStpExtensionsMib extremeStpDomainBridgeId', 'p1' => 1, 'p2' => -1, 'p3' => -1, 'regex' => '' ],
                ['id' => 21, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.9.2.1.3.0', 'descr' => 'snmp_hostname cisco - CiscoSystem hostName', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 22, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.2.1.1.5.0', 'descr' => 'snmp_hostname extreme - sysName', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 23, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.9.5.1.3.1.1.26.1', 'descr' => 'snmp_serialnumber cisco - ciscoStackMib moduleSerialNumberStringName', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 24, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.1916.1.1.1.16.0', 'descr' => 'snmp_serialnumber extreme - extremeSystemMib extremeSystemID', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 25, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.9.5.1.3.1.1.17.1', 'descr' => 'snmp_model cisco ciscoStackMibmoduleModel', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 26, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.1916.1.1.1.34.1.10.3', 'descr' => 'snmp_model extreme - regex entre parenteses', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '/\\((.*?)\\)/' ],
                ['id' => 27, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.9.5.1.3.1.1.20.1', 'descr' => 'snmp_softwareversion cisco - ciscoStackMib moduleSwVersion', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 28, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.9.9.500.1.2.1.1.7.1001', 'descr' => 'snmp_chassisid cisco - ciscoStackwiseMib cswSwitchMacAddress', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 29, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.4.1.1916.1.17.1.1.7.1', 'descr' => 'nao utilziado - funcao 10 - snmp_chassisid extreme extremeSystemMib extremeSystemID - necessita processar string - ', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 30, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.3.6.1.2.1.16.19.2.0', 'descr' => 'snmp_softwareversion dlink probeSoftwareRev', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
                ['id' => 33, 'function_name' => '', 'oid_name' => '', 'oid' => '.1.0.8802.1.1.2.1.4.1.1', 'descr' => 'lldpRemEntry', 'p1' => null, 'p2' => null, 'p3' => null, 'regex' => '' ],
            ];
        DB::table('snmp_functions')->delete();
        DB::table('snmp_functions')->insert($insert);
    }
}
