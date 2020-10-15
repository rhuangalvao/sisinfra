<?php

use Illuminate\Database\Seeder;

class SeedHostStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'status' => 'PROD'],
            ['id' => 2, 'status' => 'DEV'],
            ['id' => 3, 'status' => 'OFF'],
            ['id' => 4, 'status' => 'PRE-OFF'],
            ['id' => 5, 'status' => 'NA'],
        ];
        DB::table('host_statuses')->delete();
        DB::table('host_statuses')->insert($insert);
    }
}
