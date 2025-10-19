<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // If user is authenticated and has admin role, redirect to dashboard
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.index');
    }

    public function dashboard()
    {
        // Get dashboard statistics
        $stats = [
            'total_students' => \App\Models\Student::count(),
            'total_guardians' => \App\Models\Guardian::count(),
            'total_vehicles' => \App\Models\Vehicle::count(),
            'total_drivers' => \App\Models\User::role('driver')->count(),
            'total_routes' => \App\Models\Route::count(),
            'total_trips' => \App\Models\Trip::count(),
            'active_trips' => \App\Models\Trip::whereIn('status', ['pending', 'in_progress'])->count(),
            'completed_trips' => \App\Models\Trip::where('status', 'completed')->count(),
        ];

        // Get recent trips
        $recent_trips = \App\Models\Trip::with(['student', 'vehicle', 'route'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get active trips for real-time tracking
        $active_trips = \App\Models\Trip::with(['student', 'vehicle', 'route'])
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_trips', 'active_trips'));
    }
}
