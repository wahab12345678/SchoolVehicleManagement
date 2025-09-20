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
                        <h2 class="content-header-title float-start mb-0">Guardian</h2>
                        {{-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Datatable</a>
                                </li>
                                <li class="breadcrumb-item active">Basic
                                </li>
                            </ol>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Frontend Visibility</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal to add new record -->
                <div class="modal modal-slide-in fade" id="modals-slide-in">
                    <div class="modal-dialog sidebar-sm">
                        <form id ="store-guardian"class="add-new-record modal-content pt-0"  method="POST" action="{{ route('admin.guardians.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- @method('POST') This simulates a PUT request -->

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel">New Guardian</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                    <label class="form-label" for="basic-icon-default-fullname">Image</label>
                                    <input type="file" class="form-control" id="img_path" name="img_path" accept="image/*"  class="@error('img_path') is-invalid @enderror" required/>
                                    @error('img_path')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="name" placeholder="Enter Name of Guardian" aria-label="John Doe"  class="@error('name') is-invalid @enderror" required />
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="basic-icon-default-post">Description</label>
                                    <textarea class="form-control dt-description" id="exampleFormControlTextarea1" name="description" rows="3" placeholder="Enter Description" class="@error('description') is-invalid @enderror" required></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="basic-icon-default-post">Key Point</label>
                                    <textarea class="form-control dt-description" id="exampleFormControlTextarea1" name="key_points" rows="3" placeholder="Enter key Point"  class="@error('key_points') is-invalid @enderror" required></textarea>
                                      @error('key_points')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
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
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/guardian/custom.js"></script>
    <!-- END: Page JS-->
@endsection
