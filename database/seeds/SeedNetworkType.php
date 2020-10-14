<?php

use Illuminate\Database\Seeder;

class SeedNetworkType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'name' => 'static', 'descr' => 'Manually defined'],
            ['id' => 2, 'name' => 'dynamic', 'descr' => 'DHCP'],
            ['id' => 3, 'name' => 'reserved', 'descr' => 'Reserved'],
            ['id' => 4, 'name' => 'discovered', 'descr' => 'Networks discovered'],

        ];
        DB::table('network_types')->delete();
        DB::table('network_types')->insert($insert);
    }
}
