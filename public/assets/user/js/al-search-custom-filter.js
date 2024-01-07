$(document).on("click", ".report-tab", function () {
    $(this).closest(".card-body").find(".report-details").slideToggle();
    $(this).find(".toogle-hide").slideToggle();
    $(this).find(".toogle-show").slideToggle();
});

function resetLimit() {
    $("#start").val(0);
    // this.prop('disabled', ture);
}

// for report data
$(document).ready(function () {
    var url = $("#report-form").attr("action");
    var searchKey = '&keyword='+searchKeyword;
    var data = $("#report-form").serialize()+searchKey;
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (data) {
            ReportCallback(data);
        },
    });
});
 
 



function ReportCallback(data) {
    start_load = false;
    last_ws = 0;
    if (data.html != "") {
        $(".filter_report").html(data.html);
        $("#start").val($(".total_report").length);
        $(".reportLoading").hide();
        $(".not_found").hide();
    } else {
        $(".filter_report").html(data.html);
        $("#start").val($(".total_report").length);
        $(".not_found").show();
    }
    $("#ReportBtn").prop("disabled", false);
} 
 