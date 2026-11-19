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
                { data: 'client_name' },
                { data: 'labour_name' },
                { data: 'start_date' },
                { data: 'end_date' },
                { data: 'status' },
                { data: 'price' },
                { data: 'created_at' },
                { data: 'action' }
            ],
            createdRow: function (row, data, dataIndex) {
                // Add data-id attribute to the row
                $(row).attr('data-id', data.id);
            },
            columnDefs: [
                {
                    targets: 1, // Client Name
                    render: function (data, type, full, meta) {
                        return full.client_name; // Render client_name directly
                    }
                },
                {
                    targets: 2, // Labour Name
                    render: function (data, type, full, meta) {
                        return full.labour_name; // Render labour_name directly
                    }
                },
                {
                    targets: 3, // Labour Name
                      render: function (data, type, full, meta) {
                        const date = new Date(full.start_date);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                        const year = date.getFullYear();
                        return `${day}:${month}:${year}`;
                    }
                },
                {
                    targets: 4, // Labour Name
                      render: function (data, type, full, meta) {
                        const date = new Date(full.end_date);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                        const year = date.getFullYear();
                        return `${day}:${month}:${year}`;
                    }
                },
                {
                    targets: 5, // Status
                    render: function (data, type, full, meta) {
                        return `<span class="badge badge-glow bg-${full.status == 'completed' ? 'success' : 'info'}">${full.status.toUpperCase()}</span>`;
                    }
                },
                {
                    targets: 7, // Labour Name
                      render: function (data, type, full, meta) {
                        const date = new Date(full.created_at);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                        const year = date.getFullYear();
                        return `${day}:${month}:${year}`;
                    }
                },
                {
                    targets: 8, // Action column
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-inline-flex">' +
                            '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end">' +
                            ['pending', 'accepted', 'completed', 'cancelled'].map(status => {
                                return (
                                    '<a href="javascript:;" class="dropdown-item change-status" data-id="' + full.id + '" data-status="' + status + '">' +
                                    feather.icons['repeat'].toSvg({ class: 'font-small-4 me-50' }) +
                                    (status.charAt(0).toUpperCase() + status.slice(1)) + // Capitalize the status
                                    '</a>'
                                );
                            }).join('') + // Combine all status options into one string
                            '<a href="javascript:;" class="dropdown-item send-feedback" data-id="' + full.id + '">' +
                            feather.icons['message-circle'].toSvg({ class: 'font-small-4 me-50' }) +
                            'Send Feedback</a>' +
                            '<a href="javascript:;" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                            'Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="javascript:;" class="item-edit modals-slide-in-edit" data-id="' + full.id + '">' +
                                feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                            '</a>'
                        );
                    }
                }
            ],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                    text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add New Booking',
                    className: 'create-new btn btn-primary',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-slide-in'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
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

        $('div.head-label').html('<h6 class="mb-0">List of Bookings</h6>');
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

    $(document).on('click', '.modals-slide-in-edit', function () {
        var BookingId = $(this).data('id');
        $.ajax({
            url: `${assetPath}/edit/${BookingId}`,
            method: 'GET',
            success: function (response) {
              console.log(response);
              if (response.booking) {
                    const clientId    = response.booking?.client_id;
                    const labourId    = response.labour_ids;
                    const startDate   = response.booking?.start_date;
                    const endDate     = response.booking?.end_date;
                    const price       = response.booking?.price;
                    const description = response.booking?.description;
                    // Assign values to the fields
                    $('#client_id_Edit').val(clientId).trigger('change.select2');
                    $('#labour_id_Edit').val(labourId).trigger('change.select2');
                    $('#start_date_edit').val(startDate);
                    $('#end_date_edit').val(endDate);
                    $('#price_edit').val(price);
                    $('#description_edit').val(description);
                    $('#booking_id').val(response.booking.id);
                    // Update the Flatpickr instance if applicable
                    if ($('#start_date_edit').hasClass('flatpickr-date-time')){
                        const flatpickrInstance = $('#start_date_edit')[0]._flatpickr;
                        if (flatpickrInstance) {
                            flatpickrInstance.setDate(startDate, true); // Set the date and trigger change event
                        }
                    }
                     // Update the Flatpickr instance if applicable
                     if ($('#end_date_edit').hasClass('flatpickr-date-time')){
                        const flatpickrInstance = $('#end_date_edit')[0]._flatpickr;
                        if (flatpickrInstance) {
                            flatpickrInstance.setDate(endDate, true); // Set the date and trigger change event
                        }
                    }
                } else{
                    alert("Booking data is missing or invalid.");
                    window.location.reload();
                }
                $('#modals-slide-in-edit').modal('show');
            },
            error: function (error) {
                console.log('Error fetching data:', error);
                alert('Failed to load data.');
            }
        });
      });
  });
    // Add New Booking
    // on submit of form
    $('#store-booking').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('.invalid-feedback').text('').hide();
        $('.is-invalid').removeClass('is-invalid');
        // Get form action URL and initialize FormData
        const actionUrl = $(this).attr('action');
        const formData = new FormData(this);
        // Include CSRF token (important for Laravel)
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        formData.append('_token', csrfToken);
        // Send AJAX request
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            success: function (response) {
                console.log('response', response);
                if(response.success) {
                    // Hide the modal
                    $('#modals-slide-in').modal('hide');
                    // Optionally reload the page or update the table
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    for (const [key, messages] of Object.entries(errors)) {
                        // Show error message
                        const keyName = key.includes('.') ? key.replace('.', '[').replace('.', ']') : key; // Handle nested fields
                        $(`.${keyName}-error`).text(messages[0]).show();
                        $(`[name="${keyName}"]`).addClass('is-invalid');
                    }
                } else {
                    alert('An unexpected error occurred.');
                    console.error(xhr);
                }
            }
        });
    });

    $('#update-booking').on('submit', function (e) {

        e.preventDefault();
        // Clear previous error messages
        $('.invalid-feedback').text('').hide();
        $('.is-invalid').removeClass('is-invalid');
        // Get form action URL and initialize FormData
        const actionUrl = $(this).attr('action');
        const formData = new FormData(this);
        // Include CSRF token (important for Laravel)
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        formData.append('_token', csrfToken);
        // Send AJAX request
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            success: function (response)
            {
                console.log('response', response);
                if(response.success)
                    {
                    // Hide the modal
                    $('#modals-slide-in-edit').modal('hide');
                    // Optionally reload the page or update the table
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr)
            {
                if (xhr.status === 422)
                    {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    for (const [key, messages] of Object.entries(errors)) {
                        // Show error message
                        const keyName = key.includes('.') ? key.replace('.', '[').replace('.', ']') : key; // Handle nested fields
                        $(`.${keyName}-error`).text(messages[0]).show();
                        $(`[name="${keyName}"]`).addClass('is-invalid');
                    }
                } else {
                    alert('An unexpected error occurred.');
                    console.error(xhr);
                }
            }
        });
    });

// Event listener for delete action
$(document).on('click', '.delete-category', function () {
  const categoryId = $(this).data('id');  // Get category ID from the button data attribute

  // Show confirmation prompt before deletion
  if (confirm('Are you sure you want to delete this category?')) {

    alert("TES");
      // Send the AJAX request to delete the category
      $.ajax({
          url: `/category/categories/${categoryId}`,  // Correct URL with category prefix
          type: 'DELETE',  // HTTP method
          data: {
              _token: $('meta[name="csrf-token"]').attr('content')  // Include CSRF token
          },
          success: function (response) {
              // On success, reload or update the table data
              alert('Category deleted successfully');
              location.reload();  // Reload the page to reflect changes (you can also update the table dynamically)
          },
          error: function (error) {
              // Handle errors
              console.error('Error deleting category:', error);
              alert('There was an error deleting the category.');
          }
      });
  }
});

let accountIndex = 1; // Tracks the number of account rows
// Add Account Button Click
$("#add-account-btn").on("click", function () {
    // Clone the hidden template and update it
    let template = $("#account-template").html();
    template = template.replace(/__INDEX__/g, accountIndex); // Replace placeholder with index
    // Convert the string to HTML and append to the wrapper
    const $newAccountRow = $(template);
    $("#account-details-wrapper").append($newAccountRow);
    // Increment the index
    accountIndex++;
});
// Remove Account Button Click
$("#account-details-wrapper").on("click", ".btn-remove-account", function () {
    $(this).closest(".account-detail").remove();
});

$(document).on('click', '.send-feedback', function () {
    var recordId = $(this).data('id');
    // Show confirmation prompt before sending feedback
    if (!confirm('Are you sure you want to send feedback?')) {
        return;
    }
    $.ajax({
        url: '/booking/feedback/send',  // Update with your API endpoint
        type: 'POST',
        data: { id: recordId },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
        },
        success: function (response) {
            alert(response.message);
        },
        error: function (xhr, status, error) {
            alert('Error sending feedback: ' + xhr.responseText);
        }
    });
});
