@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
<div class="app-content content ">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Students</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        <span>Add New Student</span>
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
                                <h4 class="card-title">Students List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Search and Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input type="text" id="search-name" class="form-control" placeholder="Search by name...">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-class" class="form-select select2">
                                            <option value="">All Classes</option>
                                            @foreach($students->pluck('class')->unique()->filter() as $class)
                                                <option value="{{ $class }}">{{ $class }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-guardian" class="form-select select2">
                                            <option value="">All Guardians</option>
                                            @foreach($guardians as $guardian)
                                                <option value="{{ optional($guardian->user)->name }}">{{ optional($guardian->user)->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="clear-filters" class="btn btn-outline-secondary">Clear Filters</button>
                                    </div>
                                </div>

                                <!-- Bulk Actions -->
                                <div class="row mb-3" id="bulk-actions" style="display: none;">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <span id="selected-count" class="me-3"></span>
                                            <button type="button" id="bulk-delete" class="btn btn-danger btn-sm me-2">Delete Selected</button>
                                            <button type="button" id="bulk-export" class="btn btn-success btn-sm">Export Selected</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="students-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="select-all" class="form-check-input">
                                                </th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Roll Number</th>
                                                <th>Class</th>
                                                <th>Guardian</th>
                                                <th>Location</th>
                                                <th>Trip Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/students/custom.js') }}"></script>

    <script>
        // Setup AJAX CSRF token for all requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize DataTable if it hasn't been initialized yet to avoid reinitialisation errors
        $(document).ready(function() {
            if (!$.fn.dataTable.isDataTable('#students-table')) {
                $('#students-table').DataTable({
                    responsive: true,
                    lengthMenu: [10, 25, 50, 75, 100],
                    language: {
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });
            }

            // CRUD actions are handled in public/js/students/custom.js
        });
    </script>
@endsection
