@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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
                        <h2 class="content-header-title float-start mb-0">Trip Tracking</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.trips.index') }}">Trips</a></li>
                                <li class="breadcrumb-item active">Track Trip</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Trip Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Student:</strong> {{ $trip->student->name }}</p>
                                        <p><strong>Vehicle:</strong> {{ $trip->vehicle->number_plate ?? 'N/A' }}</p>
                                        <p><strong>Driver:</strong> {{ $trip->vehicle->driver->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Route:</strong> {{ $trip->route->name ?? 'N/A' }}</p>
                                        <p><strong>Status:</strong> 
                                            <span class="badge badge-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($trip->status) }}
                                            </span>
                                        </p>
                                        @if($trip->started_at)
                                        <p><strong>Started:</strong> {{ $trip->started_at->format('M d, Y H:i') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Trip Actions</h4>
                            </div>
                            <div class="card-body">
                                @if($trip->status == 'pending')
                                    <form action="{{ route('admin.trips.start', $trip->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i data-feather="play"></i> Start Trip
                                        </button>
                                    </form>
                                @elseif($trip->status == 'in_progress')
                                    <form action="{{ route('admin.trips.complete', $trip->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i data-feather="stop"></i> Complete Trip
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-secondary btn-block">
                                    <i data-feather="arrow-left"></i> Back to Trips
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Real-time Location Tracking</h4>
                            </div>
                            <div class="card-body">
                                <div id="mapid" style="height: 500px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location History -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Location History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="locations-table">
                                        <thead>
                                            <tr>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Recorded At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($trip->locations as $location)
                                            <tr>
                                                <td>{{ $location->latitude }}</td>
                                                <td>{{ $location->longitude }}</td>
                                                <td>{{ $location->recorded_at->format('M d, Y H:i:s') }}</td>
                                                <td>
                                                    <a href="{{ $location->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i data-feather="map-pin"></i> View on Map
                                                    </a>
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
            </section>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
$(document).ready(function() {
    // Initialize map
    var map = L.map('mapid').setView([31.5204, 74.3587], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add markers for trip locations
    var locations = @json($trip->locations);
    var markers = [];
    
    locations.forEach(function(location, index) {
        var marker = L.marker([location.latitude, location.longitude]).addTo(map);
        marker.bindPopup(`
            <strong>Location ${index + 1}</strong><br>
            Lat: ${location.latitude}<br>
            Lng: ${location.longitude}<br>
            Time: ${new Date(location.recorded_at).toLocaleString()}
        `);
        markers.push(marker);
    });

    // Fit map to show all markers
    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }

    // Auto-refresh for active trips
    @if($trip->status == 'in_progress')
    setInterval(function() {
        $.ajax({
            url: '{{ route("admin.trips.locations", $trip->id) }}',
            method: 'GET',
            success: function(data) {
                // Update location history table
                updateLocationTable(data);
            }
        });
    }, 30000); // Refresh every 30 seconds
    @endif

    function updateLocationTable(locations) {
        var tbody = $('#locations-table tbody');
        tbody.empty();
        
        locations.forEach(function(location) {
            var row = `
                <tr>
                    <td>${location.latitude}</td>
                    <td>${location.longitude}</td>
                    <td>${new Date(location.recorded_at).toLocaleString()}</td>
                    <td>
                        <a href="https://www.google.com/maps?q=${location.latitude},${location.longitude}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i data-feather="map-pin"></i> View on Map
                        </a>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }
});
</script>
@endsection
