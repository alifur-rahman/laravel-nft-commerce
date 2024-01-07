@extends('layouts.admin.app')
@section('title', 'Sales Report')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">Sales Report</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Report</li>
        <li class="breadcrumb-item text-dark">Sales Report</li>
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
                        <select class="form-select" name="payment_symbol" id="payment_symbol" data-control="select2"
                            data-placeholder="Select an Symbol">
                            <option></option>
                            @php
                                $payment_symbols = App\Models\Symbol::all();
                            @endphp
                            @foreach ($payment_symbols as $payment_symbol)
                                <option value="{{ $payment_symbol->symbol }}">{{ $payment_symbol->symbol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Search by name" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="text" name="from_date" class="form-control date" id="from_date" placeholder="YY-MM-DD" />
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="text" name="to_date" class="form-control date" id="to_date" placeholder="YY-MM-DD" />

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
                        <th class="text-start min-w-75px">Order Status</th>
                        <th class="text-start min-w-75px">Quintity</th>
                        <th class="text-start min-w-75px">Payment Symbol</th>
                        <th class="text-start min-w-75px">Sale Time</th>
                        <th class="text-start min-w-75px">Price</th>
                    </tr>
                </thead>
            </table>
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
            url: "/admin/reports/sales-report/data",
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
                    "data": "order_status"
                },
                {
                    "data": "quantity"
                },
                {
                    "data": "symbol"
                },
                {
                    "data": "sale_time"
                },
                {
                    "data": "total_price"
                },

            ],

            icon_feather: false,
            csv_export: true,
            description: false,
        });

        $('body').fetch_description({
            url: "/admin/reports/sales-report/data",
        })
    </script>
@endsection
