@extends('admin.includes.main')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2">
                                <div class="d-flex align-items-center">
                    <div class="avatar bg-gradient-primary p-2 me-2">
                        <i data-feather="activity" class="font-medium-3 text-white"></i>
                                </div>
                    <div>
                        <h2 class="content-header-title mb-0">Dashboard</h2>
                        <p class="content-header-text mb-0">Welcome back! Here's what's happening with your school transportation system.</p>
                            </div>
                                                </div>
                                            </div>
            <div class="content-header-right col-md-4 col-12 d-md-block">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i data-feather="calendar"></i> Last 30 Days
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('7')">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('30')">Last 30 Days</a></li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('90')">Last 90 Days</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('this_week')">This Week</a></li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('this_month')">This Month</a></li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('this_year')">This Year</a></li>
                        </ul>
                                            </div>
                    <button class="btn btn-primary" onclick="refreshDashboard()">
                        <i data-feather="refresh-cw"></i> Refresh
                    </button>
                                        </div>
                                    </div>
                                                </div>
        <div class="content-body">
            <!-- Enhanced Statistics Cards with Trends -->
                <div class="row match-height">
                <!-- Students Card -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card card-statistics">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                <div class="avatar bg-light-primary p-50 m-0">
                                                <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['total_students'] }}</h4>
                                    <small class="text-muted">Total Students</small>
                                    <div class="d-flex align-items-center mt-1">
                                        @if($stats['student_trend']['direction'] == 'up')
                                            <span class="badge bg-success me-1">+{{ $stats['student_trend']['percentage'] }}%</span>
                                            <small class="text-success">vs last month</small>
                                        @elseif($stats['student_trend']['direction'] == 'down')
                                            <span class="badge bg-danger me-1">-{{ $stats['student_trend']['percentage'] }}%</span>
                                            <small class="text-danger">vs last month</small>
                                        @else
                                            <span class="badge bg-secondary me-1">0%</span>
                                            <small class="text-muted">vs last month</small>
                                        @endif
                                            </div>
                                        </div>
                                    </div>
                            <div class="mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                </div>

                <!-- Vehicles Card -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                <div class="avatar bg-light-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="truck" class="font-medium-5"></i>
                                            </div>
                                            </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['total_vehicles'] }}</h4>
                                    <small class="text-muted">Total Vehicles</small>
                                    <div class="d-flex align-items-center mt-1">
                                        @if($stats['vehicle_trend']['direction'] == 'up')
                                            <span class="badge bg-success me-1">+{{ $stats['vehicle_trend']['percentage'] }}%</span>
                                            <small class="text-success">vs last month</small>
                                        @elseif($stats['vehicle_trend']['direction'] == 'down')
                                            <span class="badge bg-danger me-1">-{{ $stats['vehicle_trend']['percentage'] }}%</span>
                                            <small class="text-danger">vs last month</small>
                                        @else
                                            <span class="badge bg-secondary me-1">0%</span>
                                            <small class="text-muted">vs last month</small>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            <div class="mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                </div>

                <!-- Active Trips Card -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                <div class="avatar bg-light-warning p-50 m-0">
                                                            <div class="avatar-content">
                                        <i data-feather="navigation" class="font-medium-5"></i>
                                                            </div>
                                                        </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['active_trips'] }}</h4>
                                    <small class="text-muted">Active Trips</small>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="badge bg-warning me-1">Live</span>
                                        <small class="text-warning">in progress</small>
                                                        </div>
                                                    </div>
                                                            </div>
                            <div class="mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"></div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                            </div>

                <!-- Drivers Card -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                <div class="avatar bg-light-info p-50 m-0">
                                                            <div class="avatar-content">
                                        <i data-feather="user-check" class="font-medium-5"></i>
                                                            </div>
                                                        </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['total_drivers'] }}</h4>
                                    <small class="text-muted">Total Drivers</small>
                                    <div class="d-flex align-items-center mt-1">
                                        @if($stats['driver_trend']['direction'] == 'up')
                                            <span class="badge bg-success me-1">+{{ $stats['driver_trend']['percentage'] }}%</span>
                                            <small class="text-success">vs last month</small>
                                        @elseif($stats['driver_trend']['direction'] == 'down')
                                            <span class="badge bg-danger me-1">-{{ $stats['driver_trend']['percentage'] }}%</span>
                                            <small class="text-danger">vs last month</small>
                                        @else
                                            <span class="badge bg-secondary me-1">0%</span>
                                            <small class="text-muted">vs last month</small>
                                        @endif
                                                    </div>
                                                    </div>
                                                    </div>
                            <div class="mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 70%"></div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                            </div>
                                                        </div>

            <!-- Additional Stats Row -->
                <div class="row match-height">
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                <div class="avatar bg-light-secondary p-50 m-0">
                                                            <div class="avatar-content">
                                        <i data-feather="corner-down-right" class="font-medium-5"></i>
                                                            </div>
                                                        </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['total_guardians'] }}</h4>
                                    <small>Total Guardians</small>
                                                        </div>
                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card">
                            <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                <div class="avatar bg-light-danger p-50 m-0">
                                                            <div class="avatar-content">
                                        <i data-feather="map" class="font-medium-5"></i>
                                                            </div>
                                                        </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['total_routes'] }}</h4>
                                    <small>Total Routes</small>
                                                        </div>
                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card">
                            <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                <div class="avatar bg-light-success p-50 m-0">
                                                            <div class="avatar-content">
                                        <i data-feather="check-circle" class="font-medium-5"></i>
                                                            </div>
                                                        </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['completed_trips'] }}</h4>
                                    <small>Completed Trips</small>
                                                        </div>
                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                <div class="col-xl-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                <div class="avatar bg-light-primary p-50 m-0">
                                                            <div class="avatar-content">
                                        <i data-feather="activity" class="font-medium-5"></i>
                                                            </div>
                                                        </div>
                                <div class="ms-1">
                                    <h4 class="mb-0">{{ $stats['total_trips'] }}</h4>
                                    <small>Total Trips</small>
                                                        </div>
                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

            <!-- Charts and Analytics Section -->
            <div class="row match-height">
                <!-- Trip Trends Chart -->
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Trip Trends & Analytics</h4>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i data-feather="filter"></i> Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="updateChart('week')">This Week</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateChart('month')">This Month</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateChart('year')">This Year</a></li>
                                </ul>
                                                    </div>
                                </div>
                        <div class="card-body">
                            <div id="trip-trends-chart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                <!-- Vehicle Utilization -->
                <div class="col-lg-4 col-12">
                    <div class="card">
                            <div class="card-header">
                            <h4 class="card-title">Vehicle Utilization</h4>
                            </div>
                            <div class="card-body">
                            <div id="vehicle-utilization-chart" style="height: 300px;"></div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Available</span>
                                    <span class="fw-bold">{{ $stats['available_vehicles'] ?? 0 }}</span>
                                    </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">In Use</span>
                                    <span class="fw-bold">{{ $stats['in_use_vehicles'] ?? 0 }}</span>
                                    </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Maintenance</span>
                                    <span class="fw-bold">{{ $stats['maintenance_vehicles'] ?? 0 }}</span>
                                </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                        </div>

            <!-- Performance Metrics -->
            <div class="row match-height">
                <!-- Route Performance -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Route Performance</h4>
                                    </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <h3 class="text-primary">{{ $stats['avg_trip_duration'] ?? '25' }} min</h3>
                                        <small class="text-muted">Avg Trip Duration</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h3 class="text-success">{{ $stats['on_time_percentage'] ?? '95' }}%</h3>
                                        <small class="text-muted">On-Time Rate</small>
                                    </div>
                                    </div>
                                    </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Most Popular Route</span>
                                    <span class="fw-bold">{{ $stats['popular_route'] ?? 'Route A' }}</span>
                                    </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Peak Hours</span>
                                    <span class="fw-bold">7:00 AM - 8:30 AM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Safety Metrics -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                            <div class="card-header">
                            <h4 class="card-title">Safety & Compliance</h4>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <h3 class="text-success">{{ $stats['safety_score'] ?? '98' }}%</h3>
                                        <small class="text-muted">Safety Score</small>
                                    </div>
                                    </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h3 class="text-info">{{ $stats['incidents'] ?? '0' }}</h3>
                                        <small class="text-muted">Incidents (30 days)</small>
                                </div>
                                    </div>
                                    </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Driver Training</span>
                                    <span class="badge bg-success">100%</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Vehicle Inspections</span>
                                    <span class="badge bg-warning">Due: 3</span>
                                    </div>
                                    </div>
                                </div>
                                    </div>
                                    </div>
                                </div>

            <!-- Live Activity Feed -->
            <div class="row match-height">
                <!-- Active Trips -->
                <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                <i data-feather="activity" class="me-1"></i>
                                Live Trips
                            </h4>
                            <span class="badge bg-warning pulse-animation">{{ $stats['active_trips'] }} Active</span>
                            </div>
                        <div class="card-body">
                            @if($active_trips->count() > 0)
                                @foreach($active_trips as $trip)
                                <div class="d-flex align-items-center mb-3 p-2 border rounded">
                                    <div class="avatar bg-light-{{ $trip->status == 'in_progress' ? 'warning' : 'secondary' }} p-50 m-0 me-2">
                                        <div class="avatar-content">
                                            <i data-feather="navigation" class="font-medium-3"></i>
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $trip->student->name }}</h6>
                                        <small class="text-muted d-block">
                                            <i data-feather="truck" class="me-1" style="width: 12px; height: 12px;"></i>
                                            {{ $trip->vehicle->number_plate ?? 'No Vehicle' }}
                                        </small>
                                        <small class="text-muted">
                                            <i data-feather="map-pin" class="me-1" style="width: 12px; height: 12px;"></i>
                                            {{ $trip->route->name ?? 'No Route' }}
                                        </small>
                                </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $trip->status == 'in_progress' ? 'warning' : 'secondary' }} mb-1">
                                            {{ ucfirst($trip->status) }}
                                        </span>
                                        <br>
                                        <small class="text-muted">{{ $trip->created_at->format('H:i') }}</small>
                            </div>
                        </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i data-feather="navigation" class="text-muted" style="width: 48px; height: 48px;"></i>
                                    <p class="text-muted mt-2">No active trips at the moment</p>
                    </div>
                            @endif
                                    </div>
                                </div>
                                    </div>

                <!-- Recent Activity -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                <i data-feather="clock" class="me-1"></i>
                                Recent Activity
                            </h4>
                            <a href="{{ route('admin.trips.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                            @if($recent_trips->count() > 0)
                                @foreach($recent_trips as $trip)
                                <div class="d-flex align-items-center mb-3 p-2 border rounded">
                                    <div class="avatar bg-light-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }} p-50 m-0 me-2">
                                            <div class="avatar-content">
                                            <i data-feather="{{ $trip->status == 'completed' ? 'check-circle' : 'navigation' }}" class="font-medium-3"></i>
                                            </div>
                                        </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $trip->student->name }}</h6>
                                        <small class="text-muted d-block">
                                            <i data-feather="calendar" class="me-1" style="width: 12px; height: 12px;"></i>
                                            {{ $trip->created_at->format('M d, Y') }}
                                        </small>
                                        <small class="text-muted">
                                            <i data-feather="clock" class="me-1" style="width: 12px; height: 12px;"></i>
                                            {{ $trip->created_at->format('H:i') }}
                                        </small>
                                        </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }} mb-1">
                                            {{ ucfirst($trip->status) }}
                                        </span>
                                        <br>
                                        <small class="text-muted">{{ $trip->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i data-feather="clock" class="text-muted" style="width: 48px; height: 48px;"></i>
                                    <p class="text-muted mt-2">No recent activity</p>
                                            </div>
                            @endif
                                        </div>
                                        </div>
                                    </div>
                                </div>

            <!-- Quick Actions & Alerts -->
            <div class="row">
                <!-- Quick Actions -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i data-feather="zap" class="me-1"></i>
                                Quick Actions
                            </h4>
                                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="user-plus" class="me-2"></i> Add Student
                                    </a>
                                        </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="truck" class="me-2"></i> Add Vehicle
                                    </a>
                                        </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.drivers.create') }}" class="btn btn-info btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="user-check" class="me-2"></i> Add Driver
                                    </a>
                                    </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.trips.create') }}" class="btn btn-warning btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="navigation" class="me-2"></i> Create Trip
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.routes.create') }}" class="btn btn-secondary btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="map" class="me-2"></i> Add Route
                                    </a>
                                            </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.school.create') }}" class="btn btn-dark btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="home" class="me-2"></i> Add School
                                    </a>
                                        </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <a href="{{ route('admin.guardians.create') }}" class="btn btn-outline-primary btn-modern w-100 d-flex align-items-center justify-content-center">
                                        <i data-feather="users" class="me-2"></i> Add Guardian
                                    </a>
                                        </div>
                                    </div>
                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

<!-- Custom CSS for enhanced dashboard -->
<style>
.card-statistics {
    transition: transform 0.2s ease-in-out;
    border-left: 4px solid transparent;
}

.card-statistics:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.card-statistics:nth-child(1) { border-left-color: #7367f0; }
.card-statistics:nth-child(2) { border-left-color: #28c76f; }
.card-statistics:nth-child(3) { border-left-color: #ff9f43; }
.card-statistics:nth-child(4) { border-left-color: #00cfe8; }

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.progress {
    border-radius: 10px;
}

/* Spinning animation for refresh button */
.spinning {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Enhanced card hover effects */
.card-statistics {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.card-statistics:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* Modern gradient backgrounds with improved color combinations */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
    box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
    box-shadow: 0 4px 15px rgba(253, 203, 110, 0.3);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
    box-shadow: 0 4px 15px rgba(116, 185, 255, 0.3);
}

/* Enhanced card color schemes */
.card-statistics:nth-child(1) { 
    border-left-color: #667eea; 
    background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
}

.card-statistics:nth-child(2) { 
    border-left-color: #00b894; 
    background: linear-gradient(135deg, #ffffff 0%, #f0fff4 100%);
}

.card-statistics:nth-child(3) { 
    border-left-color: #fdcb6e; 
    background: linear-gradient(135deg, #ffffff 0%, #fff8f0 100%);
}

.card-statistics:nth-child(4) { 
    border-left-color: #74b9ff; 
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
}

/* Enhanced header styling with improved visibility */
.content-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}

.content-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.content-header-title {
    color: white;
    font-weight: 800;
    font-size: 2.2rem;
    text-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.5px;
    margin-bottom: 8px;
}

.content-header-text {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.2rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    font-weight: 500;
    line-height: 1.4;
}

/* Enhanced header button styling */
.content-header .btn {
    background: rgba(255, 255, 255, 0.15);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 12px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.content-header .btn:hover {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.content-header .btn:focus {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
    color: white;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
}

.content-header .btn-primary {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.content-header .btn-primary:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.6);
}

/* Header dropdown styling */
.content-header .dropdown-menu {
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(10px);
    margin-top: 8px;
}

.content-header .dropdown-item {
    color: #333;
    font-weight: 500;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.content-header .dropdown-item:hover {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.content-header .dropdown-divider {
    border-color: rgba(0, 0, 0, 0.1);
    margin: 8px 0;
}

/* Enhanced header icon styling */
.content-header .avatar {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.content-header .avatar i {
    color: white !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Header text container styling */
.content-header-left {
    position: relative;
    z-index: 2;
}

.content-header-right {
    position: relative;
    z-index: 2;
}

/* Enhanced header responsiveness */
@media (max-width: 768px) {
    .content-header {
        padding: 20px;
        text-align: center;
    }
    
    .content-header-title {
        font-size: 1.8rem;
    }
    
    .content-header-text {
        font-size: 1rem;
    }
    
    .content-header .btn {
        padding: 10px 16px;
        font-size: 0.9rem;
    }
    
    .content-header-right {
        margin-top: 20px;
        justify-content: center;
    }
}

/* Modern button styles with enhanced colors */
.btn-modern {
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    padding: 12px 24px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
    min-height: 50px;
}

/* Enhanced button color schemes */
.btn-primary.btn-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-success.btn-modern {
    background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
    box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
}

.btn-warning.btn-modern {
    background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
    box-shadow: 0 4px 15px rgba(253, 203, 110, 0.3);
}

.btn-info.btn-modern {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
    box-shadow: 0 4px 15px rgba(116, 185, 255, 0.3);
}

.btn-secondary.btn-modern {
    background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
    box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
}

.btn-dark.btn-modern {
    background: linear-gradient(135deg, #2d3436 0%, #636e72 100%);
    box-shadow: 0 4px 15px rgba(45, 52, 54, 0.3);
}

.btn-outline-primary.btn-modern {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(102, 126, 234, 0.05) 100%);
    border: 2px solid #667eea;
    color: #667eea;
}

.btn-outline-success.btn-modern {
    background: linear-gradient(135deg, rgba(0, 184, 148, 0.1) 0%, rgba(0, 184, 148, 0.05) 100%);
    border: 2px solid #00b894;
    color: #00b894;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-modern:hover::before {
    left: 100%;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

/* Enhanced chart containers with improved colors */
.chart-container {
    position: relative;
    height: 350px;
    border-radius: 20px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 25px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.chart-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.chart-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
}

/* Enhanced card styling with better color combinations */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 16px 16px 0 0;
}

/* Enhanced statistics card colors */
.avatar.bg-light-primary {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(102, 126, 234, 0.05) 100%) !important;
    color: #667eea !important;
}

.avatar.bg-light-success {
    background: linear-gradient(135deg, rgba(0, 184, 148, 0.1) 0%, rgba(0, 184, 148, 0.05) 100%) !important;
    color: #00b894 !important;
}

.avatar.bg-light-warning {
    background: linear-gradient(135deg, rgba(253, 203, 110, 0.1) 0%, rgba(253, 203, 110, 0.05) 100%) !important;
    color: #fdcb6e !important;
}

.avatar.bg-light-info {
    background: linear-gradient(135deg, rgba(116, 185, 255, 0.1) 0%, rgba(116, 185, 255, 0.05) 100%) !important;
    color: #74b9ff !important;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .content-header {
        padding: 20px;
        text-align: center;
    }
    
    .content-header-title {
        font-size: 1.5rem;
    }
    
    .chart-container {
        height: 250px;
        padding: 15px;
    }
    
    .card-statistics {
        margin-bottom: 20px;
    }
}

.progress-bar {
    border-radius: 10px;
}
</style>

<!-- Chart.js is loaded from theme footer -->

<script>
let tripTrendsChart = null;
let vehicleUtilChart = null;
let currentPeriod = '30';

// Wait for Chart.js to load (using theme's Chart.js v2.9.3)
let chartJSAttempts = 0;
const maxAttempts = 30; // 3 seconds max wait

function waitForChartJS() {
    chartJSAttempts++;
    
    if (typeof Chart !== 'undefined') {
        console.log('Chart.js v2.9.3 loaded successfully from theme');
        initializeDashboard();
    } else if (chartJSAttempts < maxAttempts) {
        console.log(`Waiting for Chart.js to load... (attempt ${chartJSAttempts}/${maxAttempts})`);
        setTimeout(waitForChartJS, 100);
    } else {
        console.error('Chart.js failed to load after maximum attempts');
        showChartError();
    }
}

function showChartError() {
    const tripChartElement = document.getElementById('trip-trends-chart');
    const vehicleChartElement = document.getElementById('vehicle-utilization-chart');
    
    if (tripChartElement) {
        tripChartElement.innerHTML = '<div class="text-center p-4 text-danger"><i class="fas fa-exclamation-triangle"></i><br>Chart.js failed to load. Please refresh the page.</div>';
    }
    
    if (vehicleChartElement) {
        vehicleChartElement.innerHTML = '<div class="text-center p-4 text-danger"><i class="fas fa-exclamation-triangle"></i><br>Chart.js failed to load. Please refresh the page.</div>';
    }
}

function initializeDashboard() {
    console.log('Dashboard JavaScript loaded');
    
    // Check if chart elements exist
    const tripChartElement = document.getElementById('trip-trends-chart');
    const vehicleChartElement = document.getElementById('vehicle-utilization-chart');
    
    if (!tripChartElement) {
        console.error('Trip trends chart element not found');
    }
    
    if (!vehicleChartElement) {
        console.error('Vehicle utilization chart element not found');
    }
    
    // Initialize charts with real data
    console.log('Loading initial chart data...');
    loadChartData();
    
    // Initialize period selector
    updatePeriodSelector();
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking for Chart.js...');
    waitForChartJS();
});

function loadChartData(period = '30') {
    currentPeriod = period;
    
    // Show loading state
    const tripChartContainer = document.getElementById('trip-trends-chart');
    const vehicleChartContainer = document.getElementById('vehicle-utilization-chart');
    
    if (tripChartContainer) {
        tripChartContainer.innerHTML = '<div class="text-center p-4" id="trip-loading"><div class="spinner-border text-primary" role="status"></div><br><small>Loading chart data...</small></div>';
    }
    
    if (vehicleChartContainer) {
        vehicleChartContainer.innerHTML = '<div class="text-center p-4" id="vehicle-loading"><div class="spinner-border text-primary" role="status"></div><br><small>Loading chart data...</small></div>';
    }
    
    // Fetch chart data from server
    fetch(`/admin/dashboard/chart-data?period=${period}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Chart data received:', data);
        
        if (data.tripTrends) {
            updateTripTrendsChart(data.tripTrends);
        } else {
            console.error('No trip trends data received');
        }
        
        if (data.vehicleUtilization) {
            updateVehicleUtilizationChart(data.vehicleUtilization);
        } else {
            console.error('No vehicle utilization data received');
        }
        
        updatePeriodSelector();
    })
    .catch(error => {
        console.error('Error loading chart data:', error);
        if (tripChartContainer) {
            tripChartContainer.innerHTML = '<div class="text-center p-4 text-danger">Error loading chart data: ' + error.message + '</div>';
        }
        if (vehicleChartContainer) {
            vehicleChartContainer.innerHTML = '<div class="text-center p-4 text-danger">Error loading chart data: ' + error.message + '</div>';
        }
    });
}

function updateTripTrendsChart(data) {
    const chartContainer = document.getElementById('trip-trends-chart');
    if (!chartContainer) {
        console.error('Trip trends chart container not found');
        return;
    }
    
    // Create canvas element if it doesn't exist
    let canvas = chartContainer.querySelector('canvas');
    if (!canvas) {
        console.log('Creating canvas element for trip trends chart');
        canvas = document.createElement('canvas');
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        chartContainer.appendChild(canvas);
    }
    
    console.log('Canvas element:', canvas);
    console.log('Canvas getContext function:', typeof canvas.getContext);
    
    const ctx = canvas.getContext('2d');
    
    if (tripTrendsChart) {
        tripTrendsChart.destroy();
    }
    
    try {
        tripTrendsChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    yAxes: [{
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        display: true
                    }]
                }
            }
        });
        console.log('Trip trends chart updated successfully');
        
        // Clear loading state
        const loadingDiv = document.getElementById('trip-loading');
        if (loadingDiv) {
            loadingDiv.remove();
        }
    } catch (error) {
        console.error('Error updating trip trends chart:', error);
        chartContainer.innerHTML = '<div class="text-center p-4 text-danger">Error rendering trip trends chart</div>';
    }
}

function updateVehicleUtilizationChart(data) {
    const chartContainer = document.getElementById('vehicle-utilization-chart');
    if (!chartContainer) {
        console.error('Vehicle utilization chart container not found');
        return;
    }
    
    // Create canvas element if it doesn't exist
    let canvas = chartContainer.querySelector('canvas');
    if (!canvas) {
        console.log('Creating canvas element for vehicle utilization chart');
        canvas = document.createElement('canvas');
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        chartContainer.appendChild(canvas);
    }
    
    console.log('Vehicle canvas element:', canvas);
    console.log('Vehicle canvas getContext function:', typeof canvas.getContext);
    
    const ctx = canvas.getContext('2d');
    
    if (vehicleUtilChart) {
        vehicleUtilChart.destroy();
    }
    
    try {
        vehicleUtilChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.data,
                    backgroundColor: data.backgroundColor,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            const dataset = data.datasets[tooltipItem.datasetIndex];
                            const total = dataset.data.reduce((a, b) => a + b, 0);
                            const currentValue = dataset.data[tooltipItem.index];
                            const percentage = ((currentValue / total) * 100).toFixed(1);
                            return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
        console.log('Vehicle utilization chart updated successfully');
        
        // Clear loading state
        const loadingDiv = document.getElementById('vehicle-loading');
        if (loadingDiv) {
            loadingDiv.remove();
        }
    } catch (error) {
        console.error('Error updating vehicle utilization chart:', error);
        chartContainer.innerHTML = '<div class="text-center p-4 text-danger">Error rendering vehicle utilization chart</div>';
    }
}

function updatePeriodSelector() {
    const periodText = currentPeriod === '7' ? 'Last 7 Days' : 
                      currentPeriod === '30' ? 'Last 30 Days' : 
                      currentPeriod === '90' ? 'Last 90 Days' :
                      currentPeriod === 'this_week' ? 'This Week' :
                      currentPeriod === 'this_month' ? 'This Month' :
                      currentPeriod === 'this_year' ? 'This Year' : 'Last 30 Days';
    
    document.querySelector('#dropdownMenuButton').innerHTML = `<i data-feather="calendar"></i> ${periodText}`;
    
    // Re-initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
}

// Period change function
function changePeriod(period) {
    console.log('Changing period to:', period);
    loadChartData(period);
}

// Chart update function
function updateChart(period) {
    console.log('Updating chart for period:', period);
    loadChartData(period);
}

// Refresh dashboard function
function refreshDashboard() {
    console.log('Refreshing dashboard...');
    
    // Show loading state
    const refreshBtn = document.querySelector('button[onclick="refreshDashboard()"]');
    const originalText = refreshBtn.innerHTML;
    refreshBtn.innerHTML = '<i data-feather="refresh-cw" class="spinning"></i> Refreshing...';
    refreshBtn.disabled = true;
    
    // Re-initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Reload chart data
    loadChartData(currentPeriod);
    
    // Reset button after a delay
    setTimeout(() => {
        refreshBtn.innerHTML = originalText;
        refreshBtn.disabled = false;
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }, 2000);
}
</script>
@endsection