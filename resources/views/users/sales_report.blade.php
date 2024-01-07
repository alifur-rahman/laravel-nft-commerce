@extends('layouts.users.user-admin-layout')
@section('title', 'Sales Report')
@section('custom-css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css/datatables.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .addon-input {
            border: 2px solid var(--color-border);
            border-radius: 5px;
        }

        .addon-input input {
            border: none;
        }

        .addons {
            background: #13131d;
            align-items: revert-layer;
            display: flex;
            align-items: center;
            padding: 8px;
        }

        #filter-form .input-group {
            border: 2px solid var(--color-border);
            border-radius: 5px;
            max-width: 100% !important;
        }

        #filter-form .input-group input {
            border: none;
        }

        #filter-form .input-group-append {
            padding: 13px 15px;
            border-radius: 0 6px 6px 0;
            background: #24243574;
        }

        #filter-form .form-control:focus {
            color: #fff;
        }

        #filter-form .form-control:focus {
            color: #fff;
        }

        #filter-form .form-wrapper-one {
            height: auto;
        }

        .form-wrapper-one .nice-select {
            border: 2px solid var(--color-border);
            height: 52px;
            padding: 5px 24px;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div class="rn-nft-mid-wrapper">
        <div class="rn-upcoming-area rn-section-gap">
            <div class="container">
                <!-- start Table Title -->
                <div class="table-title-area d-flex">
                    <i data-feather="briefcase"></i>
                    <h3>Sales Report</h3>
                </div>
                <!-- End Table Title -->
                <div class="row g-5">
                    <div class="col-12">
                        <div class="form-wrapper-one">
                            <form class="row" action="#" method="post" id="filter-form">

                                <div class="col-md-4">
                                    <div class="input-box pb--20">
                                        <input type="text" id="nft_name" name="nft_name" placeholder="NFT Name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-box pb--20">
                                        <select class="profile-edit-select" id="payment_symbol" name="payment_symbol">
                                            <option value="" selected>Select Symbool</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-box pb--20">
                                        <div class="addon-input d-flex">
                                            <span class="addons">From</span>
                                            <input type="date" id="from_date" name="from_date" placeholder="">
                                            <span class="addons">To</span>
                                            <input type="date" id="to_date" name="to_date" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-box pb--20">
                                        <div class="addon-input d-flex">
                                            <span class="addons">MIN</span>
                                            <input type="number" id="min_amount" name="min_amount" placeholder="">
                                            <span class="addons">-</span>
                                            <input type="number" id="max_amount" name="max_amount" placeholder="">
                                            <span class="addons">MAX</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xl-4">
                                    <div class="input-box">
                                        <button type="button" id="btn-reset" btn-name="export"
                                            class="btn btn-danger btn-large w-100">Reset</button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-4">
                                    <div class="input-box">
                                        <button type="button" id="btn-filter"
                                            class="btn btn-primary btn-large w-100">Filter</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="row mt-4" id="sales_report">
                    <div class="col-12">
                        <!-- table area Start -->
                        <div class="box-table table-responsive">
                            <table class="table upcoming-projects">
                                <thead>
                                    <tr>
                                        <th>
                                            <span>Product</span>
                                        </th>
                                        <th>
                                            <span>Sale Time</span>
                                        </th>

                                        <th>
                                            <span>Adress</span>
                                        </th>
                                        <th>
                                            <span>Quantity</span>
                                        </th>
                                        <th>
                                            <span>Price</span>
                                        </th>
                                        <th>
                                            <span>Payment Symbol</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="ranking"></tbody>
                            </table>
                        </div>
                        <!-- table End -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    {{-- <script type="text/javascript" src="{{ asset('assets/user/js/datatables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/common-ajax.js') }}"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}

    <script>
        var dt_ajax_table = $(".upcoming-projects");
        var datatable = dt_ajax_table.fetch_data({
            url: "/user/sales-report/data",
            columns: [{
                    "data": 'name'
                },
                {
                    "data": 'time'
                },

                {
                    "data": 'contract_address'
                },
                {
                    "data": 'quantity'
                },
                {
                    "data": 'total_price'
                },
                {
                    "data": 'payment_symbol'
                },

            ],
            icon_feather: true,
            csv_export: false,
            description: true,
        });
    </script>
@endsection
