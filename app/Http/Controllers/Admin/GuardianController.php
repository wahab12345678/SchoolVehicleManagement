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
            // Base query: guardians where the related user has role 'parent'
            $baseQuery = Guardian::with('user')->whereHas('user', function ($q) {
                $q->whereHas('roles', function ($r) {
                    $r->where('name', 'parent');
                });
            });

            // If Yajra DataTables is available prefer it (keeps previous behavior)
            if (class_exists('\\Yajra\\DataTables\\Facades\\DataTables')) {
                return \Yajra\DataTables\Facades\DataTables::of($baseQuery)
                    ->addColumn('name', function ($row) {
                        return optional($row->user)->name ?? '';
                    })
                    ->addColumn('email', function ($row) {
                        return optional($row->user)->email ?? '';
                    })
                    ->addColumn('phone', function ($row) {
                        return optional($row->user)->phone ?? '';
                    })
                    ->addColumn('cnic', function ($row) {
                        return $row->cnic ?? '';
                    })
                    ->addColumn('address', function ($row) {
                        return $row->address ?? '';
                    })
                    ->addColumn('action', function ($row) {
                        // Inline SVG icons to ensure icons render regardless of icon library timing
                        $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                        $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                        $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                        $btn = '<button data-id="' . $row->id . '" class="btn btn-info btn-sm view-guardian" title="View" aria-label="View guardian">' . $eyeSvg . '</button> ';
                        $btn .= '<button data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-guardian" title="Edit" aria-label="Edit guardian">' . $editSvg . '</button> ';
                        $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-guardian" title="Delete" aria-label="Delete guardian">' . $trashSvg . '</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            // Server-side handling for client-side DataTables (search, order, pagination)
            $draw = intval($request->input('draw', 0));
            $start = intval($request->input('start', 0));
            $length = intval($request->input('length', 10));
            $searchValue = $request->input('search.value', null);

            // Clone base query to get total count before filtering
            $totalQuery = (clone $baseQuery);
            $recordsTotal = $totalQuery->count();

            // Apply search filter if provided
            if (!empty($searchValue)) {
                $baseQuery->where(function ($q) use ($searchValue) {
                    $q->whereHas('user', function ($u) use ($searchValue) {
                        $u->where('name', 'like', '%' . $searchValue . '%')
                          ->orWhere('email', 'like', '%' . $searchValue . '%')
                          ->orWhere('phone', 'like', '%' . $searchValue . '%');
                    })
                    ->orWhere('cnic', 'like', '%' . $searchValue . '%')
                    ->orWhere('address', 'like', '%' . $searchValue . '%');
                });
            }

            $recordsFiltered = $baseQuery->count();

            // Ordering: try to honor DataTables column ordering if present
            $orderColIndex = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir', 'asc');
            $orderColumn = 'id';

            if ($orderColIndex !== null && is_numeric($orderColIndex)) {
                $columns = $request->input('columns', []);
                if (isset($columns[$orderColIndex]['data']) && in_array($columns[$orderColIndex]['data'], ['name','email','phone','cnic','address','id'])) {
                    $orderColumn = $columns[$orderColIndex]['data'];
                }
            }

            // If ordering by a relation column (name/email/phone), apply join-style ordering
            if (in_array($orderColumn, ['name','email','phone'])) {
                $baseQuery->join('users', 'guardians.user_id', '=', 'users.id')
                          ->orderBy('users.' . $orderColumn, $orderDir)
                          ->select('guardians.*');
            } else {
                $baseQuery->orderBy($orderColumn, $orderDir);
            }

            $rows = $baseQuery->skip($start)->take($length)->get();

                $data = $rows->map(function ($row) {
                    $name = optional($row->user)->name ?? '';
                    $email = optional($row->user)->email ?? '';
                    $eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                    $editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                    $trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                    $btn = '<button data-id="' . $row->id . '" class="btn btn-info btn-sm view-guardian" title="View" aria-label="View guardian">' . $eyeSvg . '</button> ';
                    $btn .= '<button data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-guardian" title="Edit" aria-label="Edit guardian">' . $editSvg . '</button> ';
                    $btn .= '<button data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-guardian" title="Delete" aria-label="Delete guardian">' . $trashSvg . '</button>';

                    return [
                        'id' => $row->id,
                        'name' => $name,
                        'email' => $email,
                        'phone' => optional($row->user)->phone ?? '',
                        'cnic' => $row->cnic ?? '',
                        'address' => $row->address ?? '',
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
        $guardian = $this->repository->create($request->validated());

        if ($request->ajax()) {
            return response()->json(["success" => true, "message" => "Parent created successfully", 'data' => $guardian]);
        }

        return redirect()->route('admin.guardians.index')->with('success', 'Parent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Explicitly fetch the guardian to avoid implicit binding issues during tests
        $guardian = Guardian::with('user', 'students')->find($id);

        if (request()->ajax()) {
            // If not found, return 404-like payload
            if (!$guardian) {
                return response()->json(['message' => 'Not Found'], 404);
            }

            // Log the guardian payload for debugging in automated tests
            \Log::debug('GuardianController@show - guardian received', $guardian->toArray());

            $payload = [
                'id' => $guardian->id,
                'user_id' => $guardian->user_id,
                'cnic' => $guardian->cnic,
                'address' => $guardian->address,
                'user' => $guardian->user ? $guardian->user->toArray() : null,
                'students' => $guardian->students ? $guardian->students->toArray() : [],
            ];

            return response()->json($payload);
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
