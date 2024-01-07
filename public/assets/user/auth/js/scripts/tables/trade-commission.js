
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
     //  fetch datatable data-----------------------
     var trade_report = dt_fetch_data(
         '/admin/manage-trade/trade-commission-status-dt/dt',
         [
             { "data": 'trade' },
             { "data": 'login' },
             { "data": 'trader_email' },
             { "data": 'ib_email' },
             { "data": 'symbol' },
             { "data": 'profit' },
             { "data": 'open_time' },
             { "data": 'close_time' },
             { "data": 'volume' },
             { "data": 'commission' },
         ],
         true,
         true
     )
 
 });
 // load total traders and total volume----------------------------------
$(document).ready(function () {
    // get total data----------
    $.ajax({
        url: '/admin/manage-trade/trade-commission-status-dt/total',
        dataType: 'json',
        type: 'get',
        success: function (data) {
            $(".total-trade").html(data.total_trades);
            $(".total-closed").html(data.total_closed);
            $("#total-volume").html(data.total_volume);
        }
    });
    // get total by filter
    // get total data----------
    $(document).on("click", "#btn-filter, #btn-reset", function () {
        let form_data =$("#filter-form").serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/manage-trade/trade-commission-status-total',
            dataType: 'json',
            type: 'post',
            data:form_data,
            success: function (data) {
                $(".total-trade").html(data.total_trades);
                $(".total-closed").html(data.total_closed);
                $("#total-volume").html(data.total_volume);
            }
        });
    })
})
 