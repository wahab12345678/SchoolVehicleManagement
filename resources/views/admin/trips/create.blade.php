@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Add Trip</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.trips.index') }}">Trips</a></li>
                                <li class="breadcrumb-item active">Add Trip</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Trip Information</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.trips.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="student_id">Student</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="student_id" name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                                        <option value="">-- Select Student --</option>
                                                        @foreach($students as $student)
                                                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }} ({{ $student->class ?? 'No Class' }})</option>
                                                        @endforeach
                                                    </select>
                                                    @error('student_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="vehicle_id">Vehicle</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="vehicle_id" name="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror" required>
                                                        <option value="">-- Select Vehicle --</option>
                                                        @foreach($vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->number_plate }} - {{ $vehicle->model }} ({{ ucfirst($vehicle->type) }})</option>
                                                        @endforeach
                                                    </select>
                                                    @error('vehicle_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="route_id">Route</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="route_id" name="route_id" class="form-select @error('route_id') is-invalid @enderror" required>
                                                        <option value="">-- Select Route --</option>
                                                        @foreach($routes as $route)
                                                            <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>{{ $route->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('route_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="driver_id">Driver</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="driver_id" name="driver_id" class="form-select @error('driver_id') is-invalid @enderror" required>
                                                        <option value="">-- Select Driver --</option>
                                                        @foreach($drivers as $driver)
                                                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('driver_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="status">Status</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
