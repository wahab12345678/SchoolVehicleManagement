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
                <h2 class="content-header-title">Drivers</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        <span>Add New Driver</span>
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
                                <h4 class="card-title">Drivers List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Search Control -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" id="search-drivers" class="form-control" placeholder="Search drivers by name or email...">
                                    </div>
                                    <div class="col-md-6">
                                        <button id="clear-search" class="btn btn-outline-secondary">Clear</button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="drivers-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Assigned Vehicles</th>
                                                <th>Active Trips</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DataTable will populate this section via AJAX -->
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
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize DataTable with AJAX
    $('#drivers-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/admin/drivers',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'vehicles_badge' },
            { data: 'status_badge' },
            { data: 'action', orderable: false, searchable: false }
        ],
        responsive: true,
        lengthMenu: [10, 25, 50, 75, 100],
        language: {
            paginate: {
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        }
    });

    // Handle delete button clicks
    $(document).on('click', '.delete-driver', function() {
        var driverId = $(this).data('id');
        if (confirm('Are you sure you want to delete this driver?')) {
            $.ajax({
                url: '/admin/drivers/' + driverId,
                type: 'DELETE',
                success: function(response) {
                    $('#drivers-table').DataTable().ajax.reload();
                    toastr.success('Driver deleted successfully');
                },
                error: function(xhr) {
                    toastr.error('Error deleting driver');
                }
            });
        }
    });

    // Search functionality
    $('#search-drivers').on('keyup', function() {
        var table = $('#drivers-table').DataTable();
        table.search(this.value).draw();
    });

    $('#clear-search').on('click', function() {
        $('#search-drivers').val('');
        var table = $('#drivers-table').DataTable();
        table.search('').draw();
    });
});
</script>
@endsection
