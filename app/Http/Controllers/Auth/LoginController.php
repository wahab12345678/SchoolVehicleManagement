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
            // return redirect()->route('admin.dashboard')->with('success', $result['message']);
            return redirect()->route('admin.dashboard')->with('success', $result['message']);
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
    public function logout()
    {
        Auth::logout();
        return redirect('/admin')->with('success', 'You have been logged out!');
    }
}
