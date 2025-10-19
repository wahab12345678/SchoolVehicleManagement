@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Track Your Children</h2>
                <p class="text-muted">Monitor your children's transportation in real-time</p>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                @foreach($students as $student)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $student->name }}</h5>
                            <p class="text-muted mb-0">{{ $student->class ?? 'No Class' }} - Roll #{{ $student->roll_number ?? 'N/A' }}</p>
                        </div>
                        <div class="card-body">
                            @if($student->trips->count() > 0)
                                @foreach($student->trips as $trip)
                                <div class="trip-info mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge badge-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($trip->status) }}
                                        </span>
                                        <small class="text-muted">{{ $trip->created_at->format('M d, Y H:i') }}</small>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <p class="mb-1"><strong>Vehicle:</strong> {{ $trip->vehicle->number_plate ?? 'N/A' }}</p>
                                        <p class="mb-1"><strong>Driver:</strong> {{ $trip->vehicle->driver->name ?? 'N/A' }}</p>
                                        <p class="mb-1"><strong>Route:</strong> {{ $trip->route->name ?? 'N/A' }}</p>
                                        
                                        @if($trip->current_location)
                                        <p class="mb-1">
                                            <strong>Last Location:</strong> 
                                            <a href="{{ $trip->current_location->google_maps_url }}" target="_blank" class="text-primary">
                                                {{ $trip->current_location->formatted_location }}
                                            </a>
                                        </p>
                                        <small class="text-muted">
                                            Updated: {{ $trip->current_location->recorded_at->diffForHumans() }}
                                        </small>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-2">
                                        @if($trip->status == 'in_progress')
                                        <a href="{{ route('guardian.trips.map', $trip->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-map-marker-alt"></i> Track on Map
                                        </a>
                                        @endif
                                        
                                        <button class="btn btn-info btn-sm" onclick="getTripDetails({{ $trip->id }})">
                                            <i class="fas fa-info-circle"></i> Details
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-bus fa-3x mb-2"></i>
                                    <p>No active trips for {{ $student->name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Trip Details Modal -->
<div class="modal fade" id="tripDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trip Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="tripDetailsContent">
                <!-- Trip details will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
$(document).ready(function() {
    // Auto-refresh every 30 seconds for active trips
    setInterval(function() {
        refreshActiveTrips();
    }, 30000);
});

function getTripDetails(tripId) {
    $.get('/guardian/trips/' + tripId + '/locations')
        .done(function(data) {
            let content = '<div class="row">';
            content += '<div class="col-12"><h6>Location History</h6></div>';
            
            if (data.length > 0) {
                data.forEach(function(location) {
                    content += '<div class="col-md-6 mb-2">';
                    content += '<div class="card">';
                    content += '<div class="card-body p-2">';
                    content += '<p class="mb-1"><strong>Location:</strong> ' + location.latitude + ', ' + location.longitude + '</p>';
                    content += '<p class="mb-1"><strong>Time:</strong> ' + new Date(location.recorded_at).toLocaleString() + '</p>';
                    content += '<a href="' + location.google_maps_url + '" target="_blank" class="btn btn-sm btn-outline-primary">View on Map</a>';
                    content += '</div></div></div>';
                });
            } else {
                content += '<div class="col-12"><p class="text-muted">No location data available</p></div>';
            }
            
            content += '</div>';
            $('#tripDetailsContent').html(content);
            $('#tripDetailsModal').modal('show');
        })
        .fail(function() {
            alert('Failed to load trip details');
        });
}

function refreshActiveTrips() {
    // This would refresh the page or update specific elements
    // For now, we'll just reload the page
    location.reload();
}
</script>
@endsection
