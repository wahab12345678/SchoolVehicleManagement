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
                        <h2 class="content-header-title float-start mb-0">Edit Driver</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">Drivers</a></li>
                                <li class="breadcrumb-item active">Edit Driver</li>
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
                                <h4 class="card-title">Driver Information</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.drivers.update', $driver->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="name">Full Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Driver Full Name" value="{{ old('name', $driver->name) }}" required />
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="email">Email</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Driver Email" value="{{ old('email', $driver->email) }}" required />
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="phone">Phone</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Driver Phone Number" value="{{ old('phone', $driver->phone) }}" />
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="password">New Password</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Leave blank to keep current password" />
                                                    <small class="text-muted">Leave blank to keep current password</small>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="password_confirmation">Confirm New Password</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm new password" />
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="vehicle_ids">Assign Vehicles</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="vehicle_ids" class="form-select @error('vehicle_ids') is-invalid @enderror" name="vehicle_ids[]" multiple>
                                                        @foreach($availableVehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}" 
                                                                {{ in_array($vehicle->id, old('vehicle_ids', $driver->vehicles->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                {{ $vehicle->number_plate }} - {{ $vehicle->model }} ({{ $vehicle->type }})
                                                                @if($vehicle->driver_id == $driver->id)
                                                                    - Currently Assigned to This Driver
                                                                @elseif($vehicle->driver_id === null)
                                                                    - Unassigned
                                                                @else
                                                                    - Assigned to {{ $vehicle->driver->name }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <!-- Hidden input to ensure vehicle_ids is always sent -->
                                                    <input type="hidden" name="vehicle_ids[]" value="">
                                                    @error('vehicle_ids')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">Hold Ctrl/Cmd to select multiple vehicles. You can reassign vehicles from other drivers.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Update</button>
                                            <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
