<?php

use Illuminate\Database\Seeder;

class SeedSnmpDeviceClassFunction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'snmp_device_class_id' => '1', 'snmp_function_id' => '21', 'function_name' => 'snmp_hostname'],
            ['id' => 2, 'snmp_device_class_id' => '2', 'snmp_function_id' => '22', 'function_name' => 'snmp_hostname'],
            ['id' => 3, 'snmp_device_class_id' => '3', 'snmp_function_id' => '22', 'function_name' => 'snmp_hostname'],
            ['id' => 4, 'snmp_device_class_id' => '4', 'snmp_function_id' => '22', 'function_name' => 'snmp_hostname'],
            ['id' => 5, 'snmp_device_class_id' => '1', 'snmp_function_id' => '23', 'function_name' => 'snmp_serialnumber'],
            ['id' => 6, 'snmp_device_class_id' => '2', 'snmp_function_id' => '24', 'function_name' => 'snmp_serialnumber'],
            ['id' => 7, 'snmp_device_class_id' => '3', 'snmp_function_id' => '24', 'function_name' => 'snmp_serialnumber'],
            ['id' => 8, 'snmp_device_class_id' => '4', 'snmp_function_id' => '24', 'function_name' => 'snmp_serialnumber'],
            ['id' => 9, 'snmp_device_class_id' => '1', 'snmp_function_id' => '25', 'function_name' => 'snmp_model'],
            ['id' => 10, 'snmp_device_class_id' => '2', 'snmp_function_id' => '26', 'function_name' => 'snmp_model'],
            ['id' => 11, 'snmp_device_class_id' => '3', 'snmp_function_id' => '26', 'function_name' => 'snmp_model'],
            ['id' => 12, 'snmp_device_class_id' => '4', 'snmp_function_id' => '26', 'function_name' => 'snmp_model'],
            ['id' => 13, 'snmp_device_class_id' => '1', 'snmp_function_id' => '27', 'function_name' => 'snmp_softwareversion'],
            ['id' => 17, 'snmp_device_class_id' => '1', 'snmp_function_id' => '28', 'function_name' => 'snmp_chassisid'],
            ['id' => 14, 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'function_name' => 'snmp_softwareversion'],
            ['id' => 15, 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'function_name' => 'snmp_softwareversion'],
            ['id' => 16, 'snmp_device_class_id' => '4', 'snmp_function_id' => '10', 'function_name' => 'snmp_softwareversion'],
            ['id' => 18, 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'function_name' => 'snmp_chassisid'],
            ['id' => 19, 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'function_name' => 'snmp_chassisid'],
            ['id' => 20, 'snmp_device_class_id' => '4', 'snmp_function_id' => '10', 'function_name' => 'snmp_chassisid'],
            ['id' => 21, 'snmp_device_class_id' => '6', 'snmp_function_id' => '30', 'function_name' => 'snmp_softwareversion'],
            ['id' => 22, 'snmp_device_class_id' => '1', 'snmp_function_id' => '10', 'function_name' => 'vlan_list'],
            ['id' => 23, 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'function_name' => 'vlan_list'],
            ['id' => 24, 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'function_name' => 'vlan_list'],
            ['id' => 25, 'snmp_device_class_id' => '4', 'snmp_function_id' => '10', 'function_name' => 'vlan_list'],
            ['id' => 26, 'snmp_device_class_id' => '1', 'snmp_function_id' => '10', 'function_name' => 'fdb_list'],
            ['id' => 27, 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'function_name' => 'fdb_list'],
            ['id' => 28, 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'function_name' => 'fdb_list'],
            ['id' => 29, 'snmp_device_class_id' => '4', 'snmp_function_id' => '10', 'function_name' => 'fdb_list'],
            ['id' => 30, 'snmp_device_class_id' => '1', 'snmp_function_id' => '10', 'function_name' => 'iparp_list'],
            ['id' => 31, 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'function_name' => 'iparp_list'],
            ['id' => 32, 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'function_name' => 'iparp_list'],
            ['id' => 33, 'snmp_device_class_id' => '4', 'snmp_function_id' => '10', 'function_name' => 'iparp_list'],
            ['id' => 34, 'snmp_device_class_id' => '1', 'snmp_function_id' => '10', 'function_name' => 'ipv6nd_list'],
            ['id' => 35, 'snmp_device_class_id' => '2', 'snmp_function_id' => '10', 'function_name' => 'ipv6nd_list'],
            ['id' => 36, 'snmp_device_class_id' => '3', 'snmp_function_id' => '10', 'function_name' => 'ipv6nd_list'],
        ];
        DB::table('snmp_device_class_functions')->delete();
        DB::table('snmp_device_class_functions')->insert($insert);
    }
}
