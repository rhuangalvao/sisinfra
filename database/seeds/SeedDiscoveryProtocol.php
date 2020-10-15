<?php

use Illuminate\Database\Seeder;

class SeedDiscoveryProtocol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            ['id' => 1, 'name' => 'undef', 'order' => 50 ],
            ['id' => 2, 'name' => 'lldp', 'order' => 40 ],
            ['id' => 3, 'name' => 'cdp', 'order' => 20 ],
            ['id' => 4, 'name' => 'edp', 'order' => 30 ],
            ['id' => 5, 'name' => 'manual', 'order' => 10 ],
            ['id' => 6, 'name' => 'snmp', 'order' => 60 ],
        ];
        DB::table('discovery_protocols')->delete();
        DB::table('discovery_protocols')->insert($insert);
    }
}
