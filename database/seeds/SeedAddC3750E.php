<?php

use Illuminate\Database\Seeder;

class SeedAddC3750E extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $insert = [
            ['id' => 7, 'aux_vendor_id' => '1', 'operating_system_id' => '4', 'host_type_id' => '5', 'name' => 'Catalyst 3750E Series IOS 15.2'],
        ];
        DB::table('snmp_device_classes')->insert($insert);

        $insert= [
            ['id' => 37, 'snmp_device_class_id' => 7, 'snmp_function_id' => 21, 'function_name' => 'snmp_hostname'],
            ['id' => 38, 'snmp_device_class_id' => 7, 'snmp_function_id' => 23, 'function_name' => 'snmp_serialnumber'],
            ['id' => 39, 'snmp_device_class_id' => 7, 'snmp_function_id' => 25, 'function_name' => 'snmp_model'],
            ['id' => 40, 'snmp_device_class_id' => 7, 'snmp_function_id' => 27, 'function_name' => 'snmp_softwareversion'],
            ['id' => 41, 'snmp_device_class_id' => 7, 'snmp_function_id' => 28, 'function_name' => 'snmp_chassisid'],
            ['id' => 42, 'snmp_device_class_id' => 7, 'snmp_function_id' => 10, 'function_name' => 'vlan_list'],
            ['id' => 43, 'snmp_device_class_id' => 7, 'snmp_function_id' => 10, 'function_name' => 'fdb_list'],
            ['id' => 44, 'snmp_device_class_id' => 7, 'snmp_function_id' => 10, 'function_name' => 'iparp_list'],
            ['id' => 45, 'snmp_device_class_id' => 7, 'snmp_function_id' => 10, 'function_name' => 'ipv6nd_list'],
        ];
        DB::table('snmp_device_class_functions')->insert($insert);

        $insert= [
            ['id' => 5, 'snmp_device_class_id' => 7, 'regex' => '/^(?=.*Cisco IOS)(?=.*C3750E)(?=.*Version 15.2)/s', 'order' => 10, 'enabled' => true],
        ];
        DB::table('snmp_device_class_sysdescrs')->insert($insert);


    }
}
