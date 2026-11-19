<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Vehicle::with('driver');

        // Handle AJAX DataTable requests
        if ($request->ajax()) {
            if ($request->has('draw')) {
                // DataTable server-side processing
                return datatables($baseQuery)
                    ->addColumn('type_badge', function ($row) {
                        $color = $row->type == 'bus' ? 'primary' : ($row->type == 'van' ? 'info' : 'secondary');
                        return '<span class="badge bg-' . $color . '">' . ucfirst($row->type) . '</span>';
                    })
                    ->addColumn('status_badge', function ($row) {
                        if ($row->is_available) {
                            return '<span class="badge bg-success">Available</span>';
                        } else {
                            return '<span class="badge bg-warning">In Use</span>';
                        }
                    })
                    ->addColumn('driver_name', function ($row) {
                        return $row->driver->name ?? 'No Driver';
                    })
                    ->addColumn('action', function ($row) {
                        // Inline SVG icons
                        $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                        $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                        $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                        $btn = '<a href="/admin/vehicles/' . $row->id . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View vehicle">' . $eyeSvg . '</a> ';
                        $btn .= '<a href="/admin/vehicles/' . $row->id . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit vehicle">' . $editSvg . '</a> ';
                        $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-vehicle" title="Delete" aria-label="Delete vehicle">' . $trashSvg . '</button>';
                        return $btn;
                    })
                    ->rawColumns(['type_badge', 'status_badge', 'action'])
                    ->make(true);
            } else {
                // Client-side DataTable
                $vehicles = $baseQuery->get();
                $data = $vehicles->map(function ($vehicle) {
                    $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                    $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                    $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                    $color = $vehicle->type == 'bus' ? 'primary' : ($vehicle->type == 'van' ? 'info' : 'secondary');
                    $typeBadge = '<span class="badge bg-' . $color . '">' . ucfirst($vehicle->type) . '</span>';
                    
                    $statusBadge = $vehicle->is_available 
                        ? '<span class="badge bg-success">Available</span>'
                        : '<span class="badge bg-warning">In Use</span>';

                    $btn = '<a href="/admin/vehicles/' . $vehicle->id . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View vehicle">' . $eyeSvg . '</a> ';
                    $btn .= '<a href="/admin/vehicles/' . $vehicle->id . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit vehicle">' . $editSvg . '</a> ';
                    $btn .= '<button data-id="' . $vehicle->id . '" class="btn btn-danger btn-sm delete-vehicle" title="Delete" aria-label="Delete vehicle">' . $trashSvg . '</button>';

                    return [
                        'id' => $vehicle->id,
                        'number_plate' => $vehicle->number_plate,
                        'model' => $vehicle->model,
                        'type_badge' => $typeBadge,
                        'driver_name' => $vehicle->driver->name ?? 'No Driver',
                        'status_badge' => $statusBadge,
                        'action' => $btn,
                    ];
                })->toArray();

                return response()->json(['data' => $data]);
            }
        }

        // Regular view request
        return view('admin.vehicles.index');
    }

    public function create()
    {
        $drivers = User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->get();

        return view('admin.vehicles.create', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number_plate' => 'required|string|max:20|unique:vehicles,number_plate',
            'model' => 'required|string|max:100',
            'type' => 'required|string|in:van,bus,car',
            'driver_id' => 'required|exists:users,id'
        ]);

        $vehicle = Vehicle::create($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Vehicle created successfully', 'data' => $vehicle->load('driver')]);
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['driver', 'trips.student.guardian.user', 'activeTrips.student.guardian.user']);

        if (request()->ajax()) {
            return response()->json($vehicle);
        }

        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $drivers = User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->get();

        return view('admin.vehicles.edit', compact('vehicle', 'drivers'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'number_plate' => 'required|string|max:20|unique:vehicles,number_plate,' . $vehicle->id,
            'model' => 'required|string|max:100',
            'type' => 'required|string|in:van,bus,car',
            'driver_id' => 'required|exists:users,id'
        ]);

        $vehicle->update($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Vehicle updated successfully', 'data' => $vehicle->fresh()]);
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Check if vehicle has active trips
        if ($vehicle->activeTrips()->count() > 0) {
            if (request()->ajax()) {
                return response()->json(['message' => 'Cannot delete vehicle with active trips'], 400);
            }
            return redirect()->back()->with('error', 'Cannot delete vehicle with active trips.');
        }

        $vehicle->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Vehicle deleted successfully']);
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
