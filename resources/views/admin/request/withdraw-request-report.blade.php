@extends('layouts.admin.app')
@section('title','Withdraw Request Report')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">Withdraw Request Report</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Withdraw Request Report</li>
        <li class="breadcrumb-item text-dark">Default</li>
    </ul>
@endsection
@section('custom-css')
    <style>
        .table td:first-child,
        .table th:first-child,
        .table tr:first-child {
            padding-left: 24px;
        }

        .geeks {
            width: 300px;
            height: 300px;
            overflow: hidden;
            margin: 0 auto;
        }

        .geeks img {
            width: 100%;
            transition: 0.5s all ease-in-out;
        }

        .geeks:hover img {
            transform: scale(1.5);
        }

        element.style {
            width: 138px;
        }

        .dt-buttons {
            display: none;
        }
        .modal-content {
            width: 671px;
            /* height: 323px; */
            box-shadow: var(--kt-modal-box-shadow-sm-up);
        }
        .card {
        border: 0;
        box-shadow: var(--kt-card-box-shadow);
        background-color: var(--kt-card-bg);
        margin-top: 10px;
        }

        .row.g-1 {
            margin-top: 3px;
        }
        .card-header.border-bottom.d-flex.justfy-content-between {
        margin-bottom: -33px;
        }
        .modal {
    text-align: center;
    padding: 0!important;
    }

    .modal:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px;
    }

    .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
    }

    .col-md-4 {
    flex: 0 0 auto;
    width: 33.33333333%;
    margin-top: 15px;
}

    </style>
@endsection

@section('content')
<div class="card card-flush">
    <div class="card-header border-bottom d-flex justfy-content-between">
        <h4 class="card-title">Request Filter</h4>
        <div class="btn-exports" style="width:200px; margin-top:10px ">
            <select data-placeholder="Select a state..." class="form-select" data-control="select2" style="wi" id="fx-export">
                <option value="download" data-icon="download" selected>Export to</option>
                <option value="csv" data-icon="file">CSV</option>
                <option value="excel" data-icon="file">Excel</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <form id="filter-form" class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
                <div class="col-md-4 mb-1">
                    <select class="form-select" data-control="select2" name="transaction_type" id="transaction_type">
                        <optgroup label="Search By Method">
                            <option value="">All</option>
                            <option value="Bank Deposit">Bank Wire</option>
                            <option value="Skrill">Skrill</option>
                            <option value="Neteller">Neteller</option>
                            <option value="BTC">BTC</option>
                            <option value="wETH">wETH</option>
                            <option value="LTC">LTC</option>
                            <option value="XRP">XRP</option>
                            <option value="BCH">BCH</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-4  mb-1">
                    <select class="form-select" data-control="select2" name="verification_status" id="verification_status">
                        <optgroup label="Verification Status">
                            <option value="">All</option>
                            <option value="Verified">Verified</option>
                            <option value="Unverified">Unverified</option>

                        </optgroup>
                    </select>
                </div>
                <div class="col-md-4  mb-1">
                    <select class="form-select" data-control="select2" name="status" id="status">
                        <optgroup label="Search By Status">
                            <option value="">All</option>
                            <option value="A">Approved</option>
                            <option value="P" selected>Pending</option>
                            <option value="D">Decline</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control dt-input dt-full-name" data-column="1" name="info" id="info" placeholder="Name / Email" data-column-index="0" />
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                MIN
                            </span>
                            <input id="min" type="text" class="form-control" name="min">
                            <span class="input-group-text">-</span>
                            <input id="max" type="text" class="form-control" name="max">
                            <span class="input-group-text">MAX</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group" data-date="2017/01/01" data-date-format="yyyy/mm/dd">
                        <span class="input-group-text">
                            <div class="icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                        </span>
                        {{-- <input type="text" class="form-control" id="start-date" name="from" placeholder="Start Date" /> --}}
                        <input id="from" type="text" name="from" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD">
                        <span class="input-group-text">to</span>
                        {{-- <input type="text" class="form-control" id="end-date" name="to" placeholder="End Date" /> --}}
                        <input id="to" type="text" name="to" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD">
                    </div>
                </div>


            </div>
            <div class="row g-1">
                <div class="col-md-8">
                </div>
                <div class="col-md-2 text-right">
                    <button id="btn-reset" type="button" class="btn btn-danger w-100 waves-effect waves-float waves-light">
                        <span class="align-middle">RESET</span>
                    </button>
                </div>
                <div class="col-md-2 text-right">
                    <button id="btn-filter" type="button" class="btn btn-primary  w-100 waves-effect waves-float waves-light">
                        <span class="align-middle">FILTER</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="card card-flush">
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6 gy-5 text-gray-800" id="kyc_report_tbl">
                <thead>
                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0 bg-light">
                        <th class="text-start min-w-80px">Name</th>
                        <th class="text-start min-w-75px">Email</th>
                        <th class="text-start min-w-75px">Method</th>
                        <th class="text-start min-w-75px">Status</th>
                        <th class="text-start min-w-75px">Date</th>
                        <th class="text-start min-w-75px">Amount</th>
                        <th class="text-start min-w-75px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--begin::Modals-->
<div class="modal fade" id="userDescriptionModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">     
        <div class="modal-content rounded">
            <div class="modal-header justify-content-end border-0 pb-0">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="10" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
            
                </div>
      
            </div>
            <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                <div class="mb-13 text-center">
                    <h1 class="mb-3">Withdraw Request Action</h1>
                </div>
                <div class="d-flex flex-center flex-row-fluid pt-5">
                    <input type="hidden" name="approve_id" id="approve_id">
                    <input type="hidden" name="table_id" id="table_id">
                    <button type="button" class="btn btn-success me-3" id="approve_button" data-bs-dismiss="modal" onclick="kycApproveRequest(this)">Approve</button>
                    <button type="button" class="btn btn-danger decline-request-btn me-3" id="decline_button" onclick="modalOpen(this)">Decline</button>
                    <button type="button" class="btn btn-primary me-3"  id="decline_button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add new card modal  -->
<div class="modal fade" id="kyc_decline_req" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewCardTitle">Reason For Decline</h1>

                <!-- form -->
                <form id="kyc_request" class="row gy-1 gx-2 mt-75" action="{{route('withdraw.decline.request')}}" method="POST">
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
@section('custom-script')
    <script>
        var dt_ajax_table = $("#kyc_report_tbl");
        var datatable = dt_ajax_table.fetch_data({
            url: "/admin/manage-report/withdraw-request?op=data_table",
            columns: [{
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "method"
                },
                {
                    "data": "status"
                },
                {
                    "data": "request_date"
                },
                {
                    "data": "amount"
                },
                {
                    "data": "action"
                },

            ],
            length_change: true,
            icon_feather: false,
            csv_export: true,
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

    /*<!---------------Approve Data request operation------------------!>*/
    function kycApproveRequest() {
        var id = $('#approve_id').val();
        console.log(id);
        var table_id = $('#table_id').val();
        let warning_title = "";
        let warning_msg = "";
        let request_for;
    
        warning_title = 'Are you sure? to Approve this user!';
        warning_msg = 'If you want to Approve this User please click OK, otherwise simply click cancel';
        request_for = 'block';
    
        Swal.fire({
        icon: 'warning',
        title: warning_title,
        html: warning_msg,
    
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-warning',
            cancelButton: 'btn btn-danger'
        },
        }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $('#send-mail-pass').modal('toggle');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            url: '/admin/manage-report/withdraw-request/approve-request/' + id + '/' + table_id,
            method: 'POST',
            dataType: 'json',
            data: { id: id, request_for: request_for },
            success: function (data) {
                if (data.success === true) {
                toastr['success'](data.message, 'Mail send', {
                    showMethod: 'slideDown',
                    hideMethod: 'slideUp',
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    timeOut: 2000,
    
                });
                $('#send-mail-pass').modal('toggle');
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
                });
                } else {
    
                Swal.fire({
                    icon: 'error',
                    title: 'Mail sending failed!',
                    html: data.message,
                    customClass: {
                    confirmButton: 'btn btn-danger'
                    }
                });
                }
            }
            });
        }
        });
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
            url: '/admin/manage-report/withdraw-request/decline-request',
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
                        // location.reload();

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
    </script>
@endsection
