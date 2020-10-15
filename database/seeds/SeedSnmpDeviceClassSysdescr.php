<?php

use Illuminate\Database\Seeder;

class SeedSnmpDeviceClassSysdescr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'snmp_device_class_id' => 1, 'regex' => '/^(?=.*Cisco IOS)(?=.*C2960X)(?=.*Version 15.2)/s', 'order' => 10, 'enabled' => true],
            ['id' => 2, 'snmp_device_class_id' => 2, 'regex' => '/^(?=.*ExtremeXOS)(?=.*version 16)/s', 'order' => 20, 'enabled' => true],
            ['id' => 3, 'snmp_device_class_id' => 3, 'regex' => '/^(?=.*ExtremeXOS)(?=.*version 15)/s', 'order' => 30, 'enabled' => true],
            ['id' => 4, 'snmp_device_class_id' => 4, 'regex' => '/^(?=.*ExtremeXOS)(?=.*version 12)/s', 'order' => 40, 'enabled' => true],

            ['id' => 6, 'snmp_device_class_id' => 8, 'regex' => '/^(?=.*Cisco IP Phone 7841)/s', 'order' => 100, 'enabled' => true],
            ['id' => 7, 'snmp_device_class_id' => 9, 'regex' => '/^(?=.*Cisco IP Phone 3905)/s', 'order' => 100, 'enabled' => true],
            ['id' => 8, 'snmp_device_class_id' => 10, 'regex' => '/^(?=.*Cisco IP Phone 8845)/s', 'order' => 100, 'enabled' => true],
            ['id' => 9, 'snmp_device_class_id' => 11, 'regex' => '/^(?=.*Aastra IP Phone)/s', 'order' => 100, 'enabled' => true],

            ['id' => 10, 'snmp_device_class_id' => 12, 'regex' => '/^(?=.*Cisco AP Software)/s', 'order' => 100, 'enabled' => true],
            ['id' => 11, 'snmp_device_class_id' => 13, 'regex' => '/^(?=.*Cisco IOS)(?=.*C2700)(?=.*AP3G2)/s', 'order' => 100, 'enabled' => true],

            ['id' => 12, 'snmp_device_class_id' => 14, 'regex' => '/^(?=.*S5720-28P-PWR-LI-AC)/s', 'order' => 50, 'enabled' => true],

        ];
        DB::table('snmp_device_class_sysdescrs')->delete();
        DB::table('snmp_device_class_sysdescrs')->insert($insert);
        DB::statement("SELECT setval('public.snmp_device_class_sysdescrs', 10000, true);");
    }
}
