@extends('admin.includes.main')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">School Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.school.index') }}">Schools</a></li>
                                <li class="breadcrumb-item active">{{ $school->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.school.edit', $school->id) }}" class="btn btn-primary">
                        <i data-feather="edit"></i>
                        <span>Edit School</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section id="page-account-settings">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">School Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Basic Information</h5>
                                        <p><strong>School Name:</strong> {{ $school->name }}</p>
                                        <p><strong>Email:</strong> {{ $school->email }}</p>
                                        <p><strong>Phone:</strong> {{ $school->phone }}</p>
                                        <p><strong>Website:</strong> 
                                            @if($school->website)
                                                <a href="{{ $school->website }}" target="_blank" class="text-primary">{{ $school->website }}</a>
                                            @else
                                                Not provided
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Location</h5>
                                        <p><strong>Address:</strong> {{ $school->full_address }}</p>
                                        <p><strong>Coordinates:</strong> {{ $school->formatted_location }}</p>
                                        @if($school->google_maps_url)
                                        <p>
                                            <a href="{{ $school->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i data-feather="map-pin"></i> View on Map
                                            </a>
                                        </p>
                                        @endif
                                    </div>
                                </div>

                                @if($school->description)
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Description</h5>
                                        <p>{{ $school->description }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($school->principal_name)
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Principal Information</h5>
                                        <p><strong>Name:</strong> {{ $school->principal_name }}</p>
                                        @if($school->principal_email)
                                        <p><strong>Email:</strong> {{ $school->principal_email }}</p>
                                        @endif
                                        @if($school->principal_phone)
                                        <p><strong>Phone:</strong> {{ $school->principal_phone }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Status</h5>
                                        <span class="badge badge-{{ $school->is_active ? 'success' : 'danger' }}">
                                            {{ $school->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if($school->logo)
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">School Logo</h4>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ Storage::url($school->logo) }}" alt="School Logo" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Quick Stats</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Students:</span>
                                    <strong>{{ $school->students->count() }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Vehicles:</span>
                                    <strong>{{ $school->vehicles->count() }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Routes:</span>
                                    <strong>{{ $school->routes->count() }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Trips:</span>
                                    <strong>{{ $school->trips->count() }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
