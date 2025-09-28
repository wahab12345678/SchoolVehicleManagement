// Minimal Students JS: initializes DataTable and handles add student form via AJAX
$(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    function initTable() {
        if (!$.fn.dataTable.isDataTable('#students-table')) {
            $('#students-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/admin/students',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'roll_number' },
                    { data: 'class' },
                    { data: 'guardian' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                responsive: true,
                lengthMenu: [10,25,50,100]
            });

            // replace feather icons on draw
            $('#students-table').on('draw.dt', function() {
                if (typeof feather !== 'undefined') {
                    try { feather.replace({ width: 14, height: 14 }); } catch (e) { }
                }
            });
        }
    }

    initTable();

        $('#addStudentForm').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var $submit = $(this).find('button[type="submit"]');
        $submit.prop('disabled', true).text('Saving...');

        $.post('/admin/students', data)
            .done(function(res) {
                $('#addStudentModal').modal('hide');
                $('#addStudentForm')[0].reset();
                if ($.fn.dataTable.isDataTable('#students-table')) {
                    $('#students-table').DataTable().ajax.reload(null, false);
                }
                if (typeof toastr !== 'undefined') toastr.success(res.message || 'Student added successfully');
            }).fail(function(xhr) {
                var msg = 'Failed to save student';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var first = Object.values(xhr.responseJSON.errors)[0];
                    if (first && first[0]) msg = first[0];
                }
                if (typeof toastr !== 'undefined') toastr.error(msg); else alert(msg);
            }).always(function() {
                $submit.prop('disabled', false).text($submit.data('default-text') || 'Save');
            });
    });

    // View student details
    $(document).on('click', '.view-student', function() {
        var id = $(this).data('id');
        $.get('/admin/students/' + id)
            .done(function(res) {
                $('.student-name').text(res.name || 'N/A');
                $('.student-roll').text(res.roll_number || 'N/A');
                $('.student-class').text(res.class || 'N/A');
                var guardianName = 'N/A';
                if (res.guardian) {
                    if (res.guardian.user && res.guardian.user.name) guardianName = res.guardian.user.name;
                    else if (res.guardian.name) guardianName = res.guardian.name;
                }
                $('.student-guardian').text(guardianName);
                $('#viewStudentModal').modal('show');
            }).fail(function() { if (typeof toastr !== 'undefined') toastr.error('Failed to load student details'); else alert('Failed to load student details'); });
    });

    // Edit student - load into edit modal
    $(document).on('click', '.edit-student', function() {
        var id = $(this).data('id');
        $.get('/admin/students/' + id + '/edit')
            .done(function(res) {
                $('#student_id').val(res.id);
                $('#edit-name').val(res.name || '');
                $('#edit-roll-number').val(res.roll_number || '');
                $('#edit-class').val(res.class || '');
                // res.guardian may be an object; pick id if present
                var parentId = '';
                if (res.guardian && typeof res.guardian === 'object') parentId = res.guardian.id || res.guardian.user_id || '';
                $('#edit-parent-id').val(parentId);
                $('#editStudentModal').modal('show');
            }).fail(function() { if (typeof toastr !== 'undefined') toastr.error('Failed to load student for edit'); else alert('Failed to load student for edit'); });
    });

    // Update student
    $('#editStudentForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#student_id').val();
        var $submit = $(this).find('button[type="submit"]');
        $submit.prop('disabled', true).text('Saving...');
        var data = $(this).serialize() + '&_method=PUT';
        $.post('/admin/students/' + id, data)
            .done(function(res) {
                $('#editStudentModal').modal('hide');
                if ($.fn.dataTable.isDataTable('#students-table')) $('#students-table').DataTable().ajax.reload(null, false);
                if (typeof toastr !== 'undefined') toastr.success(res.message || 'Student updated successfully');
            }).fail(function(xhr) {
                var msg = 'Failed to update student';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var first = Object.values(xhr.responseJSON.errors)[0];
                    if (first && first[0]) msg = first[0];
                }
                if (typeof toastr !== 'undefined') toastr.error(msg); else alert(msg);
            }).always(function() {
                $submit.prop('disabled', false).text($submit.data('default-text') || 'Save Changes');
            });
    });

    // Delete student
    $(document).on('click', '.delete-student', function() {
        var id = $(this).data('id');
        if (!confirm('Are you sure you want to delete this student?')) return;
        $.ajax({ url: '/admin/students/' + id, type: 'DELETE' })
            .done(function(res) {
                if ($.fn.dataTable.isDataTable('#students-table')) $('#students-table').DataTable().ajax.reload(null, false);
                if (typeof toastr !== 'undefined') toastr.success(res.message || 'Student deleted successfully');
            }).fail(function() { if (typeof toastr !== 'undefined') toastr.error('Failed to delete student'); else alert('Failed to delete student'); });
    });

    // Reset forms when modals are closed
    $('.modal').on('hidden.bs.modal', function() {
        var $form = $(this).find('form');
        if ($form.length) {
            $form[0].reset();
            $form.find('.is-invalid').removeClass('is-invalid');
        }
    });
});
