<?php

use Illuminate\Database\Seeder;

class SeedSnmpDeviceClassSysoid extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            ['id' => 1, 'function_name' => 'snmp_softwareversion', 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'oid' => '.1.3.6.1.4.1.1916.2.152', 'regex' => '/^16/'],
            ['id' => 2, 'function_name' => 'snmp_softwareversion', 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'oid' => '.1.3.6.1.4.1.1916.2.152', 'regex' => '/^15/'],
            ['id' => 3, 'function_name' => 'snmp_softwareversion', 'snmp_device_class_id' => '4', 'snmp_function_id' => '10', 'oid' => '.1.3.6.1.4.1.1916.2.152', 'regex' => '/^12/'],
            ['id' => 4, 'function_name' => 'snmp_softwareversion', 'snmp_device_class_id' => '6', 'snmp_function_id' => '30', 'oid' => '.1.3.6.1.4.1.1916.2.155', 'regex' => ''],
        ];
        DB::table('snmp_device_class_sysoids')->delete();
        DB::table('snmp_device_class_sysoids')->insert($insert);
    }
}
