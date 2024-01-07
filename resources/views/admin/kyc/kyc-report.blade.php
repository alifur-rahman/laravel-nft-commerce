@extends('layouts.admin.app')
@section('title','Kyc Report')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">KYC Report</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">KYC Report</li>
        <li class="breadcrumb-item text-dark">Default</li>
    </ul>
@endsection
@section('custom-css')
<style>
	.dt-buttons {
    display: none;
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
.g-1, .gy-1 {
    margin-top: 7px;
    --bs-gutter-y: 0.25rem;
}
.card {
    border: 0;
    box-shadow: var(--kt-card-box-shadow);
    background-color: var(--kt-card-bg);
    margin-top: 10px;
}
.card-header.border-bottom.d-flex.justfy-content-between {
    margin-bottom: -33px;
}
.row.g-1 {
        margin-top: 3px;
    }
	.col-md-4 {
    flex: 0 0 auto;
    width: 33.33333333%;
    margin-bottom: 20px;
}
</style>
@endsection

@section('content')
<div class="card card-flush">
	<div class="card-header border-bottom d-flex justfy-content-between">
		<h4 class="card-title">Report Filter</h4>
		<div class="btn-exports" style="width:200px; margin-top:10px ">
			<select data-placeholder="Select a state..." class="form-select" data-control="select2" style="wi" id="fx-export">
				<option value="download" data-icon="download" selected>Export to</option>
				<option value="csv" data-icon="file">CSV</option>
				<option value="excel" data-icon="file">Excel</option>
			</select>
		</div>
	</div>
	<div class="card-body">
		<form id="filterForm" class="dt_adv_search" method="POST">
			<div class="row g-1 mb-md-1">
				<div class="col-md-4 mb-1">
					<select class="form-select" data-control="select2" name="type" id="type">
						<optgroup label="Search By Category">
							<option value="">All</option>
							<option value="GAS BILL">GAS BILL</option>
							<option value="UTILITY BILL">UTILITY BILL</option>
							<option value="ELECTRIC BILL">ELECTRIC BILL</option>
							<option value="TELEPHONE BILL">TELEPHONE BILL</option>
							<option value="CREDIT CARD STATEMENT">CREDIT CARD STATEMENT</option>
							<option value="BANK STATEMENT">BANK STATEMENT</option>
							<option value="BANK CERTIFICATE">BANK CERTIFICATE</option>
							<option value="PASSPORT">PASSPORT COPY</option>
							<option value="NATIONAL ID">NATIONAL ID COPY</option>
							<option value="DRIVING LICENSE">DRIVING LICENSE</option>
						</optgroup>
					</select>
				</div>
				<div class="col-md-4  mb-1">
					<select class="form-select" data-control="select2" name="status" id="status">
						<optgroup label="Search By Status">
							<option value="">All</option>
							<option value="0">Pending</option>
							<option value="1">Verified</option>
							<option value="2">Declined</option>
						</optgroup>
					</select>
				</div>


				<div class="col-md-4">
					<div class="input-group" data-toggle="tooltip" data-trigger="hover" class="form-control" data-original-title="Issue Date">
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
						<input id="issue_from" type="text" title="Enter Issue date" name="issue_from" class="form-control date" placeholder="YYYY-MM-DD">
						<span class="input-group-text">To</span>
						<input id="issue_to" type="text" title="Enter Issue date" name="issue_to" class="form-control date" placeholder="YYYY-MM-DD">
					</div>
				</div>


				<div class="col-md-4">
					<div class="input-group" data-toggle="tooltip" data-trigger="hover" class="form-control" data-original-title="Issue Date">
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
						<input id="expire_from" type="text" title="Enter Expire date" name="expire_from" class="form-control date" placeholder="YYYY-MM-DD">
						<span class="input-group-text">To</span>
						<input id="expire_to" type="text" title="Enter Expire date" name="expire_to" class="form-control date" placeholder="YYYY-MM-DD">
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
						<input id="from" type="text" title="Create Date" name="from" class="form-control date" placeholder="YYYY-MM-DD">
						<span class="input-group-text">to</span>
						<input id="to" type="text" title="Create Date" name="to" class="form-control date" placeholder="YYYY-MM-DD">
					</div>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control dt-input dt-full-name" data-column="1" name="info" id="info" placeholder="Name / Email" data-column-index="0" />
				</div>

			</div>
			<div class="row g-1">
				<div class="col-md-8 text-right">
					
				</div>
				<div class="col-md-2 text-right">
					<button id="resetBtn" type="button" class="btn btn-danger w-100 waves-effect waves-float waves-light">
						<span class="align-middle">Reset</span>
					</button>
				</div>
				<div class="col-md-2 text-right">
					<button id="filterBtn" type="button" class="btn btn-primary  w-100 waves-effect waves-float waves-light">
						<span class="align-middle">Filter</span>
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
                        <th class="text-start min-w-80px">Client Name</th>
                        <th class="text-start min-w-75px">Client Type</th>
                        <th class="text-start min-w-75px">Document Type</th>
                        <th class="text-start min-w-75px">Issue Date</th>
                        <th class="text-start min-w-75px">Expire Date</th>
                        <th class="text-start min-w-75px">Status</th>
                        <th class="text-start min-w-75px">Date</th>
                        <th class="text-start min-w-75px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    	<!--begin::Modals-->
		<!--begin::Modal - Upgrade plan-->
		<div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-xl">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<!--begin::Modal header-->
					<div class="modal-header justify-content-end border-0 pb-0">
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
						<!--begin::Heading-->
						<div class="mb-13 text-center">
							<h1 class="mb-3">User Proof</h1>
						</div>
						<!--end::Heading-->
						<!--begin::Plans-->
						<div class="d-flex flex-column">
							<!--begin::Nav group-->
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Front Part</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Back Part</button>
                                </li>
                              </ul>
							<!--end::Nav group-->
							<!--begin::Row-->
							<div class="row mt-10">
								<!--begin::Col-->
								<div class="col-lg-8 mb-10 mb-lg-0">
									<!--begin::Tabs-->
									<div class="nav flex-column">
										<!--begin::Tab link-->
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="geeks" style="height: 100%; width: 100%;">
                                                    <img id="front_part" class="img-thumbnail" src="{{asset('admin-assets/driver_license.png')}}">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="geeks" style="height: 100%; width: 100%;">
                                                    <img id="backpart_part" class="img-thumbnail" src="{{asset('admin-assets/driver_license.png')}}">
                                                </div>
                                            </div>
                                          </div>
										<!--end::Tab link-->
									</div>
									<!--end::Tabs-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-lg-4">
									<!--begin::Tab content-->
									<div class="tab-content rounded h-100 bg-light p-10">
										<!--begin::Tab Pane-->
										<div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
											<!--begin::Heading-->
											<div class="pb-5">
												<h2 class="fw-bold text-dark">User Description</h2>
												
											</div>
											<!--end::Heading-->
											<!--begin::Body-->
											<div class="pt-1">
                                                <ul class="list-group list-group-circle text-start fw-bold" style="margin-left: 45px;">
                                                    <li>Name: <span class="text-primary" id="user_name"></span></li>
                                                    <li>Email : <span class="text-primary" id="user-email"> </li>
                                                    <li>Country : <span class="text-primary" id="user-country"></li>
                                                    <li>Address : <span class="text-primary" id="user-address"></span></li>
                                                    <li>City : <span class="text-primary" id="user-city"></li>
                                                    <li>State : <span class="text-primary" id="user-state"></span></li>
                                                    <li>Phone : <span class="text-primary" id="user-phone"></li>
                                                    <li>Zip : <span class="text-primary" id="user-zip-code"></li>
                                                    <li>Date Of Birth : <span class="text-primary" id="user-dob"> </li>
                                                    <li>Status : <span id="user-status"> </span></li>
                                                </ul>
                                                <hr />
                                                <ul class="list-group list-group-circle text-start fw-bold" style="margin-left: 45px;">
                                                    <li>Issue Date : <span class="text-primary" id="user-issue_date"> </li>
                                                    <li>Expire Date : <span class="text-primary" id="user-exp_date"></li>
                                                    <li>Document Type : <span class="text-primary" id="user-doc_type"></li>
                                                    <li>Issuer Country : <span class="text-primary" id="user-issuer-country"></li>
                                                </ul>
											</div>
											<!--end::Body-->
										</div>
										
									</div>
									<!--end::Tab content-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Plans-->
						<!--begin::Actions-->
						<div class="d-flex flex-center flex-row-fluid pt-12">
							<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
							{{-- <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
								<!--begin::Indicator label-->
								<span class="indicator-label">Upgrade Plan</span>
								<!--end::Indicator label-->
								<!--begin::Indicator progress-->
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								<!--end::Indicator progress-->
							</button> --}}
						</div>
						<!--end::Actions-->
					</div>
					<!--end::Modal body-->
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>
		<!--end::Modal - Upgrade plan-->
@endsection
@section('custom-script')
    <script src="{{ asset('assets/admin/custom-js/pages/kyc-report.js') }}"></script>
	<script>
	$(".date").flatpickr();
	</script>
@endsection

