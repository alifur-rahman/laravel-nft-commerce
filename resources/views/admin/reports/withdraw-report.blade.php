@extends('layouts.admin.app')
@section('breadcrumb')
<h1 class="text-dark fw-bold my-0 fs-2">Withdraw Report</h1>
<ul class="breadcrumb fw-semibold fs-base my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
    </li>
    <li class="breadcrumb-item text-muted">Withdraw Report</li>
    <li class="breadcrumb-item text-dark">Default</li>
</ul>
@endsection

@section('content')
<!--begin::filter-->
<div class="card mb-3 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details"
        aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Withdraw Report</h3>
        </div>
        <div class="card-toolbar">
            <select class="form-select form-select-solid border" data-control="select2"
                data-placeholder="Select an option" data-hide-search="true">
                <option></option>
                <option value="export" selected>Export</option>
                <option value="csv">CSV</option>
                <option value="excel">Excel</option>
            </select>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <form action="" id="filter_form">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Search By Method</label>
                    <select class="form-select" id="method" data-control="select2" data-placeholder="Select an option">
                        <option></option>
                        <option value="">All</option>
                        <option value="Bank">Bank</option>
                        <option value="Skrill">Skrill</option>
                        <option value="Neteller">Neteller</option>
                        <option value="withdraw">Withdraw</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Search By Status</label>
                    <select class="form-select" id="status" data-control="select2" data-placeholder="Select an option">
                        <option></option>

                        <option value="A">Approved</option>
                        <option value="P">Pending</option>
                        <option value="D">Decline</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">User</label>
                    <input type="text" class="form-control" id="user" placeholder="User Email/phone/name" />
                </div>
            </div>

            <div class="row mb-3 ">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                Min
                            </span>
                            <input id="min" type="text" class="form-control" name="min">
                            <span class="input-group-text">-</span>
                            <input id="max" type="text" class="form-control" name="max">
                            <span class="input-group-text">Max</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAK1JREFUSEtjZKAxYKSx+QyELPgPdQAudYTk6W+BAwMDw3wGBgYFMoPuAQMDQyIDA8MBmH50r4MUyJNpOEwbyAxFXBbAwpRCOxBBj+4DullAKHXh8iFGqsLlg+FjAbqXSeVjZDRSDSCknqAFpCbXwRfJhIKAkDzBICJkACF5ghYM/Tigug8+MDAw8JNqKpr6h8j1CXqZA6pwFlBQJ4AMT8BX4VDoeEzt5JaaRDsEAEtJNBmkfiBdAAAAAElFTkSuQmCC" />
                            </span>
                            <input class="form-control" placeholder="Pick a date" id="kt_datepicker_4" />
                            <span class="input-group-text">-</span>
                            <input class="form-control" placeholder="Pick a date" id="kt_datepicker_5" />

                        </div>
                    </div>
                    {{-- <label for="" class="form-label">Date/Time</label> --}}

                </div>
                <div class="col-md-2">
                    {{-- <label class="form-label">Action</label> --}}
                    <a href="#" class="btn btn-bg-secondary w-100" id="resetBtn">Reset</a>
                </div>
                <div class="col-md-2">
                    {{-- <label class="form-label">Action</label> --}}
                    <a href="#" class="btn btn-primary w-100" id="filterBtn">Filter</a>
                </div>
            </div>

        </form>
    </div>
    <!--end::Card body-->
</div>
<!--end::filter-->

<!--begin::manage clients-->
<div class="card card-flush">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5 text-gray-800" id="manage_client_table">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start fw-bold fs-7 text-uppercase gs-0 bg-light">
                    <th></th>
                    <th class="min-w-100px">ID</th>
                    <th class="text-start min-w-75px">Name</th>
                    <th class="text-start min-w-75px">Email</th>
                    <th class="text-start min-w-75px">Method</th>
                    <th class="text-start min-w-75px">Status</th>
                    {{-- <th class="text-start min-w-75px">Request</th> --}}
                    <th class="text-start min-w-75px">Approve</th>
                    <th class="text-start min-w-75px">Amount</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600">
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::manage clients-->
@endsection

@section('custom-script')
<script>
    const withdrawDT = $("#manage_client_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{url('admin/reports/withdraw')}}"+ "?action=table",
                data: function(d) {
                    return $.extend({}, d, {
                        transaction_type: $("#method").val(),
                        // user_id: $("#account").val(),
                        approved_status: $("#status").val(),
                        user: $("#user").val(),
                        from: $("#from").val(),
                        to: $("#to").val(),
                        min: $("#min").val(),
                        max: $("#max").val(),



                    });
                },
            },
            columns: [{
                    class: "dt-control",
                    orderable: false,
                    data: null,
                    defaultContent: "",
                },
                {
                    data: "id",
                    visible: false,
                },
                {
                    data: "name",
                },
                {
                    data: "email",
                },
                {
                    data: "transaction_type",
                },
                {
                    data: "approved_status",
                },
                {
                    data: "created_at",
                },
                {
                    data: "amount",
                },
            ],
            order: [
                [1, "desc"]
            ],
            drawCallback: function(settings) {
                $("#filterBtn").html("Filter");
            },
        });
        // filter button click event for filtering in data table
        $("#filterBtn").click(function(e) {
            $(this).html(
                "<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                );
            withdrawDT.draw();
        });
        // click event for resetting filter form
        $("#resetBtn").click(function(e) {
            $("#filter_form")[0].reset();
            withdrawDT.draw();
        });
        $("#kt_datepicker_4").flatpickr({
        onReady: function () {
        this.jumpToDate("2022-01")
    },
    // disable: ["2025-01-10", "22025-01-11", "2025-01-12", "2025-01-13", "2025-01-14", "2025-01-15", "2025-01-16", "2025-01-17"],
    dateFormat: "Y-m-d",
});

$("#kt_datepicker_5").flatpickr({
    onReady: function () {
        this.jumpToDate("2070-01")
    },
    dateFormat: "Y-m-d",
    disable: [
        {
            from: "",
            to: ""
        },
        {
            from: "",
            to: ""
        }
    ]
});
        // extra -----------------------------------------------------------------------
        $("#manage_client_table").on("click", "tr td.dt-control", function() {
            var tr = $(this).closest("tr");
            var row = withdrawDT.row(tr);
            if (row.child.isShown()) {
                row.child.hide();
                tr.next("tr").removeClass(
                    "bg-light border-start border-3 border-primary"
                );
                tr.removeClass("shown");
            } else {
                row.child(format(row.data())).show();
                tr.addClass("shown");
                tr.next("tr").addClass(
                    "bg-light border-start border-3 border-primary border-bottom-0"
                );
            }
        });
        // for showing datatable "extra" data
        function format(d) {
            return d.extra.original.description;
        }
        // -----------------------------------------------------------------------------
</script>
@endsection
