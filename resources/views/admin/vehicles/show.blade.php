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
                        <h2 class="content-header-title float-start mb-0">Vehicle Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
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
                                        <h5>Vehicle Information</h5>
                                        <div class="mt-1">
                                            <p><strong>Number Plate:</strong> {{ $vehicle->number_plate }}</p>
                                            <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                                            <p><strong>Type:</strong> {{ ucfirst($vehicle->type) }}</p>
                                            <p><strong>Driver:</strong> {{ $vehicle->driver->name ?? 'No Driver' }}</p>
                                            <p><strong>Status:</strong> 
                                                @if($vehicle->is_available)
                                                    <span class="badge badge-success">Available</span>
                                                @else
                                                    <span class="badge badge-warning">In Use</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary">Edit Vehicle</a>
                                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">Back to List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Active Trips</h5>
                            </div>
                            <div class="card-body">
                                @if($vehicle->activeTrips->count() > 0)
                                    @foreach($vehicle->activeTrips as $trip)
                                    <div class="mb-2 p-2 border rounded">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{{ $trip->student->name }}</strong><br>
                                                <small class="text-muted">{{ $trip->route->name ?? 'No Route' }}</small><br>
                                                <span class="badge bg-warning">{{ ucfirst($trip->status) }}</span>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-info btn-sm" title="View Trip">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.trips.track', $trip->id) }}" class="btn btn-warning btn-sm" title="Track Trip">
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
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No active trips</p>
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
