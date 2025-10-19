<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = School::with(['students', 'vehicles']);

        // Handle AJAX DataTable requests
        if ($request->ajax()) {
            if ($request->has('draw')) {
                // DataTable server-side processing
                return datatables($baseQuery)
                    ->addColumn('name_with_logo', function ($row) {
                        if ($row->logo) {
                            $nameWithLogo = '<div class="d-flex align-items-center">';
                            $nameWithLogo .= '<div class="avatar me-2">';
                            $nameWithLogo .= '<img src="' . asset('storage/' . $row->logo) . '" alt="Logo" class="rounded" width="32" height="32" onerror="this.style.display=\'none\'">';
                            $nameWithLogo .= '</div>';
                            $nameWithLogo .= '<div>';
                            $nameWithLogo .= '<h6 class="mb-0">' . $row->name . '</h6>';
                            if ($row->website) {
                                $nameWithLogo .= '<small class="text-muted"><a href="' . $row->website . '" target="_blank" class="text-primary">' . $row->website . '</a></small>';
                            }
                            $nameWithLogo .= '</div>';
                            $nameWithLogo .= '</div>';
                        } else {
                            $nameWithLogo = '<div><h6 class="mb-0">' . $row->name . '</h6>';
                            if ($row->website) {
                                $nameWithLogo .= '<small class="text-muted"><a href="' . $row->website . '" target="_blank" class="text-primary">' . $row->website . '</a></small>';
                            }
                            $nameWithLogo .= '</div>';
                        }
                        return $nameWithLogo;
                    })
                    ->addColumn('students_badge', function ($row) {
                        return '<span class="badge bg-primary">' . $row->students->count() . '</span>';
                    })
                    ->addColumn('vehicles_badge', function ($row) {
                        return '<span class="badge bg-success">' . $row->vehicles->count() . '</span>';
                    })
                    ->addColumn('status_badge', function ($row) {
                        $status = $row->is_active ? 'success' : 'secondary';
                        $text = $row->is_active ? 'Active' : 'Inactive';
                        return '<span class="badge bg-' . $status . '">' . $text . '</span>';
                    })
                    ->addColumn('action', function ($row) {
                        // Inline SVG icons
                        $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                        $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                        $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                        $btn = '<a href="/admin/school/' . $row->id . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View school">' . $eyeSvg . '</a> ';
                        $btn .= '<a href="/admin/school/' . $row->id . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit school">' . $editSvg . '</a> ';
                        $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-school" title="Delete" aria-label="Delete school">' . $trashSvg . '</button>';
                        return $btn;
                    })
                    ->rawColumns(['name_with_logo', 'students_badge', 'vehicles_badge', 'status_badge', 'action'])
                    ->make(true);
            } else {
                // Client-side DataTable
                $schools = $baseQuery->get();
                $data = $schools->map(function ($school) {
                    $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                    $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                    $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                    $studentsBadge = '<span class="badge bg-primary">' . $school->students->count() . '</span>';
                    $vehiclesBadge = '<span class="badge bg-success">' . $school->vehicles->count() . '</span>';
                    
                    $status = $school->is_active ? 'success' : 'secondary';
                    $statusText = $school->is_active ? 'Active' : 'Inactive';
                    $statusBadge = '<span class="badge bg-' . $status . '">' . $statusText . '</span>';

                    $btn = '<a href="/admin/school/' . $school->id . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View school">' . $eyeSvg . '</a> ';
                    $btn .= '<a href="/admin/school/' . $school->id . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit school">' . $editSvg . '</a> ';
                    $btn .= '<button data-id="' . $school->id . '" class="btn btn-danger btn-sm delete-school" title="Delete" aria-label="Delete school">' . $trashSvg . '</button>';

                    // Format name with logo
                    $nameWithLogo = '';
                    if ($school->logo) {
                        $nameWithLogo .= '<div class="d-flex align-items-center">';
                        $nameWithLogo .= '<div class="avatar me-2">';
                        $nameWithLogo .= '<img src="' . asset('storage/' . $school->logo) . '" alt="Logo" class="rounded" width="32" height="32" onerror="this.style.display=\'none\'">';
                        $nameWithLogo .= '</div>';
                        $nameWithLogo .= '<div>';
                        $nameWithLogo .= '<h6 class="mb-0">' . $school->name . '</h6>';
                        if ($school->website) {
                            $nameWithLogo .= '<small class="text-muted"><a href="' . $school->website . '" target="_blank" class="text-primary">' . $school->website . '</a></small>';
                        }
                        $nameWithLogo .= '</div>';
                        $nameWithLogo .= '</div>';
                    } else {
                        $nameWithLogo = '<div><h6 class="mb-0">' . $school->name . '</h6>';
                        if ($school->website) {
                            $nameWithLogo .= '<small class="text-muted"><a href="' . $school->website . '" target="_blank" class="text-primary">' . $school->website . '</a></small>';
                        }
                        $nameWithLogo .= '</div>';
                    }

                    return [
                        'id' => $school->id,
                        'name' => $nameWithLogo,
                        'email' => $school->email,
                        'phone' => $school->phone,
                        'city' => $school->city . ', ' . $school->state,
                        'students_badge' => $studentsBadge,
                        'vehicles_badge' => $vehiclesBadge,
                        'status_badge' => $statusBadge,
                        'action' => $btn,
                    ];
                })->toArray();

                return response()->json(['data' => $data]);
            }
        }

        // Regular view request - pass schools data for fallback
        $schools = $baseQuery->get();
        return view('admin.school.index', compact('schools'));
    }

    public function create()
    {
        return view('admin.school.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:schools,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'principal_name' => 'nullable|string|max:255',
            'principal_email' => 'nullable|email',
            'principal_phone' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('schools/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $school = School::create($data);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'School created successfully', 'data' => $school]);
        }

        return redirect()->route('admin.school.index')->with('success', 'School created successfully.');
    }

    public function show(School $school)
    {
        if (request()->ajax()) {
            return response()->json($school);
        }

        return view('admin.school.show', compact('school'));
    }

    public function edit(School $school)
    {
        return view('admin.school.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:schools,email,' . $school->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'principal_name' => 'nullable|string|max:255',
            'principal_email' => 'nullable|email',
            'principal_phone' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($school->logo && Storage::disk('public')->exists($school->logo)) {
                Storage::disk('public')->delete($school->logo);
            }
            
            $logoPath = $request->file('logo')->store('schools/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $school->update($data);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'School updated successfully', 'data' => $school->fresh()]);
        }

        return redirect()->route('admin.school.index')->with('success', 'School updated successfully.');
    }

    public function destroy(School $school)
    {
        // Delete logo if exists
        if ($school->logo && Storage::disk('public')->exists($school->logo)) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'School deleted successfully']);
        }

        return redirect()->route('admin.school.index')->with('success', 'School deleted successfully.');
    }
}
