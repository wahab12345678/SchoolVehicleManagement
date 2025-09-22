<?php
namespace App\Repositories;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuardianRepository
{
    public function all()
    {
        return Guardian::with('user')->get();
    }

    public function create(array $data)
    {
        // Create User
        // If password not provided, generate a random one and notify admin later
        $plainPassword = $data['password'] ?? null;
        if (!$plainPassword) {
            $plainPassword = substr(bin2hex(random_bytes(4)), 0, 8);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($plainPassword),
        ]);

        $user->assignRole('parent'); // spatie role

        // Create Guardian
        $guardian = Guardian::create([
            'user_id' => $user->id,
            'cnic' => $data['cnic'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        // Load relation for immediate use
        return $guardian->load('user');
    }

    public function update(Guardian $guardian, array $data)
    {
        $guardian->user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
        ]);

        $guardian->update([
            'cnic' => $data['cnic'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        return $guardian;
    }

    public function delete(Guardian $guardian)
    {
        $guardian->user->delete(); // cascade deletes guardian
    }
}
