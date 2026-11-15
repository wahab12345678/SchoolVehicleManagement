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
            'phone' => isset($data['phone']) ? $this->normalizePhone($data['phone']) : null,
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
            'phone' => isset($data['phone']) ? $this->normalizePhone($data['phone']) : null,
        ]);

        $guardian->update([
            'cnic' => $data['cnic'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        return $guardian;
    }

    /**
     * Normalize phone numbers into '92...' format (Pakistan country code without plus).
     * Examples:
     *  - 03121234567 -> 923121234567
     *  - 03xx-xxxxxxx -> 92xxxxxxxxx (hyphens removed and leading 0 replaced)
     *  - +923121234567 -> 923121234567
     *  - 923121234567 -> 923121234567
     */
    private function normalizePhone(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        // Remove all non-digit characters
        $digits = preg_replace('/\D+/', '', $phone);
        if (!$digits) {
            return null;
        }

        // If starts with '0' (local format), replace leading 0 with '92'
        if (str_starts_with($digits, '0')) {
            $digits = '92' . ltrim($digits, '0');
        }

        // If starts with country code '92' already, keep as is
        // If starts with '00' followed by country code (e.g., 0092...), normalize to 92...
        if (str_starts_with($digits, '00')) {
            // strip leading zeros
            $digits = ltrim($digits, '0');
        }

        return $digits;
    }

    public function delete(Guardian $guardian)
    {
        $guardian->user->delete(); // cascade deletes guardian
    }
}
