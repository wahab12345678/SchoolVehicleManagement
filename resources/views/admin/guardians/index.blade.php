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
                        <h2 class="content-header-title float-start mb-0">Guardians</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Guardians
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGuardianModal">
                        <i data-feather="plus"></i>
                        <span>Add New Guardian</span>
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
                                <h4 class="card-title">Guardians List</h4>
                            </div>
                            <div class="card-body">
                                <!-- Search and Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input type="text" id="search-guardians" class="form-control" placeholder="Search by name or email...">
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
                                    <table id="guardians-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>CNIC</th>
                                                <th>Address</th>
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

<!-- Add Guardian Modal -->
<div class="modal fade" id="addGuardianModal" tabindex="-1" aria-labelledby="addGuardianModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="addGuardianForm" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGuardianModalLabel">Add Guardian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Fill in guardian details. Fields marked with * are required.</p>

                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" aria-describedby="nameHelp" placeholder="Full name" maxlength="255" required />
                        <div class="invalid-feedback" id="nameHelp">Please enter the guardian's name (max 255 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="name@example.com" maxlength="255" required />
                        <div class="invalid-feedback" id="emailHelp">Please enter a valid email address (max 255 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" id="phone" class="form-control" aria-describedby="phoneHelp" placeholder="03xx-xxxxxxx" maxlength="20" inputmode="tel" required pattern="03[0-9]{2}-?[0-9]{7}" />
                        <div class="invalid-feedback" id="phoneHelp">Please provide a valid phone number (e.g. 03xx-xxxxxxx).</div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" aria-describedby="passwordHelp" placeholder="Enter password (min 6 chars)" minlength="6" required />
                            <div class="invalid-feedback" id="passwordHelp">Password must be at least 6 characters.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" aria-describedby="passwordConfirmHelp" placeholder="Confirm password" minlength="6" required />
                            <div class="invalid-feedback" id="passwordConfirmHelp">Passwords do not match.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cnic">CNIC <span class="text-danger">*</span></label>
                        <input type="text" name="cnic" id="cnic" class="form-control" aria-describedby="cnicHelp" placeholder="12345-1234567-1" maxlength="15" inputmode="numeric" pattern="[0-9]{5}-[0-9]{7}-[0-9]" required />
                        <div class="invalid-feedback" id="cnicHelp">Please enter a valid CNIC (e.g. 12345-1234567-1).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" aria-describedby="addressHelp" rows="3" placeholder="Street, City, Country" maxlength="255"></textarea>
                        <div class="invalid-feedback" id="addressHelp">Please provide an address (max 255 characters) or leave blank.</div>
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

<!-- Edit Guardian Modal (fields names match add) -->
<div class="modal fade" id="editGuardianModal" tabindex="-1" aria-labelledby="editGuardianModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="editGuardianForm" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editGuardianModalLabel">Edit Guardian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Update guardian details. Required fields are marked with <span class="text-danger">*</span>.</p>
                    <input type="hidden" name="guardian_id" id="guardian_id" />

                    <div class="mb-3">
                        <label class="form-label" for="edit-name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit-name" class="form-control" placeholder="Full name" maxlength="255" required />
                        <div class="invalid-feedback">Please enter the guardian name (max 255 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit-email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="edit-email" class="form-control" placeholder="name@example.com" maxlength="255" required />
                        <div class="invalid-feedback">Please enter a valid email (max 255 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit-phone">Phone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" id="edit-phone" class="form-control" placeholder="03xx-xxxxxxx" maxlength="20" inputmode="tel" required pattern="03[0-9]{2}-?[0-9]{7}" />
                        <div class="invalid-feedback">Please provide a valid phone number (e.g. 03xx-xxxxxxx).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit-cnic">CNIC <span class="text-danger">*</span></label>
                        <input type="text" name="cnic" id="edit-cnic" class="form-control" placeholder="12345-1234567-1" maxlength="15" inputmode="numeric" pattern="[0-9]{5}-[0-9]{7}-[0-9]" required />
                        <div class="invalid-feedback">Please enter a valid CNIC (e.g. 12345-1234567-1).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit-address">Address</label>
                        <textarea name="address" id="edit-address" class="form-control" rows="3" placeholder="Street, City, Country" maxlength="255"></textarea>
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
        <!-- View modal -->
        <div class="modal fade" id="viewGuardianModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Guardian Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> <span class="guardian-name"></span></p>
                        <p><strong>Email:</strong> <span class="guardian-email"></span></p>
                        <p><strong>CNIC:</strong> <span class="guardian-cnic"></span></p>
                        <p><strong>Address:</strong> <span class="guardian-address"></span></p>
                        <ul class="students-list list-unstyled"></ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                                    <div class="form-check form-switch form-check-success">
                                        <label class="form-check-label mb-50" for="edit-customSwitch">Active</label>
                                        <input type="checkbox" class="form-check-input" id="status" name="status"  />
                                        <label class="form-check-label" for="edit-customSwitch">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                </div> --}}
                                {{-- <div class="mb-1">
                                    <label class="form-label" for="guardian-type">Guardian Type</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected disabled>Select Guardian Type</option>
                                        <option value="1">Active</option>
                                        <option value="O">In Active</option>
                                    </select>
                                </div> --}}
                                <div class="mb-1">
                                    <label class="form-label d-block">Status</label>
                                    <div class="btn-group" role="group" aria-label="Toggle Active/Inactive">
                                        <input type="radio" class="btn-check" name="status" id="active" value="1" checked>
                                        <label class="btn btn-outline-success" for="active">Active</label>

                                        <input type="radio" class="btn-check" name="status" id="inactive" value="0">
                                        <label class="btn btn-outline-danger" for="inactive">Inactive</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary data-submit me-1" >Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

              <!-- Modal -->
              {{-- legacy modal removed; new add/edit modals above are used by JS --}}




            </section>
            <!--/ Basic table -->

        </div>
    </div>
</div>
<!-- END: Content-->
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
    <script src="{{ asset('js/guardians/custom.js') }}"></script>
    <!-- END: Page JS-->
    <script>
        // Setup AJAX CSRF token for all requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $(document).ready(function() {
            // Initialize DataTable only if it hasn't been initialized yet to avoid reinitialisation errors
            if (!$.fn.dataTable.isDataTable('#guardians-table')) {
                $('#guardians-table').DataTable({
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

            // CRUD actions are handled in public/js/guardians/custom.js to avoid duplication
        });
    </script>
@endsection
