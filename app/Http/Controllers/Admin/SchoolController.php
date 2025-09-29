<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Repositories\SchoolRepository;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected $repository;

    public function __construct(SchoolRepository $repository)
    {
        $this->repository = $repository;
        // $this->middleware(['role:admin']); // only admin access
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $baseQuery = School::query();

            // If Yajra DataTables is available
            if (class_exists('\\Yajra\\DataTables\\Facades\\DataTables')) {
                return \Yajra\DataTables\Facades\DataTables::of($baseQuery)
                    ->addColumn('name', function ($row) {
                        return $row->name ?? '';
                    })
                    ->addColumn('phone', function ($row) {
                        return $row->phone ?? '';
                    })
                    ->addColumn('address', function ($row) {
                        return $row->address ?? '';
                    })
                    ->addColumn('coordinates', function ($row) {
                        if ($row->latitude && $row->longitude) {
                            return $row->latitude . ', ' . $row->longitude;
                        }
                        return 'N/A';
                    })
                    ->addColumn('action', function ($row) {
                        // Inline SVG icons
                        $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                        $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                        $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                        $btn = '<button data-id="' . $row->schools_id . '" class="btn btn-info btn-sm view-school" title="View" aria-label="View school">' . $eyeSvg . '</button> ';
                        $btn .= '<button data-id="' . $row->schools_id . '" class="btn btn-primary btn-sm edit-school" title="Edit" aria-label="Edit school">' . $editSvg . '</button> ';
                        $btn .= '<button data-id="' . $row->schools_id . '" class="btn btn-danger btn-sm delete-school" title="Delete" aria-label="Delete school">' . $trashSvg . '</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            // Server-side handling for client-side DataTables
            $draw = intval($request->input('draw', 0));
            $start = intval($request->input('start', 0));
            $length = intval($request->input('length', 10));
            $searchValue = $request->input('search.value', null);

            // Total records count
            $totalQuery = (clone $baseQuery);
            $recordsTotal = $totalQuery->count();

            // Apply search filter
            if (!empty($searchValue)) {
                $baseQuery->where(function ($q) use ($searchValue) {
                    $q->where('name', 'like', '%' . $searchValue . '%')
                      ->orWhere('phone', 'like', '%' . $searchValue . '%')
                      ->orWhere('address', 'like', '%' . $searchValue . '%');
                });
            }

            $recordsFiltered = $baseQuery->count();

            // Ordering
            $orderColIndex = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir', 'asc');
            $orderColumn = 'schools_id';

            if ($orderColIndex !== null && is_numeric($orderColIndex)) {
                $columns = $request->input('columns', []);
                if (isset($columns[$orderColIndex]['data']) && in_array($columns[$orderColIndex]['data'], ['name','phone','address','schools_id'])) {
                    $orderColumn = $columns[$orderColIndex]['data'];
                }
            }

            $baseQuery->orderBy($orderColumn, $orderDir);
            $rows = $baseQuery->skip($start)->take($length)->get();

            $data = $rows->map(function ($row) {
                $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                $btn = '<button data-id="' . $row->schools_id . '" class="btn btn-info btn-sm view-school" title="View" aria-label="View school">' . $eyeSvg . '</button> ';
                $btn .= '<button data-id="' . $row->schools_id . '" class="btn btn-primary btn-sm edit-school" title="Edit" aria-label="Edit school">' . $editSvg . '</button> ';
                $btn .= '<button data-id="' . $row->schools_id . '" class="btn btn-danger btn-sm delete-school" title="Delete" aria-label="Delete school">' . $trashSvg . '</button>';

                return [
                    'schools_id' => $row->schools_id,
                    'name' => $row->name ?? '',
                    'phone' => $row->phone ?? '',
                    'address' => $row->address ?? '',
                    'coordinates' => $row->latitude && $row->longitude ? $row->latitude . ', ' . $row->longitude : 'N/A',
                    'action' => $btn,
                ];
            })->toArray();

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);
        }

        return view('admin.schools.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        $school = $this->repository->create($request->validated());

        if ($request->ajax()) {
            return response()->json(["success" => true, "message" => "School created successfully", 'data' => $school]);
        }

        return redirect()->route('admin.schools.index')->with('success', 'School created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $school = School::find($id);

        if (request()->ajax()) {
            if (!$school) {
                return response()->json(['message' => 'Not Found'], 404);
            }

            return response()->json($school);
        }

        return view('admin.schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        if (request()->ajax()) {
            return response()->json($school);
        }

        return view('admin.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $this->repository->update($school, $request->validated());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'School updated successfully']);
        }

        return redirect()->route('admin.schools.index')->with('success', 'School updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $this->repository->delete($school);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'School deleted successfully']);
        }

        return redirect()->route('admin.schools.index')->with('success', 'School deleted successfully.');
    }
}