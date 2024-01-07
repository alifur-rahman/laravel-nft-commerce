// for showing datatable "extra" data
function format({ extra }) {
    const {
        userID,
        userImage,
        status,
        totalWithdraw,
        totalDeposit,
        kycCheckUncheck,
        nftAddress,
        nftUserName,
        countryName,
    } = extra;
    return `
    <div class="px-6">
        <!--begin:::User Info-->
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-5">
                <!--begin::Tables Widget 1-->
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <tr>
                                    <th class="min-w-200px fw-semibold">NFT Address</th>
                                    <td>${nftAddress}</td>
                                </tr>
                                <tr>
                                    <th class="min-w-200px fw-semibold">Wallet Deposits</th>
                                    <td>&dollar; ${totalDeposit}</td>
                                </tr>
                                <tr>
                                    <th class="min-w-200px fw-semibold">Wallet Withdraw</th>
                                    <td>&dollar; ${totalWithdraw}</td>
                                </tr>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--endW::Tables Widget 1-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-7">
                <!--begin::Tables Widget 2-->
                <div class="card card-flush mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body py-3 pe-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <tr>
                                            <th class="min-w-200px fw-semibold">NFT User Name</th>
                                            <td>${nftUserName}</td>
                                        </tr>
                                        <tr>
                                            <th class="min-w-200px fw-semibold">KYC</th>
                                            <td>${kycCheckUncheck}</td>
                                        </tr>
                                        <tr>
                                            <th class="min-w-200px fw-semibold">Country</th>
                                            <td>${countryName}</td>
                                        </tr>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100 h-100">
                                    <img class="w-100" src="${userImage}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Tables Widget 2-->
            </div>
            <!--end::Col-->
        </div>
        <!--end:::User Info-->

        <div class="card card-flush h-lg-100 rounded-0">
            <div class="card-body pt-5">

                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 fw-semibold mt-6 mb-8">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" data-userid="${userID}"
                        onclick="nftExchangeDT(this, ${userID})"
                            href="#tab_view_nft_exchange_${userID}">
                            <i class="bi bi-currency-exchange"></i>
                            NFT Exchange
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" onclick="withdrawDT(this, ${userID})" href="#tab_view_withdraw_${userID}">
                            <i class="bi bi-credit-card-fill"></i>
                            Withdraws
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" onclick="depositDT(this, ${userID})" href="#tab_view_deposit_${userID}">
                            <i class="bi bi-credit-card-fill"></i>
                            Deposits
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" onclick="kycDT(this, ${userID})" href="#tab_view_kyc_${userID}">
                            <i class="bi bi-file-earmark-check-fill"></i>
                            KYC
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" onclick="commentDT(this, ${userID})" href="#tab_view_comments_${userID}">
                            <i class="bi bi-chat-square-text-fill"></i>
                            Comments
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#tab_view_settings_${userID}">
                            <i class="bi bi-gear-fill"></i>
                            Settings
                        </a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->

                <!--begin::Tab content-->
                <div class="tab-content" id="">
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade show active" id="tab_view_nft_exchange_${userID}" role="tabpanel">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 gx-7 text-gray-800 nft_exchange_datatable" id="nft_exchange_datatable_${userID}">
                            <!--begin::Table head-->
                            <thead class="bg-light">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bold fs-7 text-uppercase">
                                    <th>ID</th>
                                    <th>Asset Name</th>
                                    <th>Owner</th>
                                    <th>Seller</th>
                                    <th>Transfer From</th>
                                    <th>Transfer To</th>
                                    <th>Winner</th>
                                    <th>Sale Time</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="tab_view_withdraw_${userID}" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 gx-7 text-gray-800 withdraw_datatable" id="withdraw_datatable_${userID}">
                            <!--begin::Table head-->
                            <thead class="bg-light">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bold fs-7 text-uppercase">
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                        </table>
                    </div>
                    <!--end:::Tab pane-->
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="tab_view_deposit_${userID}" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 gx-7 text-gray-800 deposit_datatable" id="deposit_datatable_${userID}">
                            <!--begin::Table head-->
                            <thead class="bg-light">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bold fs-7 text-uppercase">
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                        </table>
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="tab_view_kyc_${userID}" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 gx-7 text-gray-800 kyc_datatable" id="kyc_datatable_${userID}">
                            <!--begin::Table head-->
                            <thead class="bg-light">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bold fs-7 text-uppercase">
                                    <th>ID</th>
                                    <th>Submit Date</th>
                                    <th>Document Type</th>
                                    <th>Status</th>

                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                        </table>
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="tab_view_comments_${userID}" role="tabpanel">
                        <button class="btn btn-sm btn-light-primary mb-2" onclick="showAddPasswordModel(this, ${userID})">
                            Add Comment
                        </button>
                        <table class="table align-middle table-row-dashed fs-6 gy-5 gx-7 text-gray-800 comment_datatable" id="comment_datatable_${userID}">
                            <!--begin::Table head-->
                            <thead class="bg-light">
                                <!--begin::Table row-->
                                <tr class="text-start fw-bold fs-7 text-uppercase">
                                    <th>ID</th>
                                    <th>Commented Date</th>
                                    <th>Comment</th>
                                    <th>Actions</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                        </table>
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="tab_view_settings_${userID}" role="tabpanel">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table border align-middle settings-table">
                                <tr class="fw-bold fs-7 text-gray-800 border-bottom-1">
                                    <th class="border-right-1 p-3">
                                        <label class="form-check-label pb-2">Block/Unblock</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input h-22px w-50px" type="checkbox" ${status.activeStatus} onchange="blockUnblock(this, ${userID})" />
                                        </div>
                                    </th>
                                    <td class="p-3">
                                        <div class="row">
                                            <div class="col-xl-6"></div>
                                            <div class="col-xl-6">
                                                <button class="btn btn-primary w-100 text-center"
                                                onclick="resetPassword(${userID})">
                                                    Reset password
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="fw-bold text-gray-800 border-bottom-1">
                                    <th class="border-right-1 p-3">
                                        <label class="form-check-label pb-2">Google 2 Step Authentication</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input h-22px w-50px" type="checkbox" onchange="twoStepAuthED(this, ${userID})" ${status.twoStepStatus} />
                                        </div>
                                    </th>
                                    <td class="p-3">
                                        <div class="row">
                                            <div class="col-xl-6"></div>
                                            <div class="col-xl-6">
                                                <button class="btn btn-primary w-100 text-center" onclick="resetTransactionPin(${userID})">
                                                    Reset Transaction Pin
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="fw-bold text-gray-800 border-bottom-1">
                                    <th class="border-right-1 p-3">
                                        <label class="form-check-label pb-2">Email Authentication</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                            <input class="form-check-input h-22px w-50px" type="checkbox" onchange="emailAuthED(this, ${userID})" ${status.emailAuthStatus} />
                                        </div>
                                    </th>
                                    <td class="p-3">
                                        <div class="row">
                                            <div class="col-xl-6"></div>
                                            <div class="col-xl-6">
                                                <button class="btn btn-primary w-100 text-center"
                                                onclick="showChangePasswordModel(${userID})">
                                                    Change password
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="fw-bold text-gray-800 border-bottom-1">
                                    <th class="border-right-1 p-3">
                                        <label class="form-check-label pb-2">Email Verification</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                            <input class="form-check-input h-22px w-50px" type="checkbox" onchange="emailVarifyED(this, ${userID})" ${status.emailVerifyStatus} />
                                        </div>
                                    </th>
                                    <td class="p-3">
                                        <div class="row">
                                            <div class="col-xl-6"></div>
                                            <div class="col-xl-6">
                                                <button class="btn btn-primary w-100 text-center" onclick="showChangeTransPinModel(${userID})">
                                                    Change Transaction Pin
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!--begin:: Now it is not in use ---------------
                                <tr class="fw-bold text-gray-800 border-bottom-1">
                                    <th class="border-right-1 p-3">
                                        <label class="form-check-label pb-2">Deposit</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                            <input class="form-check-input h-22px w-50px" name="deposit" type="checkbox" value="" />
                                        </div>
                                    </th>
                                    <td class="p-3">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                                    <option selected>Select categorey</option>
                                                    <option>Not Started</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                <button class="btn btn-primary w-100 text-center" id="">
                                                    Save Categorey
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                end:: Now it is not in use-->

                                <tr class="fw-bold text-gray-800 border-bottom-1">
                                    <th class="border-right-1 p-3">
                                        <label class="form-check-label pb-2">Account Transaction</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                            <input class="form-check-input h-22px w-50px" name="" type="checkbox" value=""/>
                                        </div>
                                    </th>
                                    <td class="p-3">
                                        <label class="form-check-label pb-2">Withdraw</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                            <input class="form-check-input h-22px w-50px" type="checkbox" onchange="withdrawOperation(this, ${userID})" ${status.withdrawOperation} />
                                        </div>
                                    </td>
                                    <td class="p-3">
                                    <label class="form-check-label pb-2">Deposit</label>
                                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-22px w-50px" type="checkbox" onchange="depositOperation(this, ${userID})" ${status.depositOperation} />
                                    </div>
                                </td>
                                </tr>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end:::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
        </div>
    </div>
    `;
}

const manageClientDT = $("#manage_client_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: `${manageClientURL}?action=table`,
        data: function (d) {
            return $.extend({}, d, {
                user_id: $("#account").val(),
                user: $("#user").val(),
                finance: $("#finance").val(),
                verification_status: $("#status").val(),
            });
        },
    },
    columns: [
        {
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
            data: "phone",
        },
        {
            data: "created_at",
        },
        {
            data: "active_status",
        },
    ],
    order: [[1, "desc"]],
    drawCallback: function (settings) {
        $("#filterBtn").html("Filter");
        $("#resetBtn").html("Reset");
    },
});
// filter button click event for filtering in data table
$("#filterBtn").click(function (e) {
    $(this).html(
        "<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
    );
    manageClientDT.draw();
});
// click event for resetting filter form
$("#resetBtn").click(function (e) {
    $(this).html(
        "<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
    );
    $("#filter_form")[0].reset();
    manageClientDT.draw();
});

// extra -----------------------------------------------------------------------
$("#manage_client_table").on("click", "tr td.dt-control", function () {
    var tr = $(this).closest("tr");
    var row = manageClientDT.row(tr);
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
    const userID = tr.next("tr").find(".active").data("userid");
    const elm = this.closest("tr")?.nextSibling?.querySelector(".active");
    nftExchangeDT(elm, userID);
});
// -----------------------------------------------------------------------------

// NFT Exchange(sales) DATATABLE------------------------------------------------
function nftExchangeDT(elm, userID) {
    $(elm)
        .closest("tr")
        .find(".nft_exchange_datatable")
        .DataTable()
        .clear()
        .destroy();
    const nftExchangeDT = $(elm)
        .closest("tr")
        .find(".nft_exchange_datatable")
        .DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: manageClientURL,
                type: "GET",
                data: {
                    action: "nft-exchange-table",
                    userID,
                },
            },
            columns: [
                {
                    data: "id",
                    visible: false,
                },
                {
                    data: "assetName",
                },
                {
                    data: "ownerName",
                },
                {
                    data: "sellerName",
                },
                {
                    data: "transfererName",
                },
                {
                    data: "recieverName",
                },
                {
                    data: "winnerName",
                },
                {
                    data: "time",
                },
            ],
            order: [[0, "desc"]],
        });
}
// -----------------------------------------------------------------------------

// withdraw DATATABLE-----------------------------------------------------------
function withdrawDT(elm, userID) {
    $(elm)
        .closest("tr")
        .find(".withdraw_datatable")
        .DataTable()
        .clear()
        .destroy();
    const withdrawDT = $(elm)
        .closest("tr")
        .find(".withdraw_datatable")
        .DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: manageClientURL,
                type: "GET",
                data: {
                    action: "withdraw-table",
                    userID,
                },
            },
            columns: [
                {
                    data: "id",
                    visible: false,
                },
                {
                    data: "amount",
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
            ],
            order: [[0, "desc"]],
        });
}
// -----------------------------------------------------------------------------

// Deposit DATATABLE------------------------------------------------------------
function depositDT(elm, userID) {
    $(elm)
        .closest("tr")
        .find(".deposit_datatable")
        .DataTable()
        .clear()
        .destroy();
    const depositDT = $(elm)
        .closest("tr")
        .find(".deposit_datatable")
        .DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: manageClientURL,
                type: "GET",
                data: {
                    action: "deposit-table",
                    userID,
                },
            },
            columns: [
                {
                    data: "id",
                    visible: false,
                },
                {
                    data: "amount",
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
            ],
            order: [[0, "desc"]],
        });
}
// -----------------------------------------------------------------------------

// KYC DATATABLE----------------------------------------------------------------
function kycDT(elm, userID) {
    $(elm).closest("tr").find(".kyc_datatable").DataTable().clear().destroy();
    const kycDT = $(elm)
        .closest("tr")
        .find(".kyc_datatable")
        .DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: manageClientURL,
                type: "GET",
                data: {
                    action: "kyc-table",
                    userID,
                },
            },
            columns: [
                {
                    data: "id",
                    visible: false,
                },
                {
                    data: "issue_date",
                },
                {
                    data: "doc_type",
                },
                {
                    data: "status",
                },
            ],
            order: [[0, "desc"]],
        });
}
// -----------------------------------------------------------------------------

// comment DATATABLE------------------------------------------------------------
function commentDT(elm, userID) {
    $(elm)
        .closest("tr")
        .find(".comment_datatable")
        .DataTable()
        .clear()
        .destroy();
    const commentDT = $(elm)
        .closest("tr")
        .find(".comment_datatable")
        .DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: manageClientURL,
                type: "GET",
                data: {
                    action: "comment-table",
                    userID,
                },
            },
            columns: [
                {
                    data: "id",
                    visible: false,
                },
                {
                    data: "created_at",
                },
                {
                    data: "comment",
                },
                {
                    data: "",
                },
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        console.log(full);
                        console.log(typeof full.comment);
                        const comment = String(full.comment);
                        return `
                        <a href="#" data-comment="${full.comment}" onclick="showCommentEditModal(event, ${full.id})">
                            <i class="bi bi-pencil-square fs-3 me-2 text-success"></i>
                        </a>
                        <a href="#" onclick="deleteComment(event, ${full.id})">
                            <i class="bi bi-trash3 fs-3 text-danger"></i>
                        </a>
                        `;
                    },
                },
            ],
            order: [[0, "desc"]],
        });
}
// -----------------------------------------------------------------------------

// add comment------------------------------------------------------------------
let tempAddCommentDT;
function showAddPasswordModel(elm, userID) {
    $("#add-comment-modal").modal("show");
    $("#add-comment-modal .user-id").val(userID);
    tempAddCommentDT = $(elm).closest(".tab-pane").find(".comment_datatable");
}

function addCommentCallBack(data) {
    if (data.status === true) {
        tempAddCommentDT.DataTable().draw();
        toastr.success(data.message, "Success!");
        $("#add-comment-modal").modal("hide");
    } else {
        toastr.error(data.message, "Failed!");
    }
}
// -----------------------------------------------------------------------------

// Update Comment---------------------------------------------------------------
let tempUpdateCommentDT;
function showCommentEditModal(event, commentID) {
    event.preventDefault();
    tempUpdateCommentDT = $(event.target)
        .closest(".tab-pane")
        .find(".comment_datatable");
    const comment = $(event.target).closest("a").data("comment");
    $("#update-comment-modal").modal("show");
    $("#update-comment-form .comment-id").val(commentID);
    $("#update-comment-form textarea").val(comment);
}

function updateCommentCallBack(data) {
    if (data.status === true) {
        tempUpdateCommentDT.DataTable().draw();
        toastr.success(data.message, "Success!");
        $("#update-comment-modal").modal("hide");
    } else {
        toastr.error(data.message, "Failed!");
    }
}

// delete comment---------------------------------------------------------------
function deleteComment(event, commentID) {
    event.preventDefault();
    const commentDT = $(event.target).closest(".comment_datatable").DataTable();

    Swal.fire({
        icon: "warning",
        title: "Are you sure? to delete this!",
        html: "If you want to permanently delete this comment please click OK, otherwise simply click cancel",
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "DELETE",
                dataType: "json",
                data: { action: "delete-comment", commentID },
                success: function (data) {
                    if (data.status === true) {
                        commentDT.draw();
                        toastr.success(data.message, "Delete Comment");
                    } else toastr.error(data.message, "Delete Comment");
                },
            });
        } //ending if condition
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Block/Unblock User-----------------------------------------------------------
function blockUnblock(elm, userID) {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = userID;
    if ($(elm).is(":checked")) {
        warning_title = "Are you sure? to Block this user!";
        warning_msg =
            "If you want to Block this User please click OK, otherwise simply click cancel";
        request_for = "block";
    } else if ($(elm).is(":not(:checked)")) {
        warning_title = "Are you sure? to Unblock this user!";
        warning_msg =
            "If you want to Unblock this User please click OK, otherwise simply click cancel";
        request_for = "unblock";
    }
    Swal.fire({
        icon: "warning",
        title: warning_title,
        html: warning_msg,
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "block-unblock",
                    id: id,
                    request_for: request_for,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, data.success_title);
                    else toastr.error(data.message, data.success_title);
                },
            });
        } else {
            if ($(elm).is(":checked")) {
                $(elm).prop("checked", false);
            } else if ($(elm).is(":not(:checked)")) {
                $(elm).prop("checked", true);
            }
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Enable/Disable Google Two Step Authentication--------------------------------
function twoStepAuthED(elm, userID) {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = userID;
    if ($(elm).is(":checked")) {
        warning_title = "Are you sure? to Enable Google 2 setp!";
        warning_msg =
            "If you want to Enable Google 2 step. please click OK, otherwise simply click cancel";
        request_for = "enable";
    } else if ($(elm).is(":not(:checked)")) {
        warning_title = "Are you sure? to Disable Google 2 setp!";
        warning_msg =
            "If you want to Disable Google 2 step. please click OK, otherwise simply click cancel";
        request_for = "disable";
    }
    Swal.fire({
        icon: "warning",
        title: warning_title,
        html: warning_msg,
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "two-step-auth",
                    id: id,
                    request_for: request_for,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, data.success_title);
                    else toastr.error(data.message, data.success_title);
                },
            });
        } else {
            if ($(elm).is(":checked")) {
                $(elm).prop("checked", false);
            } else if ($(elm).is(":not(:checked)")) {
                $(elm).prop("checked", true);
            }
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Enable/Disable Email Authentication------------------------------------------
function emailAuthED(elm, userID) {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = userID;
    if ($(elm).is(":checked")) {
        warning_title = "Are you sure? to Enable Email Authentication!";
        warning_msg =
            "If you want to Enable Email Authentication. please click OK, otherwise simply click cancel";
        request_for = "enable";
    } else if ($(elm).is(":not(:checked)")) {
        warning_title = "Are you sure? to Disable Email Authentication!";
        warning_msg =
            "If you want to Disable Email Authentication. please click OK, otherwise simply click cancel";
        request_for = "disable";
    }
    Swal.fire({
        icon: "warning",
        title: warning_title,
        html: warning_msg,

        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "email-auth",
                    id: id,
                    request_for: request_for,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, data.success_title);
                    else toastr.error(data.message, data.success_title);
                },
            });
        } else {
            if ($(elm).is(":checked")) {
                $(elm).prop("checked", false);
            } else if ($(elm).is(":not(:checked)")) {
                $(elm).prop("checked", true);
            }
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Enable/Disable Email Verification--------------------------------------------
function emailVarifyED(elm, userID) {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = userID;
    if ($(elm).is(":checked")) {
        warning_title = "Are you sure? to Enable Email Verification!";
        warning_msg =
            "If you want to Enable Email Verification. please click OK, otherwise simply click cancel";
        request_for = "enable";
    } else if ($(elm).is(":not(:checked)")) {
        warning_title = "Are you sure? to Disable Email Verification!";
        warning_msg =
            "If you want to Disable Email Verification. please click OK, otherwise simply click cancel";
        request_for = "disable";
    }
    Swal.fire({
        icon: "warning",
        title: warning_title,
        html: warning_msg,

        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "email-verify",
                    id: id,
                    request_for: request_for,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, data.success_title);
                    else toastr.error(data.message, data.success_title);
                },
            });
        } else {
            if ($(elm).is(":checked")) {
                $(elm).prop("checked", false);
            } else if ($(elm).is(":not(:checked)")) {
                $(elm).prop("checked", true);
            }
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Enable/Disble Withdraw Operation---------------------------------------------
function withdrawOperation(elm, userID) {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = userID;
    if ($(elm).is(":checked")) {
        warning_title = "Are you sure? to Enable Withdraw Operation!";
        warning_msg =
            "If you want to Enable Withdraw Operation. please click OK, otherwise simply click cancel";
        request_for = "enable";
    } else if ($(elm).is(":not(:checked)")) {
        warning_title = "Are you sure? to Disable Withdraw Operation!";
        warning_msg =
            "If you want to Disable Withdraw Operation. Please click OK, otherwise simply click cancel";
        request_for = "disable";
    }
    Swal.fire({
        icon: "warning",
        title: warning_title,
        html: warning_msg,

        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "withdraw-operation",
                    id: id,
                    request_for: request_for,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, data.success_title);
                    else toastr.error(data.message, data.success_title);
                },
            });
        } else {
            if ($(elm).is(":checked")) {
                $(elm).prop("checked", false);
            } else if ($(elm).is(":not(:checked)")) {
                $(elm).prop("checked", true);
            }
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Enable/Disble deposit Operation---------------------------------------------
function depositOperation(elm, userID) {
    let warning_title = "";
    let warning_msg = "";
    let request_for;
    let id = userID;
    if ($(elm).is(":checked")) {
        warning_title = "Are you sure? to Enable Deposit Operation!";
        warning_msg =
            "If you want to Enable Deposit Operation. please click OK, otherwise simply click cancel";
        request_for = "enable";
    } else if ($(elm).is(":not(:checked)")) {
        warning_title = "Are you sure? to Disable Deposit Operation!";
        warning_msg =
            "If you want to Disable Deposit Operation. Please click OK, otherwise simply click cancel";
        request_for = "disable";
    }
    Swal.fire({
        icon: "warning",
        title: warning_title,
        html: warning_msg,

        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "deposit-operation",
                    id: id,
                    request_for: request_for,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, data.success_title);
                    else toastr.error(data.message, data.success_title);
                },
            });
        } else {
            if ($(elm).is(":checked")) {
                $(elm).prop("checked", false);
            } else if ($(elm).is(":not(:checked)")) {
                $(elm).prop("checked", true);
            }
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Reset Password---------------------------------------------------------------
function resetPassword(userID) {
    Swal.fire({
        icon: "warning",
        title: "Reset User Password",
        html: "Are you confirm reset user password",
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "reset-password",
                    userID,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, "Success!");
                    else toastr.error(data.message, "Failed!");
                },
            });
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Reset Transaction Password---------------------------------------------------
function resetTransactionPin(userID) {
    Swal.fire({
        icon: "warning",
        title: "Reset User Transaction Pin",
        html: "Are you confirm to reset transaction pin",
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-warning",
            cancelButton: "btn btn-danger",
        },
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    action: "reset-transaction-pin",
                    userID,
                },
                success: function (data) {
                    if (data.status === true)
                        toastr.success(data.message, "Success!");
                    else toastr.error(data.message, "Failed!");
                },
            });
        }
    }); //ending swite alert
}
// -----------------------------------------------------------------------------

// Change Password--------------------------------------------------------------
function showChangePasswordModel(userID) {
    $("#change-password-model").modal("show");
    $("#change-password-model .user-id").val(userID);
}

function changePasswordCallBack(data) {
    if (data.status === true) {
        toastr.success(data.message, "Success!");
        $("#change-password-model").modal("hide");
    } else {
        toastr.error(data.message, "Failed!");
    }
}
// -----------------------------------------------------------------------------

// change transaction pin-------------------------------------------------------
function showChangeTransPinModel(userID) {
    $("#change-transaction-pin-model").modal("show");
    $("#change-transaction-pin-model .user-id").val(userID);
}

function changeTransactionPinCallBack(data) {
    if (data.status === true) {
        toastr.success(data.message, "Success!");
        $("#change-transaction-pin-model").modal("hide");
    } else {
        toastr.error(data.message, "Failed!");
    }
}
// -----------------------------------------------------------------------------
