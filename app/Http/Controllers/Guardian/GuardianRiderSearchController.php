<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guardian\AssignAndSearchDriver\AssignDriverRequest;
use App\Http\Requests\Guardian\AssignAndSearchDriver\SearchGuardianRequest;
use App\Models\Driver;
use App\Models\DriverServiceArea;
use App\Models\Student;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuardianRiderSearchController extends Controller
{
    /**
     * Display the Find Rider / Driver search page for guardians.
     */

    public function index(Request $request): View|RedirectResponse
    {
        $user = Auth::user();
        $guardian = $user?->guardian;

        if (!$guardian) {
            if ($user?->hasRole('admin')) {
                // For admin testing/supervision, load all students with driver and vehicle
                $students = Student::with(['driver.vehicles', 'school'])->get();
            } elseif ($user?->hasAnyRole(['guardian', 'parent'])) {
                $guardian = \App\Models\Guardian::firstOrCreate(
                    ['user_id' => $user->id],
                    ['address' => '']
                );
                $students = $guardian->students()->with(['driver.vehicles', 'school'])->get();
            } else {
                return redirect()->route('guardian.dashboard')->with('error', 'Guardian profile not found.');
            }
        } else {
            // Get guardian's students with their currently assigned driver and vehicle
            $students = $guardian->students()->with(['driver.vehicles', 'school'])->get();
        }

        // Get available distinct areas and cities for search filters
        $distinctAreas = DriverServiceArea::where('is_active', true)
            ->distinct()
            ->orderBy('area_name')
            ->pluck('area_name');

        $distinctCities = DriverServiceArea::where('is_active', true)
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        // Initial drivers list (filtered if query params are present, else all active drivers with coverage)
        $drivers = $this->queryDrivers($request)->get();

        return view('guardian.riders.index', compact(
            'students',
            'distinctAreas',
            'distinctCities',
            'drivers'
        ));
    }

    /**
     * Filter and return active drivers/vehicles for the selected area.
     * Supports AJAX JSON responses for dynamic filtering and standard Blade rendering.
     */
    public function search(SearchGuardianRequest $request): JsonResponse|View
    {
        $drivers = $this->queryDrivers($request)->get();

        if ($request->expectsJson() || $request->ajax()) {
            $formatted = $drivers->map(function ($driver) {
                $primaryVehicle = $driver->vehicles->first();
                $hasActiveTrips = $driver->vehicles()->whereHas('activeTrips')->exists();

                return [
                    'id' => $driver->id,
                    'name' => $driver->name,
                    'phone' => $driver->phone ?? 'Not provided',
                    'email' => $driver->email,
                    'avatar_url' => $driver->avatar_url,
                    'service_areas' => $driver->serviceAreas->pluck('area_name')->values()->all(),
                    'city' => $driver->serviceAreas->first()->city ?? 'Lahore',
                    'vehicle' => $primaryVehicle ? [
                        'id' => $primaryVehicle->id,
                        'number_plate' => $primaryVehicle->number_plate,
                        'model' => $primaryVehicle->model ?? 'Standard',
                        'type' => ucfirst($primaryVehicle->type ?? 'Van'),
                        'capacity' => $primaryVehicle->capacity,
                        'is_available' => $primaryVehicle->is_available,
                        'status' => $primaryVehicle->status ?? 'active',
                    ] : null,
                    'is_available' => !$hasActiveTrips,
                    'active_trips_count' => $driver->vehicles()->withCount('activeTrips')->get()->sum('active_trips_count'),
                ];
            });

            return response()->json([
                'success' => true,
                'count' => $formatted->count(),
                'data' => $formatted,
            ]);
        }

        $guardian = Auth::user()->guardian;
        $students = $guardian ? $guardian->students()->with(['driver.vehicles', 'school'])->get() : collect();
        $distinctAreas = DriverServiceArea::where('is_active', true)->distinct()->pluck('area_name');
        $distinctCities = DriverServiceArea::where('is_active', true)->distinct()->pluck('city');

        return view('guardian.riders.index', compact('students', 'distinctAreas', 'distinctCities', 'drivers'));
    }

    /**
     * Handle guardian's submission to link the selected driver to their student.
     */
    public function assignDriver(AssignDriverRequest $request): JsonResponse|RedirectResponse
    {
        $student = Student::findOrFail($request->input('student_id'));
        $driver = User::role('driver')->with('vehicles')->findOrFail($request->input('driver_id'));
        $assignedVehicle = $driver->vehicles->first();

        // Update student's assigned driver
        $student->driver_id = $driver->id;
        $student->save();

        // Reassign any pending/unstarted trips to the new driver and vehicle
        $pendingTrips = Trip::where('student_id', $student->id)
            ->where('status', 'pending')
            ->get();

        // Retrieve or create a default route if not set
        $route = \App\Models\Route::first() ?? \App\Models\Route::create([
            'name' => 'General School Transport',
        ]);

        if ($pendingTrips->isNotEmpty()) {
            foreach ($pendingTrips as $trip) {
                $trip->driver_id = $driver->id;
                if ($assignedVehicle) {
                    $trip->vehicle_id = $assignedVehicle->id;
                }
                if (!$trip->route_id && $route) {
                    $trip->route_id = $route->id;
                }
                $trip->save();
            }
        } else {
            // Create a pending trip record for this assignment so transport tracking is initialized
            Trip::create([
                'driver_id' => $driver->id,
                'vehicle_id' => $assignedVehicle?->id,
                'route_id' => $route->id,
                'student_id' => $student->id,
                'school_id' => $student->school_id,
                'status' => 'pending',
                'direction' => 'to_school',
            ]);
        }

        $message = "Driver {$driver->name} has been successfully assigned to {$student->name}!";

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'student' => [
                    'id' => $student->id,
                    'name' => $student->name,
                    'driver_id' => $driver->id,
                    'driver_name' => $driver->name,
                    'vehicle_plate' => $assignedVehicle?->number_plate ?? 'N/A',
                ],
            ]);
        }

        return redirect()->route('guardian.riders.index')->with('success', $message);
    }

    /**
     * Alias for assignDriver to support selectRider nomenclature.
     */
    public function selectRider(AssignDriverRequest $request): JsonResponse|RedirectResponse
    {
        return $this->assignDriver($request);
    }

    /**
     * Internal helper to build driver queries based on search parameters.
     */
    protected function queryDrivers(Request $request)
    {
        $query = User::role('driver')
            ->with([
                'serviceAreas' => fn($q) => $q->where('is_active', true),
                'vehicles',
            ])
            ->whereHas('serviceAreas', fn($q) => $q->where('is_active', true));

        // Filter by Area Name
        if ($request->filled('area')) {
            $area = trim($request->input('area'));
            $query->whereHas('serviceAreas', function ($q) use ($area) {
                $q->where('is_active', true)
                    ->where('area_name', 'like', '%' . $area . '%');
            });
        }

        // Filter by City
        if ($request->filled('city')) {
            $city = trim($request->input('city'));
            $query->whereHas('serviceAreas', function ($q) use ($city) {
                $q->where('is_active', true)
                    ->where('city', 'like', '%' . $city . '%');
            });
        }

        // Filter by Vehicle Type (e.g. van, bus, rickshaw, car)
        if ($request->filled('vehicle_type') && $request->input('vehicle_type') !== 'all') {
            $vehicleType = strtolower(trim($request->input('vehicle_type')));
            $query->whereHas('vehicles', function ($q) use ($vehicleType) {
                $q->where('type', $vehicleType);
            });
        }

        // Filter by Minimum Capacity
        if ($request->filled('min_capacity') && is_numeric($request->input('min_capacity'))) {
            $minCapacity = (int) $request->input('min_capacity');
            $query->whereHas('vehicles', function ($q) use ($minCapacity) {
                $q->where(function ($sub) use ($minCapacity) {
                    $sub->where('capacity', '>=', $minCapacity)
                        ->orWhereNull('capacity'); // fallback handles capacity dynamically
                });
            });
        }

        return $query->orderBy('name');
    }
}
