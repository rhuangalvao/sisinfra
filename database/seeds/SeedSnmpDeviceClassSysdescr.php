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
        ];
        DB::table('snmp_device_class_sysdescrs')->delete();
        DB::table('snmp_device_class_sysdescrs')->insert($insert);
    }
}
