/**
 * DataTables Basic
 */

$(function () {
    'use strict';

    var dt_basic_table = $('.datatables-basic'),
      dt_date_table = $('.dt-date'),
      assetPath = window.location.href;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
        var dt_basic = dt_basic_table.DataTable({
            ajax: assetPath + '/list',
            columns: [
                { data: 'id' },
                { data: 'booking_id' },
                // { data: 'reviewer_name' },
                // { data: 'reviewee_name' },
                { data: 'rating' },
                { data: 'comment' },
                { data: 'created_at' },
            ],
            createdRow: function (row, data, dataIndex) {
                // Add data-id attribute to the row
                $(row).attr('data-id', data.id);
            },
            columnDefs: [
                {
                    targets: 4, // 'created_at' column index
                    render: function (data) {
                        if (!data) return '';
                        const [datePart] = data.split(' ');
                        const [year, month, day] = datePart.split('-');
                        return `${day}:${month}:${year}`;
                    }
                }
            ],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                // {
                //     text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add New Booking',
                //     className: 'create-new btn btn-primary',
                //     attr: {
                //         'data-bs-toggle': 'modal',
                //         'data-bs-target': '#modals-slide-in'
                //     },
                //     init: function (api, node, config) {
                //         $(node).removeClass('btn-secondary');
                //     }
                // }
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['client_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' ? '<tr data-dt-row="' + col.rowIdx + '" data-dt-column="' + col.columnIndex + '">' +
                                '<td>' + col.title + ':' + '</td> ' +
                                '<td>' + col.data + '</td>' +
                                '</tr>' : '';
                        }).join('');
                        return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                    }
                }
            },
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });

        $('div.head-label').html('<h6 class="mb-0">List of Reviews</h6>');
    }

    // Flat Date picker
    if (dt_date_table.length) {
      dt_date_table.flatpickr({
        monthSelectorType: 'static',
        dateFormat: 'm/d/Y'
      });
    }

    // Delete Record
    $('.datatables-basic tbody').on('click', '.delete-record', function () {
        // Get the row and retrieve the ID (assuming it's stored in a data attribute)
        const row = $(this).parents('tr');
        const id = row.data('id'); // Assuming the ID is stored as data-id in the row
        // Confirm before deleting
        if (confirm('Are you sure you want to delete this record?')) {
            // Send the AJAX request
            $.ajax({
                url: `${assetPath}/delete/${id}`, // Replace with your delete endpoint
                type: 'DELETE', // HTTP method
                contentType: 'application/json', // Specify JSON format
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
                },
                success: function (response) {
                    // Remove the row from DataTable
                    dt_basic.row(row).remove().draw();
                    alert('Record deleted successfully!');
                },
                error: function (xhr) {
                    // Handle errors
                    alert('Failed to delete record. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
    // Change Status
    $('.datatables-basic tbody').on('click', '.change-status', function () {
        // Get the row and retrieve the ID (assuming it's stored in a data attribute)
        const row = $(this).parents('tr');
        const id = row.data('id'); // Assuming the ID is stored as data-id in the row
        const status = $(this).data('status');
        if (confirm('Are you sure you want to change the status of this record?')) {
            // Send the AJAX request
            $.ajax({
                url: `${assetPath}/change-status`, // Replace with your update endpoint
                type: 'POST', // HTTP method
                contentType: 'application/json', // Specify JSON format
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
                },
                data: JSON.stringify({ // Convert the data to JSON string format
                    id: id,
                    status: status
                }),
                success: function (response) {
                    alert('Status Changed Successfully!');
                    location.reload();
                },
                error: function (xhr) {
                    // Handle errors
                    alert('Failed to change status of record. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
  });
