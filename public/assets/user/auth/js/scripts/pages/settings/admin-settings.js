(function (window, document, $) {
    var dt_cp_settings;
    dt_cp_settings = $('#currency-pair-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "retrieve": true,
        "paging": false,
        "lengthChange": true,
        "buttons": true,
        "dom": 'B<"clear">lfrtip',
        "ajax": {
            "url": "/admin/settings/currency-pair-get",
            "data": function (d) {
                return $.extend({}, d, {
                    "symbol": $("#symbol").val(),
                    "title": $("#title").val(),
                    "ib_rebate": $("#ib_rebate").val(),
                    "active_status": $("#active_status").val(),
                });
            }
        },
        "columns": [
            { "data": "serial" },
            { "data": "symbol" },
            { "data": "title" },
            { "data": "ib_rebate" },
            { "data": "active_status" },
            { "data": "action" },
        ],

        "drawCallback": function (settings) {
            $("#filterBtn").html("FILTER");
            var rows = this.fnGetData();
            if (rows.length !== 0) {
                feather.replace();
            }
        }
    });
    $('#filterBtn').click(function (e) {
        dt_cp_settings.draw();
    });

    // currency pair add
    $(document).on("submit", "#currency-pair-form", function (event) {
        let form_data = new FormData(this);
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/settings/currency-pair-add",
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                if (data.status == false) {
                    let $errors = '';
                    if (data.errors.hasOwnProperty('symbol')) {
                        $errors += "  " + data.errors.symbol[0] + '<br>';
                    }
                    if (data.errors.hasOwnProperty('title')) {
                        $errors += "  " + data.errors.title[0] + '<br>';
                    }
                    if (data.errors.hasOwnProperty('ib_rebate')) {
                        $errors += "  " + data.errors.ib_rebate[0] + '<br>';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error found!',
                        html: $errors,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
                if (data.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Updated",
                        html: data.message,
                        customClass: {
                            confirmButton: "btn btn-success"
                        }
                    }).then((willDelete) => {
                        dt_cp_settings.draw();
                    });
                }
            }
        });
    });  //END: click function 

    // currency pair delete action
    $(document).on("click", "#currency-pair-delete", function (event) {
        let id = $(this).data('id');
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/settings/currency-pair-delete",
            dataType: "json",
            data: { 'id': id },
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                if (data.status == false) {
                    Swal.fire({
                        icon: "error",
                        title: "Error found!",
                        html: $errors,
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    });
                }
                if (data.status == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        html: data.message,
                        customClass: {
                            confirmButton: "btn btn-success"
                        }
                    }).then((willDelete) => {
                        dt_cp_settings.draw();
                    });
                }
            }
        });
    });  //END: click function 
})(window, document, jQuery);