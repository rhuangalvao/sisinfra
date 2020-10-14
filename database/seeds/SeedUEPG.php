<?php

use Illuminate\Database\Seeder;

class SeedUEPG extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert1 = [
            ['id' => 1, 'version' => '2c', 'community_name' => 'public'],
            ['id' => 2, 'version' => '2c', 'community_name' => 'public2'],
            ['id' => 3, 'version' => '2c', 'community_name' => 'publicUEPG'],
            ['id' => 4, 'version' => '2c', 'community_name' => 'publicUEPG2'],
        ];
        DB::table('snmp_cmms')->delete();
        DB::table('snmp_cmms')->insert($insert1);
        DB::statement("SELECT setval('public.snmp_cmms_id_seq', 10000, true);");


        $insert2 = [
            ['id'=> 1, 'network_type_id' => 1, 'name' => 'mgmt campus', 'address' => '172.19.0.0/23', 'enabled' => true],
            ['id'=> 2, 'network_type_id' => 1, 'name' => 'mgmt hu', 'address' => '172.19.21.0/26', 'enabled' => true],
            ['id'=> 3, 'network_type_id' => 1, 'name' => 'mgmt centro', 'address' => '172.21.0.0/24', 'enabled' => true],
        ];
        DB::table('networks')->delete();
        DB::table('networks')->insert($insert2);
        DB::statement("SELECT setval('public.networks_id_seq', 10000, true);");

        $insert3 = [
            ['id' => 1, 'network_id' => 1, 'snmp_cmm_id' => 1, 'enabled' => true],
            ['id' => 2, 'network_id' => 1, 'snmp_cmm_id' => 2, 'enabled' => true],
            ['id' => 3, 'network_id' => 1, 'snmp_cmm_id' => 3, 'enabled' => true],
            ['id' => 4, 'network_id' => 1, 'snmp_cmm_id' => 4, 'enabled' => true],

            ['id' => 5, 'network_id' => 2, 'snmp_cmm_id' => 1, 'enabled' => true],
            ['id' => 6, 'network_id' => 2, 'snmp_cmm_id' => 2, 'enabled' => true],
            ['id' => 7, 'network_id' => 2, 'snmp_cmm_id' => 3, 'enabled' => true],
            ['id' => 8, 'network_id' => 2, 'snmp_cmm_id' => 4, 'enabled' => true],

            ['id' => 9, 'network_id' => 3, 'snmp_cmm_id' => 1, 'enabled' => true],
            ['id' => 10, 'network_id' => 3, 'snmp_cmm_id' => 2, 'enabled' => true],
            ['id' => 11, 'network_id' => 3, 'snmp_cmm_id' => 3, 'enabled' => true],
            ['id' => 12, 'network_id' => 3, 'snmp_cmm_id' => 4, 'enabled' => true],
        ];
        DB::table('snmp_discoveries')->delete();
        DB::table('snmp_discoveries')->insert($insert3);
        DB::statement("SELECT setval('public.snmp_discoveries_id_seq', 10000, true);");
    }
}
