<?php

use Illuminate\Database\Seeder;

class SeedPassword extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'username' => 'default', 'password' => 'default', 'name' => 'default', 'descr' => 'default password']
        ];
        DB::table('passwords')->delete();
        DB::table('passwords')->insert($insert);
    }
}
