
$(function () {
  // data table ib commission structure
  // ------------------------------------------------------------------------------
  let ib_level = $("#add-ib-commission-structure").data('ib_level');
  let columns = [
    { "data": "currency" },
    { "data": "timing" },
    { "data": "total" },
    { "data": "actions" },
  ];
  var last_lement;
  if (columns.length > 1) {
    last_lement = columns.pop();
    for (let i = 1; i <= ib_level; i++) {
      columns.push({ "data": "level_" + i });
    }
  }
  columns.push(last_lement);

  var cd = (new Date()).toISOString().split('T')[0];
  var commission_datatable = $('#ib-commission-structure').DataTable({
    "processing": true,
    "serverSide": true,
    "searching": false,
    "lengthChange": false,
    "ordering": false,
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
      "url": "/admin/ib-management/ib-commission-structure-dt",
    },
    "columns": columns,
    "order": [[1, 'desc']],
    "drawCallback": function (settings) {
      var rows = this.fnGetData();
      if (rows.length !== 0) {
        feather.replace();
      }
    }
  });

  // create form field
  // ------------------------------------------------------
  $(document).on("click", "#add-ib-commission-structure", function () {
    let ib_level = $(this).data('ib_level');
    $("#ib-com-field").slideDown();
  })
  // END: Create form field

  // START: Delete form field
  // ----------------------------------------------------------------------------
  $(document).on('click', '.btn-delete-form-field', function () {
    $("#ib-com-field").slideUp();
  })
  // edit ib commission structure------------------------------------------------------------
  $(document).on("click", ".edit-ib-commission-structure", function () {
    let ib_level = $(this).data('ib_level');
    let id_commission = $(this).data('commission');
    let ib_symbol = $(this).data('symbol');
    let ib_timing = $(this).data('timing');
    let id = $(this).data('id');

    $("#symbol").val(ib_symbol);
    $("#fp-time").val(ib_timing);
    $("#structure-id").val(id);
    $("#structure-op").val('edit');
    $("#ib-com-field").slideDown();
  });

  // delete ib commission structure-----------------------------------------
  $(document).on('click', ".btn-delete", function () {
    let request_url = '/admin/ib-management/ib-commission-structure-delete';
    let data = { id: $(this).data('id') }
    confirm_alert('Are you confirm to delete? commission structure.', 'If you wnat to permanantly delete this please click ok', request_url, data, 'Commision Structure delete', commission_datatable);
  })
  // enable disable ib commission structure---------------------------------
  $(document).on('click', ".btn-enable-disable", function () {
    let request_url = '/admin/ib-management/ib-commission-structure-block-unblock';
    let data = { id: $(this).data('id'), request_for: $(this).data('request_for') }
    confirm_alert('Are you confirm to ' + $(this).data('request_for') + '? commission structure.', 'If you wnat to  enable/disable this please click ok', request_url, data, 'Commision Structure ' + $(this).data('request_for'), commission_datatable);
  })
});