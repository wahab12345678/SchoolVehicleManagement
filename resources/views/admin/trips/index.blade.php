@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Trips</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        <span>Add New Trip</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Trips List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <select id="filter-status" class="form-select select2">
                                            <option value="">All Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-student" class="form-select select2">
                                            <option value="">All Students</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-vehicle" class="form-select select2">
                                            <option value="">All Vehicles</option>
                                            @foreach($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->number_plate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button id="clear-filters" class="btn btn-outline-secondary">Clear Filters</button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="trips-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Student</th>
                                                <th>School</th>
                                                <th>Vehicle</th>
                                                <th>Driver</th>
                                                <th>Route</th>
                                                <th>Status</th>
                                                <th>Started</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($trips as $trip)
                                            <tr>
                                                <td>{{ $trip->id }}</td>
                                                <td>{{ $trip->student->name }}</td>
                                                <td>{{ $trip->school->name ?? 'N/A' }}</td>
                                                <td>{{ $trip->vehicle->number_plate ?? 'N/A' }}</td>
                                                <td>{{ $trip->vehicle->driver->name ?? 'N/A' }}</td>
                                                <td>{{ $trip->route->name ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $trip->status == 'completed' ? 'success' : ($trip->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($trip->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $trip->started_at ? $trip->started_at->format('M d, Y H:i') : 'Not started' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-info btn-sm me-1" title="View" aria-label="View trip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </a>
                                                    <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit trip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                                    </a>
                                                    @if($trip->status == 'pending')
                                                        <form action="{{ route('admin.trips.start', $trip->id) }}" method="POST" class="d-inline me-1">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm" title="Start Trip" aria-label="Start trip">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5,3 19,12 5,21"/></svg>
                                                            </button>
                                                        </form>
                                                    @elseif($trip->status == 'in_progress')
                                                        <form action="{{ route('admin.trips.complete', $trip->id) }}" method="POST" class="d-inline me-1">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm" title="Complete Trip" aria-label="Complete trip">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('admin.trips.track', $trip->id) }}" class="btn btn-info btn-sm me-1" title="Track" aria-label="Track trip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                                    </a>
                                                    <button data-id="{{ $trip->id }}" class="btn btn-danger btn-sm delete-trip" title="Delete" aria-label="Delete trip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                                    </button>
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
<script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for dropdowns
    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
    });

    $('#trips-table').DataTable({
        responsive: true,
        lengthMenu: [10, 25, 50, 75, 100],
        language: {
            paginate: {
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        }
    });

    // Filter functionality
    $('#filter-status').on('change', function() {
        var table = $('#trips-table').DataTable();
        table.column(5).search(this.value).draw();
    });

    $('#filter-student').on('change', function() {
        var table = $('#trips-table').DataTable();
        table.column(1).search(this.value).draw();
    });

    $('#filter-vehicle').on('change', function() {
        var table = $('#trips-table').DataTable();
        table.column(2).search(this.value).draw();
    });

    $('#clear-filters').on('click', function() {
        $('#filter-status').val('').trigger('change');
        $('#filter-student').val('').trigger('change');
        $('#filter-vehicle').val('').trigger('change');
        var table = $('#trips-table').DataTable();
        table.search('').columns().search('').draw();
    });

    // Handle delete button clicks
    $(document).on('click', '.delete-trip', function() {
        var tripId = $(this).data('id');
        if (confirm('Are you sure you want to delete this trip?')) {
            $.ajax({
                url: '/admin/trips/' + tripId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting trip');
                }
            });
        }
    });
});
</script>
@endsection
