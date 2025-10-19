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
                        <h2 class="content-header-title float-start mb-0">Driver Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">Drivers</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="page-account-settings">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Driver Information</h5>
                                        <div class="mt-1">
                                            <p><strong>Name:</strong> {{ $driver->name }}</p>
                                            <p><strong>Email:</strong> {{ $driver->email }}</p>
                                            <p><strong>Phone:</strong> {{ $driver->phone ?? 'Not provided' }}</p>
                                            <p><strong>Role:</strong> <span class="badge badge-primary">Driver</span></p>
                                            <p><strong>Assigned Vehicles:</strong> {{ $driver->vehicles->count() }}</p>
                                            <p><strong>Total Trips:</strong> {{ $driver->trips->count() }}</p>
                                            <p><strong>Active Trips:</strong> 
                                                @php
                                                    $activeTrips = $driver->vehicles()->whereHas('activeTrips')->count();
                                                @endphp
                                                @if($activeTrips > 0)
                                                    <span class="badge badge-warning">{{ $activeTrips }} Active</span>
                                                @else
                                                    <span class="badge badge-success">Available</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-primary">Edit Driver</a>
                                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-secondary">Back to List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Assigned Vehicles</h5>
                            </div>
                            <div class="card-body">
                                @if($driver->vehicles->count() > 0)
                                    @foreach($driver->vehicles as $vehicle)
                                    <div class="mb-2 p-2 border rounded">
                                        <strong>{{ $vehicle->number_plate }}</strong><br>
                                        <small class="text-muted">{{ $vehicle->model }} ({{ ucfirst($vehicle->type) }})</small><br>
                                        @if($vehicle->is_available)
                                            <span class="badge badge-success">Available</span>
                                        @else
                                            <span class="badge badge-warning">In Use</span>
                                        @endif
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No vehicles assigned</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($driver->trips->count() > 0)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Trips</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student</th>
                                                <th>Vehicle</th>
                                                <th>Route</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($driver->trips->take(10) as $trip)
                                            <tr>
                                                <td>{{ $trip->student->name }}</td>
                                                <td>{{ $trip->vehicle->number_plate ?? 'N/A' }}</td>
                                                <td>{{ $trip->route->name ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($trip->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $trip->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-info btn-sm me-1" title="View Trip">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.trips.track', $trip->id) }}" class="btn btn-warning btn-sm me-1" title="Track Trip">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </a>
                                                    @if($trip->status == 'in_progress')
                                                        <form action="{{ route('admin.trips.complete', $trip->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm" title="Complete Trip">
                                                                <i class="fas fa-stop"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </section>
        </div>
    </div>
</div>
@endsection
