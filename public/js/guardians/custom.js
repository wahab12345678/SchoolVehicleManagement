$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize DataTable if not already initialized. If it exists, reuse the instance.
    var table;
    if ($.fn.dataTable.isDataTable('#guardians-table')) {
        table = $('#guardians-table').DataTable();
    } else {
        // Use client-side DataTable: controller returns full dataset under { data: [...] }
        table = $('#guardians-table').DataTable({
            processing: true,
            ajax: {
                url: '/admin/guardians',
                dataSrc: 'data'
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                { data: 'cnic' },
                { data: 'address' },
                { data: 'action', orderable: false, searchable: false }
            ],
            responsive: true,
            lengthMenu: [10, 25, 50, 75, 100]
        });
    }

    // Add Guardian Form Submit
    $('#addGuardianForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '/admin/guardians',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addGuardianModal').modal('hide');
                $('#addGuardianForm')[0].reset();
                table.ajax.reload();
                toastr.success('Guardian added successfully');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    toastr.error(value[0]);
                });
            }
        });
    });

    // Edit Guardian - Load Data
    $(document).on('click', '.edit-guardian', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/admin/guardians/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#editGuardianForm #guardian_id').val(response.id);
                $('#edit-name').val(response.user.name);
                $('#edit-email').val(response.user.email);
                $('#edit-phone').val(response.user.phone || '');
                $('#edit-cnic').val(response.cnic || '');
                $('#edit-address').val(response.address || '');
                $('#editGuardianModal').modal('show');
            },
            error: function(xhr) {
                toastr.error('Error loading guardian data');
            }
        });
    });

    // Update Guardian Form Submit
    $('#editGuardianForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editGuardianForm #guardian_id').val();
        var formData = $(this).serialize();

        $.ajax({
            url: '/admin/guardians/' + id,
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function(response) {
                $('#editGuardianModal').modal('hide');
                table.ajax.reload();
                toastr.success('Guardian updated successfully');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                if (errors) {
                    $.each(errors, function(key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('Error updating guardian');
                }
            }
        });
    });

    // View Guardian Details
    $(document).on('click', '.view-guardian', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/admin/guardians/' + id,
            type: 'GET',
            success: function(response) {
                $('#viewGuardianModal .guardian-name').text(response.user.name);
                $('#viewGuardianModal .guardian-email').text(response.user.email);
                $('#viewGuardianModal .guardian-cnic').text(response.cnic || 'N/A');
                $('#viewGuardianModal .guardian-address').text(response.address || 'N/A');

                // Display students if any
                var studentsList = $('#viewGuardianModal .students-list');
                studentsList.empty();

                if (response.students && response.students.length > 0) {
                    $.each(response.students, function(index, student) {
                        studentsList.append('<li>' + student.name + ' (' + student.registration_no + ')</li>');
                    });
                } else {
                    studentsList.append('<li>No students assigned</li>');
                }

                $('#viewGuardianModal').modal('show');
            },
            error: function(xhr) {
                toastr.error('Error loading guardian details');
            }
        });
    });

    // Delete Guardian
    $(document).on('click', '.delete-guardian', function() {
        var id = $(this).data('id');

        if (confirm('Are you sure you want to delete this guardian?')) {
            $.ajax({
                url: '/admin/guardians/' + id,
                type: 'DELETE',
                success: function(response) {
                    table.ajax.reload();
                    toastr.success('Guardian deleted successfully');
                },
                error: function(xhr) {
                    toastr.error('Error deleting guardian');
                }
            });
        }
    });

    // Reset forms when modals are closed
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
    });
});
