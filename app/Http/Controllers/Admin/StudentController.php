<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Optimized query with specific field selection and caching
            $baseQuery = Student::select([
                'id', 'name', 'roll_number', 'class', 'parent_id', 'school_id', 
                'latitude', 'longitude', 'created_at', 'updated_at'
            ])->with([
                'guardian:id,user_id', 
                'guardian.user:id,name',
                'activeTrips:id,student_id,status'
            ]);

            // If Yajra DataTables is available prefer it (keeps previous behavior)
            if (class_exists('\\Yajra\\DataTables\\Facades\\DataTables')) {
                return \Yajra\DataTables\Facades\DataTables::of($baseQuery)
                    ->addColumn('guardian', function ($row) {
                        return optional($row->guardian->user)->name ?? '';
                    })
                    ->addColumn('trip_status', function ($row) {
                        $activeTrips = $row->activeTrips->count();
                        if ($activeTrips > 0) {
                            return '<span class="badge bg-warning">' . $activeTrips . ' Active Trip' . ($activeTrips > 1 ? 's' : '') . '</span>';
                        }
                        return '<span class="badge bg-success">Available</span>';
                    })
                    ->addColumn('action', function ($row) {
                        $view = '<button data-id="' . $row->id . '" class="btn btn-info btn-sm view-student">View</button>';
                        $edit = '<button data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-student">Edit</button>';
                        $del = '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-student">Delete</button>';
                        return $view . ' ' . $edit . ' ' . $del;
                    })
                    ->rawColumns(['action', 'trip_status'])
                    ->make(true);
            }

            // If this is a client-side DataTables request (no draw parameter) return full dataset under `data`
            if (!$request->has('draw')) {
                $rows = $baseQuery->get();

                $data = $rows->map(function ($row) {
                $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                $btn = '<button data-id="' . $row->id . '" class="btn btn-info btn-sm view-student" title="View" aria-label="View student">' . $eyeSvg . '</button> ';
                $btn .= '<button data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-student" title="Edit" aria-label="Edit student">' . $editSvg . '</button> ';
                $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-student" title="Delete" aria-label="Delete student">' . $trashSvg . '</button>';

                $activeTrips = $row->activeTrips->count();
                $tripStatus = $activeTrips > 0 
                    ? '<span class="badge bg-warning">' . $activeTrips . ' Active Trip' . ($activeTrips > 1 ? 's' : '') . '</span>'
                    : '<span class="badge bg-success">Available</span>';

                return [
                    'id' => $row->id,
                    'name' => $row->name,
                    'roll_number' => $row->roll_number,
                    'class' => $row->class,
                    'guardian' => optional($row->guardian->user)->name ?? '',
                    'location' => ($row->latitude && $row->longitude) ? $row->latitude . ', ' . $row->longitude : 'Not set',
                    'trip_status' => $tripStatus,
                    'action' => $btn,
                ];
                })->toArray();

                return response()->json(['data' => $data]);
            }

            // Minimal server-side fallback for DataTables serverSide mode
            $draw = intval($request->input('draw', 0));
            $start = intval($request->input('start', 0));
            $length = intval($request->input('length', 10));

            $total = $baseQuery->count();
            $rows = $baseQuery->skip($start)->take($length)->get();

            $data = $rows->map(function ($row) {
                $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                $btn = '<button data-id="' . $row->id . '" class="btn btn-info btn-sm view-student" title="View" aria-label="View student">' . $eyeSvg . '</button> ';
                $btn .= '<button data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-student" title="Edit" aria-label="Edit student">' . $editSvg . '</button> ';
                $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-student" title="Delete" aria-label="Delete student">' . $trashSvg . '</button>';

                $activeTrips = $row->activeTrips->count();
                $tripStatus = $activeTrips > 0 
                    ? '<span class="badge bg-warning">' . $activeTrips . ' Active Trip' . ($activeTrips > 1 ? 's' : '') . '</span>'
                    : '<span class="badge bg-success">Available</span>';

                return [
                    'id' => $row->id,
                    'name' => $row->name,
                    'roll_number' => $row->roll_number,
                    'class' => $row->class,
                    'guardian' => optional($row->guardian->user)->name ?? '',
                    'location' => ($row->latitude && $row->longitude) ? $row->latitude . ', ' . $row->longitude : 'Not set',
                    'trip_status' => $tripStatus,
                    'action' => $btn,
                ];
            })->toArray();

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ]);
        }

        $students = Student::with('guardian.user')->get(); // For filter dropdowns
        $guardians = \App\Models\Guardian::with('user')->get(); // For filter dropdowns

        return view('admin.students.index', compact('students', 'guardians'));
    }

    public function create()
    {
        $guardians = \App\Models\Guardian::with('user')->get();
        return view('admin.students.create', compact('guardians'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = $this->repository->create($request->validated());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Student created successfully', 'data' => $student]);
        }

        return redirect()->route('admin.students.index')->with('success', 'Student created.');
    }

    public function show($id)
    {
        $student = Student::with('guardian.user')->find($id);

        if (request()->ajax()) {
            if (!$student) {
                return response()->json(['message' => 'Not Found'], 404);
            }

            // Debug payload for test logs
            \Log::debug('StudentController@show - student', $student->toArray());

            $payload = [
                'id' => $student->id,
                'name' => $student->name,
                'roll_number' => $student->roll_number,
                'class' => $student->class,
                // Provide an explicit guardian object with nested user for consistency
                'guardian' => $student->guardian ? [
                    'id' => $student->guardian->id,
                    'user_id' => $student->guardian->user_id,
                    'cnic' => $student->guardian->cnic ?? null,
                    'address' => $student->guardian->address ?? null,
                    'user' => $student->guardian->user ? $student->guardian->user->toArray() : null,
                ] : null,
            ];

            return response()->json($payload);
        }

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        if (request()->ajax()) {
            // Ensure nested guardian->user is available to the client
            return response()->json($student->load('guardian.user'));
        }

        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return redirect()->route('admin.students.index')->with('error', 'Student not found.');
        }

        $this->repository->update($student, $request->validated());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Student updated successfully', 'data' => $student->fresh()]);
        }

        return redirect()->route('admin.students.index')->with('success', 'Student updated.');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            if (request()->ajax()) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return redirect()->route('admin.students.index')->with('error', 'Student not found.');
        }

        $this->repository->delete($student);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Student deleted successfully']);
        }

        return redirect()->route('admin.students.index')->with('success', 'Student deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'No students selected'], 400);
            }
            return redirect()->route('admin.students.index')->with('error', 'No students selected.');
        }

        $deletedCount = Student::whereIn('id', $ids)->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $deletedCount . ' students deleted successfully']);
        }

        return redirect()->route('admin.students.index')->with('success', $deletedCount . ' students deleted successfully.');
    }

    public function export(Request $request)
    {
        $ids = $request->input('ids', []);
        
        $query = Student::with('guardian.user');
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }
        
        $students = $query->get();
        
        $filename = 'students_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, ['ID', 'Name', 'Roll Number', 'Class', 'Guardian', 'Latitude', 'Longitude', 'Created At']);
            
            // CSV data
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $student->name,
                    $student->roll_number,
                    $student->class,
                    optional($student->guardian->user)->name ?? 'N/A',
                    $student->latitude,
                    $student->longitude,
                    $student->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
