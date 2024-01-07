$(function () {

  // Roles Datatable
  /*********************************************************** */
  var cd = (new Date()).toISOString().split('T')[0];
  var datatable = $('#admin-datatable').DataTable({
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
      "url": "/admin/admin-management/get-all-admins",
    },
    "columns": [
      { "data": "name" },
      { "data": "group" },
      { "data": "country" },
      { "data": "status" },
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

  //    datatable descriptions
  // --------------------------------------------------------------------------------------------------------
  $(document).on("click", ".dt-description", function (params) {
    let __this = $(this);
    let admin_id = $(this).data('id');
    $.ajax({
      type: "GET",
      url: '/admin/admin-management/get-all-admin-description/' + admin_id,
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
            if ($(__this).closest('tr').next('.description').find('.accessible-user').length) {
              $(__this).closest('tr').next('.description').find('.accessible-user').DataTable().clear().destroy();
              var cd = (new Date()).toISOString().split('T')[0];
              var users = $(__this).closest('tr').next('.description').find('.accessible-user').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                paging: false,
                "dom": 'Bfrtip',
                "ajax": { "url": "/admin/admin-management/get-all-admin-description-users/" + admin_id },
                "columns": [
                  { "data": "available_right" },
                  { "data": "permission_1" },
                  { "data": "permission_2" },
                  { "data": "permission_3" },
                  { "data": "permission_4" },
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

  // get data into edit offcanvas
  $(document).on("click", ".edit-group", function () {
    $("#group_id").val($(this).data('id'));
    $("#group-name-edit").val($(this).data('name'));
  })

  // select all rights---------------------------------------------
  $(document).on('change', '.select-all-right', function () {
    if ($(this).is(':checked')) {
      $(this).closest('tr').find('.form-check-input').each(function (index, $this) {
        $($this).prop('checked', true);
      });
    }
    else {
      $(this).closest('table').find('.form-check-input').each(function (index, $this) {
        $($this).prop('checked', false);
      });
    }
  });
  // checked all permission for this rights
  // ----------------------------------------------------------------
  $(document).on('change', ".role-checkbox", function () {
    if ($(this).is(":checked")) {
      $(this).closest('tr').find('.form-check-input').each(function (index, $this) {
        $($this).prop('checked', true);
      });
    }
    else {
      $(this).closest('tr').find('.form-check-input').each(function (index, $this) {
        $($this).prop('checked', false);
      });
    }
  });

  /// block unblock-------------------------------------------------
  $(document).on("change click", ".btn-block", function () {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = $(this).data('id');
    console.log(id);
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
    confirm_alert(warning_title, warning_msg, request_url, data, 'User ' + request_for, datatable);
  })
  // update modal open-------------------
  $(document).on("click", '.btn-edit-admin', function () {
    let id = $(this).data('id');
    
    get_form('admin',id,"admin-update-form-field","fp-human-friendly");
    $("#modal-update-admin").modal("show");
  })
});