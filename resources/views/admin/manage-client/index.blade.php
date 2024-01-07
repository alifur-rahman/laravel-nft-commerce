@extends('layouts.admin.app')
@section('breadcrumb')
<h1 class="text-dark fw-bold my-0 fs-2">Manage Clients</h1>
<ul class="breadcrumb fw-semibold fs-base my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
    </li>
    <li class="breadcrumb-item text-muted">Manage Client</li>
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
            <h3 class="fw-bold m-0">Report Filter</h3>
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
        <form action=""id="filter_form">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Search By Finance</label>
                    <select class="form-select" id="finance" data-control="select2" data-placeholder="Select an option">
                        <option></option>
                        <option value="">All</option>
                        <option value="deposit">Deposit</option>
                        <option value="withdraw">Withdraw</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kyc Status</label>
                    <select class="form-select" id="status" data-control="select2" data-placeholder="Select an option">
                        <option></option>

                        <option value="0">pending</option>
                        <option value="1">verified</option>
                        <option value="2">declined</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">User</label>
                    <input type="text" class="form-control" id="user" placeholder="User Email/phone/name" />
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-md-4">
                    <label class="form-label">NFT Account </label>
                    <input type="text" class="form-control" id="account" placeholder="NFT Account" />
                </div>
                <div class="col-md-4">
                    <label class="form-label">Action</label>
                    <a href="#" class="btn btn-bg-secondary w-100" id="resetBtn" >Reset</a>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Action</label>
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
                    <th class="text-start min-w-75px">Phone</th>
                    <th class="text-start min-w-75px">Joined</th>
                    <th class="text-start min-w-75px">Status</th>
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

{{-- START: MODELS --}}
<!-- add comment model -->
<div class="modal fade" id="add-comment-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Comment</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>
            <form action="{{ url('admin/manage-clients') }}" id="add-comment-form" method="POST">
                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label">Comment</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Comment"></textarea>
                    </div>
                    <input type="hidden" name="user_id" class="user-id">
                    <input type="hidden" name="action" value="add-comment">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-new-comment" onclick="_run(this)"
                        data-validator="true" data-form="add-comment-form"
                        data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                        data-callback="addCommentCallBack" data-btnid="add-new-comment">Add Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- update comment model -->
<div class="modal fade" id="update-comment-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Comment</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>
            <form action="{{ url('admin/manage-clients') }}" id="update-comment-form">
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label">Comment</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Comment"></textarea>
                    </div>
                    {{-- <input type="hidden" name="user_id" class="user-id"> --}}
                    <input type="hidden" name="comment_id" class="comment-id">
                    <input type="hidden" name="action" value="update-comment">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-new-comment" onclick="_run(this)"
                        data-validator="true" data-form="update-comment-form"
                        data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                        data-callback="updateCommentCallBack" data-btnid="update-new-comment">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--change password model-->
<div class="modal fade" id="change-password-model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Change Password 🔒</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>
            <form action="{{ url('admin/manage-clients') }}" id="change-password-form">

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>
                    <input type="hidden" name="trader_id" class="user-id">
                    <input type="hidden" name="action" value="change-password">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="set-new-password" onclick="_run(this)"
                        data-validator="true" data-form="change-password-form"
                        data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                        data-callback="changePasswordCallBack" data-btnid="set-new-password">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--change transaction pin model-->
<div class="modal fade" id="change-transaction-pin-model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Change Password 🔒</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>
            <form action="{{ url('admin/manage-clients') }}" id="change-transaction-pin-form">

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label">New Password</label>
                        <input type="password" name="transaction_pin" class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="transaction_pin_confirmation" class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>
                    <input type="hidden" name="user_id" class="user-id">
                    <input type="hidden" name="action" value="change-transaction-pin">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="set-new-transaction-pin" onclick="_run(this)"
                        data-validator="true" data-form="change-transaction-pin-form"
                        data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                        data-callback="changeTransactionPinCallBack" data-btnid="set-new-transaction-pin">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- END: MODELS --}}
@endsection

@section('custom-script')
<script>
    const manageClientURL = "{{ url('admin/manage-clients') }}";
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
</script>
<script src="{{ asset('assets/admin/custom-js/manage-client/manage-client.js') }}"></script>
@endsection
