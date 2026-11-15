@extends('admin.includes.main')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
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
                        <h2 class="content-header-title float-start mb-0">Schools</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Schools
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                        <i data-feather="plus"></i>
                        <span>Add New School</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div id="alert-container">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Schools List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="schools-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Coordinates</th>
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
<!-- END: Content-->

<!-- Add School Modal -->
<div class="modal fade" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addSchoolForm" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSchoolModalLabel">Add School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Fill in school details. Fields marked with * are required.</p>

                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="School name" maxlength="255" required />
                        <div class="invalid-feedback">Please enter the school name.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="03xx-xxxxxxx" maxlength="20" />
                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="3" placeholder="Street, City, Country" maxlength="255"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="latitude">Latitude</label>
                                <input type="number" step="any" name="latitude" id="latitude" class="form-control" placeholder="e.g., 24.860966" />
                                <div class="invalid-feedback">Latitude must be between -90 and 90.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="longitude">Longitude</label>
                                <input type="number" step="any" name="longitude" id="longitude" class="form-control" placeholder="e.g., 67.001137" />
                                <div class="invalid-feedback">Longitude must be between -180 and 180.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-default-text="Save">Save</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit School Modal -->
<div class="modal fade" id="editSchoolModal" tabindex="-1" aria-labelledby="editSchoolModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="editSchoolForm" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSchoolModalLabel">Edit School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Update school details. Required fields are marked with <span class="text-danger">*</span>.</p>
                    <input type="hidden" name="school_id" id="school_id" />

                    <div class="mb-3">
                        <label class="form-label" for="edit-name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit-name" class="form-control" placeholder="School name" maxlength="255" required />
                        <div class="invalid-feedback">Please enter the school name.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit-phone">Phone</label>
                        <input type="tel" name="phone" id="edit-phone" class="form-control" placeholder="03xx-xxxxxxx" maxlength="20" />
                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit-address">Address</label>
                        <textarea name="address" id="edit-address" class="form-control" rows="3" placeholder="Street, City, Country" maxlength="255"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="edit-latitude">Latitude</label>
                                <input type="number" step="any" name="latitude" id="edit-latitude" class="form-control" placeholder="e.g., 24.860966" />
                                <div class="invalid-feedback">Latitude must be between -90 and 90.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="edit-longitude">Longitude</label>
                                <input type="number" step="any" name="longitude" id="edit-longitude" class="form-control" placeholder="e.g., 67.001137" />
                                <div class="invalid-feedback">Longitude must be between -180 and 180.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-default-text="Save Changes">Save Changes</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View School Modal -->
<div class="modal fade" id="viewSchoolModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">School Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span class="school-name"></span></p>
                <p><strong>Phone:</strong> <span class="school-phone"></span></p>
                <p><strong>Address:</strong> <span class="school-address"></span></p>
                <p><strong>Latitude:</strong> <span class="school-latitude"></span></p>
                <p><strong>Longitude:</strong> <span class="school-longitude"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('js/schools/custom.js') }}"></script>
    <!-- END: Page JS-->
    <script>
        // Setup AJAX CSRF token for all requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Initialize DataTable only if it hasn't been initialized yet
            if (!$.fn.dataTable.isDataTable('#schools-table')) {
                $('#schools-table').DataTable({
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
        });
    </script>
@endsection