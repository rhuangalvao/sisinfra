<?php

use Illuminate\Database\Seeder;

class SeedOperatingSystem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert= [
            ['id' => 1, 'version' => 'Outro/Desconhecido', 'name' => 'Outro/Desconhecido'],
            ['id' => 2, 'version' => '15.7', 'name' => 'Extreme XOS'],
            ['id' => 3, 'version' => '16.1', 'name' => 'Extreme XOS'],
            ['id' => 4, 'version' => '15.2', 'name' => 'Cisco IOS'],
            ['id' => 5, 'version' => '5 LENNY', 'name' => 'Linux Debian'],
            ['id' => 6, 'version' => '6 SQUEEZE', 'name' => 'Linux Debian'],
            ['id' => 7, 'version' => '7 WHEEZY', 'name' => 'Linux Debian'],
            ['id' => 8, 'version' => '8 JESSIE', 'name' => 'Linux Debian'],
            ['id' => 9, 'version' => '9 STRETCH', 'name' => 'Linux Debian'],
            ['id' => 10, 'version' => '5.5', 'name' => 'Linux Centos'],
            ['id' => 11, 'version' => '6', 'name' => 'Linux Centos'],
            ['id' => 12, 'version' => '7', 'name' => 'Linux Centos'],
            ['id' => 13, 'version' => '2003 x86', 'name' => 'Windows Server'],
            ['id' => 14, 'version' => '2003 R2 x86', 'name' => 'Windows Server'],
            ['id' => 15, 'version' => '2008 x64', 'name' => 'Windows Server'],
            ['id' => 16, 'version' => '2008 R2 x64', 'name' => 'Windows Server'],
            ['id' => 17, 'version' => '2012 x64', 'name' => 'Windows Server'],
            ['id' => 18, 'version' => '2012 R2 x64', 'name' => 'Windows Server'],
            ['id' => 19, 'version' => '2016 x64', 'name' => 'Windows Server'],
            ['id' => 20, 'version' => '10', 'name' => 'Windows'],
            ['id' => 21, 'version' => 'SIP', 'name' => 'Cisco IP Phone'],
            ['id' => 22, 'version' => '5', 'name' => 'MX-ONE'],
            ['id' => 23, 'version' => '8', 'name' => 'Ubuntu'],
            ['id' => 24, 'version' => '7', 'name' => 'Windows'],
            ['id' => 25, 'version' => 'XP', 'name' => 'Windows'],
            ['id' => 26, 'version' => 'Cisco', 'name' => 'Cisco'],
            ['id' => 27, 'version' => '1', 'name' => 'VyOS'],
            ['id' => 28, 'version' => '15.2.2.7', 'name' => 'Extreme XOS'],
            ['id' => 29, 'version' => '8', 'name' => 'Windows'],
            ['id' => 30, 'version' => 'Aastra IP Phone 3.2', 'name' => 'Aastra IP Phone'],
            ['id' => 31, 'version' => '7.1', 'name' => 'XenServer'],
            ['id' => 32, 'version' => '5.5', 'name' => 'VMWare'],
            ['id' => 33, 'version' => '5.2', 'name' => 'Blade OS'],
            ['id' => 34, 'version' => '7.2.1b', 'name' => 'Fabric OS'],
            ['id' => 35, 'version' => '6.3.1.11', 'name' => 'Aruba AOS'],
            ['id' => 36, 'version' => '11', 'name' => 'Cisco IOS'],
            ['id' => 37, 'version' => '15.1', 'name' => 'Cisco IOS'],
            ['id' => 38, 'version' => '12', 'name' => 'Extreme XOS'],
            ['id' => 39, 'version' => '1.0', 'name' => 'D-Link DES-3028'],
            ['id' => 40, 'version' => '8.2.170.0', 'name' => 'Cisco AP IOS'],
            ['id' => 40, 'version' => 'V200', 'name' => 'Huawei VRP'],

        ];
        DB::table('operating_systems')->delete();
        DB::table('operating_systems')->insert($insert);
        DB::statement("SELECT setval('public.operating_systems', 10000, true);");
    }
}
