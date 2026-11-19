@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Vehicles</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        <span>Add New Vehicle</span>
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
                                <h4 class="card-title">Vehicles List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <select id="filter-type" class="form-select select2">
                                            <option value="">All Types</option>
                                            <option value="van">Van</option>
                                            <option value="bus">Bus</option>
                                            <option value="car">Car</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="filter-availability" class="form-select select2">
                                            <option value="">All Vehicles</option>
                                            <option value="1">Available</option>
                                            <option value="0">In Use</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button id="clear-filters" class="btn btn-outline-secondary">Clear Filters</button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="vehicles-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Number Plate</th>
                                                <th>Model</th>
                                                <th>Type</th>
                                                <th>Driver</th>
                                                <th>Status</th>
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

    // Initialize Select2 for dropdowns
    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
    });

    // Initialize DataTable with AJAX
    $('#vehicles-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/admin/vehicles',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'number_plate' },
            { data: 'model' },
            { data: 'type_badge' },
            { data: 'driver_name' },
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
    $(document).on('click', '.delete-vehicle', function() {
        var vehicleId = $(this).data('id');
        if (confirm('Are you sure you want to delete this vehicle?')) {
            $.ajax({
                url: '/admin/vehicles/' + vehicleId,
                type: 'DELETE',
                success: function(response) {
                    $('#vehicles-table').DataTable().ajax.reload();
                    toastr.success('Vehicle deleted successfully');
                },
                error: function(xhr) {
                    toastr.error('Error deleting vehicle');
                }
            });
        }
    });

    // Filter functionality
    $('#filter-type').on('change', function() {
        var table = $('#vehicles-table').DataTable();
        table.column(3).search(this.value).draw();
    });

    $('#filter-availability').on('change', function() {
        var table = $('#vehicles-table').DataTable();
        if (this.value === '1') {
            table.column(5).search('Available').draw();
        } else if (this.value === '0') {
            table.column(5).search('In Use').draw();
        } else {
            table.column(5).search('').draw();
        }
    });

    $('#clear-filters').on('click', function() {
        $('#filter-type').val('').trigger('change');
        $('#filter-availability').val('').trigger('change');
        var table = $('#vehicles-table').DataTable();
        table.search('').columns().search('').draw();
    });
});
</script>
@endsection
