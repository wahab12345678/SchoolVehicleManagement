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
                        return $this->formatNameWithLogo($row);
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
                        return $this->getActionButtons($row->id);
                    })
                    ->rawColumns(['name_with_logo', 'students_badge', 'vehicles_badge', 'status_badge', 'action'])
                    ->make(true);
            } else {
                // Client-side DataTable
                $schools = $baseQuery->get();
                $data = $schools->map(function ($school) {
                    $studentsBadge = '<span class="badge bg-primary">' . $school->students->count() . '</span>';
                    $vehiclesBadge = '<span class="badge bg-success">' . $school->vehicles->count() . '</span>';

                    $status = $school->is_active ? 'success' : 'secondary';
                    $statusText = $school->is_active ? 'Active' : 'Inactive';
                    $statusBadge = '<span class="badge bg-' . $status . '">' . $statusText . '</span>';

                    return [
                        'id' => $school->id,
                        'name' => $this->formatNameWithLogo($school),
                        'email' => $school->email,
                        'phone' => $school->phone,
                        'city' => $school->city . ', ' . $school->state,
                        'students_badge' => $studentsBadge,
                        'vehicles_badge' => $vehiclesBadge,
                        'status_badge' => $statusBadge,
                        'action' => $this->getActionButtons($school->id),
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
        $validatedData = $this->validateSchool($request);

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('schools/logos', 'public');
        }

        $school = School::create($validatedData);

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
        $validatedData = $this->validateSchool($request, $school->id);

        if ($request->hasFile('logo')) {
            if ($school->logo && Storage::disk('public')->exists($school->logo)) {
                Storage::disk('public')->delete($school->logo);
            }

            $validatedData['logo'] = $request->file('logo')->store('schools/logos', 'public');
        }

        $school->update($validatedData);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'School updated successfully', 'data' => $school->fresh()]);
        }

        return redirect()->route('admin.school.index')->with('success', 'School updated successfully.');
    }

    public function destroy(School $school)
    {
        if ($school->logo && Storage::disk('public')->exists($school->logo)) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'School deleted successfully']);
        }

        return redirect()->route('admin.school.index')->with('success', 'School deleted successfully.');
    }

    /**
     * Helper method to validate school requests.
     */
    protected function validateSchool(Request $request, $schoolId = null)
    {
        $emailRule = 'required|email|unique:schools,email';
        if ($schoolId) {
            $emailRule .= ',' . $schoolId;
        }

        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => $emailRule,
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
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'timezone' => 'nullable|string|max:64',
            'pickup_lead_minutes' => 'nullable|integer|min:0|max:240',
        ]);
    }

    /**
     * Helper method to format school name with logo and website link.
     */
    protected function formatNameWithLogo($school)
    {
        $html = '<div class="d-flex align-items-center">';

        if ($school->logo) {
            $html .= '<div class="avatar me-2">';
            $html .= '<img src="' . asset('storage/' . $school->logo) . '" alt="Logo" class="rounded" width="32" height="32" onerror="this.style.display=\'none\'">';
            $html .= '</div>';
        }

        $html .= '<div>';
        $html .= '<h6 class="mb-0">' . $school->name . '</h6>';
        if ($school->website) {
            $html .= '<small class="text-muted"><a href="' . $school->website . '" target="_blank" class="text-primary">' . $school->website . '</a></small>';
        }
        $html .= '</div>';

        $html .= '</div>';

        return $html;
    }

    /**
     * Helper method to generate action buttons with SVG icons.
     */
    protected function getActionButtons($schoolId)
    {
        $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
        $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
        $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

        $btn = '<a href="/admin/school/' . $schoolId . '" class="btn btn-info btn-sm me-1" title="View" aria-label="View school">' . $eyeSvg . '</a> ';
        $btn .= '<a href="/admin/school/' . $schoolId . '/edit" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit school">' . $editSvg . '</a> ';
        $btn .= '<button data-id="' . $schoolId . '" class="btn btn-danger btn-sm delete-school" title="Delete" aria-label="Delete school">' . $trashSvg . '</button>';

        return $btn;
    }
}