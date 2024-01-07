@extends('layouts.admin.app')
@section('title', 'Company Social Info')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">Company Settings</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Settings</li>
        <li class="breadcrumb-item text-dark">Social Info</li>
    </ul>
@endsection

@section('custom-css')

@endsection

@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Social Infos</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <form id="social_info_form" class="form" action="{{ route('admin.settings.social_info') }}" method="POST">
                @csrf

                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label required fw-semibold fs-6">Social Links</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-10">
                            <!--begin::Row-->
                            <div class="row mb-6">
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="bi bi-facebook"></i>
                                        </span>
                                        <input type="text" class="form-control" name="facebook"
                                            placeholder="Facebook url" aria-describedby="basic-addon3"
                                            value="{{ $social_info != '' && $social_info->facebook != '' ? $social_info->facebook : '' }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="bi bi-instagram"></i>
                                        </span>
                                        <input type="text" class="form-control" name="instagram"
                                            placeholder="Instagram url" aria-describedby="basic-addon3"
                                            value="{{ $social_info != '' && $social_info->instagram != '' ? $social_info->instagram : '' }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-6">
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="bi bi-github"></i>
                                        </span>
                                        <input type="text" class="form-control" name="github" placeholder="Github url"
                                            aria-describedby="basic-addon3"
                                            value="{{ $social_info != '' && $social_info->github != '' ? $social_info->github : '' }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="bi bi-twitter"></i>
                                        </span>
                                        <input type="text" class="form-control" name="twitter" placeholder="Twitter url"
                                            aria-describedby="basic-addon3"
                                            value="{{ $social_info != '' && $social_info->twitter != '' ? $social_info->twitter : '' }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row">

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <i class="bi bi-linkedin"></i>
                                        </span>
                                        <input type="text" class="form-control" name="linkedin"
                                            placeholder="Linkedin url" aria-describedby="basic-addon3"
                                            value="{{ $social_info != '' && $social_info->linkedin != '' ? $social_info->linkedin : '' }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                    <button type="button" class="btn btn-primary" id="social_info_btn" data-file="true"
                        data-btnid="social_info_btn" data-form="social_info_form" data-validator="true"
                        data-callback="socialInfoCallback" onclick="_run(this)">Save</button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->
@endsection

@section('custom-script')
    <script>
        function companyInfoCallback(data) {
            if (data.status == true) {
                // $("#company_info_form").trigger("reset");
                notify('success', data.message, 'Company Info Added');
                setTimeout(function() {

                }, 1000 * 2);
            } else {
                notify('error', data.message, 'Company Info Added Failed');
                // $.validator("footer_subscribe_form", data.errors);
            }
            $.validator("company_info_form", data.errors);
        }

        function socialInfoCallback(data) {
            if (data.status == true) {
                // $("#company_info_form").trigger("reset");
                notify('success', data.message, 'Social Info Added');
                setTimeout(function() {

                }, 1000 * 2);
            } else {
                notify('error', data.message, 'Social Info Added Failed');
                // $.validator("footer_subscribe_form", data.errors);
            }
            $.validator("social_info_form", data.errors);
        }
    </script>
@endsection
