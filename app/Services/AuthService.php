<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Authenticates a user based on the given credentials.
     *
     * @param array $credentials
     * @return array
     */
    public function authenticate(array $credentials)
    {
        // Attempt to log in the user
        $attempt = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);
        if ($attempt) {
            $user = Auth::user(); // Get the authenticated user
            
            // Check if the user has any of the allowed roles
<<<<<<< HEAD
            if ($user->hasAnyRole(['admin', 'guardian', 'parent', 'driver'])) {
=======
            $role = match (true) {
                $user->hasRole('admin') => 'admin',
                $user->hasAnyRole(['guardian', 'parent']) => 'guardian',
                $user->hasRole('driver') => 'driver',
                default => null,
            };

            if ($role) {
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
                return [
                    'success' => true,
                    'message' => 'Login successful.',
                    'role' => $role,
                ];
            }
            // Log out the user if they don't have the required role
            Auth::logout();
            return [
                'success' => false,
                'message' => 'Invalid role. Access denied.',
            ];
        }
        return [
            'success' => false,
            'message' => 'Invalid email or password.',
        ];
    }
}
