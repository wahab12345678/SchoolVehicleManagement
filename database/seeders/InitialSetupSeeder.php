<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class InitialSetupSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate tables
        DB::table('model_has_roles')->truncate();
        Role::truncate();
        User::truncate();
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Define roles
        $roles = ['admin', 'student', 'driver', 'parent'];
        // Create roles
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }
        // Create users and assign roles
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'Student User', 'email' => 'student@example.com', 'role' => 'student'],
            ['name' => 'Driver User', 'email' => 'driver@example.com', 'role' => 'driver'],
            ['name' => 'Parent User', 'email' => 'parent@example.com', 'role' => 'parent'],
        ];
        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'), // use secure password in real apps
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
