<?php

use Illuminate\Database\Seeder;

class SeedSnmpDeviceClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'aux_vendor_id' => '1', 'operating_system_id' => '4', 'host_type_id' => '5', 'name' => 'Catalyst 2960X Series IOS 15.2'],
            ['id' => 2, 'aux_vendor_id' => '2', 'operating_system_id' => '3', 'host_type_id' => '5', 'name' => 'Extreme XOS 16'],
            ['id' => 3, 'aux_vendor_id' => '2', 'operating_system_id' => '2', 'host_type_id' => '5', 'name' => 'Extreme XOS 15'],
            ['id' => 4, 'aux_vendor_id' => '2', 'operating_system_id' => '38', 'host_type_id' => '5', 'name' => 'Extreme XOS 12'],
            ['id' => 6, 'aux_vendor_id' => '3', 'operating_system_id' => '39', 'host_type_id' => '5', 'name' => 'D-Link DES-3028'],

            ['id' => 8, 'aux_vendor_id' => '1', 'operating_system_id' => '21', 'host_type_id' => '7', 'name' => 'Cisco IP Phone 7841'],
            ['id' => 9, 'aux_vendor_id' => '1', 'operating_system_id' => '21', 'host_type_id' => '7', 'name' => 'Cisco IP Phone 3905'],
            ['id' => 10, 'aux_vendor_id' => '1', 'operating_system_id' => '21', 'host_type_id' => '7', 'name' => 'Cisco IP Phone 8845'],
            ['id' => 11, 'aux_vendor_id' => '7', 'operating_system_id' => '30', 'host_type_id' => '7', 'name' => 'Aastra IP Phone'],

            ['id' => 12, 'aux_vendor_id' => '1', 'operating_system_id' => '40', 'host_type_id' => '8', 'name' => 'Cisco AP'],
            ['id' => 13, 'aux_vendor_id' => '1', 'operating_system_id' => '40', 'host_type_id' => '8', 'name' => 'Cisco AP 2700'],

            ['id' => 14, 'aux_vendor_id' => '4', 'operating_system_id' => '41', 'host_type_id' => '5', 'name' => 'Huawei S5720-28P-PWR-LI-AC'],


        ];
        DB::table('snmp_device_classes')->delete();
        DB::table('snmp_device_classes')->insert($insert);
        DB::statement("SELECT setval('public.snmp_device_classes', 10000, true);");
    }
}
