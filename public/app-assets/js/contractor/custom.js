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
            { data: 'name' },
            { data: 'phone' },
            { data: 'status' },
            { data: 'cnic_no' },
            { data: 'cnic_front_img' },
            { data: 'cnic_back_img' },
            { data: 'created_at' },
            { data: 'action' }
          ],
            createdRow: function (row, data, dataIndex) {
                // Add data-id attribute to the row
                $(row).attr('data-id', data.id);
            },
          columnDefs: [
            {
              targets: 0, // id
              render: function (data, type, full, meta) {
                return full.id; // Directly render the id
              }
            },
            {
              targets: 1, // Name
              render: function (data, type, full, meta) {
                return full.name; // Directly render the name
              }
            },
            {
              targets: 2, // Phone
              render: function (data, type, full, meta) {
                return full.phone; // Directly render the phone number
              }
            },
            {
            targets: 3, // Status
                render: function (data, type, full, meta) {
                    // Checking if status is 1 (Active) or 0 (Inactive) and applying the appropriate badge class
                    if (full.status == "Active") {
                    return '<span class="badge badge-glow bg-success">Active</span>'; // Green badge for Active
                    } else {
                    return '<span class="badge badge-glow bg-danger">Inactive</span>'; // Red badge for Inactive
                    }
                }
            },
            {
              targets: 4, // CNIC number
              render: function (data, type, full, meta) {
                return full.cnic_no; // Render CNIC number
              }
            },
            {
              targets: 5, // CNIC front image
              render: function (data, type, full, meta) {
                return full.cnic_front_img ? `<img src="${full.cnic_front_img}" alt="CNIC Front" width="50" height="50">` : ''; // Render image or empty if not available
              }
            },
            {
              targets: 6, // CNIC back image
              render: function (data, type, full, meta) {
                return full.cnic_back_img ? `<img src="${full.cnic_back_img}" alt="CNIC Back" width="50" height="50">` : ''; // Render image or empty if not available
              }
            },
            {
              // targets: 7, // Created at
              // render: function (data, type, full, meta) {
              //   return full.created_at; // Render creation date
              // }
              targets: 7, // Created at
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
                    // Conditionally display "Activate/Deactivate" based on the current status
                    '<a href="javascript:;" class="dropdown-item toggle-status" data-id="' + full.id + '" data-status="' + full.status + '">' +
                    feather.icons['archive'].toSvg({ class: 'font-small-4 me-50' }) +
                    (full.status == 'Active' ? 'Deactivate' : 'Activate') +
                    '</a>' +
                    '<a href="javascript:;" class="dropdown-item delete-record">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Delete</a>' +
                    '</div>' +
                    '</div>' +
                     // Edit button to trigger the modal
                  '<a href="javascript:;" class="item-edit modal-slide-in-edit" data-id="' + full.id + '" data-name="' + full.name + '" data-phone="' + full.phone + '" data-category_name="' + full.category_name + '">' +
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
              text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add New Contractor',
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
                  return 'Details of ' + data['name'];
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

        $('div.head-label').html('<h6 class="mb-0">List of Contractors</h6>');
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
    $('.datatables-basic tbody').on('click', '.toggle-status', function () {
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

    $(document).on('click', '.modal-slide-in-edit', function () {
  
      var contractorId = $(this).data('id'); 
    
      $.ajax({
    
          url: `${assetPath}/edit/${contractorId}`,
    
          method: 'GET',
          success: function (response) 
          {
            console.log(response);
            
              $('.labour-name').val(response.user[0].name);
              $('.labour-phone').val(response.user[0].phone);
              $('.labour-cnic_no').val(response.user[0].meta.cnic_no);
              $('.labour-address').val(response.user[0].meta.address);
              $('.contractor_id').val(response.user[0].id);

              if (response.user[0].meta.cnic_front_img) 
              {
                $('#front-preview').html(`<img src="${response.user[0].meta.cnic_front_img}" class="img-fluid" style="max-width: 200px; max-height: 150px; margin-top: 10px;" alt="CNIC Front">`);
                $('.labour-cnic_front_img').removeAttr('required');  // Optional on update

              } 
              else 
              {
                $('#front-preview').html(`<p>No CNIC front image available.</p>`);
              }

              if(response.user[0].meta.cnic_back_img) 
              {
                $('#back-preview').html(`<img src="${response.user[0].meta.cnic_back_img}" class="img-fluid" style="max-width: 200px; max-height: 150px; margin-top: 10px;" alt="CNIC Back">`);
                $('.labour-cnic_back_img').removeAttr('required');  // Optional on update

              } 
              else 
              {
                $('#back-preview').html(`<p>No CNIC back image available.</p>`);
              }
              
              let accountIndexEdit          = response.user[0].accounts.length; // Tracks the number of account rows
              let accountDetailsWrapper = $('#account-details-wrapper-edit');

              if (response.user[0].accounts && Array.isArray(response.user[0].accounts)) 
                {
               
                  response.user[0].accounts.forEach((account, index) => 
                    {
                      let accountTypeOptions = `<option value="">Select Type</option>`;
                      
                      if (response.accountTypeList && Array.isArray(response.accountTypeList)) 
                        {
                          response.accountTypeList.forEach(accountType => 
                            {
                              accountTypeOptions += `<option value="${accountType.id}" ${account.account_type_id == accountType.id ? 'selected' : ''}>${accountType.name}</option>`;
                            });
                      }
                      const accountRow = `
                          <div class="account-detail mb-2 d-flex align-items-center">
                              <div class="me-1">
                                  <label class="form-label" for="account-type-${index}">Account Type</label>
                                  <select class="form-select" name="accounts[${index}][type]" id="account-type-${index}" required>
                                      ${accountTypeOptions}
                                  </select>
                              </div>
                              <div class="me-1">
                                  <label class="form-label" for="account-number-${index}">Account Number</label>
                                  <input type="text" class="form-control" name="accounts[${index}][number]" id="account-number-${index}" 
                                        placeholder="Enter Number" value="${account.account_no}" required>
                              </div>
                              <div class="me-1">
                                  <label class="form-label" for="account-title-${index}">Account Title</label>
                                  <input type="text" class="form-control" name="accounts[${index}][title]" id="account-title-${index}" 
                                        placeholder="Enter Title" value="${account.account_title}" required>
                              </div>
                          </div>`;

                      $("#account-details-wrapper-edit").append(accountRow);
                  });
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
    // Add New Labour
    // on submit of form
    $('#store-contractor').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.invalid-feedback').text('').hide();
        $('.is-invalid').removeClass('is-invalid');

        // Get form action URL and initialize FormData
        const actionUrl = $(this).attr('action');
        const formData = new FormData(this);

        // Handle the status value for the checkbox
        const statusCheckbox = $('#customSwitch111').is(':checked') ? '1' : '0';
        formData.set('status', statusCheckbox);

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
                // Hide the modal
                $('#modals-slide-in').modal('hide');
                // Optionally reload the page or update the table
                alert('Contractor added successfully!');
                location.reload();
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

    // Add update Labour
    // on update of form
    $('#update-contractor').on('submit', function (e) {
      e.preventDefault();

      // Clear previous error messages
      $('.invalid-feedback').text('').hide();
      $('.is-invalid').removeClass('is-invalid');

      // Get form action URL and initialize FormData
      const actionUrl = $(this).attr('action');
      const formData  = new FormData(this);
      // Handle the status value for the checkbox
      const statusCheckbox = $('#customSwitch111').is(':checked') ? '1' : '0';
      formData.set('status', statusCheckbox);

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
              // Hide the modal
              $('#modals-slide-in-edit').modal('hide');
              // Optionally reload the page or update the table
              alert('Contractor Updated successfully!');
              location.reload();
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

    $('#labour-cnic_front_img').on('change', function(event) {
      // Get the selected file
      const file = event.target.files[0];
      
      if (file) {
          const reader = new FileReader();

          // Once the file is read, display the preview
          reader.onload = function(e) {
              // Set the preview container's HTML to display the image
              $('#front-preview').html(
                  `<img src="${e.target.result}" class="img-fluid" style="max-width: 200px; max-height: 150px; margin-top: 10px;" alt="CNIC Front">`
              );
          }

          // Read the selected file as a Data URL
          reader.readAsDataURL(file);
      }
    });

    // Images changes front side
    $('#labour-cnic_front_img').on('change', function(event) {
      // Get the selected file
      const file = event.target.files[0];
      
      if (file) {
          const reader = new FileReader();

          reader.onload = function(e) {

            $('#front-preview').html(
                  `<img src="${e.target.result}" class="img-fluid" style="max-width: 200px; max-height: 150px; margin-top: 10px;" alt="CNIC Front">`
              );
          }

          reader.readAsDataURL(file);
      }
    });

    // Images changes back side
    $('#labour-cnic_back_img').on('change', function(event) {
      // Get the selected file
      const file = event.target.files[0];
      
      if (file) {
          const reader = new FileReader();

          reader.onload = function(e) 
          {
              $('#back-preview').html(
                  `<img src="${e.target.result}" class="img-fluid" style="max-width: 200px; max-height: 150px; margin-top: 10px;" alt="CNIC Front">`
              );
          }
          reader.readAsDataURL(file);
      }
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

$("#add-account-btn-edit").on("click", function () {

  let accountIndexEdit = $("#account-details-wrapper-edit").children().length;
  // Clone the hidden template and update it
  let template = $("#account-template-edit").html();
  template = template.replace(/__INDEX__/g, accountIndexEdit); // Replace placeholder with index
  // Convert the string to HTML and append to the wrapper
  const $newAccountRow = $(template);
  $("#account-details-wrapper-edit").append($newAccountRow);
  // Increment the index
});

// Remove Account Button Click
$("#account-details-wrapper-edit").on("click", ".btn-remove-account", function () {
    $(this).closest(".account-detail").remove();
});





