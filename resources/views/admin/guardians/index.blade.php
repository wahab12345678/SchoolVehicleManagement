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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
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
<div class="modal fade" id="addGuardianModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addGuardianForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Guardian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Password (optional)</label>
                        <input type="password" name="password" id="password" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">CNIC</label>
                        <input type="text" name="cnic" id="cnic" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Guardian Modal (fields names match add) -->
<div class="modal fade" id="editGuardianModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editGuardianForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Guardian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="guardian_id" id="guardian_id" />
                    <div class="mb-1">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" id="edit-phone" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">CNIC</label>
                        <input type="text" name="cnic" id="edit-cnic" class="form-control" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Address</label>
                        <textarea name="address" id="edit-address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
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
              <div class="modal modal-slide-in fade" id="modals-slide-in-edit">
                <div class="modal-dialog sidebar-sm">
                    <form id="update-guardian" class="edit-record modal-content pt-0" method="POST" action="{{ route('admin.guardians.store') }}" enctype="multipart/form-data">
                        @csrf

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Guardian</h5>
                        </div>
                        <input type="hidden" name="status" value="0">

                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Image</label>
                                <input type="file" class="form-control" id="img_path" name="img_path" accept="image/*" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="edit-guardian-name">Name</label>
                                <input type="text" class="form-control dt-full-name" id="edit-guardian-name" name="name" placeholder="Enter Name of Guardian" aria-label="Guardian Name" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="edit-guardian-description">Description</label>
                                <textarea class="form-control" id="edit-guardian-description" name="description" rows="3" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-post">Key Point</label>
                                <textarea class="form-control dt-description" id="edit-key-point" name="key_points" rows="3" placeholder="Enter key Point"></textarea>
                            </div>
                            {{-- <div class="mb-1">
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
                                <label class="form-label d-block">Status</label>
                                <div class="btn-group" role="group" aria-label="Toggle Active/Inactive">
                                    <input type="radio" class="btn-check" name="status" id="active" value="1" >
                                    <label class="btn btn-outline-success" for="active">Active</label>

                                    <input type="radio" class="btn-check" name="status" id="inactive" value="0">
                                    <label class="btn btn-outline-danger" for="inactive">Inactive</label>
                                </div>
                            </div> --}}
                            <input type="hidden" class="form-control dt-full-name" id="edit-guardian-id" name="guardian_id" placeholder="Enter Name of Guardian" aria-label="Guardian Name" />
                            <button type="submit" class="btn btn-primary data-submit me-1" id="update-guardian">Save Changes</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>




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

            // Handle Edit Guardian Button Click (use event delegation in case rows are loaded dynamically)
            $(document).on('click', '.edit-guardian', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const phone = $(this).data('phone');
                const cnic = $(this).data('cnic');
                const address = $(this).data('address');

                $('#edit-guardian-name').val(name);
                $('#edit-guardian-id').val(id);
                // Set other fields as needed
            });

            // Handle View Guardian Button Click (delegate to document for dynamically added rows)
            $(document).on('click', '.view-guardian', function() {
                const id = $(this).data('id');

                // Fetch guardian details
                $.ajax({
                    url: `/admin/guardians/${id}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Display guardian details in a modal
                        console.log(response);
                        // Populate modal with guardian data
                    },
                    error: function() {
                        $('#alert-container').html('<div class="alert alert-danger">Error loading guardian details</div>');
                    }
                });
            });

            // Handle Delete Guardian Button Click (delegate to document for dynamically added rows)
            $(document).on('click', '.delete-guardian', function() {
                const id = $(this).data('id');

                if (confirm('Are you sure you want to delete this guardian?')) {
                    $.ajax({
                        url: `/admin/guardians/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#guardian-row-' + id).fadeOut(function() {
                                $(this).remove();
                            });

                            $('#alert-container').html(`
                                <div class="alert alert-success">
                                    Guardian deleted successfully
                                </div>
                            `);

                            // Auto-hide alert after 3 seconds
                            setTimeout(function() {
                                $('#alert-container .alert').fadeOut();
                            }, 3000);
                        },
                        error: function() {
                            $('#alert-container').html(`
                                <div class="alert alert-danger">
                                    Error deleting guardian
                                </div>
                            `);
                        }
                    });
                }
            });
        });
    </script>
@endsection
