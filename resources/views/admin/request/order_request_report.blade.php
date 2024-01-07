@extends('layouts.admin.app')
@section('title', 'Oreder Request')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">Order Request Report</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Order Request Report</li>
        <li class="breadcrumb-item text-dark">Default</li>
    </ul>
@endsection
@section('custom-css')
    <style>
        .table td:first-child,
        .table th:first-child,
        .table tr:first-child {
            padding-left: 24px;
            padding-right: 24px;
        }

        .dt-buttons {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details"
            aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Filter Report</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <form action="#" id="filter-form" method="post">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select class="form-select" name="category" id="category" data-control="select2"
                            data-placeholder="Select an Category">
                            <option></option>
                            @php
                                $categories = App\Models\NftAssetCategory::all();
                            @endphp
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="email" class="form-control" id="email"
                            placeholder="Buyer email" />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="seller_account" class="form-control" id="seller_account"
                            placeholder="Seller Account" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="text" name="from_date" class="form-control date" id="from_date"
                                placeholder="YY-MM-DD" />
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="text" name="to_date" class="form-control date" id="to_date"
                                placeholder="YY-MM-DD" />

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1">Min</span>
                            <input type="number" name="min_price" class="form-control" id="min_price" />
                            <span class="input-group-text" id="basic-addon1">-</span>
                            <input type="number" name="max_price" class="form-control" id="max_price" />
                            <span class="input-group-text" id="basic-addon1">Max</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        {{-- <label class="form-label">Action</label> --}}
                        <button type="button" id="btn-reset" btn-name="export"
                            class="btn btn-danger btn-large w-100">Reset</button>
                    </div>
                    <div class="col-md-2">
                        {{-- <label class="form-label">Action</label> --}}
                        <button type="button" id="btn-filter" class="btn btn-primary btn-large w-100">Filter</button>
                    </div>

                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6 gy-5 text-gray-800" id="order_request_tbl">
                <thead>
                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0 bg-light">
                        <th class="text-start min-w-75px">Product</th>
                        <th class="text-start min-w-75px">Name</th>
                        <th class="text-start min-w-75px">Category</th>
                        <th class="text-start min-w-75px">Quintity</th>
                        <th class="text-start min-w-75px">Payment Symbol</th>
                        <th class="text-start min-w-75px">Price</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- modal for cancel order --}}

    <div class="modal fade" tabindex="-1" id="cancel_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Reason for Cancel Order</h3>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.cancel_order') }}" id="cancel_form" method="POST">
                        @csrf
                        <input type="hidden" name="sale_id" id="sale_id" class="form-control" value="" />
                        <input type="text" name="note" id="note" class="form-control" placeholder="Type the reason" />
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="cancel_confirm_btn" data-file="true"
                                data-btnid="cancel_confirm_btn" data-form="cancel_form" data-validator="true"
                                data-callback="cancelConfirm" class="btn btn-primary" onclick="_run(this)">Confirm Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    {{-- <script src="{{ asset('js/datatable-functions.js') }}"></script> --}}
    <script>
        // for date picker
        $(".date").flatpickr();
        var dt_ajax_table = $("#order_request_tbl");
        var dt = dt_ajax_table.fetch_data({
            url: "/admin/manage-order/order-request-report",
            columns: [{
                    "data": "product"
                },
                {
                    "data": "name"
                },
                {
                    "data": "category"
                },
                {
                    "data": "quantity"
                },
                {
                    "data": "symbol"
                },
                {
                    "data": "total_price"
                },

            ],

            icon_feather: false,
            csv_export: true,
            description: false,
        });

        // for description
        $('body').fetch_description({
            url: "/admin/manage-order/order-request-report",
        })

        /* Order Request Approved start */
        function orderApproveRequest(e) {
            let obj = $(e);
            var id = obj.data('id');

            let warning_title = "";
            let warning_msg = "";

            warning_title = 'Are you sure? you want to Approve this order!';
            warning_msg = 'If you want to Approve this order please click OK, otherwise simply click cancel'

            Swal.fire({
                icon: 'warning',
                title: warning_title,
                html: warning_msg,

                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-warning',
                    cancelButton: 'btn btn-danger'
                },
                closeOnCancel: false,
                closeOnConfirm: false,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({

                        url: '/admin/manage-order/order-request/approve-request/' + id,
                        method: 'POST',
                        dataType: 'json',

                        success: function(data) {
                            if (data.success === true) {
                                toastr['success'](data.message, 'Approved Request', {
                                    showMethod: 'slideDown',
                                    hideMethod: 'slideUp',
                                    closeButton: true,
                                    tapToDismiss: false,
                                    progressBar: true,
                                    timeOut: 2000,

                                });

                                Swal.fire({
                                    icon: 'success',
                                    title: data.success_title,
                                    html: data.message,
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }

                                }).then((willDelete) => {
                                    dt.draw();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Approved failed!',
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
        /* Order Request Approved end */

        /* Order Request Declined start */
        function productId(id) {
            $('#sale_id').val(id);
        }

        function cancelConfirm(data) {
            if (data.success == true) {
                $("#cancel_form").trigger("reset");
                $("#cancel_modal").modal('hide');
                toastr['success'](data.message, 'Canceled Order', {
                    showMethod: 'slideDown',
                    hideMethod: 'slideUp',
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    timeOut: 2000,
                });
                Swal.fire({
                    icon: 'success',
                    title: data.success_title,
                    html: data.message,
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }

                }).then((willDelete) => {
                    dt.draw();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cancel failed!',
                    html: data.message,
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    }
                });
                $.validator("cancel_form", data.errors);
            }

        }

        // function orderDeclinedRequest(e) {
        //     let obj = $(e);
        //     var id = obj.data('id');

        //     let warning_title = "";
        //     let warning_msg = "";

        //     warning_title = 'Are you sure? You want to cancel this order!';
        //     warning_msg = 'If you want to cancel this order please click OK, otherwise simply click cancel'

        //     Swal.fire({
        //         icon: 'warning',
        //         title: warning_title,
        //         html: warning_msg,

        //         showCancelButton: true,
        //         customClass: {
        //             confirmButton: 'btn btn-danger',
        //             cancelButton: 'btn btn-warning'
        //         },
        //         closeOnCancel: false,
        //         closeOnConfirm: false,
        //     }).then((willDelete) => {
        //         if (willDelete.isConfirmed) {
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });
        //             $.ajax({

        //                 url: '/admin/manage-order/order-request/decline-request/' + id,
        //                 method: 'POST',
        //                 dataType: 'json',

        //                 success: function(data) {
        //                     if (data.success === true) {
        //                         toastr['success'](data.message, 'Canceled Order', {
        //                             showMethod: 'slideDown',
        //                             hideMethod: 'slideUp',
        //                             closeButton: true,
        //                             tapToDismiss: false,
        //                             progressBar: true,
        //                             timeOut: 2000,

        //                         });

        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: data.success_title,
        //                             html: data.message,
        //                             customClass: {
        //                                 confirmButton: 'btn btn-success'
        //                             }

        //                         }).then((willDelete) => {
        //                             dt.draw();
        //                         });
        //                     } else {
        //                         Swal.fire({
        //                             icon: 'error',
        //                             title: 'Cancel failed!',
        //                             html: data.message,
        //                             customClass: {
        //                                 confirmButton: 'btn btn-danger'
        //                             }
        //                         });
        //                     }
        //                 }
        //             });

        //         }

        //     });

        // }

        /* Order Request Declined end */
    </script>
@endsection
