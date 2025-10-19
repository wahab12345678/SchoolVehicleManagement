$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize DataTable if not already initialized
    var table;
    if ($.fn.dataTable.isDataTable('#schools-table')) {
        table = $('#schools-table').DataTable();
    } else {
        table = $('#schools-table').DataTable({
            processing: true,
            ajax: {
                url: '/admin/schools',
                dataSrc: 'data'
            },
            columns: [
                { data: 'schools_id' },
                { data: 'name' },
                { data: 'phone' },
                { data: 'address' },
                { data: 'coordinates' },
                { data: 'action', orderable: false, searchable: false }
            ],
            responsive: true,
            lengthMenu: [10, 25, 50, 75, 100]
        });
    }

    // Ensure feather icons render for dynamically inserted buttons
    if (typeof feather !== 'undefined') {
        try { feather.replace({ width: 14, height: 14 }); } catch (e) { /* ignore */ }
    }

    $('#schools-table').on('draw.dt', function() {
        if (typeof feather !== 'undefined') {
            try { feather.replace({ width: 14, height: 14 }); } catch (e) { /* ignore */ }
        }
    });

    // Add School Form Submit
    $('#addSchoolForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        
        // Reset validation states
        $form.find('.is-invalid').removeClass('is-invalid');

        // Basic validation
        var name = $.trim($form.find('#name').val());
        var latitude = $form.find('#latitude').val();
        var longitude = $form.find('#longitude').val();

        if (!name) {
            $form.find('#name').addClass('is-invalid');
            return;
        }

        // Validate latitude if provided
        if (latitude && (latitude < -90 || latitude > 90)) {
            $form.find('#latitude').addClass('is-invalid');
            return;
        }

        // Validate longitude if provided
        if (longitude && (longitude < -180 || longitude > 180)) {
            $form.find('#longitude').addClass('is-invalid');
            return;
        }

        var formData = $form.serialize();
        var $submit = $form.find('button[type="submit"]');
        $submit.prop('disabled', true).text('Saving...');

        $.ajax({
            url: '/admin/schools',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addSchoolModal').modal('hide');
                $('#addSchoolForm')[0].reset();
                table.ajax.reload(null, false);
                toastr.success(response.message || 'School added successfully');
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
                    toastr.error('Failed to create school.');
                }
            },
            complete: function() {
                $submit.prop('disabled', false).text('Save');
            }
        });
    });

    // Edit School - Load Data
    $(document).on('click', '.edit-school', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/admin/schools/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#editSchoolForm #school_id').val(response.schools_id);
                $('#edit-name').val(response.name);
                $('#edit-phone').val(response.phone || '');
                $('#edit-address').val(response.address || '');
                $('#edit-latitude').val(response.latitude || '');
                $('#edit-longitude').val(response.longitude || '');
                $('#editSchoolModal').modal('show');
            },
            error: function(xhr) {
                toastr.error('Error loading school data');
            }
        });
    });

    // Update School Form Submit
    $('#editSchoolForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editSchoolForm #school_id').val();
        var $form = $(this);
        
        // Reset validation states
        $form.find('.is-invalid').removeClass('is-invalid');

        // Basic validation
        var name = $.trim($form.find('#edit-name').val());
        var latitude = $form.find('#edit-latitude').val();
        var longitude = $form.find('#edit-longitude').val();

        if (!name) {
            $form.find('#edit-name').addClass('is-invalid');
            return;
        }

        // Validate latitude if provided
        if (latitude && (latitude < -90 || latitude > 90)) {
            $form.find('#edit-latitude').addClass('is-invalid');
            return;
        }

        // Validate longitude if provided
        if (longitude && (longitude < -180 || longitude > 180)) {
            $form.find('#edit-longitude').addClass('is-invalid');
            return;
        }

        var formData = $form.serialize() + '&_method=PUT';
        var $submit = $form.find('button[type="submit"]');
        $submit.prop('disabled', true).text('Saving...');

        $.ajax({
            url: '/admin/schools/' + id,
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editSchoolModal').modal('hide');
                table.ajax.reload(null, false);
                toastr.success(response.message || 'School updated successfully');
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
                    toastr.error('Error updating school');
                }
            },
            complete: function() {
                $submit.prop('disabled', false).text('Save Changes');
            }
        });
    });

    // View School Details
    $(document).on('click', '.view-school', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/admin/schools/' + id,
            type: 'GET',
            success: function(response) {
                $('#viewSchoolModal .school-name').text(response.name);
                $('#viewSchoolModal .school-phone').text(response.phone || 'N/A');
                $('#viewSchoolModal .school-address').text(response.address || 'N/A');
                $('#viewSchoolModal .school-latitude').text(response.latitude || 'N/A');
                $('#viewSchoolModal .school-longitude').text(response.longitude || 'N/A');
                $('#viewSchoolModal').modal('show');
            },
            error: function(xhr) {
                toastr.error('Error loading school details');
            }
        });
    });

    // Delete School
    $(document).on('click', '.delete-school', function() {
        var id = $(this).data('id');

        if (confirm('Are you sure you want to delete this school?')) {
            $.ajax({
                url: '/admin/schools/' + id,
                type: 'DELETE',
                success: function(response) {
                    table.ajax.reload();
                    toastr.success('School deleted successfully');
                },
                error: function(xhr) {
                    toastr.error('Error deleting school');
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
            // Restore default button text if changed
            $form.find('button[type="submit"]').each(function(){
                var $btn = $(this);
                if ($btn.data('default-text')) {
                    $btn.text($btn.data('default-text'));
                }
            });
        }
    });
});