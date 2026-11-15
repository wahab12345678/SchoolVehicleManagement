<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::firstOrCreate(
            ['email' => 'info@lahoreschool.edu.pk'],
            [
                'name' => 'Lahore International School',
                'email' => 'info@lahoreschool.edu.pk',
                'phone' => '+92-42-1234567',
                'address' => 'Gulberg, Lahore',
                'city' => 'Lahore',
                'state' => 'Punjab',
                'country' => 'Pakistan',
                'postal_code' => '54000',
                'latitude' => 31.5204,
                'longitude' => 74.3587,
                'website' => 'https://www.lahoreschool.edu.pk',
                'description' => 'A leading educational institution in Lahore providing quality education and comprehensive transportation services for students.',
                'principal_name' => 'Dr. Ahmed Hassan',
                'principal_email' => 'principal@lahoreschool.edu.pk',
                'principal_phone' => '+92-42-1234568',
                'is_active' => true
            ]
        );
    }
}
