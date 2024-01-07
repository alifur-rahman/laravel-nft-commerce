@extends('layouts.admin.app')
@section('title', 'Company Settings')
@section('breadcrumb')
    <h1 class="text-dark fw-bold my-0 fs-2">Company Settings</h1>
    <ul class="breadcrumb fw-semibold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('admin/dashboard') }}" class="text-muted">Home</a>
        </li>
        <li class="breadcrumb-item text-muted">Settings</li>
        <li class="breadcrumb-item text-dark">Company Settings</li>
    </ul>
@endsection

@section('custom-css')
    <style>
        label {
            /* max-width: 200px; */
            margin: 0 auto 15px;
            text-align: center;
            word-wrap: break-word;
            color: #1a4756;

        }

        .label {
            padding: 7px;
            border: 2px solid var(--kt-card-border-color);
            border-radius: 5px;
        }

        .hidden,
        #uploadImg:not(.hidden)+label {
            display: none;
        }

        #file {
            display: none;
            margin: 0 auto;
        }

        #upload {
            padding: 10px 25px;
            border: 0;
            margin: 0 auto;
            font-size: 15px;
            letter-spacing: 0.05em;
            cursor: pointer;
            background: #216e69;
            color: #fff;
            outline: none;
            transition: .3s ease-in-out;

            &:hover,
            &:focus {
                background: #1AA39A;
            }

            &:active {
                background: #13D4C8;
                transition: .1s ease-in-out;
            }
        }

        img {
            margin: 0 auto 15px;
            height: 125px;
            width: auto;
        }
    </style>
@endsection

@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Company Details</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="kt_account_settings_profile_details" class="collapse show">
            <!--begin::Form-->
            <form id="company_info_form" class="form" action="{{ route('admin.company_info') }}" method="POST">
                @csrf

                {{-- @php
                    $company_infos = App\Models\CompanyInfo::all()->first();
                @endphp --}}
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company Logo</label>
                        <!--end::Label-->
                        <div class="col-lg-8">
                            <div class="company-logo">
                                {{-- <label class="label" for="input">Please upload a picture !</label> --}}

                                <label class="label">
                                    @if ($company_infos == '' || $company_infos->com_logo == '')
                                        <img class="h-125px m-0" src="{{ asset('assets/admin/logo/logo.png') }}"
                                            alt="Company_logo">
                                    @else
                                        <img class="h-125px m-0"
                                            src="{{ asset('assets/admin/logo/' . $company_infos->com_logo) }}"
                                            alt="Company_logo">
                                    @endif
                                </label>


                                <div class="input">
                                    <input name="com_logo" id="file" type="file">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="com_name" class="form-control form-control-lg form-control-solid"
                                placeholder="Type Your Company name"
                                value="{{ $company_infos != '' ? $company_infos->com_name : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company License</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="com_license" class="form-control form-control-lg form-control-solid"
                                placeholder="License # CM21XXX"
                                value="{{ $company_infos != '' ? $company_infos->com_license : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="email" name="com_email" class="form-control form-control-lg form-control-solid"
                                placeholder="example@gmail.com"
                                value="{{ $company_infos != '' ? $company_infos->com_email : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company Phone</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="tel" name="com_phone" class="form-control form-control-lg form-control-solid"
                                placeholder="+1 124 845 12"
                                value="{{ $company_infos != '' ? $company_infos->com_phone : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company Website</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="com_website" class="form-control form-control-lg form-control-solid"
                                placeholder="example.com"
                                value="{{ $company_infos != '' ? $company_infos->com_website : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Compnay Authority</label>
                        <!--begin::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="com_authority"
                                class="form-control form-control-lg form-control-solid" placeholder="company authority"
                                value="{{ $company_infos != '' ? $company_infos->com_authority : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Compnay Address</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="com_address"
                                class="form-control form-control-lg form-control-solid"
                                placeholder="2517 Heritage Road Raymond, CA 93653"
                                value="{{ $company_infos != '' ? $company_infos->com_address : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Copyright</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="copyright"
                                class="form-control form-control-lg form-control-solid" placeholder="copyright@2022"
                                value="{{ $company_infos != '' ? $company_infos->copyright : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Support Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="email" name="support_email"
                                class="form-control form-control-lg form-control-solid" placeholder="spport@gmail.com"
                                value="{{ $company_infos != '' ? $company_infos->support_email : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Auto Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="email" name="auto_email"
                                class="form-control form-control-lg form-control-solid" placeholder="auto@gmail.com"
                                value="{{ $company_infos != '' ? $company_infos->auto_email : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                    <button type="button" class="btn btn-primary" id="com_info_btn" data-file="true"
                        data-btnid="com_info_btn" data-form="company_info_form" data-validator="true"
                        data-callback="companyInfoCallback" onclick="_run(this)">Save</button>
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
        $(function() {
            var container = $('.company-logo'),
                inputFile = $('#file'),
                img, btn, txt = 'Browse',
                txtAfter = 'Browse';

            if (!container.find('#upload').length) {
                container.find('.input').append('<input type="button" value="' + txt + '" id="upload">');
                btn = $('#upload');
                container.prepend('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
                img = $('#uploadImg');
            }

            btn.on('click', function() {
                img.animate({
                    opacity: 1
                }, 300);
                inputFile.click();
            });

            inputFile.on('change', function(e) {
                container.find('label').html(inputFile.val());

                var i = 0;
                for (i; i < e.originalEvent.srcElement.files.length; i++) {
                    var file = e.originalEvent.srcElement.files[i],
                        reader = new FileReader();

                    reader.onloadend = function() {
                        img.attr('src', reader.result).animate({
                            opacity: 1
                        }, 700);
                    }
                    reader.readAsDataURL(file);
                    img.removeClass('hidden');
                }
                btn.val(txtAfter);

            });
        });

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
    </script>
@endsection
