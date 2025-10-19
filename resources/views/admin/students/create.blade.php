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
                                                    <label class="col-form-label" for="parent_id">Guardian</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                                        <option value="">-- Select Guardian --</option>
                                                        @foreach(\App\Models\Guardian::with('user')->get() as $g)
                                                            <option value="{{ $g->id }}" {{ old('parent_id') == $g->id ? 'selected' : '' }}>{{ optional($g->user)->name ?? 'Guardian #'.$g->id }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('parent_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">Location</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="number" step="any" id="latitude" class="form-control @error('latitude') is-invalid @enderror" name="latitude" placeholder="Latitude (e.g. 31.5204)" value="{{ old('latitude') }}" />
                                                            @error('latitude')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="number" step="any" id="longitude" class="form-control @error('longitude') is-invalid @enderror" name="longitude" placeholder="Longitude (e.g. 74.3587)" value="{{ old('longitude') }}" />
                                                            @error('longitude')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <button type="button" class="btn btn-outline-secondary" id="btn-pick-location-add">Pick on Map</button>
                                                    </div>
                                                    <small class="text-muted">Optional: Enter coordinates for student's home location or pick on map</small>
                                                </div>
                                            </div>
                                        </div>

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

<!-- Pick Location Modal -->
<div class="modal fade" id="pickLocationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pick Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="pickLocationMap"></div>
                <div class="mt-2 small text-muted">Click on the map to set latitude/longitude.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    #pickLocationMap { width: 100%; height: 380px; }
</style>

<script>
    // Map picking functionality
    var map, marker, target;
    
    function ensureMap() {
        if (typeof L === 'undefined') return false;
        if (!map) {
            map = L.map('pickLocationMap').setView([31.5204, 74.3587], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            map.on('click', function(e) {
                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);
                if (target === 'add') {
                    $('#latitude').val(lat);
                    $('#longitude').val(lng);
                } else if (target === 'edit') {
                    $('#edit-latitude').val(lat);
                    $('#edit-longitude').val(lng);
                }
                if (marker) marker.setLatLng(e.latlng); else marker = L.marker(e.latlng).addTo(map);
            });
        } else {
            setTimeout(function(){ map.invalidateSize(); }, 200);
        }
        return true;
    }

    $('#btn-pick-location-add').on('click', function() {
        target = 'add';
        $('#pickLocationModal').modal('show');
        setTimeout(ensureMap, 250);
    });

    $('#btn-pick-location-edit').on('click', function() {
        target = 'edit';
        $('#pickLocationModal').modal('show');
        setTimeout(function(){
            if (ensureMap()) {
                var lat = parseFloat($('#latitude').val());
                var lng = parseFloat($('#longitude').val());
                if (!isNaN(lat) && !isNaN(lng)) {
                    var ll = L.latLng(lat, lng);
                    if (marker) marker.setLatLng(ll); else marker = L.marker(ll).addTo(map);
                    map.setView(ll, 13);
                }
            }
        }, 250);
    });
</script>
@endsection
