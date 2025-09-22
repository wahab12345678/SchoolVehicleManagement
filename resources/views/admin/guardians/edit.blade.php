@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Edit Guardian</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.guardians.index') }}">Guardians</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Guardian
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Guardian Information</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.guardians.update', $guardian->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="name">Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name', $guardian->user->name) }}" required />
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
                                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email', $guardian->user->email) }}" required />
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
                                                    <div class="input-group">
                                                        <span class="input-group-text">+92</span>
                                                        <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="3XX XXXXXXX" value="{{ old('phone', $guardian->user->phone) }}" pattern="[0-9]{10}" title="Please enter a valid phone number (10 digits without country code)" />
                                                    </div>
                                                    <small class="form-text text-muted">Format: 3XX XXXXXXX (without leading zero)</small>
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="cnic">CNIC</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="cnic" class="form-control @error('cnic') is-invalid @enderror" name="cnic" placeholder="XXXXX-XXXXXXX-X" value="{{ old('cnic', $guardian->cnic) }}" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="Please enter a valid CNIC number in format: XXXXX-XXXXXXX-X" />
                                                    <small class="form-text text-muted">Format: XXXXX-XXXXXXX-X</small>
                                                    @error('cnic')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="address">Address</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address">{{ old('address', $guardian->address) }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="password">Password (leave blank to keep current)</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password" />
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="password_confirmation">Confirm Password</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm New Password" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Update</button>
                                            <a href="{{ route('admin.guardians.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Horizontal form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection