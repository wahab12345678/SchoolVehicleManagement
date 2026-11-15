<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = User::role('driver')->with('vehicles');

        // Handle AJAX DataTable requests
        if ($request->ajax()) {
            if ($request->has('draw')) {
                // DataTable server-side processing
                return datatables($baseQuery)
                    ->addColumn('vehicles_badge', function ($row) {
                        if ($row->vehicles->count() > 0) {
                            $badges = '';
                            foreach ($row->vehicles as $vehicle) {
                                $badges .= '<span class="badge bg-info me-1">' . $vehicle->number_plate . '</span>';
                            }
                            return $badges;
                        } else {
                            return '<span class="text-muted">No vehicles assigned</span>';
                        }
                    })
                    ->addColumn('status_badge', function ($row) {
                        $activeTrips = $row->vehicles()->whereHas('activeTrips')->count();
                        if ($activeTrips > 0) {
                            return '<span class="badge bg-warning">' . $activeTrips . ' Active</span>';
                        } else {
                            return '<span class="badge bg-success">Available</span>';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        // Inline SVG icons
                        $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                        $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                        $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                        $btn = '<a href="/admin/drivers/' . $row->id . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View driver">' . $eyeSvg . '</a> ';
                        $btn .= '<a href="/admin/drivers/' . $row->id . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit driver">' . $editSvg . '</a> ';
                        $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-driver" title="Delete" aria-label="Delete driver">' . $trashSvg . '</button>';
                        return $btn;
                    })
                    ->rawColumns(['vehicles_badge', 'status_badge', 'action'])
                    ->make(true);
            } else {
                // Client-side DataTable
                $drivers = $baseQuery->get();
                $data = $drivers->map(function ($driver) {
                    $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                    $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                    $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                    $vehiclesBadge = '';
                    if ($driver->vehicles->count() > 0) {
                        foreach ($driver->vehicles as $vehicle) {
                            $vehiclesBadge .= '<span class="badge bg-info me-1">' . $vehicle->number_plate . '</span>';
                        }
                    } else {
                        $vehiclesBadge = '<span class="text-muted">No vehicles assigned</span>';
                    }

                    $activeTrips = $driver->vehicles()->whereHas('activeTrips')->count();
                    $statusBadge = $activeTrips > 0 
                        ? '<span class="badge bg-warning">' . $activeTrips . ' Active</span>'
                        : '<span class="badge bg-success">Available</span>';

                    $btn = '<a href="/admin/drivers/' . $driver->id . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View driver">' . $eyeSvg . '</a> ';
                    $btn .= '<a href="/admin/drivers/' . $driver->id . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit driver">' . $editSvg . '</a> ';
                    $btn .= '<button data-id="' . $driver->id . '" class="btn btn-danger btn-sm delete-driver" title="Delete" aria-label="Delete driver">' . $trashSvg . '</button>';

                    return [
                        'id' => $driver->id,
                        'name' => $driver->name,
                        'email' => $driver->email,
                        'phone' => $driver->phone ?? 'N/A',
                        'vehicles_badge' => $vehiclesBadge,
                        'status_badge' => $statusBadge,
                        'action' => $btn,
                    ];
                })->toArray();

                return response()->json(['data' => $data]);
            }
        }

        // Regular view request
        return view('admin.drivers.index');
    }

    public function create()
    {
        $vehicles = Vehicle::whereNull('driver_id')->get();
        return view('admin.drivers.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Assign driver role
        $user->assignRole('driver');

        // Assign vehicle if selected
        if ($request->vehicle_id) {
            Vehicle::where('id', $request->vehicle_id)->update(['driver_id' => $user->id]);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Driver created successfully', 'data' => $user]);
        }

        return redirect()->route('admin.drivers.index')->with('success', 'Driver created successfully.');
    }

    public function show(User $driver)
    {
        // Ensure this is a driver
        if (!$driver->hasRole('driver')) {
            return redirect()->route('admin.drivers.index')->with('error', 'User is not a driver.');
        }

        $driver->load(['vehicles', 'trips.student.guardian.user', 'trips.vehicle', 'trips.route']);

        if (request()->ajax()) {
            return response()->json($driver);
        }

        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(User $driver)
    {
        // Ensure this is a driver
        if (!$driver->hasRole('driver')) {
            return redirect()->route('admin.drivers.index')->with('error', 'User is not a driver.');
        }

        $driver->load('vehicles');
        // Get all vehicles for assignment - show unassigned and currently assigned to this driver
        // Also include vehicles assigned to other drivers for reassignment
        $availableVehicles = Vehicle::with('driver')->orderBy('driver_id')->orderBy('number_plate')->get();
        
        return view('admin.drivers.edit', compact('driver', 'availableVehicles'));
    }

    public function update(Request $request, User $driver)
    {
        // Ensure this is a driver
        if (!$driver->hasRole('driver')) {
            return redirect()->route('admin.drivers.index')->with('error', 'User is not a driver.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $driver->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'vehicle_ids' => 'nullable|array',
            'vehicle_ids.*' => 'exists:vehicles,id',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $driver->update($updateData);

        // Handle vehicle assignments
        if ($request->has('vehicle_ids')) {
            // Remove driver from all current vehicles
            Vehicle::where('driver_id', $driver->id)->update(['driver_id' => null]);
            
            // Assign new vehicles if any are selected
            if (!empty($request->vehicle_ids) && is_array($request->vehicle_ids)) {
                // Filter out any null or empty values
                $validVehicleIds = array_filter($request->vehicle_ids, function($id) {
                    return !empty($id) && is_numeric($id);
                });
                
                if (!empty($validVehicleIds)) {
                    Vehicle::whereIn('id', $validVehicleIds)->update(['driver_id' => $driver->id]);
                }
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Driver updated successfully', 'data' => $driver->fresh()]);
        }

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(User $driver)
    {
        // Ensure this is a driver
        if (!$driver->hasRole('driver')) {
            if (request()->ajax()) {
                return response()->json(['message' => 'User is not a driver'], 400);
            }
            return redirect()->back()->with('error', 'User is not a driver.');
        }

        // Check if driver has active trips
        if ($driver->vehicles()->whereHas('activeTrips')->exists()) {
            if (request()->ajax()) {
                return response()->json(['message' => 'Cannot delete driver with active trips'], 400);
            }
            return redirect()->back()->with('error', 'Cannot delete driver with active trips.');
        }

        $driver->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Driver deleted successfully']);
        }

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
