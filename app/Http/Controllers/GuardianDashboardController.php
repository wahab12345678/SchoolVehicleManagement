<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Trip;

class GuardianDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get guardian's students
        $guardian = $user->guardian;
        if (!$guardian) {
            return redirect()->route('admin.index')->with('error', 'Guardian profile not found.');
        }

        $students = $guardian->students;
        
        // Get active trips for guardian's students
        $activeTrips = Trip::whereIn('student_id', $students->pluck('id'))
            ->whereIn('status', ['pending', 'in_progress'])
            ->with(['student', 'vehicle', 'route'])
            ->get();

        // Get recent trips
        $recentTrips = Trip::whereIn('student_id', $students->pluck('id'))
            ->with(['student', 'vehicle', 'route'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('guardian.dashboard', compact('students', 'activeTrips', 'recentTrips'));
    }
}
