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
                <h2 class="content-header-title">Routes</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        <span>Add New Route</span>
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
                                <h4 class="card-title">Routes List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Search Control -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" id="search-routes" class="form-control" placeholder="Search routes...">
                                    </div>
                                    <div class="col-md-6">
                                        <button id="clear-search" class="btn btn-outline-secondary">Clear</button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="routes-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Total Trips</th>
                                                <th>Active Trips</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($routes as $route)
                                            <tr>
                                                <td>{{ $route->id }}</td>
                                                <td>{{ $route->name }}</td>
                                                <td>{{ $route->description ?? 'No description' }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $route->trips_count }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">{{ $route->active_trips_count }}</span>
                                                </td>
                                                <td>
                                                    @if($route->active_trips_count > 0)
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($route->trips_count > 0)
                                                        <span class="badge bg-info">Inactive</span>
                                                    @else
                                                        <span class="badge bg-secondary">No Trips</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.routes.show', $route->id) }}" class="btn btn-info btn-sm me-1" title="View" aria-label="View route">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </a>
                                                    <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-primary btn-sm me-1" title="Edit" aria-label="Edit route">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                                    </a>
                                                    <button data-id="{{ $route->id }}" class="btn btn-danger btn-sm delete-route" title="Delete" aria-label="Delete route">
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
    $('#routes-table').DataTable({
        responsive: true,
        lengthMenu: [10, 25, 50, 75, 100],
        language: {
            paginate: {
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        }
    });

    // Search functionality
    $('#search-routes').on('keyup', function() {
        var table = $('#routes-table').DataTable();
        table.column(1).search(this.value).draw();
    });

    $('#clear-search').on('click', function() {
        $('#search-routes').val('');
        var table = $('#routes-table').DataTable();
        table.search('').columns().search('').draw();
    });

    // Handle delete button clicks
    $(document).on('click', '.delete-route', function() {
        var routeId = $(this).data('id');
        if (confirm('Are you sure you want to delete this route?')) {
            $.ajax({
                url: '/admin/routes/' + routeId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting route');
                }
            });
        }
    });
});
</script>
@endsection
