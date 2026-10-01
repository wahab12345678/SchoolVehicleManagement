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
            <!-- Guardian Profile & Welcome Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card" style="border: 1px solid rgba(99, 102, 241, 0.15); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border-radius: 12px; overflow: hidden;">
                        <div class="card-body p-2 p-md-3">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-2 me-md-3">
                                        <img src="{{ Auth::user()->avatar_url }}" 
                                             alt="{{ Auth::user()->name }}" 
                                             class="round user-avatar-image shadow-sm" 
                                             width="72" 
                                             height="72" 
                                             style="object-fit: cover; border: 3px solid #6366f1; border-radius: 50%;" 
                                             data-user-avatar>
                                        <button type="button" 
                                                class="btn btn-sm btn-icon btn-primary rounded-circle position-absolute bottom-0 end-0 trigger-change-photo" 
                                                title="Change Photo" 
                                                style="width: 28px; height: 28px; padding: 0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.4); border: 2px solid #ffffff;">
                                            <i data-feather="camera" style="width: 14px; height: 14px;"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center flex-wrap gap-1 mb-25">
                                            <h4 class="mb-0 fw-bolder" style="color: #1f2937;">{{ Auth::user()->name }}</h4>
                                            <span class="badge badge-light-primary">Guardian</span>
                                        </div>
                                        <p class="text-muted small mb-25">
                                            <span><i data-feather="mail" style="width: 12px; height: 12px;" class="me-25"></i>{{ Auth::user()->email }}</span>
                                            @if(Auth::user()->phone)
                                                <span class="ms-2"><i data-feather="phone" style="width: 12px; height: 12px;" class="me-25"></i>{{ Auth::user()->phone }}</span>
                                            @endif
                                        </p>
                                        <p class="text-muted small mb-0">Track your children's transportation and stay updated with their trips.</p>
                                    </div>
                                </div>
                                <div class="mt-2 mt-md-0 d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-primary btn-sm trigger-change-photo d-inline-flex align-items-center" style="border-radius: 8px;">
                                        <i data-feather="camera" class="me-50" style="width: 15px; height: 15px;"></i> Change Photo
                                    </button>
                                </div>
                            </div>
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
