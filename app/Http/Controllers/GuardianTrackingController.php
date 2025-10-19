<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\TripLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianTrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guardian = Guardian::where('user_id', Auth::id())->first();
        
        if (!$guardian) {
            return redirect()->route('home')->with('error', 'Guardian profile not found.');
        }

        $students = $guardian->students()->with(['trips' => function($query) {
            $query->whereIn('status', ['pending', 'in_progress'])->with(['vehicle.driver', 'route', 'locations' => function($q) {
                $q->latest('recorded_at')->limit(1);
            }]);
        }])->get();

        return view('guardian.tracking.index', compact('students'));
    }

    public function getStudentTrips($studentId)
    {
        $guardian = Guardian::where('user_id', Auth::id())->first();
        
        if (!$guardian) {
            return response()->json(['message' => 'Guardian not found'], 404);
        }

        $student = $guardian->students()->find($studentId);
        
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $trips = $student->trips()
            ->with(['vehicle.driver', 'route', 'locations' => function($q) {
                $q->orderBy('recorded_at', 'desc')->limit(10);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($trips);
    }

    public function getActiveTrip($studentId)
    {
        $guardian = Guardian::where('user_id', Auth::id())->first();
        
        if (!$guardian) {
            return response()->json(['message' => 'Guardian not found'], 404);
        }

        $student = $guardian->students()->find($studentId);
        
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $activeTrip = $student->trips()
            ->whereIn('status', ['pending', 'in_progress'])
            ->with(['vehicle.driver', 'route', 'locations' => function($q) {
                $q->orderBy('recorded_at', 'desc')->limit(1);
            }])
            ->first();

        return response()->json($activeTrip);
    }

    public function getTripLocations($tripId)
    {
        $guardian = Guardian::where('user_id', Auth::id())->first();
        
        if (!$guardian) {
            return response()->json(['message' => 'Guardian not found'], 404);
        }

        $trip = Trip::whereHas('student', function($query) use ($guardian) {
            $query->where('parent_id', $guardian->id);
        })->find($tripId);

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        $locations = $trip->locations()
            ->orderBy('recorded_at', 'desc')
            ->limit(50)
            ->get();

        return response()->json($locations);
    }

    public function getRealTimeLocation($tripId)
    {
        $guardian = Guardian::where('user_id', Auth::id())->first();
        
        if (!$guardian) {
            return response()->json(['message' => 'Guardian not found'], 404);
        }

        $trip = Trip::whereHas('student', function($query) use ($guardian) {
            $query->where('parent_id', $guardian->id);
        })->find($tripId);

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        $currentLocation = $trip->locations()
            ->orderBy('recorded_at', 'desc')
            ->first();

        return response()->json([
            'trip' => $trip,
            'current_location' => $currentLocation,
            'status' => $trip->status,
            'started_at' => $trip->started_at,
            'vehicle' => $trip->vehicle,
            'driver' => $trip->driver
        ]);
    }

    public function trackMap($tripId)
    {
        $guardian = Guardian::where('user_id', Auth::id())->first();
        
        if (!$guardian) {
            return redirect()->route('home')->with('error', 'Guardian profile not found.');
        }

        $trip = Trip::whereHas('student', function($query) use ($guardian) {
            $query->where('parent_id', $guardian->id);
        })->with(['student', 'vehicle.driver', 'route', 'locations' => function($q) {
            $q->orderBy('recorded_at', 'desc')->limit(100);
        }])->find($tripId);

        if (!$trip) {
            return redirect()->route('guardian.tracking.index')->with('error', 'Trip not found.');
        }

        return view('guardian.tracking.map', compact('trip'));
    }
}
