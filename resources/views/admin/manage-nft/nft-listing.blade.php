@extends('layouts.admin.app')
@section('title', 'NFT Listing')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">NFT Listing</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Manage NFT</li>
        <li class="breadcrumb-item text-dark">NFT Listing</li>
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
            <div class="card-toolbar">
                <select class="form-select form-select-solid border" data-control="select2"
                    data-placeholder="Select an option" data-hide-search="true">
                    <option></option>
                    <option value="export" selected>Export</option>
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                </select>
            </div>
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
                        <select class="form-select" name="sale_type" id="sale_type" data-control="select2"
                            data-placeholder="Select an Sale Type">
                            <option></option>
                            <option value="1">Fixed price</option>
                            <option value="2">Timed Auction</option>
                            <option value="3">Not for Sale</option>
                            <option value="4">Open for offer</option>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Owner email" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="token" class="form-control" id="token"
                            placeholder="Search by token" />
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1">Min</span>
                            <input type="number" name="min_price" class="form-control" id="min_price"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Minimum Price" />
                            <span class="input-group-text" id="basic-addon1">-</span>
                            <input type="number" name="max_price" class="form-control" id="max_price"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Maximum Price" />
                            <span class="input-group-text" id="basic-addon1">Max</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="text" name="from_date" class="form-control date" id="from_date"
                                placeholder="YY-MM-DD" data-bs-toggle="tooltip" data-bs-placement="top" title="From Date" />
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="text" name="to_date" class="form-control date" id="to_date"
                                placeholder="YY-MM-DD" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="To Date" />

                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        {{-- <label class="form-label">Action</label> --}}
                        <button type="button" id="btn-reset" btn-name="export"
                            class="btn btn-danger btn-large w-100">Reset</button>
                    </div>
                    <div class="col-md-4">
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
            <table class="table align-middle table-row-dashed fs-6 gy-5 text-gray-800" id="nft_listing_tbl">
                <thead>
                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0 bg-light">
                        <th class="text-start min-w-75px">Product</th>
                        <th class="text-start min-w-75px">Name</th>
                        <th class="text-start min-w-75px">Token</th>
                        <th class="text-start min-w-75px">Sale Type</th>
                        <th class="text-start min-w-75px">Owner Email</th>
                        <th class="text-start min-w-75px">Price</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        // for date picker
        $(".date").flatpickr();
        var dt_ajax_table = $("#nft_listing_tbl");
        var dt = dt_ajax_table.fetch_data({
            url: "/admin/manage-nft/nft-listing/data",
            columns: [
                {
                    "data": "product"
                },
                {
                    "data": "name"
                },
                {
                    "data": "token"
                },
                {
                    "data": "sale_type"
                },
                {
                    "data": "owner_email"
                },
                {
                    "data": "base_price"
                },

            ],

            icon_feather: false,
            description: false,
            csv_export: true,
        });
        $('body').fetch_description({
            url: "/admin/manage-nft/nft-listing/data",
        })

        /* Product active start */
        function nftActive(e) {
            let obj = $(e);
            var asset_id = obj.data('id');

            let warning_title = "";
            let warning_msg = "";
            let request_for;

            warning_title = 'Are you sure? to active this nft!';
            warning_msg = 'If you want to active this nft please click OK, otherwise simply click cancel'
            request_for = 'block'

            Swal.fire({
                icon: 'warning',
                title: warning_title,
                html: warning_msg,

                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-warning'
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

                        url: '/admin/manage-nft/active-nft/' + asset_id,
                        method: 'POST',
                        dataType: 'json',

                        success: function(data) {
                            if (data.success === true) {
                                toastr['success'](data.message, 'active Success', {
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
                                    title: 'NFT activate Failed',
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

        /* Product deactive start */
        function nftDeactive(e) {
            let obj = $(e);
            var asset_id = obj.data('id');

            let warning_title = "";
            let warning_msg = "";
            let request_for;

            warning_title = 'Are you sure? to deactive this nft!';
            warning_msg = 'If you want to deactive this nft please click OK, otherwise simply click cancel'
            request_for = 'block'

            Swal.fire({
                icon: 'warning',
                title: warning_title,
                html: warning_msg,

                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-warning'
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

                        url: '/admin/manage-nft/deactive-nft/' + asset_id,
                        method: 'POST',
                        dataType: 'json',

                        success: function(data) {
                            if (data.success === true) {
                                toastr['success'](data.message, 'Deactive Success', {
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
                                    title: 'NFT Deactivate Failed',
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


    </script>
@endsection
