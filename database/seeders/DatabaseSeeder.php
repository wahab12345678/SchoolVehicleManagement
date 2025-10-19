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
        // run the InitialSetupSeeder
        $this->call(InitialSetupSeeder::class);
        
        // run the SchoolVehicleManagementSeeder for dummy data
        $this->call(SchoolVehicleManagementSeeder::class);
    }
}
