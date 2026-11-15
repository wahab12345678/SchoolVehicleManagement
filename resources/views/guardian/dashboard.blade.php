@extends('admin.includes.main')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Guardian Dashboard</h2>
            </div>
        </div>
        <div class="content-body">
            <!-- Welcome Message -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Welcome, {{ Auth::user()->name }}!</h4>
                            <p class="text-muted">Track your children's transportation and stay updated with their trips.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Children -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">My Children</h4>
                        </div>
                        <div class="card-body">
                            @if($students->count() > 0)
                                <div class="row">
                                    @foreach($students as $student)
                                    <div class="col-md-4 col-12 mb-3">
                                        <div class="card border">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $student->name }}</h5>
                                                <p class="card-text">
                                                    <strong>Roll Number:</strong> {{ $student->roll_number }}<br>
                                                    <strong>Class:</strong> {{ $student->class ?? 'Not specified' }}<br>
                                                    <strong>Location:</strong> 
                                                    @if($student->latitude && $student->longitude)
                                                        <a href="https://www.google.com/maps?q={{ $student->latitude }},{{ $student->longitude }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i data-feather="map-pin"></i> View on Map
                                                        </a>
                                                    @else
                                                        Not set
                                                    @endif
                                                </p>
                                                <a href="{{ route('guardian.tracking.index') }}" class="btn btn-primary btn-sm">
                                                    <i data-feather="navigation"></i> Track Trips
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No children registered.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Trips -->
            @if($activeTrips->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Active Trips</h4>
                        </div>
                        <div class="card-body">
                            @foreach($activeTrips as $trip)
                            <div class="d-flex align-items-center mb-3 p-3 border rounded">
                                <div class="avatar bg-light-{{ $trip->status == 'in_progress' ? 'warning' : 'secondary' }} p-50 m-0 me-2">
                                    <div class="avatar-content">
                                        <i data-feather="navigation" class="font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $trip->student->name }}</h6>
                                    <small class="text-muted">
                                        Vehicle: {{ $trip->vehicle->number_plate ?? 'N/A' }} | 
                                        Route: {{ $trip->route->name ?? 'N/A' }} |
                                        Driver: {{ $trip->vehicle->driver->name ?? 'N/A' }}
                                    </small>
                                </div>
                                <div class="ms-2">
                                    <span class="badge badge-{{ $trip->status == 'in_progress' ? 'warning' : 'secondary' }}">
                                        {{ ucfirst($trip->status) }}
                                    </span>
                                    <a href="{{ route('guardian.trips.map', $trip->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                                        <i data-feather="map"></i> Track
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Recent Trips -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Recent Trips</h4>
                        </div>
                        <div class="card-body">
                            @if($recentTrips->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
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
                                            @foreach($recentTrips as $trip)
                                            <tr>
                                                <td>{{ $trip->student->name }}</td>
                                                <td>{{ $trip->vehicle->number_plate ?? 'N/A' }}</td>
                                                <td>{{ $trip->route->name ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($trip->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $trip->created_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    @if($trip->status == 'in_progress')
                                                        <a href="{{ route('guardian.trips.map', $trip->id) }}" class="btn btn-sm btn-outline-primary">
                                                            <i data-feather="map"></i> Track
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Completed</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No recent trips found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
