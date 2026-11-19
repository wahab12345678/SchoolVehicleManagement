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
                {{-- Vehicle Type Display Banner at Top --}}
                <div class="row mb-2">
                    <div class="col-12">
                        @php
                            $primaryVehicle = $driver->vehicles->first();
                            $vType = strtolower($primaryVehicle->type ?? '');
                            $typeBadgeClass = match($vType) {
                                'bus' => 'bg-warning text-dark',
                                'van' => 'bg-info text-white',
                                'rickshaw' => 'bg-success text-white',
                                'car' => 'bg-primary text-white',
                                default => 'bg-secondary text-white'
                            };
                            $typeIcon = match($vType) {
                                'bus' => 'fa-bus',
                                'van' => 'fa-shuttle-van',
                                'rickshaw' => 'fa-motorcycle',
                                'car' => 'fa-car',
                                default => 'fa-truck'
                            };
                        @endphp
                        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: linear-gradient(135deg, #102A43 0%, #1B4D5C 50%, #0F766E 100%); color: #fff;">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between flex-wrap">
                                <div class="d-flex align-items-center mb-1 mb-md-0">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 58px; height: 58px; background: rgba(255,255,255,0.18);">
                                        <i class="fas {{ $typeIcon }} fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-white-50 text-uppercase small fw-bold tracking-wider">Assigned Vehicle Type</div>
                                        <h3 class="text-white mb-0 fw-bold">
                                            @if($primaryVehicle)
                                                <span class="badge {{ $typeBadgeClass }} me-2 text-uppercase">{{ $primaryVehicle->type }}</span>
                                                <span>{{ $primaryVehicle->model }} ({{ $primaryVehicle->number_plate }})</span>
                                            @else
                                                <span class="badge bg-secondary">No Vehicle Assigned</span>
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                                @if($primaryVehicle)
                                    <div class="text-md-end mt-2 mt-md-0">
                                        <span class="badge bg-light text-dark px-3 py-2 fw-bold" style="font-size: 0.9rem;">
                                            Capacity: {{ $primaryVehicle->capacity }} Seats
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm" style="border-radius: 14px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="fw-bold mb-3" style="color: #102A43;">Driver Profile Information</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0 text-muted" style="width: 220px;">Full Name:</th>
                                                        <td class="fw-bold text-dark">{{ $driver->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">CNIC Number:</th>
                                                        <td><span class="badge bg-light text-dark px-2 py-1 border">{{ $driver->cnic ?? 'Not provided' }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">Phone Number:</th>
                                                        <td class="fw-semibold">{{ $driver->phone ?? 'Not provided' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">License Number:</th>
                                                        <td><span class="badge bg-light text-primary px-2 py-1 border">{{ $driver->license_number ?? 'Not provided' }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">House / Home Location:</th>
                                                        <td class="text-dark">{{ $driver->address ?? 'Not provided' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">Email Address:</th>
                                                        <td>{{ $driver->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">Role:</th>
                                                        <td><span class="badge bg-primary">Driver</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">Assigned Vehicles:</th>
                                                        <td>{{ $driver->vehicles->count() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">Total Trips:</th>
                                                        <td>{{ $driver->trips->count() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0 text-muted">Status:</th>
                                                        <td>
                                                            @php
                                                                $activeTrips = $driver->vehicles()->whereHas('activeTrips')->count();
                                                            @endphp
                                                            @if($activeTrips > 0)
                                                                <span class="badge bg-warning">{{ $activeTrips }} Active</span>
                                                            @else
                                                                <span class="badge bg-success">Available</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-primary px-3">Edit Driver</a>
                                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-secondary px-3">Back to List</a>
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
