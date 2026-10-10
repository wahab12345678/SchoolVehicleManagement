@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
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
                        <h2 class="content-header-title float-start mb-0">Add Student</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a>
                                </li>
                                <li class="breadcrumb-item active">Add Student
                                </li>
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
                                <h4 class="card-title">Student Information</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.students.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="name">Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required />
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="roll_number">Roll Number</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="roll_number" class="form-control @error('roll_number') is-invalid @enderror" name="roll_number" placeholder="Roll Number" value="{{ old('roll_number') }}" />
                                                    @error('roll_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="registration_no">Registration Number</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="registration_no" class="form-control @error('registration_no') is-invalid @enderror" name="registration_no" placeholder="Registration Number" value="{{ old('registration_no') }}" />
                                                    @error('registration_no')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="class">Class</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="class" class="form-control @error('class') is-invalid @enderror" name="class" placeholder="Class" value="{{ old('class') }}" />
                                                    @error('class')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="school_id">School</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="school_id" name="school_id" class="form-select @error('school_id') is-invalid @enderror">
                                                        <option value="">-- Select School --</option>
                                                        @if(isset($schools))
                                                            @foreach($schools as $school)
                                                                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('school_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="parent_id">Guardian</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                                        <option value="">-- Select Guardian --</option>
                                                        @if(isset($guardians))
                                                            @foreach($guardians as $g)
                                                                <option value="{{ $g->id }}" {{ old('parent_id') == $g->id ? 'selected' : '' }}>{{ optional($g->user)->name ?? 'Guardian #'.$g->id }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('parent_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        @include('admin.partials.gps-location-picker', [
                                            'title' => 'Student Home Location',
                                            'latitude' => old('latitude'),
                                            'longitude' => old('longitude'),
                                        ])

                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
<!-- END: Content-->

@endsection

@section('footer')
@include('admin.partials.gps-location-picker-scripts')
@endsection
