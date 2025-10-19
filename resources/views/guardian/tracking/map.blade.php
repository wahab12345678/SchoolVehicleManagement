@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map { height: 500px; }
    .trip-info { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
    .status-badge { font-size: 0.9em; }
</style>
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Track {{ $trip->student->name }}</h2>
                <p class="text-muted">Real-time location tracking</p>
            </div>
            <div class="content-header-right col-md-3 col-12">
                <a href="{{ route('guardian.tracking.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Tracking
                </a>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="trip-info">
                        <h5 class="mb-3">Trip Information</h5>
                        
                        <div class="mb-2">
                            <strong>Student:</strong> {{ $trip->student->name }}
                        </div>
                        
                        <div class="mb-2">
                            <strong>Status:</strong> 
                            <span class="badge status-badge badge-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($trip->status) }}
                            </span>
                        </div>
                        
                        <div class="mb-2">
                            <strong>Vehicle:</strong> {{ $trip->vehicle->number_plate ?? 'N/A' }}
                        </div>
                        
                        <div class="mb-2">
                            <strong>Driver:</strong> {{ $trip->vehicle->driver->name ?? 'N/A' }}
                        </div>
                        
                        <div class="mb-2">
                            <strong>Route:</strong> {{ $trip->route->name ?? 'N/A' }}
                        </div>
                        
                        @if($trip->started_at)
                        <div class="mb-2">
                            <strong>Started:</strong> {{ $trip->started_at->format('M d, Y H:i') }}
                        </div>
                        @endif
                        
                        @if($trip->ended_at)
                        <div class="mb-2">
                            <strong>Completed:</strong> {{ $trip->ended_at->format('M d, Y H:i') }}
                        </div>
                        @endif
                        
                        <div class="mt-3">
                            <button id="refreshLocation" class="btn btn-primary btn-sm">
                                <i class="fas fa-sync-alt"></i> Refresh Location
                            </button>
                            <button id="centerMap" class="btn btn-info btn-sm">
                                <i class="fas fa-crosshairs"></i> Center Map
                            </button>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Recent Locations</h6>
                        </div>
                        <div class="card-body" id="recentLocations" style="max-height: 300px; overflow-y: auto;">
                            <!-- Recent locations will be loaded here -->
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Live Map</h6>
                        </div>
                        <div class="card-body p-0">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
let map;
let markers = [];
let routeLine;

$(document).ready(function() {
    initializeMap();
    loadTripData();
    
    // Auto-refresh every 30 seconds
    setInterval(loadTripData, 30000);
    
    $('#refreshLocation').click(function() {
        loadTripData();
    });
    
    $('#centerMap').click(function() {
        if (markers.length > 0) {
            map.setView(markers[markers.length - 1].getLatLng(), 15);
        }
    });
});

function initializeMap() {
    // Initialize map centered on first location or default location
    const defaultLat = {{ $trip->locations->first()->latitude ?? 31.5204 }};
    const defaultLng = {{ $trip->locations->first()->longitude ?? 74.3587 }};
    
    map = L.map('map').setView([defaultLat, defaultLng], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
}

function loadTripData() {
    $.get('/guardian/trips/{{ $trip->id }}/realtime')
        .done(function(data) {
            updateMap(data);
            updateRecentLocations(data.current_location);
        })
        .fail(function() {
            console.error('Failed to load trip data');
        });
}

function updateMap(data) {
    // Clear existing markers
    markers.forEach(marker => map.removeLayer(marker));
    markers = [];
    
    if (data.current_location) {
        const lat = parseFloat(data.current_location.latitude);
        const lng = parseFloat(data.current_location.longitude);
        
        // Add current location marker
        const currentMarker = L.marker([lat, lng], {
            icon: L.divIcon({
                className: 'current-location-marker',
                html: '<div style="background: #ff0000; width: 20px; height: 20px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            })
        }).addTo(map);
        
        currentMarker.bindPopup(`
            <strong>Current Location</strong><br>
            ${data.current_location.latitude}, ${data.current_location.longitude}<br>
            <small>Updated: ${new Date(data.current_location.recorded_at).toLocaleString()}</small>
        `);
        
        markers.push(currentMarker);
        
        // Center map on current location
        map.setView([lat, lng], 15);
    }
}

function updateRecentLocations(currentLocation) {
    if (!currentLocation) return;
    
    const locationHtml = `
        <div class="location-item mb-2 p-2 border rounded">
            <div class="d-flex justify-content-between">
                <strong>Current Location</strong>
                <small class="text-muted">${new Date(currentLocation.recorded_at).toLocaleTimeString()}</small>
            </div>
            <div class="mt-1">
                <small>${currentLocation.latitude}, ${currentLocation.longitude}</small>
            </div>
            <div class="mt-1">
                <a href="${currentLocation.google_maps_url}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-external-link-alt"></i> View on Google Maps
                </a>
            </div>
        </div>
    `;
    
    $('#recentLocations').prepend(locationHtml);
    
    // Keep only last 10 locations
    const items = $('#recentLocations .location-item');
    if (items.length > 10) {
        items.slice(10).remove();
    }
}
</script>
@endsection
