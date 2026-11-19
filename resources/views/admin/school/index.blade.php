@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
@endsection

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Schools</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.school.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        <span>Add New School</span>
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
                                <h4 class="card-title">Schools List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Search and Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input type="text" id="search-schools" class="form-control" placeholder="Search by name or email...">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-city" class="form-select select2">
                                            <option value="">All Cities</option>
                                            <option value="Karachi">Karachi</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Islamabad">Islamabad</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-status" class="form-select select2">
                                            <option value="">All Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="clear-filters" class="btn btn-outline-secondary">Clear</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="schools-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>School Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Students</th>
                                                <th>Vehicles</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($schools) && $schools->count() > 0)
                                                @foreach($schools as $school)
                                                <tr>
                                                    <td>{{ $school->id }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($school->logo)
                                                            <div class="avatar me-2">
                                                                <img src="{{ asset('storage/' . $school->logo) }}" alt="Logo" class="rounded" width="32" height="32" onerror="this.style.display='none'">
                                                            </div>
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-0">{{ $school->name }}</h6>
                                                                @if($school->website)
                                                                <small class="text-muted">
                                                                    <a href="{{ $school->website }}" target="_blank" class="text-primary">{{ $school->website }}</a>
                                                                </small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $school->email }}</td>
                                                    <td>{{ $school->phone }}</td>
                                                    <td>{{ $school->city }}, {{ $school->state }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $school->students->count() }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success">{{ $school->vehicles->count() }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $school->is_active ? 'success' : 'secondary' }}">
                                                            {{ $school->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.school.show', $school->id) }}" class="btn btn-info btn-sm me-1" title="View" aria-label="View school">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                                        </a>
                                                        <a href="{{ route('admin.school.edit', $school->id) }}" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit school">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                                        </a>
                                                        <button data-id="{{ $school->id }}" class="btn btn-danger btn-sm delete-school" title="Delete" aria-label="Delete school">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <!-- DataTable will populate this section via AJAX -->
                                            @endif
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

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize Select2 for dropdowns
    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
    });

    // Initialize DataTable
    var table = $('#schools-table').DataTable({
        processing: true,
        serverSide: false,
        @if(isset($schools) && $schools->count() > 0)
        // Use existing data if available
        data: [],
        @else
        // Use AJAX if no data available
        ajax: {
            url: '/admin/school',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'city' },
            { data: 'students_badge' },
            { data: 'vehicles_badge' },
            { data: 'status_badge' },
            { data: 'action', orderable: false, searchable: false }
        ],
        @endif
        responsive: true,
        pageLength: 10,
        order: [[1, 'asc']]
    });

    // Search functionality
    $('#search-schools').on('keyup', function() {
        var table = $('#schools-table').DataTable();
        table.search(this.value).draw();
    });

    // Filter by city
    $('#filter-city').on('change', function() {
        var table = $('#schools-table').DataTable();
        table.column(4).search(this.value).draw(); // City column
    });

    // Filter by status
    $('#filter-status').on('change', function() {
        var table = $('#schools-table').DataTable();
        table.column(7).search(this.value).draw(); // Status column
    });

    // Clear filters
    $('#clear-filters').on('click', function() {
        $('#search-schools').val('');
        $('#filter-city').val('').trigger('change');
        $('#filter-status').val('').trigger('change');
        var table = $('#schools-table').DataTable();
        table.search('').columns().search('').draw();
    });

    // Handle delete button clicks
    $(document).on('click', '.delete-school', function() {
        var schoolId = $(this).data('id');
        if (confirm('Are you sure you want to delete this school? This action cannot be undone.')) {
            $.ajax({
                url: '/admin/school/' + schoolId,
                type: 'DELETE',
                success: function(response) {
                    // Reload the page to refresh the data
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting school');
                }
            });
        }
    });
});
</script>
@endsection