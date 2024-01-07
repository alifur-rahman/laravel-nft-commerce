
    $(document).ready(function(){
   
        var dt = $('#kyc_report_tbl').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching":false,
            "lengthChange":true,
            "buttons": true,
            "dom": 'B<"clear">lfrtip',
                buttons: [
                {
                    extend: 'csv',
                    text: 'csv',
                    className: 'btn btn-success btn-sm',
                    action: serverSideButtonAction
                },
                {
                    extend: 'copy',
                    text: 'Copy',
                    className: 'btn btn-success btn-sm',
                    action: serverSideButtonAction
                },
                {
                    extend: 'excel',
                    text: 'excel',
                    className: 'btn btn-warning btn-sm',
                    action: serverSideButtonAction
                },
                {
                    extend: 'pdf',
                    text: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    action: serverSideButtonAction
                }
            ],
            "ajax": {
                

                "url": "/admin/kyc-management/kyc-report?op=data_table",
                "data": function (d) {
                      return $.extend( {}, d, {
                        "from": $("#from").val(),
                        "to": $("#to").val(),
                        "type": $("#type").val(),
                        "status":$("#status").val(),
                        "client_type":$("#client_type").val(),
                        "info":$("#info").val(),
                        "issue_from":$("#issue_from").val(),
                        "issue_to":$("#issue_to").val(),
                        "expire_from":$("#expire_from").val(),
                        "expire_to":$("#expire_to").val(),
                        "manager_email":$("#manager_email").val(),
                        "ib_email":$("#ib_email").val(),

                      });
                    }
            },
   
            "columns": [
                { "data": "client_name" },
                { "data": "client_type" },
                { "data": "document_type" },
                { "data": "issue_date" },
                { "data": "expire_date" },
                { "data": "status" },
                { "data": "date" },
                { "data": "action" },
                
            ],
            "columnDefs": [ {
                "targets": 7,
                "orderable": false
                } ],
            
            "drawCallback": function( settings ) {
                $("#filterBtn").html("FILTER");
            }
        });
        $('#filterBtn').click(function (e) {
            dt.draw();
        });
   
    });

/*<--------------Datatable export function Start----------------->*/ 
$(document).on("change","#fx-export",function () {
  if ($(this).val()==='csv') {
    $(".buttons-csv").trigger('click');
  }
  if ($(this).val()==='excel') {
    $(".buttons-excel").trigger('click');
  }
  
});
function serverSideButtonAction(e, dt, node, config) {

    var me = this;
    var button = config.text.toLowerCase();
    if (typeof $.fn.dataTable.ext.buttons[button] === "function") {
        button = $.fn.dataTable.ext.buttons[button]();
    }
    var len = dt.page.len();
    var start = dt.page();
    dt.page(0);

    dt.context[0].aoDrawCallback.push({
        "sName": "ssb",
        "fn": function () {
            $.fn.dataTable.ext.buttons[button].action.call(me, e, dt, node, config);
            dt.context[0].aoDrawCallback = dt.context[0].aoDrawCallback.filter(function (e) { return e.sName !== "ssb" });
        }
    });
    dt.page.len(999999999).draw();
    setTimeout(function () {
        dt.page(start);
        dt.page.len(len).draw();
    }, 500);
}
 
/*<--------------Datatable export function End----------------->*/ 


/*<---------For reset button script-------------->*/
  $(document).ready(function () {
    $("#resetBtn").click(function () {
        $("#filterForm")[0].reset();
        $('#type').prop('selectedIndex', 0).trigger("change");
        $('#verification_status').prop('selectedIndex', 0).trigger("change");
        $('#status').prop('selectedIndex', 0).trigger("change");
        $('#client_type').prop('selectedIndex', 0).trigger("change");
    });
});



// User Description view
function view_document(e){
    let obj = $(e);
    var id=obj.data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          url : '/admin/kyc-management/kyc-report-view-descrption/'+id,
          method: 'GET',
          dataType : 'json',
          success:function (data) {
            // console.log(data);
            var issue_date = new Date(data.user_info.issue_date).toLocaleString();
            issue_date = new Date(issue_date).toLocaleDateString();

            var exp_date=new Date(data.user_info.exp_date).toLocaleString();
            exp_date=new Date(exp_date).toLocaleDateString();

            var dob=new Date(data.user_info.date_of_birth).toLocaleString();
            dob=new Date(dob).toLocaleDateString();

              
            var backPart=`/${data.image}/${data.document.back_part}`;
            // console.log(backPart);
            $('#backpart_part').attr("src",backPart);
         
            var frontPart=`/${data.image}/${data.document.front_part}`
            // console.log(frontPart);
            $('#front_part').attr("src",frontPart);

            $('#user-status').html(data.status);
            $('#user-name').text(data.user_info.name);
            $('#user-email').text(data.user_info.email);
            $('#user-phone').text(data.user_info.phone);
            $('#user-city').text(data.user_info.city);
            $('#user-state').text(data.user_info.state);
            $('#user-address').text(data.user_info.address);
            $('#user-zip-code').text(data.user_info.zip_code);
            $('#user-issue_date').text(issue_date);
            $('#user-exp_date').text(exp_date);
            $('#user-doc_type').text(data.user_info.doc_type);
            $('#user-country').text(data.user_country.name);
            $('#user-dob').text(dob);
            $('#user-issuer-country').text(data.user_country.name);
            
            
          }
        });
     }
   
