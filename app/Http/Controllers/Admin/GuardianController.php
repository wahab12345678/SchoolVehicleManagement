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
    public function index()
    {
        $guardians = $this->repository->all();
        return view('admin.guardians.index', compact('guardians'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        return view('admin.guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $this->repository->update($guardian, $request->validated());
        return redirect()->route('admin.guardians.index')->with('success', 'Parent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $this->repository->delete($guardian);
        return redirect()->route('admin.guardians.index')->with('success', 'Parent deleted successfully.');
    }
}
