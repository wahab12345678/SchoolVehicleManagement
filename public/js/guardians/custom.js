$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Helper: normalize phone to '92...' format
    function normalizePhone(input) {
        if (!input) return '';
        var digits = input.replace(/\D+/g, '');
        if (!digits) return '';
        // if starts with 0 -> replace leading 0 with 92
        if (digits.charAt(0) === '0') {
            digits = '92' + digits.replace(/^0+/, '');
        }
        // if starts with 00 -> strip leading zeros
        if (digits.startsWith('00')) {
            digits = digits.replace(/^0+/, '');
        }
        // remove leading + if present (already removed by regex)
        return digits;
    }

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

    // Ensure feather icons render for dynamically inserted buttons (feather is used in admin layout)
    // Attempt an initial replace if feather is already available
    if (typeof feather !== 'undefined') {
        try { feather.replace({ width: 14, height: 14 }); } catch (e) { /* ignore */ }
    }

    // Always attach the draw handler; call feather.replace() inside it when available.
    $('#guardians-table').on('draw.dt', function() {
        if (typeof feather !== 'undefined') {
            try { feather.replace({ width: 14, height: 14 }); } catch (e) { /* ignore */ }
        }
    });

    // Search functionality
    $('#search-guardians').on('keyup', function() {
        var table = $('#guardians-table').DataTable();
        table.search(this.value).draw();
    });

    // Filter by city
    $('#filter-city').on('change', function() {
        var table = $('#guardians-table').DataTable();
        table.column(5).search(this.value).draw(); // Address column
    });

    // Filter by status
    $('#filter-status').on('change', function() {
        var table = $('#guardians-table').DataTable();
        // This would need to be implemented based on your status logic
        table.draw();
    });

    // Initialize Select2 for dropdowns
    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
    });

    // Clear filters
    $('#clear-filters').on('click', function() {
        $('#search-guardians').val('');
        $('#filter-city').val('').trigger('change');
        $('#filter-status').val('').trigger('change');
        var table = $('#guardians-table').DataTable();
        table.search('').columns().search('').draw();
    });

    // Add Guardian Form Submit
    $('#addGuardianForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        // basic client-side validation
    var name = $.trim($form.find('#name').val());
    var email = $.trim($form.find('#email').val());
    var phone = $.trim($form.find('#phone').val());
    var password = $form.find('#password').val();
    var passwordConfirm = $form.find('#password_confirmation').val();
    var cnic = $.trim($form.find('#cnic').val());

        // reset validation states
        $form.find('.is-invalid').removeClass('is-invalid');

        // name
        if (!name) {
            $form.find('#name').addClass('is-invalid');
            return;
        }

        if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
            $form.find('#email').addClass('is-invalid');
            return;
        }

        // phone required and pattern: 03xx-xxxxxxx (allow optional hyphen)
        var phonePattern = /^03[0-9]{2}-?[0-9]{7}$/;
        if (!phone || !phonePattern.test(phone)) {
            $form.find('#phone').addClass('is-invalid');
            return;
        }

        // password required on create
        if (!password || password.length < 6) {
            $form.find('#password').addClass('is-invalid');
            return;
        }

        if (password !== passwordConfirm) {
            $form.find('#password_confirmation').addClass('is-invalid');
            return;
        }

        // CNIC required and pattern: 12345-1234567-1
        var cnicPattern = /^[0-9]{5}-[0-9]{7}-[0-9]$/;
        if (!cnic || !cnicPattern.test(cnic)) {
            $form.find('#cnic').addClass('is-invalid');
            return;
        }

    // normalize phone to '92...' form before submit
    var normalizedPhone = normalizePhone(phone);
    $form.find('#phone').val(normalizedPhone);
    var formData = $form.serialize();
        var $submit = $form.find('button[type="submit"]');
        $submit.prop('disabled', true).text('Saving...');

        $.ajax({
            url: '/admin/guardians',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addGuardianModal').modal('hide');
                $('#addGuardianForm')[0].reset();
                table.ajax.reload(null, false);
                toastr.success(response.message || 'Guardian added successfully');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                if (errors) {
                    $.each(errors, function(key, value) {
                        var $field = $form.find('[name="' + key + '"]');
                        if ($field.length) {
                            $field.addClass('is-invalid');
                        }
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('Failed to create guardian.');
                }
            },
            complete: function() {
                $submit.prop('disabled', false).text('Save');
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
        var $form = $(this);
        // basic client-side validation
        $form.find('.is-invalid').removeClass('is-invalid');
    var name = $.trim($form.find('#edit-name').val());
    var email = $.trim($form.find('#edit-email').val());
    var phone = $.trim($form.find('#edit-phone').val());
    var cnic = $.trim($form.find('#edit-cnic').val());

    if (!name) { $form.find('#edit-name').addClass('is-invalid'); return; }
    if (!email || !/^\S+@\S+\.\S+$/.test(email)) { $form.find('#edit-email').addClass('is-invalid'); return; }
    var phonePattern = /^03[0-9]{2}-?[0-9]{7}$/;
    if (!phone || !phonePattern.test(phone)) { $form.find('#edit-phone').addClass('is-invalid'); return; }
    var cnicPattern = /^[0-9]{5}-[0-9]{7}-[0-9]$/;
    if (!cnic || !cnicPattern.test(cnic)) { $form.find('#edit-cnic').addClass('is-invalid'); return; }

    // normalize phone to '92...' form before submit
    var normalizedPhone = normalizePhone(phone);
    $form.find('#edit-phone').val(normalizedPhone);
    var formData = $form.serialize() + '&_method=PUT';
        var $submit = $form.find('button[type="submit"]');
        $submit.prop('disabled', true).text('Saving...');

        $.ajax({
            url: '/admin/guardians/' + id,
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editGuardianModal').modal('hide');
                table.ajax.reload(null, false);
                toastr.success(response.message || 'Guardian updated successfully');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                if (errors) {
                    $.each(errors, function(key, value) {
                        var $field = $form.find('[name="' + key + '"]');
                        if ($field.length) { $field.addClass('is-invalid'); }
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('Error updating guardian');
                }
            },
            complete: function() {
                $submit.prop('disabled', false).text('Save Changes');
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
        var $form = $(this).find('form');
        if ($form.length) {
            $form[0].reset();
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('button[type="submit"]').prop('disabled', false);
            // restore default button text if changed
            $form.find('button[type="submit"]').each(function(){
                var $btn = $(this);
                if ($btn.data('default-text')) {
                    $btn.text($btn.data('default-text'));
                }
            });
        }
    });
});
