<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OptimizedStudentController extends Controller
{
    protected $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Use optimized query with caching
            $cacheKey = 'students_list_' . md5($request->getQueryString());
            
            return Cache::remember($cacheKey, 300, function () use ($request) {
                $query = Student::select([
                    'id', 'name', 'roll_number', 'class', 'parent_id', 'school_id', 
                    'latitude', 'longitude', 'created_at', 'updated_at'
                ])->with([
                    'guardian:id,user_id', 
                    'guardian.user:id,name',
                    'school:id,name'
                ]);

                // Apply filters
                if ($request->filled('search')) {
                    $search = $request->get('search')['value'];
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('roll_number', 'like', "%{$search}%")
                          ->orWhere('class', 'like', "%{$search}%");
                    });
                }

                if ($request->filled('class_filter')) {
                    $query->where('class', $request->get('class_filter'));
                }

                if ($request->filled('school_filter')) {
                    $query->where('school_id', $request->get('school_filter'));
                }

                // Get total count for DataTables
                $totalRecords = Student::count();
                $filteredRecords = $query->count();

                // Apply pagination
                $start = $request->get('start', 0);
                $length = $request->get('length', 10);
                
                $students = $query->skip($start)->take($length)->get();

                return response()->json([
                    'draw' => intval($request->get('draw')),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data' => $students->map(function($student) {
                        return [
                            'id' => $student->id,
                            'name' => $student->name,
                            'roll_number' => $student->roll_number,
                            'class' => $student->class,
                            'guardian_name' => $student->guardian?->user?->name ?? 'N/A',
                            'school_name' => $student->school?->name ?? 'N/A',
                            'location' => $student->latitude && $student->longitude 
                                ? "{$student->latitude}, {$student->longitude}" 
                                : 'Not Set',
                            'created_at' => $student->created_at->format('Y-m-d H:i:s'),
                            'actions' => $this->getActionButtons($student->id)
                        ];
                    })
                ]);
            });
        }

        // Get filter options for non-AJAX requests
        $classes = Cache::remember('student_classes', 600, function () {
            return Student::select('class')->distinct()->orderBy('class')->pluck('class');
        });

        $schools = Cache::remember('schools_list', 600, function () {
            return \App\Models\School::select('id', 'name')->orderBy('name')->get();
        });

        return view('admin.students.index', compact('classes', 'schools'));
    }

    public function create()
    {
        $guardians = Cache::remember('guardians_list', 300, function () {
            return \App\Models\Guardian::with('user:id,name')
                ->select('id', 'user_id')
                ->get()
                ->map(function($guardian) {
                    return [
                        'id' => $guardian->id,
                        'name' => $guardian->user->name
                    ];
                });
        });

        $schools = Cache::remember('schools_list', 600, function () {
            return \App\Models\School::select('id', 'name')->orderBy('name')->get();
        });

        return view('admin.students.create', compact('guardians', 'schools'));
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $student = $this->repository->create($request->validated());
            
            // Clear relevant caches
            $this->clearStudentCaches();
            
            DB::commit();
            
            return redirect()->route('admin.students.index')
                ->with('success', 'Student created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating student: ' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        // Use optimized query with specific fields
        $student = Student::select([
            'id', 'name', 'roll_number', 'class', 'parent_id', 'school_id',
            'latitude', 'longitude', 'created_at', 'updated_at'
        ])->with([
            'guardian:id,user_id',
            'guardian.user:id,name,email,phone',
            'school:id,name,address',
            'trips:id,student_id,vehicle_id,route_id,status,started_at,ended_at'
        ])->findOrFail($student->id);

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $guardians = Cache::remember('guardians_list', 300, function () {
            return \App\Models\Guardian::with('user:id,name')
                ->select('id', 'user_id')
                ->get()
                ->map(function($guardian) {
                    return [
                        'id' => $guardian->id,
                        'name' => $guardian->user->name
                    ];
                });
        });

        $schools = Cache::remember('schools_list', 600, function () {
            return \App\Models\School::select('id', 'name')->orderBy('name')->get();
        });

        return view('admin.students.edit', compact('student', 'guardians', 'schools'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            DB::beginTransaction();
            
            $this->repository->update($student, $request->validated());
            
            // Clear relevant caches
            $this->clearStudentCaches();
            
            DB::commit();
            
            return redirect()->route('admin.students.index')
                ->with('success', 'Student updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating student: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {
            DB::beginTransaction();
            
            $this->repository->delete($student);
            
            // Clear relevant caches
            $this->clearStudentCaches();
            
            DB::commit();
            
            return response()->json(['success' => true, 'message' => 'Student deleted successfully.']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error deleting student: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get action buttons HTML for DataTables
     */
    private function getActionButtons($studentId)
    {
        return '
            <div class="d-flex gap-1">
                <a href="' . route('admin.students.show', $studentId) . '" class="btn btn-sm btn-outline-info" title="View">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
                <a href="' . route('admin.students.edit', $studentId) . '" class="btn btn-sm btn-outline-warning" title="Edit">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </a>
                <button onclick="deleteStudent(' . $studentId . ')" class="btn btn-sm btn-outline-danger" title="Delete">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3,6 5,6 21,6"></polyline>
                        <path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                    </svg>
                </button>
            </div>
        ';
    }

    /**
     * Clear student-related caches
     */
    private function clearStudentCaches()
    {
        Cache::forget('students_list_*');
        Cache::forget('student_classes');
        Cache::forget('guardians_list');
        Cache::forget('schools_list');
    }

    /**
     * Bulk delete students
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id'
        ]);

        try {
            DB::beginTransaction();
            
            $deletedCount = Student::whereIn('id', $request->student_ids)->delete();
            
            // Clear relevant caches
            $this->clearStudentCaches();
            
            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => "Successfully deleted {$deletedCount} students."
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Error deleting students: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export students to CSV
     */
    public function export(Request $request)
    {
        $students = Student::select([
            'name', 'roll_number', 'class', 'latitude', 'longitude', 'created_at'
        ])->with([
            'guardian.user:name',
            'school:name'
        ])->get();

        $filename = 'students_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, ['Name', 'Roll Number', 'Class', 'Guardian', 'School', 'Location', 'Created At']);
            
            // Add data rows
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->name,
                    $student->roll_number,
                    $student->class,
                    $student->guardian?->user?->name ?? 'N/A',
                    $student->school?->name ?? 'N/A',
                    $student->latitude && $student->longitude 
                        ? "{$student->latitude}, {$student->longitude}" 
                        : 'Not Set',
                    $student->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
