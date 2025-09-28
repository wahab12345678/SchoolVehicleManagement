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
<div class="app-content content ">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h2 class="content-header-title">Students</h2>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                <div class="mb-1 breadcrumb-right">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i data-feather="plus"></i>
                        <span>Add New Student</span>
                    </button>
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
                                <div class="table-responsive">
                                    <table id="students-table" class="table table-striped datatables-basic">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Roll #</th>
                                                <th>Class</th>
                                                <th>Guardian</th>
                                                <th>Actions</th>
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

<!-- Add Student Modal (basic fields) -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addStudentForm">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Add Student</h5></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input id="add-name" name="name" class="form-control" placeholder="Full name" maxlength="255" required />
                        <div class="invalid-feedback">Please enter the student's name (max 255 characters).</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Roll Number</label>
                        <input id="add-roll-number" name="roll_number" class="form-control" placeholder="Roll number (optional)" maxlength="50" />
                        <div class="invalid-feedback">Please enter a valid roll number (max 50 characters) or leave blank.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Class</label>
                        <input id="add-class" name="class" class="form-control" placeholder="Class (optional)" maxlength="50" />
                        <div class="invalid-feedback">Please enter a class name (max 50 characters) or leave blank.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Guardian</label>
                        <select id="add-parent-id" name="parent_id" class="form-select" aria-describedby="guardianHelp">
                            <option value="">-- Select Guardian --</option>
                            @foreach(\App\Models\Guardian::with('user')->get() as $g)
                                <option value="{{ $g->id }}">{{ optional($g->user)->name ?? 'Guardian #'.$g->id }}</option>
                            @endforeach
                        </select>
                        <div id="guardianHelp" class="invalid-feedback">Please select a guardian if applicable.</div>
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
        // Setup AJAX CSRF token for all requests (guardians page does the same)
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

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editStudentForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="student_id" id="student_id" />
                <div class="modal-header"><h5 class="modal-title">Edit Student</h5></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" id="edit-name" class="form-control" placeholder="Full name" maxlength="255" required />
                        <div class="invalid-feedback">Please enter the student's name (max 255 characters).</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Roll Number</label>
                        <input name="roll_number" id="edit-roll-number" class="form-control" placeholder="Roll number (optional)" maxlength="50" />
                        <div class="invalid-feedback">Please enter a valid roll number (max 50 characters) or leave blank.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Class</label>
                        <input name="class" id="edit-class" class="form-control" placeholder="Class (optional)" maxlength="50" />
                        <div class="invalid-feedback">Please enter a class name (max 50 characters) or leave blank.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Guardian</label>
                        <select name="parent_id" id="edit-parent-id" class="form-select" aria-describedby="editGuardianHelp">
                            <option value="">-- Select Guardian --</option>
                            @foreach(\App\Models\Guardian::with('user')->get() as $g)
                                <option value="{{ $g->id }}">{{ optional($g->user)->name ?? 'Guardian #'.$g->id }}</option>
                            @endforeach
                        </select>
                        <div id="editGuardianHelp" class="invalid-feedback">Please select a guardian if applicable.</div>
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

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span class="student-name"></span></p>
                <p><strong>Roll #:</strong> <span class="student-roll"></span></p>
                <p><strong>Class:</strong> <span class="student-class"></span></p>
                <p><strong>Guardian:</strong> <span class="student-guardian"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
