<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Trip;

class UpdateAllRecordsSchoolSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first school
        $school = School::first();
        
        if (!$school) {
            $this->command->error('No school found. Please create a school first.');
            return;
        }

        // Update vehicles
        $vehiclesUpdated = Vehicle::whereNull('school_id')->update(['school_id' => $school->id]);
        $this->command->info("Updated {$vehiclesUpdated} vehicles with school_id: {$school->id}");

        // Update routes
        $routesUpdated = Route::whereNull('school_id')->update(['school_id' => $school->id]);
        $this->command->info("Updated {$routesUpdated} routes with school_id: {$school->id}");

        // Update trips
        $tripsUpdated = Trip::whereNull('school_id')->update(['school_id' => $school->id]);
        $this->command->info("Updated {$tripsUpdated} trips with school_id: {$school->id}");

        $this->command->info('All records updated with school_id successfully!');
    }
}
