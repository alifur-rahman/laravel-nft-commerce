@extends('layouts.users.user-layout')
@section('title','KYC Report')
@section('custom-css')
<!-- Datatable CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
                    <h3>KYC Request</h3>
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
<!--begin::Modals-->
<div class="modal fade" id="userDescriptionModel" tabindex="-1" aria-hidden="true">
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
                    <h4 class="mb-3">User Proof</h4>
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
                                            <img id="front_part" class="img-thumbnail" src="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="geeks" style="height: 100%; width: 100%;">
                                            <img id="backpart_part" class="img-thumbnail" src="">
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
                    <!--/ pricing free trial -->
                    <input type="hidden" name="approve_id" id="approve_id">
                    <input type="hidden" name="table_id" id="table_id">
                    <button type="button" class="btn btn-success me-3" id="approve_button" data-bs-dismiss="modal" onclick="kycApproveRequest(this)">Approve</button>
                    <button type="button" class="btn btn-danger decline-request-btn me-3" id="decline_button" onclick="modalOpen(this)">Decline</button>
                    <button type="button" class="btn btn-primary me-3"  id="decline_button" data-bs-dismiss="modal">Close</button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!-- update kyc request  profile modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body pb-5 px-sm-4 mx-50 form-wrapper-one registration-area">
                <h4 class="address-title text-center mb-1" id="addNewAddressTitle">Update Profile</h4>
                <form id="profile-update-form" action="{{route('user.kyc.request.profile.update')}}" method="POST" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                    @csrf
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressFirstName">Full Name
                            <font class=" text-danger">*</font>
                        </label>
                        <input type="text" id="name" name="name" class="form-control" value="" data-msg="Please enter your full name" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressLastName">State
                            <font class=" text-danger">*</font>
                        </label>
                        <input type="text" id="state" name="state" class="form-control" value="" data-msg="Please enter your state name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Country
                            <font class=" text-danger">*</font>
                        </label>
                        <select id="country" name="country" value="" class="select2 form-select">

                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="modalAddressAddress2">Zip
                            <font class=" text-danger">*</font>
                        </label>
                        <input type="text" id="zip" name="zip" class="form-control" placeholder="Zip" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressTown">City
                            <font class=" text-danger">*</font>
                        </label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Los Angeles" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class=" form-label  flatpickr-basic" for="modalAddressState">Issue Date
                            <font class=" text-danger">*</font>
                        </label>
                        <div class="input-group" data-toggle="tooltip" data-trigger="hover" class="form-control" data-original-title="Issue Date">
                            <span class="input-group-text">
                                <div class="icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                            </span>
                            <input id="issue_date" type="text" title="Enter Issue date" name="issue_date" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressZipCode">Expire Date
                            <font class=" text-danger">*</font>
                        </label>
                        <div class="input-group" data-toggle="tooltip" data-trigger="hover" class="form-control" data-original-title="Issue Date">
                            <span class="input-group-text">
                                <div class="icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                            </span>
                            <input id="expire_date" type="text" title="Enter Issue date" name="expire_date" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD">
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddressZipCode">Date Of Birth
                            <font class=" text-danger">*</font>
                        </label>
                        <div class="input-group" data-toggle="tooltip" data-trigger="hover" class="form-control" data-original-title="Issue Date">
                            <span class="input-group-text">
                                <div class="icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                            </span>
                            <input id="dob" type="text" title="Enter Issue date" name="dob" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="modalAddressAddress1">Address
                            <font class=" text-danger">*</font>
                        </label>

                        <textarea type="text" id="address" name="address" class="form-control" placeholder="12, Business Park"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <input type="hidden" name="data_id" id="data_id">
                        <button type="button" class="btn btn-primary me-1 mb-1" id="profileUpdateBtn" onclick="_run(this)" data-el="fg" data-form="profile-update-form" data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>" data-callback="profileUpdateCallBack" data-btnid="profileUpdateBtn">Save Change</button>
                        <button type="reset" class="btn btn-secondary mb-1" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / update profile modal -->
<!-- add new card modal  -->
<div class="modal fade" id="kyc_decline_req" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
     
            <div class="modal-body px-sm-5 mx-50 pb-5 form-wrapper-one registration-area" >
                <h4 class="text-center" id="addNewCardTitle">Reason For Decline</h4>
                <!-- form -->
                <form id="kyc_request" class="row gy-1 gx-2 mt-75" action="{{route('kyc.management.decline')}}" method="POST">
                    <div class="col-12">
                        <label class="form-label" for="modalAddCardNumber">Reason:</label>
                        <div class="input-group input-group-merge">
                            <input id="reason" name="reason" class="form-control add-credit-card-mask" type="text" placeholder="type here....." aria-describedby="modalAddCard2" />
                            <span class="input-group-text cursor-pointer p-25" id="modalAddCard2">
                                <span class="add-card-type"></span>
                            </span>
                            <input type="hidden" name="kyc_decline_id" id="kyc_decline_id">
                            <input type="hidden" name="tbl_id" id="tbl_id">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-1 mt-1">Yes</button>
                        <button type="reset" class="btn btn-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                            No
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ add new card modal  -->

@endsection
@section('custom-js')
<script src="{{ asset('assets/admin/custom-js/pages/user/user-kyc-request.js') }}"></script>
<script src="{{ asset('assets/admin/custom-js/pages/common-ajax.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const token = "{{ csrf_token() }}";
    console.log(token);
    var dt;
    $(document).ready(function() {

        dt = $('#kyc_report_tbl').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": true,
            // "buttons": true,
            // "dom": 'B<"clear">lfrtip',
            // buttons: [{
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


                "url": "/user/kyc-management/kyc-request?op=data_table",
                "data": function(d) {
                    return $.extend({}, d, {
                        "from": $("#from").val(),
                        "to": $("#to").val(),
                        "type": $("#type").val(),
                        "status": $("#status").val(),
                        "client_type": $("#client_type").val(),
                        "info": $("#info").val(),
                        "issue_from": $("#issue_from").val(),
                        "issue_to": $("#issue_to").val(),
                        "expire_from": $("#expire_from").val(),
                        "expire_to": $("#expire_to").val(),
                        "manager_email": $("#manager_email").val(),
                        "ib_email": $("#ib_email").val(),

                    });
                }
            },

            "columns": [{
                    "data": "client_name"
                },
                {
                    "data": "client_type"
                },
                {
                    "data": "document_type"
                },
                {
                    "data": "issue_date"
                },
                {
                    "data": "expire_date"
                },
                {
                    "data": "status"
                },
                {
                    "data": "date"
                },
                {
                    "data": "action"
                },

            ],
            "columnDefs": [{
                "targets": 7,
                "orderable": false
            }],

            "drawCallback": function(settings) {
                $("#filterBtn").html("FILTER");

                // var rows = this.fnGetData();
                // if (rows.length !== 0) {
                //     feather.replace();
                // }
            }
        });
        $('#filterBtn').click(function(e) {
            dt.draw();
        });

    });

    /*<--------------Datatable export function Start----------------->*/
    $(document).on("change", "#fx-export", function() {
        if ($(this).val() === 'csv') {
            $(".buttons-csv").trigger('click');
        }
        if ($(this).val() === 'excel') {
            $(".buttons-excel").trigger('click');
        }

    });

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
    //         "fn": function() {
    //             $.fn.dataTable.ext.buttons[button].action.call(me, e, dt, node, config);
    //             dt.context[0].aoDrawCallback = dt.context[0].aoDrawCallback.filter(function(e) {
    //                 return e.sName !== "ssb"
    //             });
    //         }
    //     });
    //     dt.page.len(999999999).draw();
    //     setTimeout(function() {
    //         dt.page(start);
    //         dt.page.len(len).draw();
    //     }, 500);
    // }

    /*<--------------Datatable export function End----------------->*/


    /*<---------For reset button script-------------->*/
    $(document).ready(function() {
        $("#resetBtn").click(function() {
            $("#filterForm")[0].reset();
            $('#type').prop('selectedIndex', 0).trigger("change");
            $('#verification_status').prop('selectedIndex', 0).trigger("change");
            $('#status').prop('selectedIndex', 0).trigger("change");
            $('#client_type').prop('selectedIndex', 0).trigger("change");

        });
    });

    //user id pass
    $(document).on("click", ".user-id", function() {
        $('#data_id').val($(this).data('id'));
        $('#approve_id').val($(this).data('id'));
        $('#kyc_decline_id').val($(this).data('id'));
        $('#table_id').val($(this).data('table_id'));
        $('#tbl_id').val($(this).data('table_id'));

    });


    function modalOpen() {
        $('#userDescriptionModel').modal('hide');
        $("#kyc_decline_req").modal('show');
    }
    //-----------------Kyc Decline Request-------------------------//

    $(document).on("submit", "#kyc_request", function(event) {

        $('#send-mail-pass').modal('toggle');
        $("#kyc_decline_req").modal('hide');

        let form_data = $(this).serializeArray();
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/user/kyc-management/kyc-decline-request',
            method: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.success === true) {

                    toastr['success'](data.message, 'Mail send', {

                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        timeOut: 500,
                    });

                    Swal.fire({
                        icon: 'success',
                        title: data.success_title,
                        html: data.message,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    }).then((willDelete) => {

                        const table = $("#kyc_report_tbl").DataTable();
                        table.draw();
                        location.reload();

                    });
                } else {
                    let $errors = 'Please Enter a Reason';
                    Swal.fire({
                        icon: 'error',
                        title: 'Decline operation failed!',
                        html: $errors,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                }
            }
        })
    });

    //kyc profile update callback
    function profileUpdateCallBack(data) {
        if (data.success) {

            toastr.success(data.message);
            // notify('success', data.message, 'User Profile');
            $('#updateProfileModal').modal('toggle');
            dt.draw();
        } else {
            toastr.error("Fix the following Error");
            // notify('error', data.message, 'User Profile');
        }
        $.validator("profile-update-form", data.errors);
    }
</script>
@endsection