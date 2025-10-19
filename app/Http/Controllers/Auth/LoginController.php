<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new LoginController instance.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an authentication attempt.
     *
     * @param LoginRequest $request The request object containing user login data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the admin dashboard on success,
     *                                           or back to the login page with an error message on failure.
     */
    public function login(LoginRequest $request)
    {
        $result = $this->authService->authenticate($request->validated());
        if ($result['success']) {
            $user = Auth::user();
            $role = $result['role'];
            
            // Redirect based on user role
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', $result['message']);
                case 'guardian':
                    return redirect()->route('guardian.dashboard')->with('success', $result['message']);
                case 'driver':
                    return redirect()->route('admin.dashboard')->with('success', $result['message']); // Drivers can access admin dashboard for now
                default:
                    return redirect()->route('admin.dashboard')->with('success', $result['message']);
            }
        }
        // Add the email to session and return errors
        return back()->with(['error' => $result['message']]); // Retains email in input
    }

    /**
     * Logs out the current user.
     *
     * Redirects to the login page on success.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        return redirect()->route('admin.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin')->with('success', 'You have been logged out!');
    }
}
