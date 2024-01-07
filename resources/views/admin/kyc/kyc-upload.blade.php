@extends('layouts.admin.app')
@section('title','KYC UPLOAD')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">KYC UPLOAD</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">KYC Management</li>
        <li class="breadcrumb-item text-dark">Default</li>
    </ul>
@endsection
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/search-dropdown.css')}}">
<style>
    .w-50 {
        width: 37%!important;
    }
    .dark-layout .dropdown-content {
        background-color: #283046;
        border-color: #404656;
        border-radius: 6px;
    }

    .dropdown-content {
        background-color: #fff;
        border-color: #d8d6de;
        border-radius: 6px;
    }

    .dark-layout .dropdown-content a:hover {
        background-color: #404656;
        color: #fff;
    }

    .dark-layout .dropdown-content a {
        color: #b4b7bd;
    }

    #myInput:focus {
        outline: none;
    }

    .dark-layout #myInput {
        background-image: url('searchicon.png');
        border-bottom: 1px solid;
        border-color: #404656;
        border-radius: 6px;
    }

    .al-fixed-input-error .has-error {
        position: absolute;
        left: auto;
        bottom: auto;
    }
    
    .position-relative.al-fixed-input-error-select2{
        margin-bottom: 15px;
    }

    .position-relative.al-fixed-input-error-select2 .has-error {
        position: absolute;
        bottom: -20px;
        left: 0;
    }
    /* select option validation error position */

    .select-val-error> span.text-danger.has-error {
        position: relative;
        top: 65px;
    }
</style>
@endsection
@section('content')
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Sidebar-->
            <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                <!--begin::Card-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Summary-->
                        <!--begin::User Info-->
                        <div class="d-flex flex-center flex-column py-5">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <img src="{{ asset('assets/admin/images/avatars/'.$avatar) }}" alt="image" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Name-->
                            <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">Emma Smith</a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            <div class="mb-9">
                                <!--begin::Badge-->
                                <div class="badge badge-lg badge-light-primary d-inline">Administrator</div>
                                <!--begin::Badge-->
                            </div>
                        </div>
                        <!--end::User Info-->
                        <!--end::Summary-->
                        <!--begin::Details toggle-->
                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span></div>
                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">Edit</a>
                            </span>
                        </div>
                        <!--end::Details toggle-->
                        <div class="separator"></div>
                        <!--begin::Details content-->
                        <div id="kt_user_view_details" class="collapse show">
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Name</div>
                                <div class="text-gray-600" id="name">----</div>
                                <!--begin::Details item-->
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Address</div>
                                <div class="text-gray-600">
                                    <a href="#" class="text-gray-600 text-hover-primary" id="address">----</a>
                                </div>
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Zip Code</div>
                                <div class="text-gray-600" id="zip-code">---</div>
                                <!--begin::Details item-->
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">City</div>
                                <div class="text-gray-600" id="city">---</div>

                                <div class="fw-bold mt-5">State</div>
                                <div class="text-gray-600" id="state">---</div>
                                <!--begin::Details item-->
                            </div>
                        </div>
                        <!--end::Details content-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Sidebar-->
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-15">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">ID Proof</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Address Proof</a>
                    </li>
                  
                    <li class="nav-item ms-auto">
                        <!--begin::Action menu-->
                        <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-2 me-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Payments</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="#" class="menu-link px-5">Create invoice</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="#" class="menu-link flex-stack px-5">Create payments
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title">Subscription</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-5">Apps</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-5">Billing</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-5">Statements</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3">
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input w-30px h-20px" type="checkbox" value="" name="notifications" checked="checked" id="kt_user_menu_notifications" />
                                                <span class="form-check-label text-muted fs-6" for="kt_user_menu_notifications">Notifications</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-3"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Account</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="#" class="menu-link px-5">Reports</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5 my-1">
                                <a href="#" class="menu-link px-5">Account Settings</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="#" class="menu-link text-danger px-5">Delete customer</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu-->
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin:::Tab content-->
                <div class="tab-content" id="myTabContent">
                    <!--id proof-->
                    <form class="tab-pane fade show active" enctype="multipart/form-data" action="#" method="post" id="kt_user_view_overview_tab" role="tabpanel" >
                        @csrf
                        <input type="hidden" name="perpose" value="id proof">
                        <input type="hidden" name="op" value="admin">
                        <!--begin::Card-->
                        <div class="card card-flush mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header mt-6">
                                <div class="card-title flex-column">
                                    <h2 class="mb-1">User's ID Proof</h2>
                                    {{-- <div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div> --}}
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label class="fs-6 fw-semibold">Document Type</label>
                                    </div>
                                    <div class="col-sm-9 select-val-error">
                                        <select name="document_type" aria-label="Select a Language" data-control="select2" data-placeholder="Select a document type first" class="select2-selection select2-selection--single form-select form-select-solid">
                                            <option value="" selected>Select a document type first</option>
                                            @foreach($id_document_type as $value)
                                            <option value="{{$value->id}}">{{$value->id_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4" data-kt-calendar="datepicker">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">                                    
                                        <label class="fs-6 fw-semibold">Issue Date</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="id-issue-date" class="form-control form-control-solid flatpickr-basic" placeholder="YYYY-MM-DD" name="issue_date"  />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">                                    
                                        <label class="fs-6 fw-semibold">Expire Date</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="id-expire-date" name="expire_date" class="form-control form-control-solid flatpickr-basic"  placeholder="YYYY-MM-DD" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">                                    
                                        <label class="fs-6 fw-semibold">Client</label>
                                    </div>
                                    <div class="col-sm-9" id="myDropdown">
                                        <input type="text" name="client_email" class="form-control form-control-solid get-client" placeholder="client_email" id="myInput" onkeyup="filterFunction()">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label class="fs-6 fw-semibold">Status</label>
                                    </div>
                                    <div class="col-sm-9 select-val-error">
                                        <select name="status" aria-label="Select a Language" data-control="select2" data-placeholder="Select Status" class="select2-selection select2-selection--single form-select form-select-solid">
                                            <option></option>
                                            <option value="">Select status</option>
                                            <option value="1">Verified</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Decline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-end">
                                        <!-- id front part -->
                                        <div class="w-50">
                                            <div class="dropzone dropzone-area id-proof-dropzone w-100 text-center" data-field="front_part" id="id-dropzone" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID">
                                                <div class="dz-message justify-content-center">
                                                    <div class="dz-message-label">Drop Your id front part</div>
                                                </div>
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                        <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- id back part -->
                                        <div class="w-50 ms-2">
                                            <div class="dropzone dropzone-area id-proof-dropzone w-100" data-field="back_part" id="id-back-part" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID Back Part">
                                                <div class="dz-message justify-content-center">
                                                    <div class="dz-message-label">Drop Your id back part</div>
                                                </div>
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                        <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="d-flex justify-content-end align-items-center mt-12">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-primary w-25" id="upload-kyc-button" >
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                           
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </form>
                    <!--end:::Tab pane-->
                    <!--address proof-->
                    <form class="tab-pane fade"   action="#" method="post" id="kt_user_view_overview_security"  role="tabpanel">
                        @csrf
                        <input type="hidden" name="perpose" value="address proof">
                        <input type="hidden" name="op" value="admin">
                        <!--begin::Card-->
                        <div class="card card-flush mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header mt-6">
                                <div class="card-title flex-column">
                                    <h2 class="mb-1">User's Address Proof</h2>
                                    {{-- <div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div> --}}
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label class="fs-6 fw-semibold">Document Type</label>
                                    </div>
                                    <div class="col-sm-9 select-val-error">
                                        <select name="document_type" aria-label="Select a Language" data-control="select2" data-placeholder="Select a document type first" class="select2-selection select2-selection--single form-select form-select-solid">
                                            <option value="" selected>Select a document type first</option>
                                            @foreach($address_document_type as $value)
                                            <option value="{{$value->id}}">{{$value->id_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4" data-kt-calendar="datepicker">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">                                    
                                        <label class="fs-6 fw-semibold">Issue Date</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="id-issue-date" class="form-control form-control-solid flatpickr-basic" placeholder="YYYY-MM-DD" name="issue_date"  />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">                                    
                                        <label class="fs-6 fw-semibold">Expire Date</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="id-expire-date" name="expire_date" class="form-control form-control-solid flatpickr-basic"  placeholder="YYYY-MM-DD" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">                                    
                                        <label class="fs-6 fw-semibold">Client</label>
                                    </div>
                                    <div class="col-sm-9" id="myDropdown">
                                        <input type="text" name="client_email" class="form-control form-control-solid get-client" placeholder="client_email" id="address-client-email" onkeyup="filterFunction()">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="fv-row row mb-1">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label class="fs-6 fw-semibold">Status</label>
                                    </div>
                                    <div class="col-sm-9 select-val-error">
                                        <select name="status" aria-label="Select a Language" data-control="select2" data-placeholder="Select Status" class="select2-selection select2-selection--single form-select form-select-solid">
                                            <option></option>
                                            <option value="">Select status</option>
                                            <option value="1">Verified</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Decline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="col-sm-12">
                                    <div class="">
                                        <!-- id front part -->
                                        <div class="w-50 float-end">
                                            <div class="dropzone dropzone-area address-proof-dropzone" id="id-dropzone-address-proof" data-field="document" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your Banner">
                                                <div class="dz-message justify-content-center">
                                                    <div class="dz-message-label">Drop Your Document</div>
                                                </div>
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                        <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-8 pt-4">
                                <div class="d-flex justify-content-end align-items-center mt-12">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-primary w-25" id="upload-kyc-button-address">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </form>
                </div>
                <!--end:::Tab content-->
            </div>
            <!--end::Content-->
        </div>
<!--end::Content-->
@endsection
@section('custom-script')
<script src="{{asset('assets/admin/custom-js/pages/admin-kyc-upload.js')}}"> </script>
<script src="{{asset('assets/admin/js/file-uploaders/dropzone.min.js')}}"> </script>
<script src="{{asset('assets/admin/js/file-upload-with-form.js')}}"> </script>
<script>


$('#upload-kyc-button, #upload-kyc-button-address').click(function() {
        $(this).prop('disabled', true);
        setTimeout(() => {
            $(this).prop('disabled', false);
        }, 30000);
   
    })
// proof--------------
file_upload(
    "/admin/user-admin/verify-form", //<--request url for proccessing
    false, //<---auto process true or false
    ".id-proof-dropzone", //<---dropzones selectore
    "kt_user_view_overview_tab", //<---form id/selectore
    "#upload-kyc-button", //<---submit button selectore
    "ID Proof" //<---Notification Title
);
// address proof--------------------------------------
file_upload(
    "/admin/user-admin/verify-form", //<--request url for proccessing
    false, //<---auto process true or false
    ".address-proof-dropzone", //<---dropzones selectore
    "kt_user_view_overview_security", //<---form id/selectore
    "#upload-kyc-button-address", //<---submit button selectore
    "Address proof" //<---Notification title
);

</script>


@endsection