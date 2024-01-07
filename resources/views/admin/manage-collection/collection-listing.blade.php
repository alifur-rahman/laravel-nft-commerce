@extends('layouts.admin.app')
@section('title', 'Manage Collection')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">All Collection</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Manage Collection</li>
        <li class="breadcrumb-item text-dark">All Collection</li>
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
                <h3 class="fw-bold m-0">Filter Collection</h3>
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
                        <input type="text" name="collection_name" class="form-control" id="collection_name"
                            placeholder="Search by Collection Name" />
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="owner_name" class="form-control" id="owner_name"
                            placeholder="Search by Owner Name" />
                    </div>

                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Owner email" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="url" class="form-control" id="url"
                            placeholder="Search by url" />
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="slug" class="form-control" id="slug"
                            placeholder="Search by slug" />

                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i>
                            </span>
                            <input type="text" name="from_date" class="form-control date" id="from_date"
                                placeholder="YY-MM-DD" data-bs-toggle="tooltip" data-bs-placement="top" title="From Date" />
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="text" name="to_date" class="form-control date" id="to_date"
                                placeholder="YY-MM-DD" data-bs-toggle="tooltip" data-bs-placement="top" title="To Date" />

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
            <table class="table align-middle table-row-dashed fs-6 gy-5 text-gray-800" id="collection_tbl">
                <thead>
                    <tr class="text-start fw-bold fs-7 text-uppercase gs-0 bg-light">
                        <th class="text-start min-w-75px">Collection</th>
                        <th class="text-start min-w-75px">Name</th>
                        <th class="text-start min-w-75px">Owner Name</th>
                        <th class="text-start min-w-75px">Owner Email</th>
                        <th class="text-start min-w-75px">Create Time</th>
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
        var dt_ajax_table = $("#collection_tbl");
        var dt = dt_ajax_table.fetch_data({
            url: "/admin/manage-collection/all-collection/data",
            columns: [{
                    "data": "collection"
                },
                {
                    "data": "name"
                },
                {
                    "data": "owner_name"
                },
                {
                    "data": "owner_email"
                },
                {
                    "data": "created_at"
                },

            ],

            icon_feather: false,
            description: false,
            csv_export: true,
        });

        $('body').fetch_description({
            url: "/admin/manage-collection/all-collection/data",
        })
    </script>
@endsection
