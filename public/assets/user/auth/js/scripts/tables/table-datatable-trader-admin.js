
/**
 * DataTables Advanced
 */

'use strict';

// Datepicker for advanced filter
// ---------------------------------------------------------------------------
var separator = ' - ',
  rangePickr = $('.flatpickr-range'),
  dateFormat = 'MM/DD/YYYY';
var options = {
  autoUpdateInput: false,
  autoApply: true,
  locale: {
    format: dateFormat,
    separator: separator
  },
  opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
};

//Range Picker
// ---------------------------------------------------------------------------------------------
if (rangePickr.length) {
  rangePickr.flatpickr({
    mode: 'range',
    dateFormat: 'm/d/Y',
    onClose: function (selectedDates, dateStr, instance) {
      var startDate = '',
        endDate = new Date();
      if (selectedDates[0] != undefined) {
        startDate =
          selectedDates[0].getMonth() + 1 + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
        $('.start_date').val(startDate);
      }
      if (selectedDates[1] != undefined) {
        endDate =
          selectedDates[1].getMonth() + 1 + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
        $('.end_date').val(endDate);
      }
      $(rangePickr).trigger('change').trigger('keyup');
    }
  });
}

// Advanced Search Functions Ends

$(function () {
  var isRtl = $('html').attr('data-textdirection') === 'rtl';

  var dt_ajax_table = $('.datatables-ajax'),
    assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // Ajax Sourced Server-side
  // --------------------------------------------------------------------
  var datatable;
  if (dt_ajax_table.length) {

    feather.replace();
    var cd = (new Date()).toISOString().split('T')[0];
    datatable = dt_ajax_table.DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "lengthChange": false,
      "buttons": true,
      "dom": 'B<"clear">lfrtip',
      buttons: [
        {
          extend: 'csv',
          text: 'csv',
          className: 'btn btn-success btn-sm',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          },
          action: serverSideButtonAction
        },
        {
          extend: 'excel',
          text: 'excel',
          className: 'btn btn-warning btn-sm',
          action: serverSideButtonAction
        },
      ],
      "ajax": {
        "url": "/admin/client-management/trader-admin-fetch-data",
        "data": function (d) {
          return $.extend({}, d, {
            "finance": $("#finance").val(),
            "category": $("#category").val(),
            "verification_status": $("#verification-status").val(),
            "acc_manager": $("#account-manager").val(),
            "start_date": $(".start_date").val(),
            "end_date": $(".end_date").val(),
            "info":$("#info").val(),
            "desk_manager":$("#desk_manager").val(),
            "ib_info":$("#ib_info").val(),
            "min":$("#min").val(),
            "max":$("#max").val(),
            "trading_acc":$("#trading_acc").val()
          });
        }
      },

      "columns": [
        { "data": "name" },
        { "data": "email" },
        { "data": "phone" },
        { "data": "joined" },
        { "data": "status" },
        { "data": "actions" },
      ],
      "columnDefs": [{
        "targets": 5,
        "orderable": false
      }],
      "order": [[1, 'desc']],
      "drawCallback": function (settings) {
        var rows = this.fnGetData();
        if (rows.length !== 0) {
          feather.replace();
        }
      }
    });
    // Filter operation
    $("#btn-filter").on("click", function (e) {
      datatable.draw();
    });
    // reset operation
    $("#btn-reset").on("click", function (e) {
      $(".start_date").val('');
      $(".end_date").val('');
      $("#filter-form").trigger('reset');
      datatable.draw();
    });

  }

  // datatable export function
  $(document).on("change", "#fx-export", function () {
    if ($(this).val() === 'csv') {
      $(".buttons-csv").trigger('click');
    }
    if ($(this).val() === 'excel') {
      $(".buttons-excel").trigger('click');
    }

  });


  // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');

  //    datatable descriptions
  // --------------------------------------------------------------------------------------------------------
  $(document).on("click", ".dt-description", function (params) {
    let __this = $(this);
    let trader_id = $(this).data('id');
    $.ajax({
      type: "GET",
      url: '/admin/client-management/dt-description-trader-admin/' + trader_id,
      dataType: 'json',
      success: function (data) {
        if (data.status == true) {
          if ($(__this).closest("tr").next().hasClass("description")) {
            $(__this).closest("tr").next().remove();
            $(__this).find('.w').html(feather.icons['plus'].toSvg());
          } else {
            $(__this).closest('tr').after(data.description);
            $(__this).closest('tr').next('.description').slideDown('slow').delay(5000);
            $(__this).find('.w').html(feather.icons['minus'].toSvg());

            // Inner datatable
            if ($(__this).closest('tr').next('.description').find('.trading_account').length) {
              $(__this).closest('tr').next('.description').find('.trading_account').DataTable().clear().destroy();
              var cd = (new Date()).toISOString().split('T')[0];
              var dt_trading_account = $(__this).closest('tr').next('.description').find('.trading_account').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "dom": 'Bfrtip',
                "ajax": { "url": "/admin/client-management/trader-admin-dt-inner-fetch-data/" + trader_id },
                "columns": [
                  { "data": "account_number" },
                  { "data": "platform" },
                  { "data": "leverage" },
                  { "data": "group" },
                  { "data": "raw_group" },
                  { "data": "created_at" },
                  { "data": "actions" },
                ],
                "order": [[1, 'desc']],
                "drawCallback": function (settings) {
                  var rows = this.fnGetData();
                  if (rows.length !== 0) {
                    feather.replace();
                  }
                }
              });
            }
          }
        }
      }
    })
  });

  //  deposit report
  $(document).on("click", ".deposit-tab-fill", function () {
    let trader_id = $(this).data('id');
    if ($(this).closest('tr').find('.deposit').length) {
      $(this).closest('tr').find('.deposit').DataTable().clear().destroy();
      var cd = (new Date()).toISOString().split('T')[0];
      var dt_deposit = $(this).closest('tr').find('.deposit').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        "dom": 'Bfrtip',
        "ajax": { "url": "/admin/client-management/trader-admin-dt-deposit-fetch-data/" + trader_id },
        "columns": [
          { "data": "date" },
          { "data": "Ammount" },
          { "data": "Method" },
          { "data": "Status" },
          { "data": "actions" },
        ],
        "order": [[1, 'desc']],
        "drawCallback": function (settings) {
          var rows = this.fnGetData();
          if (rows.length !== 0) {
            feather.replace();
          }
        }
      });
    }
  })
  //  withdraw report
  $(document).on("click", ".withdraw-tab-fill", function () {
    let trader_id = $(this).data('id');
    if ($(this).closest('tr').find('.withdraw').length) {
      $(this).closest('tr').find('.withdraw').DataTable().clear().destroy();
      var cd = (new Date()).toISOString().split('T')[0];
      var dt_withdraw = $(this).closest('tr').find('.withdraw').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        "buttons": true,
        "dom": 'Bfrtip',
        "ajax": { "url": "/admin/client-management/trader-admin-dt-withdraw-fetch-data/" + trader_id },
        "columns": [
          { "data": "date" },
          { "data": "Ammount" },
          { "data": "Method" },
          { "data": "Status" },
          { "data": "actions" },
        ],
        "order": [[1, 'desc']],
        "drawCallback": function (settings) {
          var rows = this.fnGetData();
          if (rows.length !== 0) {
            feather.replace();
          }
        }
      });
    }
  })
  //  bonus report
  $(document).on("click", ".bonus-tab-fill", function () {
    let trader_id = $(this).data('id');
    if ($(this).closest('tr').find('.bonus').length) {
      $(this).closest('tr').find('.bonus').DataTable().clear().destroy();
      var cd = (new Date()).toISOString().split('T')[0];
      var dt_bonus = $(this).closest('tr').find('.bonus').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        "buttons": true,
        "dom": 'Bfrtip',
        "ajax": { "url": "/admin/client-management/trader-admin-dt-bonus-fetch-data/" + trader_id },
        "columns": [
          { "data": "date" },
          { "data": "amount" },
          { "data": "bonus_title" },
          { "data": "ending_date" },
        ],
        "order": [[1, 'desc']],
        "drawCallback": function (settings) {
          var rows = this.fnGetData();
          if (rows.length !== 0) {
            feather.replace();
          }
        }
      });
    }
  });
  //  Kyc report
  $(document).on("click", ".kyc-tab-fill", function () {
    let trader_id = $(this).data('id');
    if ($('.kyc').length) {
      $('.kyc').DataTable().clear().destroy();
      var cd = (new Date()).toISOString().split('T')[0];
      var dt_kyc = $(this).closest('tr').find('.kyc').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        "buttons": true,
        "dom": 'Bfrtip',
        "ajax": { "url": "/admin/client-management/trader-admin-dt-kyc-fetch-data/" + trader_id },
        "columns": [
          { "data": "date" },
          { "data": "document_type" },
          { "data": "status" },
        ],
        "order": [[1, 'desc']],
        "drawCallback": function (settings) {
          var rows = this.fnGetData();
          if (rows.length !== 0) {
            feather.replace();
          }
        }
      });
    }
  });
  //  Comments report
  $(document).on("click", ".comment-tab-fill", function () {
    let trader_id = $(this).data('id');
    if ($(this).closest('tr').find('.comment').length) {
      $(this).closest('tr').find('.comment').DataTable().clear().destroy();
      var cd = (new Date()).toISOString().split('T')[0];
      var dt_comment = $(this).closest('tr').find('.comment').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        "buttons": true,
        "dom": 'Bfrtip',
        "ajax": { "url": "/admin/client-management/trader-admin-dt-comment-fetch-data/" + trader_id },
        "columns": [
          { "data": "date" },
          { "data": "comment" },
          { "data": "actions" },
        ],
        "order": [[1, 'desc']],
        "drawCallback": function (settings) {
          var rows = this.fnGetData();
          if (rows.length !== 0) {
            feather.replace();
          }
        }
      });
    }
  });

  // update exist comment
  // get quil data into form
  $(document).on("click", ".btn-update-comment", function () {
    $('.comment-to').html($(this).data('name'));
    $('#trader-id-update').val($(this).data('id'));
    $('#comment-id').val($(this).data('commentid'));
    $(".ql-editor").html($(this).data('comment'));
  });

  // delete comment
  var comment_table_obj;
  $(document).on("click", ".btn-delete-comment", function () {
    let id = $(this).data('id');
    comment_table_obj = $(this).closest('.description').find('.comment');
    Swal.fire({
      icon: 'warning',
      title: 'Are you sure? to delete this!',
      html: 'If you want to permanently delete this comment please click OK, otherwise simply click cancel',

      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-delete-comment',
          method: 'POST',
          dataType: 'json',
          data: { id: id },
          success: function (data) {
            if (data.status === true) {
              toastr['success'](data.message, 'Delete Comment', {
                showMethod: 'slideDown',
                hideMethod: 'slideUp',
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
                timeOut: 2000,
              });
              comment_table_obj.DataTable().draw();
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Deleted operation failed!',
                html: 'The comment delete operation failed, please try again later.',
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }//ending if condition 

    });//ending swite alert
  });

  // Action or security setttings
  // operation block/unblock

  $(document).on("change click", ".switch-user-block, .btn-block", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if (id == "") {
      id = $(this).data("id");
    }
    if ($(this).is(":checked") || ($(this).data('request_for') != "" && $(this).data('request_for') === 'block')) {
      warning_title = 'Are you sure? to Block this user!';
      warning_msg = 'If you want to Block this User please click OK, otherwise simply click cancel'
      request_for = 'block'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Unblock this user!';
      warning_msg = 'If you want to Unblock this User please click OK, otherwise simply click cancel'
      request_for = 'unblock'
    }
    let data = { id: id, request_for: request_for };
    let request_url = '/admin/client-management/trader-admin-block-trader';
    confirm_alert(warning_title, warning_msg, request_url, data, 'Trader ' + request_for, datatable);

  })
  // enable / disable google 2 step authentication
  $(document).on("change", "#2-step-swtich", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if ($(this).is(":checked")) {
      warning_title = 'Are you sure? to Enable Google 2 setp!';
      warning_msg = 'If you want to Enable Google 2 step. please click OK, otherwise simply click cancel'
      request_for = 'enable'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Disable Google 2 setp!';
      warning_msg = 'If you want to Disable Google 2 step. please click OK, otherwise simply click cancel'
      request_for = 'disable'
    }
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,

      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-google-two-step',
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.status === true) {
              notify('success', data.message, 'Google 2 step');
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Deleted operation failed!',
                html: 'The comment delete operation failed, please try again later.',
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }
      else {
        if ($(this).is(":checked")) {
          $(this).prop('checked', false);
        }
        else if ($(this).is(":not(:checked)")) {
          $(this).prop('checked', true);
        }

      }

    });//ending swite alert
  })

  // Enable / Disable Email authentication
  $(document).on("change", "#email-a-swtich", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if ($(this).is(":checked")) {
      warning_title = 'Are you sure? to Enable Email Authentication!';
      warning_msg = 'If you want to Enable Email Authentication. please click OK, otherwise simply click cancel'
      request_for = 'enable'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Disable Email Authentication!';
      warning_msg = 'If you want to Disable Email Authentication. please click OK, otherwise simply click cancel'
      request_for = 'disable'
    }
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,

      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-email-auth',
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.status === true) {
              notify('success', data.message, 'Email Authentication');
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Email Authentication!',
                html: data.message,
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }
      else {
        if ($(this).is(":checked")) {
          $(this).prop('checked', false);
        }
        else if ($(this).is(":not(:checked)")) {
          $(this).prop('checked', true);
        }

      }

    });//ending swite alert
  })


  // Enable / Disable email verification
  $(document).on("change", "#email-v-switch", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if ($(this).is(":checked")) {
      warning_title = 'Are you sure? to Enable Email Verification!';
      warning_msg = 'If you want to Enable Email Verification. please click OK, otherwise simply click cancel'
      request_for = 'enable'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Disable Email Verification!';
      warning_msg = 'If you want to Disable Email Verification. please click OK, otherwise simply click cancel'
      request_for = 'disable'
    }
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,

      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-email-verification',
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.status === true) {
              notify('success', data.message, 'Email Verification');
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Deleted operation failed!',
                html: 'The comment delete operation failed, please try again later.',
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }
      else {
        if ($(this).is(":checked")) {
          $(this).prop('checked', false);
        }
        else if ($(this).is(":not(:checked)")) {
          $(this).prop('checked', true);
        }

      }

    });//ending swite alert
  })
  // Enable / Disable deposit operation
  $(document).on("change", "#deposit-switch", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if ($(this).is(":checked")) {
      warning_title = 'Are you sure? to Enable Deposit Operation!';
      warning_msg = 'If you want to Enable Deposit Operation. please click OK, otherwise simply click cancel'
      request_for = 'enable'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Disable Deposit Operation!';
      warning_msg = 'If you want to Disable Deposit Operation. Please click OK, otherwise simply click cancel'
      request_for = 'disable'
    }
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,

      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-deposit-operation',
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.status === true) {
              notify('success', data.message, 'Deposit Operation');
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Deposit operation!',
                html: data.message,
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }
      else {
        if ($(this).is(":checked")) {
          $(this).prop('checked', false);
        }
        else if ($(this).is(":not(:checked)")) {
          $(this).prop('checked', true);
        }

      }
    });//ending swite alert
  })

  // Enable / Disable withdraw operation
  $(document).on("change", "#withdraw-switch", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if ($(this).is(":checked")) {
      warning_title = 'Are you sure? to Enable Withdraw Operation!';
      warning_msg = 'If you want to Enable Withdraw Operation. please click OK, otherwise simply click cancel'
      request_for = 'enable'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Disable Withdraw Operation!';
      warning_msg = 'If you want to Disable Withdraw Operation. Please click OK, otherwise simply click cancel'
      request_for = 'disable'
    }
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,

      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-withdraw-operation',
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.status === true) {
              notify('success', data.message, 'Withdraw Operation');
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Withdraw Operation!',
                html: data.message,
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }
      else {
        if ($(this).is(":checked")) {
          $(this).prop('checked', false);
        }
        else if ($(this).is(":not(:checked)")) {
          $(this).prop('checked', true);
        }

      }
    });//ending swite alert
  })
  // Enable / Disable Internal transfer
  $(document).on("change", "#atw-stwitch", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).val();
    if ($(this).is(":checked")) {
      warning_title = 'Are you sure? to Enable Tranding account to wallet transfer!';
      warning_msg = 'If you want to Enable Tranding account to wallet transfer. please click OK, otherwise simply click cancel'
      request_for = 'enable'
    }
    else if ($(this).is(":not(:checked)")) {
      warning_title = 'Are you sure? to Disable Tranding account to wallet transfer!';
      warning_msg = 'If you want to Disable Tranding account to wallet transfer. Please click OK, otherwise simply click cancel'
      request_for = 'disable'
    }
    Swal.fire({
      icon: 'warning',
      title: warning_title,
      html: warning_msg,
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning',
        cancelButton: 'btn btn-danger'
      },
      closeOnCancel: false,
      closeOnConfirm: false,
    }).then((willDelete) => {
      if (willDelete.isConfirmed) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/admin/client-management/trader-admin-internal-transfer',
          method: 'POST',
          dataType: 'json',
          data: { id: id, request_for: request_for },
          success: function (data) {
            if (data.status === true) {
              notify('success', data.message, 'Internal Transfer');
            } else {
              Swal.fire({
                icon: 'danger',
                title: 'Internal Transfer!',
                html: data.message,
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          }
        })

      }
      else {
        if ($(this).is(":checked")) {
          $(this).prop('checked', false);
        }
        else if ($(this).is(":not(:checked)")) {
          $(this).prop('checked', true);
        }

      }
    });//ending swite alert
  });

  // set category to traders
  $(document).on("click", "#save-category", function () {
    let id = $(this).data('id');
    let category = $(this).closest('.row').find('select').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/admin/client-management/trader-admin-set-category',
      method: 'POST',
      dataType: 'json',
      data: { id: id, category: category },
      success: function (data) {
        if (data.status === true) {
          notify('success', data.message, 'Set Category')
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Set Category!',
            html: (data.hasOwnProperty('message')) ? data.message : data.errors.category,
            customClass: {
              confirmButton: 'btn btn-danger'
            }
          });
        }
      }
    })
  });

  //Reset passsword
  $(document).on("click", ".reset-password-btn", function () {
    let id = $(this).data('id');
    let $request_url = '/admin/client-management/trader-admin-reset-password';
    let data = { trader_id: id, };
    let $url = '/admin/client-management/trader-admin-reset-password-mail/' + id;
    confirm_alert('Reset Trader Password', 'Are you confirm reset trader password', $request_url, data, 'Reset password', true, $url);
  });

  //Reset transaction pin
  $(document).on("click", ".transaction-pin-reset", function () {
    let id = $(this).data('id');
    let $request_url = '/admin/client-management/trader-admin-reset-transaction-pin';
    let data = { trader_id: id };
    let $url = '/admin/client-management/trader-admin-reset-transaction-pin-mail/' + id;
    confirm_alert('Reset Trader Transaction Pin', 'Are you confirm reset transaction pin', $request_url, data, 'Transaction pin reset', true, $url);
  });
  // get user data for update
  // user profile---------------------------------------------------------
  $(document).on("click", ".btn-update-profile", function () {
    let user_id = $(this).data('user');
    $.ajax({
      url: '/admin/client-management/get-user-info/' + user_id,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        $("#update-profile").find('#name').val(data.name);
        $("#update-profile").find('#email').val(data.email);
        $("#update-profile").find('#phone').val(data.phone);
        $('#update-profile').find('#country option[value="' + data.country_id + '"]').prop('selected', true);
        $("#update-profile").find('#appr-investment').val(data.app_investment);
        $("#update-profile").find('#city').val(data.city);
        $("#update-profile").find('#state').val(data.state);
        $("#update-profile").find('#zip-code').val(data.zip_code);
        $("#update-profile").find('#address').val(data.address);
        $("#update-profile").find('#trading-ac-limit').val(data.trading_ac_limit);
        $("#update-profile").find('#transaction-pin').val(data.transaction_password);
        $("#update-profile").find('#password').val(data.password);
        $("#update-profile").find('#user-id').val(data.user_id);
      }
    });
    $("#update-profile").modal("show");
  })

  // get user id for DESK MANAGER/ and open modal
  // ASSIGN DESK MANAGER---------------------------------------------------------
  $(document).on("click", ".btn-desk-manager", function () {
    let user_id = $(this).data('user');
    $('#assign-to-desk-manager').find('.trader-id-for-manager').val(user_id);
    $("#assign-to-desk-manager").modal("show");
  })

  // toushspin min max----------------------------------------------------
  var touchspinValue = $('.touchspin-min-max'),
    counterMin = 0,
    counterMax = 50;
  if (touchspinValue.length > 0) {
    touchspinValue
      .TouchSpin({
        min: counterMin,
        max: counterMax,
        buttondown_txt: feather.icons['minus'].toSvg(),
        buttonup_txt: feather.icons['plus'].toSvg()
      })
      .on('touchspin.on.startdownspin', function () {
        var $this = $(this);
        $('.bootstrap-touchspin-up').removeClass('disabled-max-min');
        if ($this.val() == counterMin) {
          $(this).siblings().find('.bootstrap-touchspin-down').addClass('disabled-max-min');
        }
      })
      .on('touchspin.on.startupspin', function () {
        var $this = $(this);
        $('.bootstrap-touchspin-down').removeClass('disabled-max-min');
        if ($this.val() == counterMax) {
          $(this).siblings().find('.bootstrap-touchspin-up').addClass('disabled-max-min');
        }
      });
  }

  // find desk manager----------------------------------------------
  $("#desk-manager-email").val("");
  $(document).on('blure keyup', "#desk-manager-email", function () {
    let email = $(this).val();
    $.ajax({
      url: '/admin/client-management/get-desk-manager/' + email,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        if (data.status == true) {
          $("#assign-to-desk-manager").find('.desk-manager-info').find(".not-found-msg").slideUp();
          $("#assign-to-desk-manager").find('.desk-manager-info').find(".tbl-manager-info").slideDown();
          $("#assign-to-desk-manager").find('#desk-m-name').text(data.desk_manager_info.name)
          $("#assign-to-desk-manager").find('#desk-m-email').text(data.desk_manager_info.email)
          $("#assign-to-desk-manager").find('#desk-m-phone').text(data.desk_manager_info.phone)
          $("#assign-to-desk-manager").find('#desk-m-country').text(data.desk_manager_info.country)
          $("#assign-to-desk-manager").find('#desk-m-group').text(data.desk_manager_info.group_name)
          // enable submit button
          $("#btn-assign-desk-manager").prop('disabled', false);
        }
        if (data.status == false) {
          $("#assign-to-desk-manager").find('.desk-manager-info').find(".not-found-msg").text(data.message).slideDown();
          $("#assign-to-desk-manager").find('.desk-manager-info').find(".tbl-manager-info").slideUp();
          // disable submit button
          $("#btn-assign-desk-manager").prop('disabled', true);
        }
      }
    });
  })
  // end desk manager----------------------------------------------
  // get user id for account MANAGER/ and open modal
  // ASSIGN account MANAGER---------------------------------------------------------
  $(document).on("click", ".btn-account-manager", function () {
    let user_id = $(this).data('user');
    $('#assign-to-account-manager').find('.trader-id-for-manager').val(user_id);
    $("#assign-to-account-manager").modal("show");
  })

  // find account manager----------------------------------------------
  $("#desk-manager-email").val("");
  $(document).on('blure keyup', "#account-manager-email", function () {
    let email = $(this).val();
    $.ajax({
      url: '/admin/client-management/get-account-manager/' + email,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        if (data.status == true) {
          $("#assign-to-account-manager").find('.account-manager-info').find(".not-found-msg").slideUp();
          $("#assign-to-account-manager").find('.account-manager-info').find(".tbl-manager-info").slideDown();
          $("#assign-to-account-manager").find('#account-m-name').text(data.account_manager_info.name)
          $("#assign-to-account-manager").find('#account-m-email').text(data.account_manager_info.email)
          $("#assign-to-account-manager").find('#account-m-phone').text(data.account_manager_info.phone)
          $("#assign-to-account-manager").find('#account-m-country').text(data.account_manager_info.country)
          $("#assign-to-account-manager").find('#account-m-group').text(data.account_manager_info.group_name)
          // enable submit button
          $("#btn-assign-account-manager").prop('disabled', false);
        }
        if (data.status == false) {
          $("#assign-to-account-manager").find('.account-manager-info').find(".not-found-msg").text(data.message).slideDown();
          $("#assign-to-account-manager").find('.account-manager-info').find(".tbl-manager-info").slideUp();
          // disable submit button
          $("#btn-assign-account-manager").prop('disabled', true);
        }
      }
    });
  })
  // end account manager----------------------------------------------

  // resent verification email------------------------------------------
  $(document).on("click", ".btn-resent-verification-email", function () {
    let trader_id = $(this).data('user');
    var close_time;
    Swal.fire({
      title: 'Verification Email',
      text: 'Are You Confirm to send verification email',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Send Email',
      showLoaderOnConfirm: true,
      preConfirm: (login) => {
        $(".swal2-html-container").text("We Sending Email, Please Wait.....")
        return fetch(`/admin/client-management/resent-verification-email/` + trader_id)
          .then(response => {
            if (!response.ok) {
              throw new Error(response.statusText)
            }
            return response.json()
          })
          .catch(error => {
            Swal.showValidationMessage(
              `Request failed: ${error}`
            )
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      console.log(result);
      if (result.isConfirmed) {
        if (result.value.status == false) {
          toastr['error'](result.value.message, 'Verification Email', {
            showMethod: 'slideDown',
            hideMethod: 'slideUp',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            timeOut: 2000,
          });
        } else {
          toastr['success'](result.value.message, 'Verification Email', {
            showMethod: 'slideDown',
            hideMethod: 'slideUp',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            timeOut: 2000,
          });
        }

      }
    })
  })
  // END: resent verfication email--------------------------------------

  // send welcome mail------------------------------------------
  $(document).on("click", ".btn-send-welcome-mail", function () {
    let trader_id = $(this).data('user');
    var close_time;
    Swal.fire({
      title: 'Welcome Email',
      text: 'Are You Confirm to send welcome mail ?',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Send Email',
      showLoaderOnConfirm: true,
      preConfirm: (login) => {
        $(".swal2-html-container").text("We Sending Email, Please Wait.....")
        return fetch(`/admin/client-management/send-welcome-email/` + trader_id)
          .then(response => {
            if (!response.ok) {
              throw new Error(response.statusText)
            }
            return response.json()
          })
          .catch(error => {
            Swal.showValidationMessage(
              `Request failed: ${error}`
            )
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      console.log(result);
      if (result.isConfirmed) {
        if (result.value.status == false) {
          notify('error', data.value.message, 'Welcome Email');
        } else {
          notify('success', data.value.message, 'Welcome Email');
        }
      }
    })
  })
  // END: send welcome mail--------------------------------------

  // finance report--------------------------------------------
  $(document).on("click", '.btn-finance-report', function () {
    let id = $(this).data('user');
    $.ajax({
      url: '/admin/client-management/finance-report/' + id,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        $("#total-deposit-amount").find('span').html(data.total_deposit_amount);
        $("#total-deposit-counter").find('span').html(data.total_deposit_counter);
        $("#total-rec-fund-amount").find('span').html(data.total_rec_fund_amount);
        $("#total-rec-fund-counter").find('span').html(data.total_rec_fund_counter);
        $("#total-up-balance-amount").find('span').html(data.total_up_balance_amount);
        $("#total-up-balance-counter").find('span').html(data.total_up_balance_counter);
        $("#total-dc-balance-amount").find('span').html(data.total_dc_balance_amount);
        $("#total-dc-balance-counter").find('span').html(data.total_dc_balance_counter);
        $("#total-withdraw-amount").find('span').html(data.total_withdraw_amount);
        $("#total-withdraw-counter").find('span').html(data.total_withdraw_counter);
        $("#total-pending-withdraw-amount").find('span').html(data.total_pending_withdraw_amount);
        $("#total-pending-withdraw-counter").find('span').html(data.total_pending_withdraw_counter);
        $("#total-send-fund-amount").find('span').html(data.total_send_fund_amount);
        $("#total-send-fund-counter").find('span').html(data.total_send_fund_counter);
        $("#total-ib-balance-amount").find('span').html(data.total_ib_balance_amount);
        $("#total-ib-balance-counter").find('span').html(data.total_ib_balance_counter);
        $("#total-current-balance").find('span').html(data.total_current_balance);
      }
    });
    $("#finance-report").modal('show');
  })
  // ending finance report---------------------------------------

  // trader registrations*********************************************
  // get account category data for registrations------------------------------------
  $(document).on("change", "#server", function () {
    let server = $(this).val();
    $.ajax({
      url: '/admin/client-management/get-client-type/' + server,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        $("#client-type").html(data);
        $("#client-type").data('server', server);
      }
    });
  })
  // end: get account category data------------------------------------------
  // get client group data for registrations------------------------------------
  $(document).on("change", "#client-type", function () {
    let server = $(this).val();
    let client_type = $(this).data('server');
    $.ajax({
      url: '/admin/client-management/get-client-groups/' + client_type + '/meta-server/' + server,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        $("#account-type").html(data.client_groups);
        $("#leverage").html(data.leverage);
      }
    });
  })
  // end: get client group data------------------------------------------



});
