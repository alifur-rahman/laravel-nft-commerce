/**
 * @param {string} request_url The table request url
 * @param {object} collumns The table request url with id
 * @param {boolean} filter The table data filter or not
 * @param {object} filter_input The filter inputs data
 * @param {boolean} csv_export The table data export or not
 * @param {Array} exportable_col whose collumns are export
 */
// function for serialize object
$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
// function for datatable------------------------------------
function dt_fetch_data(request_url, collumns, filter = true, icon =true, csv_export = false, exportable_col=null,total=null, length_change =false,o_Language=false,search=false) {
    var lang = null;
if (o_Language) {
    lang = {
        previous: "<",
        next: ">",
    };
}
else{
    lang = {
        previous: "prev",
        next: "next",
    };
}
    var isRtl = $('html').attr('data-textdirection') === 'rtl';

    var dt_ajax_table = $('.datatables-ajax'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }
    var datatable;
    if (dt_ajax_table.length) {

        if (icon==true) {
            feather.replace();
        }
        var cd = (new Date()).toISOString().split('T')[0];
        datatable = dt_ajax_table.DataTable({
            "processing": true,
            "serverSide": true,
            "searching": search,
            "lengthChange": length_change,
            "buttons": csv_export,
            "dom": 'B<"clear">lfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: 'csv',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: exportable_col
                    },
                    action: serverSideButtonAction
                },
                {
                    extend: 'excel',
                    text: 'excel',
                    className: 'btn btn-warning btn-sm',
                    exportOptions: {
                        columns: exportable_col
                    },
                    action: serverSideButtonAction
                },
            ],
            "ajax": {
                "url": request_url,
                "data": function (d) {
                    return $.extend({}, d, (filter == true) ? $("#filter-form").serializeObject() : {});
                }
            },

            "columns": collumns,
            "columnDefs": [{
                // "targets": 5,
                "orderable": false
            }],
            "order": [[1, 'desc']],
            oLanguage: {
                "sLengthMenu": "\_MENU_",
                "sSearch": ""
            },
            language: {
                paginate: lang,
            },
            "drawCallback": function (settings) {
                var rows = this.fnGetData();
                if (rows.length !== 0) {
                    if (icon == true) {
                        feather.replace();
                    }
                    
                }
                if (total != null) {
                    for (let i = 1; i <=total; i++) {
                        $("#total_"+i).html('$'+settings.json.total[i-1]);
                    }
                }
            }
        });
        // Filter operation
        $("#btn-filter").on("click", function () {
            datatable.draw();
        });
        // reset operation
        $("#btn-reset").on("click", function (e) {
            $("#filter-form").find("select").val('').change();
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

    // return datatable;
    return datatable;
}
// funcation for datatable description
/**
 * @param {string} table_class The identifiacation of table
 * @param {string} request_url The table request url
 * @param {boolean} with_id The table request url with id
 */
function dt_description(table_class = null, request_url, with_id = false) {
    $(document).on("click", ".dt-description", function (params) {
        let __this = $(this);
        var $url;
        if (with_id == true) {
            let trader_id = $(this).data('id');
            $url = request_url + trader_id;
        }
        else {
            $url = request_url;
        }
        $.ajax({
            type: "GET",
            url: $url,
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
                    }
                }
            }
        })
    });
}

// functions for get user data
/**
 * @param {string} type Get the user type
 * @param {string} id Get user ID
 * @param {string} form_id Get user form
 * @param {string} date_id Get user form
 */
function get_form(type, id, form_id, date_id = null) {
    var form_id_local = "#" + form_id;
    var form_date_id = "#" + date_id;
    $.ajax({
        type: "GET",
        url: '/admin/admin-management/user-get-form/' + type + '/user/' + id,
        dataType: 'json',
        success: function (data) {
            if (data.status == true) {
                $(form_id_local).html(data.form);
                if (date_id != null) {
                    $(form_date_id).val(data.date);
                }
            }
            else {
                $(form_id_local).html(data.message);
            }
        }
    });
}