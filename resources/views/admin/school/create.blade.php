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
                        <h2 class="content-header-title float-start mb-0">Add School Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.school.index') }}">School</a></li>
                                <li class="breadcrumb-item active">Add School</li>
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
                                <h4 class="card-title">School Information</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.school.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Basic Information -->
                                        <div class="col-12">
                                            <h5 class="mb-2">Basic Information</h5>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="name">School Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="School Name" value="{{ old('name') }}" required />
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
                                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="School Email" value="{{ old('email') }}" required />
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
                                                    <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="School Phone" value="{{ old('phone') }}" required />
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="website">Website</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="url" id="website" class="form-control @error('website') is-invalid @enderror" name="website" placeholder="School Website" value="{{ old('website') }}" />
                                                    @error('website')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address Information -->
                                        <div class="col-12">
                                            <h5 class="mb-2 mt-3">Address Information</h5>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="address">Address</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="School Address" rows="3" required>{{ old('address') }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="city">City</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="City" value="{{ old('city') }}" required />
                                                    @error('city')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="state">State/Province</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="state" class="form-control @error('state') is-invalid @enderror" name="state" placeholder="State/Province" value="{{ old('state') }}" required />
                                                    @error('state')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="country">Country</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="country" class="form-control @error('country') is-invalid @enderror" name="country" placeholder="Country" value="{{ old('country', 'Pakistan') }}" required />
                                                    @error('country')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="postal_code">Postal Code</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" placeholder="Postal Code" value="{{ old('postal_code') }}" />
                                                    @error('postal_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- GPS Coordinates -->
                                        <div class="col-12">
                                            <h5 class="mb-2 mt-3">GPS Coordinates (Optional)</h5>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="latitude">Latitude</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="number" step="any" id="latitude" class="form-control @error('latitude') is-invalid @enderror" name="latitude" placeholder="Latitude (e.g. 31.5204)" value="{{ old('latitude') }}" />
                                                    @error('latitude')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="longitude">Longitude</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="number" step="any" id="longitude" class="form-control @error('longitude') is-invalid @enderror" name="longitude" placeholder="Longitude (e.g. 74.3587)" value="{{ old('longitude') }}" />
                                                    @error('longitude')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Principal Information -->
                                        <div class="col-12">
                                            <h5 class="mb-2 mt-3">Principal Information (Optional)</h5>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="principal_name">Principal Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="principal_name" class="form-control @error('principal_name') is-invalid @enderror" name="principal_name" placeholder="Principal Name" value="{{ old('principal_name') }}" />
                                                    @error('principal_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="principal_email">Principal Email</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="email" id="principal_email" class="form-control @error('principal_email') is-invalid @enderror" name="principal_email" placeholder="Principal Email" value="{{ old('principal_email') }}" />
                                                    @error('principal_email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="principal_phone">Principal Phone</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="principal_phone" class="form-control @error('principal_phone') is-invalid @enderror" name="principal_phone" placeholder="Principal Phone" value="{{ old('principal_phone') }}" />
                                                    @error('principal_phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Information -->
                                        <div class="col-12">
                                            <h5 class="mb-2 mt-3">Additional Information</h5>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="description">Description</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="School Description" rows="4">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="logo">School Logo</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="file" id="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*" />
                                                    <small class="text-muted">Upload school logo (JPG, PNG, GIF - Max 2MB)</small>
                                                    @error('logo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <a href="{{ route('admin.school.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
