<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $query = Route::withCount(['trips', 'activeTrips']);

        // Filter by name
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $routes = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.routes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        $route = Route::create($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Route created successfully', 'data' => $route]);
        }

        return redirect()->route('admin.routes.index')->with('success', 'Route created successfully.');
    }

    public function show(Route $route)
    {
        $route->load(['trips.student.guardian.user', 'trips.vehicle.driver', 'activeTrips.student.guardian.user']);

        if (request()->ajax()) {
            return response()->json($route);
        }

        return view('admin.routes.show', compact('route'));
    }

    public function edit(Route $route)
    {
        return view('admin.routes.edit', compact('route'));
    }

    public function update(Request $request, Route $route)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        $route->update($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Route updated successfully', 'data' => $route->fresh()]);
        }

        return redirect()->route('admin.routes.index')->with('success', 'Route updated successfully.');
    }

    public function destroy(Route $route)
    {
        // Check if route has trips
        if ($route->trips()->count() > 0) {
            if (request()->ajax()) {
                return response()->json(['message' => 'Cannot delete route with existing trips'], 400);
            }
            return redirect()->back()->with('error', 'Cannot delete route with existing trips.');
        }

        $route->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Route deleted successfully']);
        }

        return redirect()->route('admin.routes.index')->with('success', 'Route deleted successfully.');
    }
}
