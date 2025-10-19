// Students JS: initializes DataTable and handles CRUD operations
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
                    { 
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<input type="checkbox" class="form-check-input row-checkbox" value="' + row.id + '">';
                        }
                    },
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'roll_number' },
                    { data: 'class' },
                    { data: 'guardian' },
                    { data: 'location' },
                    { data: 'trip_status' },
                    { 
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var eyeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                            var editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                            var trashSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>';

                            var btn = '<a href="/admin/students/' + row.id + '" class="btn btn-info btn-sm" title="View" aria-label="View student">' + eyeSvg + '</a> ';
                            btn += '<a href="/admin/students/' + row.id + '/edit" class="btn btn-primary btn-sm" title="Edit" aria-label="Edit student">' + editSvg + '</a> ';
                            btn += '<button data-id="' + row.id + '" class="btn btn-danger btn-sm delete-student" title="Delete" aria-label="Delete student">' + trashSvg + '</button>';
                            return btn;
                        }
                    }
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

    // Initialize Select2 for dropdowns
    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
    });

    // Search and filter functionality
    var table;
    function getTable() {
        if (!table && $.fn.dataTable.isDataTable('#students-table')) {
            table = $('#students-table').DataTable();
        }
        return table;
    }

    // Name search
    $('#search-name').on('keyup', function() {
        var table = getTable();
        if (table) {
            table.column(1).search(this.value).draw();
        }
    });

    // Class filter
    $('#filter-class').on('change', function() {
        var table = getTable();
        if (table) {
            table.column(4).search(this.value).draw();
        }
    });

    // Guardian filter
    $('#filter-guardian').on('change', function() {
        var table = getTable();
        if (table) {
            table.column(5).search(this.value).draw();
        }
    });

    // Clear filters
    $('#clear-filters').on('click', function() {
        $('#search-name').val('');
        $('#filter-class').val('').trigger('change');
        $('#filter-guardian').val('').trigger('change');
        var table = getTable();
        if (table) {
            table.search('').columns().search('').draw();
        }
    });

    // Bulk operations
    $('#select-all').on('change', function() {
        var isChecked = this.checked;
        $('.row-checkbox').prop('checked', isChecked);
        updateBulkActions();
    });

    $(document).on('change', '.row-checkbox', function() {
        updateBulkActions();
    });

    function updateBulkActions() {
        var checked = $('.row-checkbox:checked').length;
        var total = $('.row-checkbox').length;
        
        if (checked > 0) {
            $('#bulk-actions').show();
            $('#selected-count').text(checked + ' of ' + total + ' students selected');
        } else {
            $('#bulk-actions').hide();
        }
        
        // Update select all checkbox
        if (checked === 0) {
            $('#select-all').prop('indeterminate', false).prop('checked', false);
        } else if (checked === total) {
            $('#select-all').prop('indeterminate', false).prop('checked', true);
        } else {
            $('#select-all').prop('indeterminate', true);
        }
    }

    // Bulk delete
    $('#bulk-delete').on('click', function() {
        var selected = $('.row-checkbox:checked').map(function() { return this.value; }).get();
        if (selected.length === 0) return;
        
        if (!confirm('Are you sure you want to delete ' + selected.length + ' selected students?')) return;
        
        $.ajax({
            url: '/admin/students/bulk-delete',
            type: 'POST',
            data: { ids: selected },
            success: function(res) {
                if ($.fn.dataTable.isDataTable('#students-table')) {
                    $('#students-table').DataTable().ajax.reload(null, false);
                }
                if (typeof toastr !== 'undefined') toastr.success(res.message || 'Selected students deleted successfully');
            },
            error: function() {
                if (typeof toastr !== 'undefined') toastr.error('Failed to delete selected students');
            }
        });
    });

    // Bulk export
    $('#bulk-export').on('click', function() {
        var selected = $('.row-checkbox:checked').map(function() { return this.value; }).get();
        if (selected.length === 0) return;
        
        var form = $('<form method="POST" action="/admin/students/export">');
        form.append('<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">');
        selected.forEach(function(id) {
            form.append('<input type="hidden" name="ids[]" value="' + id + '">');
        });
        $('body').append(form);
        form.submit();
        form.remove();
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
});
