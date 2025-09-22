@extends('admin.includes.main')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Guardian Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.guardians.index') }}">Guardians</a>
                                </li>
                                <li class="breadcrumb-item active">View Guardian
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.guardians.edit', $guardian->id) }}" class="btn btn-primary">
                        <i data-feather="edit"></i>
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section class="app-user-view-account">
                <div class="row">
                    <!-- User Card -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                        <div class="user-avatar-section">
                                            <div class="d-flex justify-content-start">
                                                <div class="d-flex flex-column ms-1">
                                                    <div class="user-info mb-1">
                                                        <h4 class="mb-0">{{ $guardian->user->name }}</h4>
                                                        <span class="card-text">{{ $guardian->user->email }}</span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <a href="{{ route('admin.guardians.edit', $guardian->id) }}" class="btn btn-primary">Edit</a>
                                                        <form action="{{ route('admin.guardians.destroy', $guardian->id) }}" method="POST" class="ms-1" onsubmit="return confirm('Are you sure you want to delete this guardian?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                        <div class="user-info-wrapper">
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="user" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Name:</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $guardian->user->name }}</p>
                                            </div>
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="mail" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Email:</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $guardian->user->email }}</p>
                                            </div>
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="phone" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Phone:</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $guardian->user->phone ?? 'N/A' }}</p>
                                            </div>
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="credit-card" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">CNIC:</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $guardian->cnic ?? 'N/A' }}</p>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                <div class="user-info-title">
                                                    <i data-feather="map-pin" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Address:</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $guardian->address ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Students Card -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Associated Students</h4>
                            </div>
                            <div class="card-body">
                                @if($guardian->students->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Roll Number</th>
                                                    <th>Class</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($guardian->students as $student)
                                                    <tr>
                                                        <td>{{ $student->id }}</td>
                                                        <td>{{ $student->name }}</td>
                                                        <td>{{ $student->roll_number }}</td>
                                                        <td>{{ $student->class ?? 'N/A' }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-sm btn-info">
                                                                <i data-feather="eye"></i>
                                                                <span>View</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>No students associated with this guardian.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection