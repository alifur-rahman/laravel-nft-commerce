@extends('layouts.users.user-admin-layout')
@section('title','Deposit Report')
@section('custom-css')
<!-- Datatable CSS -->
<style>
#filter-form  .input-group {
    border: 2px solid var(--color-border);
    border-radius: 5px;
    max-width: 100% !important;
}

#filter-form  .input-group input {
    border: none;
}

#filter-form  .input-group-append {
    padding: 13px 15px;
    border-radius: 0 6px 6px 0;
    background: #24243574;
}

#filter-form  .form-control:focus {
    color: #fff;
}
#filter-form  .form-wrapper-one{
    height: auto;
}
#filter-form .form-wrapper-one .nice-select {
	border: 2px solid var(--color-border);
	height: 53px;
	padding: 5px 24px;
    margin: 0 ;
}
</style>

@endsection
@section('content')

<div class="rn-nft-mid-wrapper">
<div class="rn-upcoming-area rn-section-gap">
    <div class="container">

        {{-- start filter area  --}}
        <div class="row g-5 mb-5">
            <div class="col-12">
                <!-- start Table Title -->
                <div class="table-title-area d-flex">
                    <i data-feather="briefcase"></i>
                    <h3>Deposit Report</h3>
                </div>
                <!-- End Table Title -->
                <div class="form-wrapper-one">
                    <form class="row" action="#" method="post" id="filter-form">

                        <div class="col-md-4">
                            <div class="input-box pb--20">
                                <select class="profile-edit-select" id="type" name="type">
                                    <option value="" selected>Mathod</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Crypto">Crypto</option>
                                </select>
                                {{-- <label for="dollerValue" class="form-label">Name / Email</label> --}}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-box pb--20">
                                <select class="profile-edit-select" id="approve_status" name="approve_status">
                                    <option value="" selected>Approve Status</option>
                                    <option value="A">Approve</option>
                                    <option value="P">Pending</option>
                                    <option value="D">Decline</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex align-items-center">
                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <span><i class="feather-calendar"></i></span>
                                </div>
                                <input type="date" name="from_date" class="form-control" id="from_date"
                                    placeholder="">
                                <div class="input-group-append">
                                    <span>To</span>
                                </div>
                                <input type="date" name="to_date" class="form-control" id="to_date" placeholder="">

                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span>Min</span>
                                </div>
                                <input type="datetime" class="form-control" name="min_amount" id="min_amount"
                                    placeholder="">
                                <div class="input-group-append">
                                    <span>-</span>
                                </div>
                                <input type="datetime" class="form-control" name="max_amount" id="max_amount"
                                    placeholder="">
                                <div class="input-group-append">
                                    <span class="">Max</span>
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
        {{-- end filter area  --}}
        <div class="row">
            <div class="col-12">

                <!-- table area Start -->
                <div class="box-table table-responsive">
                    <table class="table upcoming-projects">
                        <thead>
                            <tr>
                                <th>
                                    <span>Mathod</span>
                                </th>
                                <th>
                                    <span>Charge</span>
                                </th>
                                <th>
                                    <span>Deposit Date</span>
                                </th>
                                <th>
                                    <span>Approve Date</span>
                                </th>
                                <th>
                                    <span>Approve Status</span>
                                </th>
                                <th>
                                    <span>Amount</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="ranking">

                        </tbody>
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
<script>
    var dt_ajax_table = $(".upcoming-projects");
    var datatable = dt_ajax_table.fetch_data({
        url: "/finance/deposit-report?op=data_table",
        columns: [{
                "data": "transaction_type"
            },
            {
                "data": "charge"
            },
            {
                "data": "created_at"
            },
            {
                "data": "update_at"
            },
            {
                "data": "status"
            },
            {
                "data": "amount"
            },
        ],
        icon_feather: false,
        csv_export: false,
        description: true,
        // length_change:true
    });
    $('select').niceSelect('update');
</script>

@endsection
