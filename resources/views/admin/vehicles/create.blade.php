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
                        <h2 class="content-header-title float-start mb-0">Add Vehicle</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
                                <li class="breadcrumb-item active">Add Vehicle</li>
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
                                <h4 class="card-title">Vehicle Information</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.vehicles.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="number_plate">Number Plate</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="number_plate" class="form-control @error('number_plate') is-invalid @enderror" name="number_plate" placeholder="Vehicle Number Plate" value="{{ old('number_plate') }}" required />
                                                    @error('number_plate')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="model">Model</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="model" class="form-control @error('model') is-invalid @enderror" name="model" placeholder="Vehicle Model" value="{{ old('model') }}" required />
                                                    @error('model')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="type">Type</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
                                                        <option value="">-- Select Vehicle Type --</option>
                                                        <option value="van" {{ old('type') == 'van' ? 'selected' : '' }}>Van</option>
                                                        <option value="bus" {{ old('type') == 'bus' ? 'selected' : '' }}>Bus</option>
                                                        <option value="car" {{ old('type') == 'car' ? 'selected' : '' }}>Car</option>
                                                    </select>
                                                    @error('type')
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

                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
