<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Repositories\GuardianRepository;
use App\Models\Guardian;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    protected $repository;

    public function __construct(GuardianRepository $repository)
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
            // Only include guardians whose user has role 'parent'
            $guardians = Guardian::with('user')->whereHas('user', function ($q) {
                $q->whereHas('roles', function ($r) {
                    $r->where('name', 'parent');
                });
            })->get();

            // If Yajra DataTables is available use it, otherwise return a plain JSON
            // structure that client-side DataTables can consume (the 'data' key).
            if (class_exists('\\Yajra\\DataTables\\Facades\\DataTables')) {
                return \Yajra\DataTables\Facades\DataTables::of($guardians)
                    ->addColumn('action', function($row){
                        $btn = '<button data-id="'.$row->id.'" class="btn btn-info btn-sm view-guardian"><i class="fa fa-eye"></i></button> ';
                        $btn .= '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm edit-guardian"><i class="fa fa-edit"></i></button> ';
                        $btn .= '<button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete-guardian"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            // Fallback: manually build the array expected by client-side DataTables
            $data = $guardians->map(function ($row) {
                $name = optional($row->user)->name ?? '';
                $email = optional($row->user)->email ?? '';
                $btn = '<button data-id="'.$row->id.'" class="btn btn-info btn-sm view-guardian"><i class="fa fa-eye"></i></button> ';
                $btn .= '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm edit-guardian"><i class="fa fa-edit"></i></button> ';
                $btn .= '<button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete-guardian"><i class="fa fa-trash"></i></button>';

                return [
                    'id' => $row->id,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $row->phone ?? '',
                    'cnic' => $row->cnic ?? '',
                    'address' => $row->address ?? '',
                    'action' => $btn,
                ];
            })->toArray();

            return response()->json(['data' => $data]);
        }

        return view('admin.guardians.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guardians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuardianRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect()->route('admin.guardians.index')->with('success', 'Parent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guardian $guardian)
    {
        if (request()->ajax()) {
            $guardian->load('user', 'students');
            return response()->json($guardian);
        }

        return view('admin.guardians.show', compact('guardian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        if (request()->ajax()) {
            $guardian->load('user');
            return response()->json($guardian);
        }

        return view('admin.guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $this->repository->update($guardian, $request->validated());

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Guardian updated successfully']);
        }

        return redirect()->route('admin.guardians.index')->with('success', 'Guardian updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $this->repository->delete($guardian);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Guardian deleted successfully']);
        }

        return redirect()->route('admin.guardians.index')->with('success', 'Guardian deleted successfully.');
    }
}
