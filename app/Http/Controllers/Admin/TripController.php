<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Student;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\TripLocation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::with(['student.guardian.user', 'vehicle.driver', 'route', 'school', 'locations' => function($q) {
            $q->latest('recorded_at')->limit(1);
        }]);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by student
        if ($request->has('student_id') && $request->student_id !== '') {
            $query->where('student_id', $request->student_id);
        }

        // Filter by vehicle
        if ($request->has('vehicle_id') && $request->vehicle_id !== '') {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $trips = $query->orderBy('created_at', 'desc')->paginate(20);

        $students = Student::with('guardian.user')->get();
        $vehicles = Vehicle::with('driver')->get();
        $routes = Route::all();

        return view('admin.trips.index', compact('trips', 'students', 'vehicles', 'routes'));
    }

    public function create()
    {
        $students = Student::with('guardian.user')->get();
        $vehicles = Vehicle::with('driver')->available()->get();
        $routes = Route::all();
        $drivers = \App\Models\User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->get();

        return view('admin.trips.create', compact('students', 'vehicles', 'routes', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
            'driver_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $trip = Trip::create($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Trip created successfully', 'data' => $trip->load(['student.guardian.user', 'vehicle.driver', 'route'])]);
        }

        return redirect()->route('admin.trips.index')->with('success', 'Trip created successfully.');
    }

    public function show(Trip $trip)
    {
        $trip->load(['student.guardian.user', 'vehicle.driver', 'route', 'locations' => function($q) {
            $q->orderBy('recorded_at', 'desc');
        }]);

        if (request()->ajax()) {
            return response()->json($trip);
        }

        return view('admin.trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        $students = Student::with('guardian.user')->get();
        $vehicles = Vehicle::with('driver')->get();
        $routes = Route::all();
        $drivers = \App\Models\User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->get();

        return view('admin.trips.edit', compact('trip', 'students', 'vehicles', 'routes', 'drivers'));
    }

    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
            'driver_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $trip->update($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Trip updated successfully', 'data' => $trip->fresh()]);
        }

        return redirect()->route('admin.trips.index')->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Trip deleted successfully']);
        }

        return redirect()->route('admin.trips.index')->with('success', 'Trip deleted successfully.');
    }

    public function start(Trip $trip)
    {
        $trip->update([
            'status' => 'in_progress',
            'started_at' => Carbon::now()
        ]);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Trip started successfully']);
        }

        return redirect()->back()->with('success', 'Trip started successfully.');
    }

    public function complete(Trip $trip)
    {
        $trip->update([
            'status' => 'completed',
            'ended_at' => Carbon::now()
        ]);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Trip completed successfully']);
        }

        return redirect()->back()->with('success', 'Trip completed successfully.');
    }

    public function addLocation(Request $request, Trip $trip)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        $location = TripLocation::create([
            'trip_id' => $trip->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'recorded_at' => Carbon::now()
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Location added successfully', 'data' => $location]);
        }

        return redirect()->back()->with('success', 'Location added successfully.');
    }

    public function getLocations(Trip $trip)
    {
        $locations = $trip->locations()->orderBy('recorded_at')->get();

        if (request()->ajax()) {
            return response()->json($locations);
        }

        return view('admin.trips.locations', compact('trip', 'locations'));
    }

    public function track(Trip $trip)
    {
        $trip->load(['student.guardian.user', 'vehicle.driver', 'route', 'locations' => function($q) {
            $q->orderBy('recorded_at', 'desc')->limit(50);
        }]);

        return view('admin.trips.track', compact('trip'));
    }
}
