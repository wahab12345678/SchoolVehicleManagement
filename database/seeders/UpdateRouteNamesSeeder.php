<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\School;

class UpdateRouteNamesSeeder extends Seeder
{
    public function run(): void
    {
        // Get the school
        $school = School::first();
        
        if (!$school) {
            $this->command->error('No school found. Please create a school first.');
            return;
        }

        $schoolName = $school->name;

        // Update route names to include actual school name
        $routes = [
            'Route A - Gulshan to School' => "Route A - Gulshan to {$schoolName}",
            'Route B - Clifton to School' => "Route B - Clifton to {$schoolName}",
            'Route C - North Nazimabad to School' => "Route C - North Nazimabad to {$schoolName}",
            'Route D - Malir to School' => "Route D - Malir to {$schoolName}",
            'Route E - Gulberg to School' => "Route E - Gulberg to {$schoolName}",
        ];

        foreach ($routes as $oldName => $newName) {
            Route::where('name', $oldName)->update(['name' => $newName]);
        }

        $this->command->info('Updated route names to include school name: ' . $schoolName);
    }
}
