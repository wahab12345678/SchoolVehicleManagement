<?php

namespace Database\Seeders;

use App\Models\DriverServiceArea;
use App\Models\User;
use Illuminate\Database\Seeder;

class DriverServiceAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::role('driver')->get();

        if ($drivers->isEmpty()) {
            return;
        }

        $sampleAreas = [
            ['Johar Town', 'Model Town', 'Faisal Town'],
            ['Model Town', 'Gulberg', 'Garden Town'],
            ['Johar Town', 'Wapda Town', 'Valencia'],
            ['DHA Phase 5', 'Cantt', 'Gulberg'],
            ['Bahria Town', 'Johar Town', 'Wapda Town'],
        ];

        foreach ($drivers as $index => $driver) {
            $assignedAreas = $sampleAreas[$index % count($sampleAreas)];
            foreach ($assignedAreas as $area) {
                DriverServiceArea::firstOrCreate([
                    'driver_id' => $driver->id,
                    'area_name' => $area,
                    'city' => 'Lahore',
                ], [
                    'is_active' => true,
                ]);
            }
        }
    }
}
