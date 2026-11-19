<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('production')) {
            throw new \RuntimeException('Refusing to run demo seeders in production.');
        }

        // run the InitialSetupSeeder
        $this->call(InitialSetupSeeder::class);
        
        // run the SchoolVehicleManagementSeeder for dummy data
        $this->call(SchoolVehicleManagementSeeder::class);
    }
}
