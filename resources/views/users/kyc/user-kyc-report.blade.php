@extends('layouts.users.user-layout')
@section('title','KYC Report')
@section('custom-css')
<!-- Datatable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<style>
/* table.dataTable>tbody>tr {
    background-color: #f8f9fa;
} */
ul li {
    font-size: var(--font-size-b1);
    line-height: var(--line-height-b1);
    margin-top: 0px;
    margin-bottom: 10px;
    color: var(--color-body);
}
</style>

@endsection
@section('content')
<div class="rn-upcoming-area rn-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- start Table Title -->
                <div class="table-title-area d-flex">
                    <i data-feather="briefcase"></i>
                    <h3>KYC Report</h3>
                </div>
                <!-- End Table Title -->

                <!-- table area Start -->
                <div class="box-table table-responsive">
                    <table class="table upcoming-projects" id="kyc_report_tbl">
                        <thead>
                            <tr>
                                <th>
                                    <span>Client Name</span>
                                </th>
                                <th>
                                    <span>Client Type</span>
                                </th>
                                <th>
                                    <span>Document Type</span>
                                </th>
                                <th>
                                    <span>Issue Date</span>
                                </th>
                                <th>
                                    <span>Expire Date</span>
                                </th>
                                <th>
                                    <span>STATUS</span>
                                </th>
                                <th>
                                    <span>DATE</span>
                                </th>
                                <th>
                                    <span>ACTION</span>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--begin::Modal - Upgrade plan-->
<div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-xl">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header justify-content-end border-0 pb-0">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h3 class="mb-3" style="color: black">User Proof</h3>
                </div>
                <!--end::Heading-->
                <!--begin::Plans-->
                <div class="d-flex flex-column">
                    <!--begin::Nav group-->
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Front Part</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Back Part</button>
                        </li>
                      </ul>
                    <!--end::Nav group-->
                    <!--begin::Row-->
                    <div class="row mt-10">
                        <!--begin::Col-->
                        <div class="col-lg-8 mb-10 mb-lg-0">
                            <!--begin::Tabs-->
                            <div class="nav flex-column">
                                <!--begin::Tab link-->
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="geeks" style="height: 100%; width: 100%;">
                                            <img id="front_part" class="img-thumbnail" src="{{asset('admin-assets/driver_license.png')}}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="geeks" style="height: 100%; width: 100%;">
                                            <img id="backpart_part" class="img-thumbnail" src="{{asset('admin-assets/driver_license.png')}}">
                                        </div>
                                    </div>
                                  </div>
                                <!--end::Tab link-->
                            </div>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <!--begin::Tab content-->
                            <div class="tab-content rounded h-100 bg-light p-10">
                                <!--begin::Tab Pane-->
                                <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
                                    <!--begin::Heading-->
                                    <div class="pb-5">
                                        <h2 class="fw-bold text-dark">User Description</h2>

                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        <ul class="list-group list-group-circle text-start fw-bold" style="margin-left: 45px;">
                                            <li>Name: <span class="text-primary" id="user_name"></span></li>
                                            <li>Email : <span class="text-primary" id="user-email"> </li>
                                            <li>Country : <span class="text-primary" id="user-country"></li>
                                            <li>Address : <span class="text-primary" id="user-address"></span></li>
                                            <li>City : <span class="text-primary" id="user-city"></li>
                                            <li>State : <span class="text-primary" id="user-state"></span></li>
                                            <li>Phone : <span class="text-primary" id="user-phone"></li>
                                            <li>Zip : <span class="text-primary" id="user-zip-code"></li>
                                            <li>Date Of Birth : <span class="text-primary" id="user-dob"> </li>
                                            <li>Status : <span id="user-status"> </span></li>
                                        </ul>
                                        <hr />
                                        <ul class="list-group list-group-circle text-start fw-bold" style="margin-left: 45px;">
                                            <li>Issue Date : <span class="text-primary" id="user-issue_date"> </li>
                                            <li>Expire Date : <span class="text-primary" id="user-exp_date"></li>
                                            <li>Document Type : <span class="text-primary" id="user-doc_type"></li>
                                            <li>Issuer Country : <span class="text-primary" id="user-issuer-country"></li>
                                        </ul>
                                    </div>
                                    <!--end::Body-->
                                </div>

                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Plans-->
                <!--begin::Actions-->
                <div class="d-flex justify-content-center">
                    <button type="reset" class="btn btn-danger me-3" data-bs-dismiss="modal">Discard</button>
                    {{-- <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Upgrade Plan</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button> --}}
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Upgrade plan-->
@endsection
@section('custom-js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>

   $(document).ready(function(){

   var dt = $('#kyc_report_tbl').DataTable( {
       "processing": true,
       "serverSide": true,
       "searching":false,
       "lengthChange":true,
       // "buttons": true,
       // "dom": 'B<"clear">lfrtip',
       //     buttons: [
       //     {
       //         extend: 'csv',
       //         text: 'csv',
       //         className: 'btn btn-success btn-sm',
       //         action: serverSideButtonAction
       //     },
       //     {
       //         extend: 'copy',
       //         text: 'Copy',
       //         className: 'btn btn-success btn-sm',
       //         action: serverSideButtonAction
       //     },
       //     {
       //         extend: 'excel',
       //         text: 'excel',
       //         className: 'btn btn-warning btn-sm',
       //         action: serverSideButtonAction
       //     },
       //     {
       //         extend: 'pdf',
       //         text: 'pdf',
       //         className: 'btn btn-danger btn-sm',
       //         action: serverSideButtonAction
       //     }
       // ],
       "ajax": {
           "url": "/user/kyc-management/kyc-report?op=data_table",
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
// $(document).on("change","#fx-export",function () {
//   if ($(this).val()==='csv') {
//     $(".buttons-csv").trigger('click');
//   }
//   if ($(this).val()==='excel') {
//     $(".buttons-excel").trigger('click');
//   }

// });
// function serverSideButtonAction(e, dt, node, config) {

//     var me = this;
//     var button = config.text.toLowerCase();
//     if (typeof $.fn.dataTable.ext.buttons[button] === "function") {
//         button = $.fn.dataTable.ext.buttons[button]();
//     }
//     var len = dt.page.len();
//     var start = dt.page();
//     dt.page(0);

//     dt.context[0].aoDrawCallback.push({
//         "sName": "ssb",
//         "fn": function () {
//             $.fn.dataTable.ext.buttons[button].action.call(me, e, dt, node, config);
//             dt.context[0].aoDrawCallback = dt.context[0].aoDrawCallback.filter(function (e) { return e.sName !== "ssb" });
//         }
//     });
//     dt.page.len(999999999).draw();
//     setTimeout(function () {
//         dt.page(start);
//         dt.page.len(len).draw();
//     }, 500);
// }

/*<--------------Datatable export function End----------------->*/


/*<---------For reset button script-------------->*/
//   $(document).ready(function () {
//     $("#resetBtn").click(function () {
//         $("#filterForm")[0].reset();
//         $('#type').prop('selectedIndex', 0).trigger("change");
//         $('#verification_status').prop('selectedIndex', 0).trigger("change");
//         $('#status').prop('selectedIndex', 0).trigger("change");
//         $('#client_type').prop('selectedIndex', 0).trigger("change");
//     });
// });



// admin Description view
function view_document(e){
let obj = $(e);
var id=obj.data('id');
var table_id=obj.data('table_id');
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   $.ajax({
     url : '/user/kyc-management/kyc-report-view-descrption/'+id+'/'+table_id,
     method: 'GET',
     dataType : 'json',
     success:function (data) {
       if (data.group_name == 'id proof') {
           $('#pills-profile-tab').show();
           var frontPart = `/${data.image_path}/${data.images.front_part}`;

           $('#front_part').attr("src", frontPart);

           var backPart = `/${data.image_path}/${data.images.back_part}`;
           $('#backpart_part').attr("src", backPart);
       } else if (data.group_name == 'address proof') {
           $('#pills-profile-tab').hide();
           var address_proof = `/${data.image_path}/${data.images.front_part}`;
           $('#front_part').attr("src", address_proof);
       }

       $('#user-status').html(data.status);
       $('#user_name').text(data.user.name);
       $('#user-email').text(data.user.email);
       $('#user-phone').text(data.user.phone);
       $('#user-city').text(data.user.city);
       $('#user-state').text(data.user.state);
       $('#user-address').text(data.user.address);
       $('#user-zip-code').text(data.user.zip_code);
       $('#user-issue_date').text(data.issue_date);
       $('#user-exp_date').text(data.exp_date);
       $('#user-doc_type').text(data.document_name);
       $('#user-country').text(data.country.name);
       $('#user-dob').text(data.dob);
       $('#user-issuer-country').text(data.country.name);
     }
   });
}


</script>
@endsection
