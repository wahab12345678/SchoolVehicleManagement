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
            $baseQuery = Student::with('guardian.user');

            // If Yajra DataTables is available prefer it (keeps previous behavior)
            if (class_exists('\\Yajra\\DataTables\\Facades\\DataTables')) {
                return \Yajra\DataTables\Facades\DataTables::of($baseQuery)
                    ->addColumn('guardian', function ($row) {
                        return optional($row->guardian->user)->name ?? '';
                    })
                    ->addColumn('action', function ($row) {
                        $view = '<button data-id="' . $row->id . '" class="btn btn-info btn-sm view-student">View</button>';
                        $edit = '<button data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-student">Edit</button>';
                        $del = '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-student">Delete</button>';
                        return $view . ' ' . $edit . ' ' . $del;
                    })
                    ->rawColumns(['action'])
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

                return [
                    'id' => $row->id,
                    'name' => $row->name,
                    'roll_number' => $row->roll_number,
                    'class' => $row->class,
                    'guardian' => optional($row->guardian->user)->name ?? '',
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

                return [
                    'id' => $row->id,
                    'name' => $row->name,
                    'roll_number' => $row->roll_number,
                    'class' => $row->class,
                    'guardian' => optional($row->guardian->user)->name ?? '',
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

        return view('admin.students.index');
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
}
