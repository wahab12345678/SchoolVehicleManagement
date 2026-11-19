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
                        <h2 class="content-header-title float-start mb-0">Trip Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.trips.index') }}">Trips</a></li>
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
                                        <h5>Trip Information</h5>
                                        <div class="mt-1">
                                            <p><strong>Student:</strong> {{ $trip->student->name }}</p>
                                            <p><strong>School:</strong> {{ $trip->school->name ?? 'N/A' }}</p>
                                            <p><strong>Vehicle:</strong> {{ $trip->vehicle->number_plate ?? 'N/A' }} ({{ $trip->vehicle->model ?? 'N/A' }})</p>
                                            <p><strong>Driver:</strong> {{ $trip->vehicle->driver->name ?? 'N/A' }}</p>
                                            <p><strong>Route:</strong> {{ $trip->route->name ?? 'N/A' }}</p>
                                            <p><strong>Status:</strong> 
                                                <span class="badge badge-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($trip->status) }}
                                                </span>
                                            </p>
                                            @if($trip->started_at)
                                            <p><strong>Started:</strong> {{ $trip->started_at->format('M d, Y H:i') }}</p>
                                            @endif
                                            @if($trip->ended_at)
                                            <p><strong>Completed:</strong> {{ $trip->ended_at->format('M d, Y H:i') }}</p>
                                            @endif
                                            @if($trip->duration)
                                            <p><strong>Duration:</strong> {{ $trip->duration }} minutes</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-primary">Edit Trip</a>
                                    <a href="{{ route('admin.trips.track', $trip->id) }}" class="btn btn-info">Track Trip</a>
                                    <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-secondary">Back to List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Locations</h5>
                            </div>
                            <div class="card-body">
                                @if($trip->locations->count() > 0)
                                    @foreach($trip->locations->take(5) as $location)
                                    <div class="mb-2 p-2 border rounded">
                                        <strong>{{ $location->latitude }}, {{ $location->longitude }}</strong><br>
                                        <small class="text-muted">{{ $location->recorded_at->format('M d, Y H:i') }}</small><br>
                                        <a href="{{ $location->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-primary">View on Map</a>
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No location data available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
