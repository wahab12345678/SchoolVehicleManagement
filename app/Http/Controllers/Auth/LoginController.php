<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
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
            $request->session()->regenerate();

            switch ($result['role']) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', $result['message']);
                case 'guardian':
                case 'parent':
                    return redirect()->route('guardian.dashboard')->with('success', $result['message']);
                case 'driver':
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('admin.index')->with('error', 'Driver accounts use the mobile app.');
                default:
                    Auth::logout();

                    return back()->with(['error' => 'Invalid role. Access denied.']);
            }
        }
        // Add the email to session and return errors
        return back()->with(['error' => $result['message']]); // Retains email in input
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        return redirect()->route('admin.index');
    }

    /**
     * Log out the current user and return to the login page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/admin')->with('success', 'You have been logged out!');
    }
}
