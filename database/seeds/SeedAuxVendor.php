<?php

use Illuminate\Database\Seeder;

class SeedAuxVendor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id'=> 1, 'name' => 'Cisco Systems'],
            ['id'=> 2, 'name' => 'Extreme Networks'],
            ['id'=> 3, 'name' => 'D-Link'],
            ['id'=> 4, 'name' => 'Huawei'],
            ['id'=> 5, 'name' => 'HP'],
            ['id'=> 6, 'name' => 'HPE/Aruba'],
        ];
        DB::table('aux_vendors')->insert($insert);
    }
}
