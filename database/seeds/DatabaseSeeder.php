<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call([
            SeedOperatingSystem::class,
            SeedHostType::class,
            SeedPassword::class,
            SeedAuxVendor::class,
            //SeedAuxMac::class,
            SeedNetworkType::class,
            SeedSnmpDeviceClass::class,
            SeedSnmpDeviceClassSysdescr::class,
            SeedSnmpFunction::class,
            SeedSnmpDeviceClassFunction::class,
            SeedSnmpDeviceClassSysoid::class,
            SeedDiscoveryProtocol::class,
            SeedAddC3750E::class,
            SeedHostStatus::class,
        ]);

    }
}
