<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Trip;
use App\Models\TripLocation;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class SchoolVehicleManagementSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if they don't exist
        $roles = ['admin', 'guardian', 'driver', 'student'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name' => 'School Administrator',
                'email' => 'admin@school.com',
                'password' => Hash::make('password'),
                'phone' => '+92-300-1234567'
            ]
        );
        $admin->assignRole('admin');

        // Create Drivers
        $drivers = [
            ['name' => 'Ahmed Khan', 'email' => 'ahmed.khan@school.com', 'phone' => '+92-300-1111111'],
            ['name' => 'Muhammad Ali', 'email' => 'muhammad.ali@school.com', 'phone' => '+92-300-2222222'],
            ['name' => 'Hassan Sheikh', 'email' => 'hassan.sheikh@school.com', 'phone' => '+92-300-3333333'],
            ['name' => 'Usman Ahmed', 'email' => 'usman.ahmed@school.com', 'phone' => '+92-300-4444444'],
            ['name' => 'Saeed Khan', 'email' => 'saeed.khan@school.com', 'phone' => '+92-300-5555555'],
        ];

        $driverUsers = [];
        foreach ($drivers as $driverData) {
            $driver = User::firstOrCreate(
                ['email' => $driverData['email']],
                [
                    'name' => $driverData['name'],
                    'email' => $driverData['email'],
                    'password' => Hash::make('password'),
                    'phone' => $driverData['phone']
                ]
            );
            $driver->assignRole('driver');
            $driverUsers[] = $driver;
        }

        // Create Guardians
        $guardians = [
            ['name' => 'Fatima Khan', 'email' => 'fatima.khan@email.com', 'phone' => '+92-300-6666666', 'cnic' => '12345-1234567-1', 'address' => 'Gulshan-e-Iqbal, Karachi'],
            ['name' => 'Ayesha Ahmed', 'email' => 'ayesha.ahmed@email.com', 'phone' => '+92-300-7777777', 'cnic' => '12345-1234567-2', 'address' => 'Defence, Karachi'],
            ['name' => 'Zainab Ali', 'email' => 'zainab.ali@email.com', 'phone' => '+92-300-8888888', 'cnic' => '12345-1234567-3', 'address' => 'Clifton, Karachi'],
            ['name' => 'Sara Sheikh', 'email' => 'sara.sheikh@email.com', 'phone' => '+92-300-9999999', 'cnic' => '12345-1234567-4', 'address' => 'North Nazimabad, Karachi'],
            ['name' => 'Maryam Khan', 'email' => 'maryam.khan@email.com', 'phone' => '+92-300-1010101', 'cnic' => '12345-1234567-5', 'address' => 'Malir, Karachi'],
            ['name' => 'Amina Ahmed', 'email' => 'amina.ahmed@email.com', 'phone' => '+92-300-2020202', 'cnic' => '12345-1234567-6', 'address' => 'Gulberg, Karachi'],
            ['name' => 'Khadija Ali', 'email' => 'khadija.ali@email.com', 'phone' => '+92-300-3030303', 'cnic' => '12345-1234567-7', 'address' => 'Korangi, Karachi'],
            ['name' => 'Hafsa Sheikh', 'email' => 'hafsa.sheikh@email.com', 'phone' => '+92-300-4040404', 'cnic' => '12345-1234567-8', 'address' => 'Landhi, Karachi'],
        ];

        $guardianUsers = [];
        $guardianRecords = [];
        foreach ($guardians as $guardianData) {
            $user = User::firstOrCreate(
                ['email' => $guardianData['email']],
                [
                    'name' => $guardianData['name'],
                    'email' => $guardianData['email'],
                    'password' => Hash::make('password'),
                    'phone' => $guardianData['phone']
                ]
            );
            $user->assignRole('guardian');
            $guardianUsers[] = $user;

            $guardian = Guardian::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'cnic' => $guardianData['cnic'],
                    'address' => $guardianData['address']
                ]
            );
            $guardianRecords[] = $guardian;
        }

        // Create Students
        $students = [
            ['name' => 'Ali Khan', 'roll_number' => 'ST001', 'class' => 'Grade 1', 'latitude' => 31.5204, 'longitude' => 74.3587],
            ['name' => 'Aisha Ahmed', 'roll_number' => 'ST002', 'class' => 'Grade 1', 'latitude' => 31.5210, 'longitude' => 74.3595],
            ['name' => 'Hassan Ali', 'roll_number' => 'ST003', 'class' => 'Grade 2', 'latitude' => 31.5215, 'longitude' => 74.3600],
            ['name' => 'Fatima Sheikh', 'roll_number' => 'ST004', 'class' => 'Grade 2', 'latitude' => 31.5220, 'longitude' => 74.3605],
            ['name' => 'Usman Khan', 'roll_number' => 'ST005', 'class' => 'Grade 3', 'latitude' => 31.5225, 'longitude' => 74.3610],
            ['name' => 'Zara Ahmed', 'roll_number' => 'ST006', 'class' => 'Grade 3', 'latitude' => 31.5230, 'longitude' => 74.3615],
            ['name' => 'Omar Ali', 'roll_number' => 'ST007', 'class' => 'Grade 4', 'latitude' => 31.5235, 'longitude' => 74.3620],
            ['name' => 'Layla Sheikh', 'roll_number' => 'ST008', 'class' => 'Grade 4', 'latitude' => 31.5240, 'longitude' => 74.3625],
            ['name' => 'Ibrahim Khan', 'roll_number' => 'ST009', 'class' => 'Grade 5', 'latitude' => 31.5245, 'longitude' => 74.3630],
            ['name' => 'Amina Ahmed', 'roll_number' => 'ST010', 'class' => 'Grade 5', 'latitude' => 31.5250, 'longitude' => 74.3635],
        ];

        foreach ($students as $index => $studentData) {
            $studentData['registration_no'] = $studentData['roll_number']; // Add registration_no field
            $studentData['parent_id'] = $guardianRecords[$index % count($guardianRecords)]->id; // Assign guardian cyclically
            Student::firstOrCreate(
                ['roll_number' => $studentData['roll_number']],
                $studentData
            );
        }

        // Create Vehicles
        $vehicles = [
            ['number_plate' => 'KHI-2024-001', 'model' => 'Toyota Hiace', 'type' => 'van'],
            ['number_plate' => 'KHI-2024-002', 'model' => 'Hino Bus', 'type' => 'bus'],
            ['number_plate' => 'KHI-2024-003', 'model' => 'Suzuki Carry', 'type' => 'van'],
            ['number_plate' => 'KHI-2024-004', 'model' => 'Toyota Coaster', 'type' => 'bus'],
            ['number_plate' => 'KHI-2024-005', 'model' => 'Honda City', 'type' => 'car'],
        ];

        foreach ($vehicles as $index => $vehicleData) {
            $vehicleData['driver_id'] = $driverUsers[$index % count($driverUsers)]->id; // Assign driver cyclically
            Vehicle::firstOrCreate(
                ['number_plate' => $vehicleData['number_plate']],
                $vehicleData
            );
        }

        // Create Routes
        $routes = [
            ['name' => 'Route A - Gulshan to School', 'description' => 'Covers Gulshan-e-Iqbal, Defence, and surrounding areas'],
            ['name' => 'Route B - Clifton to School', 'description' => 'Covers Clifton, DHA, and nearby localities'],
            ['name' => 'Route C - North Nazimabad to School', 'description' => 'Covers North Nazimabad, Nazimabad, and adjacent areas'],
            ['name' => 'Route D - Malir to School', 'description' => 'Covers Malir, Korangi, and surrounding areas'],
            ['name' => 'Route E - Gulberg to School', 'description' => 'Covers Gulberg, Landhi, and nearby areas'],
        ];

        foreach ($routes as $routeData) {
            Route::firstOrCreate(
                ['name' => $routeData['name']],
                [
                    'name' => $routeData['name'],
                    'description' => $routeData['description']
                ]
            );
        }

        // Create Trips
        $students = Student::all();
        $vehicles = Vehicle::all();
        $routes = Route::all();

        // Create some completed trips
        for ($i = 0; $i < 15; $i++) {
            $vehicle = $vehicles->random();
            $trip = Trip::create([
                'vehicle_id' => $vehicle->id,
                'route_id' => $routes->random()->id,
                'driver_id' => $vehicle->driver_id,
                'student_id' => $students->random()->id,
                'status' => 'completed',
                'started_at' => Carbon::now()->subDays(rand(1, 30))->setTime(rand(7, 8), rand(0, 59)),
                'ended_at' => Carbon::now()->subDays(rand(1, 30))->setTime(rand(15, 16), rand(0, 59))
            ]);

            // Add some location data for completed trips
            $this->addLocationData($trip);
        }

        // Create some in-progress trips
        for ($i = 0; $i < 3; $i++) {
            $vehicle = $vehicles->random();
            $trip = Trip::create([
                'vehicle_id' => $vehicle->id,
                'route_id' => $routes->random()->id,
                'driver_id' => $vehicle->driver_id,
                'student_id' => $students->random()->id,
                'status' => 'in_progress',
                'started_at' => Carbon::now()->subHours(rand(1, 3))
            ]);

            // Add current location data for in-progress trips
            $this->addLocationData($trip);
        }

        // Create some pending trips
        for ($i = 0; $i < 5; $i++) {
            $vehicle = $vehicles->random();
            Trip::create([
                'vehicle_id' => $vehicle->id,
                'route_id' => $routes->random()->id,
                'driver_id' => $vehicle->driver_id,
                'student_id' => $students->random()->id,
                'status' => 'pending'
            ]);
        }

        $this->command->info('School Vehicle Management dummy data created successfully!');
        $this->command->info('Admin: admin@school.com / password');
        $this->command->info('Drivers: Check driver emails with password "password"');
        $this->command->info('Guardians: Check guardian emails with password "password"');
    }

    private function addLocationData($trip)
    {
        $baseLat = 31.5204;
        $baseLng = 74.3587;
        
        // Add 5-10 location points for the trip
        $locationCount = rand(5, 10);
        
        for ($i = 0; $i < $locationCount; $i++) {
            $lat = $baseLat + (rand(-100, 100) / 10000); // Small random offset
            $lng = $baseLng + (rand(-100, 100) / 10000);
            
            TripLocation::create([
                'trip_id' => $trip->id,
                'latitude' => $lat,
                'longitude' => $lng,
                'recorded_at' => $trip->started_at ? 
                    $trip->started_at->addMinutes($i * 10) : 
                    Carbon::now()->subMinutes(rand(10, 60))
            ]);
        }
    }
}
