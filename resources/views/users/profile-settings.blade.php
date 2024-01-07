@extends('layouts.users.user-admin-layout')
@section('title', 'User Profile Settings')
@section('custom-css')
<!-- Datatable CSS -->


<link rel="stylesheet" href="{{ asset('assets/user/sweetalert/animate.min.css') }}" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('assets/user/sweetalert/sweetalert2.min.css') }}" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    ul li {
        font-size: var(--font-size-b1);
        line-height: var(--line-height-b1);
        margin-top: -3px;
        margin-bottom: 10px;
        /* color: var(--color-body); */
        color: black !important;
    }

    .input-two-wrapper .currency {
        width: 100%;
    }

    .dropzone {
        background: #242435;
        border: 2px dotted #ddd;
        border-radius: 5px;
        /* padding: 29px; */
    }

    .input-two-wrapper .currency {
        margin-right: 0px;
    }

    .input-two-wrapper .profile-edit-select {
        margin-top: 0px;

    }

    label {
        margin-top: 10px !important;
    }

    .left-nav {
        padding: 0;
        margin-bottom: 10px;
    }

    ul li {
        font-size: var(--font-size-b1);
        line-height: var(--line-height-b1);
        margin-top: -3px;
        margin-bottom: 10px;
        color: var(--color-body);

    }

    .custom-select-design {
        position: relative;
    }

    .left-nav {
        padding: 0;
        margin-bottom: 10px;
    }

    ul li {
        font-size: var(--font-size-b1);
        line-height: var(--line-height-b1);
        margin-top: -3px;
        margin-bottom: 10px;
        color: var(--color-body);
    }

    .custom-select-design {
        position: relative;
    }

    .full-wid.currency.al_show_error {
        margin-bottom: 16px;
        height: 100%;
    }

    #nav-proof {
        background: transparent;
        border: none;
        padding: 0;
    }

    .button-area.save-btn-edit.row {
        margin: 1rem 0px;
        justify-content: unset;
        max-width: none;
    }

    #nav-document {
        background: transparent;
        border: none;
    }

    #nav-report {
        background: transparent;
        padding: 0;
        margin: 0;
        border: none;
    }

    .box-table.table-responsive {
        border: none;
        background: transparent;
        /* padding: 0; */
    }

    #kyc_report_tbl {
        width: 100% !important;
    }

    .nice-select.open .list {
        background: var(--color-primary-alta);
        width: 100%;
    }

    .dz-error-mark {
        display: none;
    }

    .dz-success-mark {
        display: none;
    }

    .dz-details {
        display: none;
    }
</style>


@endsection
@section('content')
@php use App\Services\AllfunctionService; @endphp
<!-- profile section -->
<div class="rn-nft-mid-wrapper">
    <div class="edit-profile-area rn-section-gapTop">
        <div class="container">
            <div class="row padding-control-edit-wrapper pl_md--0 pr_md--0 pl_sm--0 pr_sm--0">
                <div class="col-12 d-flex justify-content-between mb--30 align-items-center">
                    <h4 class="title-left">Edit Your Profile</h4>
                    @php
                    $user_info = App\Models\UserDescription::where('user_id', auth()->user()->id)->first();
                    @endphp
                    <a href="{{ route('user.login_profile') }}" class="btn btn-primary ml--10"><i class="feather-eye mr--5"></i>
                        Preview</a>
                </div>
            </div>
            <div class="row padding-control-edit-wrapper pl_md--0 pr_md--0 pl_sm--0 pr_sm--0">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <!-- Start tabs area -->
                    <nav class="left-nav rbt-sticky-top-adjust-five">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="feather-edit"></i>Edit Profile Image</button>
                            <button class="nav-link" id="nav-home-tabs" data-bs-toggle="tab" data-bs-target="#nav-homes" type="button" role="tab" aria-controls="nav-homes" aria-selected="false"><i class="feather-user"></i>Personal Information</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="feather-unlock"></i>Change Password</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#change_trans_pass" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="feather-unlock"></i>Change Transaction
                                Password</button>
                            <button class="nav-link" id="nav-verification-tab" data-bs-toggle="tab" data-bs-target="#nav-verification" type="button" role="tab" aria-controls="nav-verification" aria-selected="false"><i class="feather-check-square"></i>Verification</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="feather-bell"></i>Notification Setting</button>
                        </div>
                    </nav>
                    <!-- End tabs area -->
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 mt_sm--30">
                    <div class="tab-content tab-content-edit-wrapepr" id="nav-tabContent">

                        <!-- sigle tab content -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <!-- start personal information -->
                            <div class="nuron-information">

                                <div class="profile-change row g-5">
                                    <div class="profile-left col-lg-4">
                                        <div class="profile-image mb--30">
                                            <h6 class="title">Change Profile Picture</h6>
                                            <img id="rbtinput1" src="{{ AllfunctionService::userPhoto(auth()->user()->id) }}" alt="Profile-NFT">
                                        </div>
                                        <div class="button-area">
                                            <div class="brows-file-wrapper">
                                                <!-- actual upload which is hidden -->
                                                <form action="" method="post" id="form-profile-upload">
                                                    @csrf
                                                    <input type="hidden" name="op" value="profile-upload">
                                                    <input name="fatima" id="fatima" type="file">
                                                </form>
                                                <!-- our custom upload button -->
                                                <label for="fatima" title="No File Choosen">
                                                    <span class="text-center color-white">Upload Profile</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile-left right col-lg-8">
                                        <div class="profile-image mb--30">
                                            <h6 class="title">Change Your Cover Photo</h6>
                                            <img id="rbtinput2" src="{{AllfunctionService::user_cover_photo(null)}}" alt="Profile-NFT">
                                        </div>
                                        <div class="button-area">
                                            <div class="brows-file-wrapper">
                                                <form action="" method="post" id="form-cover-upload">
                                                    @csrf
                                                    <input type="hidden" name="op" value="cover-upload">
                                                    <!-- actual upload which is hidden -->
                                                    <input name="nipa" id="nipa" type="file">
                                                    <!-- our custom upload button -->
                                                    <label for="nipa" title="No File Choosen">
                                                        <span class="text-center color-white">Upload Cover</span>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End personal information -->
                        </div>
                        <!-- End single tabv content -->
                        <!-- sigle tab content -->
                        <div class="tab-pane fade" id="nav-homes" role="tabpanel" aria-labelledby="nav-home-tab">
                            <!-- start personal information -->
                            <form class="nuron-information" action="" method="post" id="form-persional-info">
                                @csrf
                                <input type="hidden" name="op" value="persional-info">
                                <div class="profile-form-wrapper">
                                    <div class="input-two-wrapper mb--15">
                                        <div class="first-name half-wid">
                                            <label for="contact-name" class="form-label">Full Name</label>
                                            <input name="name" id="contact-name" type="text" value="{{ $profile->name }}">
                                        </div>
                                        <div class="last-name half-wid">
                                            <label for="Email" class="form-label">Your Email</label>
                                            <input name="email" id="Email" type="email" value="{{ $profile->email }}" disabled>
                                        </div>
                                    </div>
                                </div>


                                <!-- edit bio area Start-->
                                <div class="edit-bio-area mt--20">
                                    <label for="Discription" class="form-label">Edit Your Bio</label>
                                    <textarea id="Discription" name="bio">{{ isset($user_description) ? ($user_description->about_user != '' ? $user_description->about_user : '') : '' }}</textarea>
                                </div>
                                <!-- edit bio area End -->

                                <div class="input-two-wrapper mt--15">
                                    <div class="half-wid currency">
                                        <label for="phone" class="form-label mb--10">Your Phone</label>
                                        <input name="phone" id="phone" type="text" value="{{ $profile->phone }}">
                                    </div>
                                    <div class="half-wid phone-number">
                                        <label for="gender" class="form-label mb--10">Gender</label>
                                        <select class="profile-edit-select" id="gender" name="gender">
                                            @php
                                            $male = $female = $third = '';
                                            if (isset($user_description)) {
                                            if ($user_description->gender != '' && $user_description->gender === 'male') {
                                            $male = 'selected';
                                            }
                                            if ($user_description->gender != '' && $user_description->gender === 'female') {
                                            $female = 'selected';
                                            }
                                            if ($user_description->gender != '' && $user_description->gender === 'other') {
                                            $third = 'selected';
                                            }
                                            }
                                            $male = isset($user_description) ? ($user_description->gender != '' ? $user_description->gender : '') : '';
                                            @endphp
                                            <option selected>Select Your Gender</option>
                                            <option value="1" {{ $male }}>Male</option>
                                            <option value="2" {{ $female }}>Female</option>
                                            <option value="3" {{ $third }}>Third Gender</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="input-two-wrapper mt--15">
                                    <div class="half-wid currency al_show_error">
                                        <!-- select country -->
                                        @php
                                        $Country = App\Models\Country::where('id', $user_info->country_id)
                                        ->select('name')
                                        ->first();
                                        @endphp
                                        <label for="Country" class="form-label">Country</label>
                                        <select class="profile-edit-select" id="Country" name="country">
                                            <option value="">Choose a Country</option>
                                            @if (isset($Country->name))
                                            <option selected value="{{ $user_info->country_id }}">
                                                {{ $Country->name }}
                                            </option>
                                            @endif
                                            @foreach ($country as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- end country -->
                                    </div>
                                    <div class="half-wid phone-number">
                                        <label for="address" class="form-label">Address</label>
                                        <input name="address" id="address" type="text" placeholder="Your Address Here" value="{{ $user_description->address }}">
                                    </div>
                                </div>
                                <div class="input-two-wrapper mt--15">
                                    <div class="half-wid currency">
                                        <!-- state -->
                                        <div class="role-area mt--15">
                                            <label for="state" class="form-label mb--10">State</label>
                                            <input name="state" placeholder="Your State Here" id="state" type="text" value="{{ $user_description->state }}">
                                        </div>
                                    </div>
                                    <div class="half-wid phone-number">
                                        <!-- city -->
                                        <label for="city" class="form-label">City</label>
                                        <input name="city" id="city" type="text" value="{{ $user_description->city }}" placeholder="Your City Name">
                                    </div>
                                </div>
                                <div class="input-two-wrapper mt--15">
                                    <div class="half-wid currency">
                                        <!-- zip code -->
                                        <div class="role-area mt--15">
                                            <label for="zipcode" class="form-label mb--10">Zipcode</label>
                                            <input name="zipcode" id="zipcode" type="text" value="{{ $user_description->zip_code }}" placeholder="Your Zipcode Here">
                                        </div>
                                    </div>
                                    <div class="half-wid phone-number">
                                        <!-- city -->
                                        <label for="date-of-birth" class="form-label">Date of birth</label>
                                        <input name="date_of_birth" id="date-of-birth" type="date" value="{{ $user_info->date_of_birth }}">
                                    </div>
                                </div>
                                <div class="button-area save-btn-edit">
                                    <a href="#" class="btn btn-primary-alta mr--15" onclick="customAlert.alert('Cancel Edit Profile?')">Cancel</a>
                                    <!-- <a href="#" class="btn btn-primary" onclick="customAlert.alert('Successfully Saved Your Profile?')">Save</a> -->
                                    <button type="button" data-label="Submit Request" id="btn-persional-info" data-btnid="btn-persional-info" data-callback="persional_info_call_back" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="form-persional-info" data-el="fg" onclick="_run(this)" class="btn btn-primary">Save</button>
                                </div>

                            </form>
                            <!-- End personal information -->
                        </div>
                        <!-- End single tabv content -->

                        <!-- change password area Start -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form class="nuron-information" action="" method="post" id="form-change-password">
                                @csrf
                                <input type="hidden" name="op" value="change-password">
                                <div class="condition">
                                    <h5 class="title">Create Your Password</h5>
                                    <p class="condition">
                                        Passwords are a critical part of information and network security. Passwords
                                        serve to protect user accounts but a poorly chosen password, if compromised,
                                        could put the entire network at risk.
                                    </p>
                                    <hr />
                                    <!-- <div class="email-area">
                                            <label for="Email2" class="form-label">Enter Email</label>
                                            <input name="email" id="Email2" type="email" value="">
                                        </div> -->
                                </div>
                                <div class="input-two-wrapper mt--15">
                                    <div class="old-password half-wid">
                                        <label for="oldPass" class="form-label">Enter Old Password</label>
                                        <input name="old_password" id="oldPass" type="password">
                                    </div>
                                    <div class="new-password half-wid">
                                        <label for="NewPass" class="form-label">Create New Password</label>
                                        <input name="password" id="NewPass" type="password">
                                    </div>
                                </div>
                                <div class="email-area mt--15">
                                    <label for="rePass" class="form-label">Confirm Password</label>
                                    <input name="confirm_password" id="rePass" type="password" value="">
                                </div>
                                <!-- <a href="#" class="btn btn-primary save-btn-edit" onclick="customAlert.alert('Successfully Changed Password?')">Save</a> -->
                                <button type="button" data-label="Submit Request" id="btn-change-password" data-btnid="btn-change-password" data-callback="change_password_call_back" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="form-change-password" data-el="fg" onclick="_run(this)" class="btn btn-primary save-btn-edit">Save</button>
                            </form>
                            <!-- change password area ENd -->
                        </div>

                        {{-- Transaction Password change area  --}}
                        <div class="tab-pane fade" id="change_trans_pass" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form class="nuron-information" action="" method="post" id="change_trans_password_form">
                                @csrf
                                <input type="hidden" name="op" value="change-transaction-password">
                                <div class="condition">
                                    <h5 class="title">Create Your Transaction Password</h5>
                                    <p class="condition">
                                        Passwords are a critical part of information and network security. Passwords
                                        serve to protect user accounts but a poorly chosen password, if compromised,
                                        could put the entire network at risk.
                                    </p>
                                    <hr />
                                </div>
                                <div class="input-two-wrapper mt--15">
                                    <div class="old-password half-wid">
                                        <label for="oldPass" class="form-label">Enter Account Password</label>
                                        <input name="acc_password" id="oldPass" type="password">
                                    </div>
                                    <div class="new-password half-wid">
                                        <label for="NewPass" class="form-label">Create Transaction Password</label>
                                        <input name="password" id="NewPass" type="password">
                                    </div>
                                </div>
                                <div class="email-area mt--15">
                                    <label for="rePass" class="form-label">Confirm Transaction Password</label>
                                    <input name="confirm_password" id="rePass" type="password" value="">
                                </div>
                                <!-- <a href="#" class="btn btn-primary save-btn-edit" onclick="customAlert.alert('Successfully Changed Password?')">Save</a> -->
                                <button type="button" data-label="Submit Request" id="change_trans_password" data-btnid="change_trans_password" data-callback="changeTransactionPassword" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="change_trans_password_form" data-el="fg" onclick="_run(this)" class="btn btn-primary save-btn-edit">Save</button>
                            </form>
                            <!-- change password area ENd -->
                        </div>

                        {{-- verification  --}}
                        <div class="tab-pane fade" id="nav-verification" role="tabpanel" aria-labelledby="nav-verification-tab">
                            <div class="row padding-control-edit-wrapper pl_md--0 pr_md--0 pl_sm--0 pr_sm--0">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <!-- Start tabs area -->
                                    <nav class="left-nav rbt-sticky-top-adjust-five">
                                        <div class="nav nav-tabs custom_nav_doc" id="nav-tab" role="tablist">
                                            <button class="nav-link active" style="flex:0 0 28%; text-align:center" id="nav-proof-tabs" data-bs-toggle="tab" data-bs-target="#nav-proof" type="button" role="tab" aria-controls="nav-proof" aria-selected="false"><i class="feather-user"></i>ID Proof</button>

                                            <button class="nav-link" id="nav-document-tab" style="flex:0 0 28%;text-align:center" data-bs-toggle="tab" data-bs-target="#nav-document" type="button" role="tab" aria-controls="nav-document" aria-selected="false"> <i class="feather-unlock"></i>Address Proof</button>

                                            <button class="nav-link" id="nav-report-tab" style="flex:0 0 28%;text-align:center" data-bs-toggle="tab" data-bs-target="#nav-report" type="button" role="tab" aria-controls="nav-report" aria-selected="false"> <i class="feather-unlock"></i>KYC Report</button>
                                        </div>
                                    </nav>
                                    <!-- End tabs area -->
                                </div>
                                <!-------------------------ID Proof--------------------------->
                                <div class="col-lg-12 col-md-12 col-sm-12 mt_sm--30">
                                    <div class="tab-content tab-content-edit-wrapepr" id="nav-tabContent">
                                        <!-- sigle tab content -->
                                        <form class="tab-pane fade show active" id="nav-proof" role="tabpanel" aria-labelledby="nav-proof-tab">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8 col-lg-6 col-12 mx-auto">
                                                    <input type="hidden" name="perpose" value="id proof">
                                                    <input type="hidden" name="op" value="admin">
                                                    <!-- start personal information -->
                                                    <div class="nuron-information">

                                                        <div class="input-two-wrapper col-12">
                                                            <div class="full-wid currency custom-select-design al_show_error">
                                                                <label for="id-document-type" class="form-label">Document Type</label>
                                                                <select class="profile-edit-select " name="document_type" id="id-document-type">
                                                                    <option value="" selected>
                                                                        Select a document typefirst
                                                                    </option>
                                                                    @foreach ($id_document_type as $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->id_type }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="profile-form-wrapper">
                                                            <div class="issue-area">
                                                                <label for="issudate" class="form-label">Issue Date</label>
                                                                <input type="date" data-date-format="yyyy-mm-dd" id="id-issue-date" class="form-control form-control-solid" placeholder="YYYY-MM-DD" name="issue_date" />
                                                            </div>
                                                        </div>
                                                        <div class="profile-form-wrapper">
                                                            <div class="issue-area">
                                                                <label for="expiredate" class="form-label">Expire Date</label>
                                                                <input type="date" data-date-format="yyyy-mm-dd" id="id-expire-date" name="expire_date" class="form-control form-control-solid" placeholder="YYYY-MM-DD" />
                                                            </div>
                                                        </div>
                                                        <div class="pt-5">
                                                            <div class="col-sm-12">
                                                                <div class="d-flex justify-content-end">
                                                                    <!-- id front part -->
                                                                    <div class="w-50">
                                                                        <div class="dropzone dropzone-area id-proof-dropzone w-100 text-center" data-field="front_part" id="id-dropzone" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID">
                                                                            <div class="dz-message justify-content-center">
                                                                                <div class="dz-message-label text-white">Drop
                                                                                    Your
                                                                                    id front part</div>
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
                                                                        <div class="dropzone dropzone-area id-proof-dropzone w-100 text-center" data-field="back_part" id="id-back-part" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID Back Part">
                                                                            <div class="dz-message justify-content-center">
                                                                                <div class="dz-message-label text-white">Drop
                                                                                    Your
                                                                                    id back part</div>
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
                                                        <div class="button-area save-btn-edit row mt-5">
                                                            <div class="col-12 col-lg-6 ps-0">
                                                                <a href="#" class="btn btn-primary-alta mr--15 w-100">Cancel</a>

                                                            </div>
                                                            <div class="col-12 col-lg-6 pe-0">
                                                                <a href="#" class="btn btn-primary w-100" data-label="Save" id="upload-kyc-button">Save</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End single tabv content -->

                                        <!-------------------------Address Proof--------------------------->
                                        <form class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                                                    <input type="hidden" name="perpose" value="address proof">
                                                    <input type="hidden" name="op" value="admin">
                                                    <!-- start personal information -->
                                                    <div class="nuron-information">
                                                        <div class="row">
                                                            <div class="input-two-wrapper col-12 al_show_error">
                                                                <div class="full-wid currency">
                                                                    <!-- select gender -->
                                                                    <label for="document" class="form-label">Document
                                                                        Type</label>
                                                                    <select class="profile-edit-select" name="document_type">
                                                                        <option selected>Select a document type
                                                                            first</option>
                                                                        @foreach ($address_document_type as $value)
                                                                        <option value="{{ $value->id }}">
                                                                            {{ $value->id_type }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <!-- end gender -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="profile-form-wrapper mt-4">
                                                            <div class="issue-areaone">
                                                                <label for="issudate" class="form-label">Issue Date</label>
                                                                <input type="date" id="id-issue-date" class="form-control form-control-solid " placeholder="YYYY-MM-DD" name="issue_date" />
                                                            </div>
                                                        </div>
                                                        <div class="profile-form-wrapper">
                                                            <div class="issue-area">
                                                                <label for="expiredate" class="form-label">Expire Date</label>
                                                                <input type="date" id="id-expire-date" name="expire_date" class="form-control form-control-solid" placeholder="YYYY-MM-DD" />
                                                            </div>
                                                        </div>
                                                        <div class="pt-5">
                                                            <div class="col-sm-12">
                                                                <div class="d-flex justify-content-end">
                                                                    <!-- id front part -->
                                                                    <div class="w-100">
                                                                        <div class="dropzone dropzone-area address-proof-dropzone w-100 text-center" data-field="document" id="id-dropzone-address-proof" enctype="multipart/form-data" data-bs-toggle="tooltip" data-bs-placement="top" title="Drag and Drop or click your ID">
                                                                            <div class="dz-message justify-content-center">
                                                                                <div class="dz-message-label text-white">
                                                                                    Drop Your Document
                                                                                </div>
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
                                                        <div class="button-area save-btn-edit row">
                                                            <div class="col-12 col-md-6 col-lg-6 ps-0">
                                                                <a href="#" class="btn btn-primary-alta mr--15 w-100">Cancel</a>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6 pe-0">
                                                                <a href="#" class="btn btn-primary w-100" data-label="Save" id="upload-kyc-button-address">Save</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End personal information -->
                                        </form>

                                        {{-- KYC Report  --}}
                                        <div class="tab-pane fade" id="nav-report" role="tabpanel" aria-labelledby="nav-report-tab">
                                            <!-- table area Start -->
                                            <div class="box-table table-responsive">
                                                <table class="table upcoming-projects w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <span>Issue Date</span>
                                                            </th>
                                                            <th>
                                                                <span>Expire Date</span>
                                                            </th>
                                                            <th>
                                                                <span>STATUS</span>
                                                            </th>
                                                            <th>
                                                                <span>ACTION</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="ranking">

                                                    </tbody>
                                                </table>
                                            </div>
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
                                                                <h3 class="mb-3" style="color: black">User Document
                                                                </h3>
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
                                                                                        <img id="front_part" class="img-thumbnail" src="{{ asset('assets/admin/images/1663310296_id_front_part_driver_license.png') }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                                                    <div class="geeks" style="height: 100%; width: 100%;">
                                                                                        <img id="backpart_part" class="img-thumbnail" src="{{ asset('assets/admin/images/1663310296_id_front_part_driver_license.png') }}">
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

                                                                                <!--begin::Body-->
                                                                                <div class="pt-1">
                                                                                    <ul class="list-group list-group-circle text-start fw-bold" style="margin-left: 45px;">
                                                                                        <li>Name: <span class="text-primary" id="user_name"></span>
                                                                                        </li>
                                                                                        <li>Email : <span class="text-primary" id="user-email"> </li>
                                                                                        <li>Country : <span class="text-primary" id="user-country"></li>
                                                                                        <li>Address : <span class="text-primary" id="user-address"></span>
                                                                                        </li>
                                                                                        <li>City : <span class="text-primary" id="user-city"></li>
                                                                                        <li>State : <span class="text-primary" id="user-state"></span>
                                                                                        </li>
                                                                                        <li>Phone : <span class="text-primary" id="user-phone"></li>
                                                                                        <li>Zip : <span class="text-primary" id="user-zip-code">
                                                                                        </li>
                                                                                        <li>Date Of Birth : <span class="text-primary" id="user-dob"> </li>
                                                                                        <li>Status : <span id="user-status">
                                                                                            </span></li>
                                                                                    </ul>
                                                                                    <hr />
                                                                                    <ul class="list-group list-group-circle text-start fw-bold" style="margin-left: 45px;">
                                                                                        <li>Issue Date : <span class="text-primary" id="user-issue_date">
                                                                                        </li>
                                                                                        <li>Expire Date : <span class="text-primary" id="user-exp_date">
                                                                                        </li>
                                                                                        <li>Document Type : <span class="text-primary" id="user-doc_type">
                                                                                        </li>
                                                                                        <li>Issuer Country : <span class="text-primary" id="user-issuer-country">
                                                                                        </li>
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
                                                            <div class="d-flex justify-content-center">
                                                                <button type="reset" class="btn btn-danger me-3" data-bs-dismiss="modal">Discard</button>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                            <!-- start Notification Setting  -->
                            <div class="nuron-information">
                                <h5 class="title">Make Sure Your Notification setting </h5>
                                <p class="notice-disc">
                                    Notification Center is where you can find app notifications and Quick Settings—which
                                    give you quick access to commonly used settings and apps. You can change your
                                    notification settings at any time from the Settings app. Select Start , then select
                                    Settings
                                </p>
                                <hr />
                                <!-- start notice wrapper parrent -->
                                <form class="notice-parent-wrapper d-flex" action="" method="post" id="form-notification-settings">
                                    @csrf
                                    <input type="hidden" name="op" value="notification-settings">
                                    @php

                                    $order_confirm = isset($notification_settings->order_confirm) && $notification_settings->order_confirm == true ? 'checked' : '';
                                    $new_item = isset($notification_settings->new_item) && $notification_settings->new_item == true ? 'checked' : '';
                                    $new_bid = isset($notification_settings->new_bid) && $notification_settings->new_bid == true ? 'checked' : '';
                                    $payment_card = isset($notification_settings->payment_card) && $notification_settings->payment_card == true ? 'checked' : '';
                                    $ending_bid = isset($notification_settings->ending_bid) && $notification_settings->ending_bid == true ? 'checked' : '';
                                    $aprove_product = isset($notification_settings->approve_product) && $notification_settings->approve_product == true ? 'checked' : '';
                                    @endphp
                                    <div class="notice-child-wrapper">
                                        <!-- single notice wrapper -->
                                        <div class="single-notice-setting">
                                            <div class="input">
                                                <input type="checkbox" id="themeSwitch" name="order_confirm" class="theme-switch__input" value="1" {{ $order_confirm }} />
                                                <label for="themeSwitch" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>Order Confirmation Notice</p>
                                            </div>
                                        </div>
                                        <!-- single notice wrapper End -->

                                        <!-- single notice wrapper -->
                                        <div class="single-notice-setting mt--15">
                                            <div class="input">
                                                <input type="checkbox" id="themeSwitchs" name="new_item" class="theme-switch__input" value="1" {{ $new_item }} />
                                                <label for="themeSwitchs" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>New Items Notification</p>
                                            </div>
                                        </div>
                                        <!-- single notice wrapper End -->

                                        <!-- single notice wrapper -->
                                        <div class="single-notice-setting mt--15">
                                            <div class="input">
                                                <input type="checkbox" id="OrderNotice" name="new_bid" class="theme-switch__input" value="1" {{ $new_bid }} />
                                                <label for="OrderNotice" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>New Bid Notification</p>
                                            </div>
                                        </div>
                                        <!-- single notice wrapper End -->

                                        <!-- single notice wrapper -->
                                        <div class="single-notice-setting mt--15">
                                            <div class="input">
                                                <input type="checkbox" id="newPAy" name="payment_card" class="theme-switch__input" value="1" {{ $payment_card }} />
                                                <label for="newPAy" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>Payment Card Notification</p>
                                            </div>
                                        </div>
                                        <!-- single notice wrapper End -->

                                        <!-- single notice wrapper -->
                                        <div class="single-notice-setting mt--15">
                                            <div class="input">
                                                <input type="checkbox" id="EndBid" name="ending_bid" class="theme-switch__input" value="1" {{ $ending_bid }} />
                                                <label for="EndBid" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>Ending Bid Notification Before 5 min</p>
                                            </div>
                                        </div>
                                        <!-- single notice wrapper End -->

                                        <!-- single notice wrapper -->
                                        <div class="single-notice-setting mt--15">
                                            <div class="input">
                                                <input type="checkbox" id="Approve" name="approve_product" class="theme-switch__input" value="1" {{ $aprove_product }} />
                                                <label for="Approve" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>Notification for approving product</p>
                                            </div>
                                        </div>
                                        <!-- single notice wrapper End -->
                                    </div>
                                    <div class="notice-child-wrapper">
                                    </div>
                                </form>
                                <!-- end notice wrapper parrent -->
                                <!-- <a href="#" class="btn btn-primary save-btn-edit" onclick="customAlert.alert('Successfully saved Your Notificationm setting')">Save</a> -->
                                <button type="button" data-label="Submit Request" id="btn-notification-settings" data-btnid="btn-notification-settings" data-callback="notification_settings_call_back" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="form-notification-settings" data-el="fg" onclick="_run(this)" class="btn btn-primary save-btn-edit">Save</button>
                            </div>
                            <!-- End Notification Setting  -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
{{-- <script src="{{ asset('assets/user/js/pages/user-kyc-upload.js') }}"></script> --}}
<script src="{{ asset('assets/admin/custom-js/pages/common-ajax.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> --}}



<script src="{{ asset('assets/admin/js/file-uploaders/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/file-upload-with-form.js') }}"></script>
<script src="{{ asset('assets/admin/custom-js/search-dropdown.js') }}"></script>
<script src="{{ asset('assets/user/sweetalert/sweetalert2.all.min.js') }}" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // change profile picture
    $(document).on('change', '#fatima', function() {
        $("#form-profile-upload").trigger('submit');
    })
    $(document).on('submit', '#form-profile-upload', function(event) {
        var formData = new FormData(this);
        formData.append('file_document', $('#fatima')[0].files[0]);
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/user/profile-settings',
            type: 'POST',
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function(data) {
                if (data.status == true) {
                    notify('success', data.message, 'Change cover photo');
                }
                if (data.status == false) {
                    notify('error', data.message, 'Change cover photo');
                }
            }
        });
    })
    // change cover picture
    $(document).on('change', '#nipa', function() {
        $("#form-cover-upload").trigger('submit');
    })
    $(document).on('submit', '#form-cover-upload', function(event) {
        var formData = new FormData(this);
        formData.append('file_document', $('#nipa')[0].files[0]);
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/user/profile-settings',
            type: 'POST',
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function(data) {
                if (data.status == true) {
                    notify('success', data.message, 'Change cover photo');
                }
                if (data.status == false) {
                    notify('error', data.message, 'Change cover photo');
                }
            }
        });
    });
    // save persional form
    function persional_info_call_back(data) {
        if (data.status == true) {
            notify('success', data.message, 'Update persional info');
        }
        if (data.status == false) {
            notify('error', data.message, 'Update persioanl info');
        }
        $.validator("form-persional-info", data.errors);
    }
    // change password
    function change_password_call_back(data) {
        if (data.status == true) {
            notify('success', data.message, 'Change password');
        }
        if (data.status == false) {
            notify('error', data.message, 'Change password');
        }
        $.validator("form-change-password", data.errors);
    }

    // change transaction password
    function changeTransactionPassword(data) {
        if (data.status == true) {
            notify('success', data.message, 'Change transaction password');
            $("#change_trans_password_form").trigger("reset");
        }
        if (data.status == false) {
            notify('error', data.message, 'Change transaction password');
        }
        $.validator("change_trans_password_form", data.errors);
    }

    function notification_settings_call_back(data) {
        if (data.status == true) {
            notify('success', data.message, 'Notification settings');
        }
        if (data.status == false) {
            notify('error', data.message, 'Notification settings');
        }
        $.validator("form-notification-settings", data.errors);
    }
    $('#upload-kyc-button, #upload-kyc-button-address').click(function() {
        $(this).prop('disabled', true);
        setTimeout(() => {
            $(this).prop('disabled', false);
        }, 30000);

    })
    // proof--------------
    file_upload(
        "/user/verify-form", //<--request url for proccessing
        false, //<---auto process true or false
        ".id-proof-dropzone", //<---dropzones selectore
        "nav-proof", //<---form id/selectore
        "#upload-kyc-button", //<---submit button selectore
        "ID Proof" //<---Notification Title
    );
    // address proof--------------------------------------
    file_upload(
        "/user/verify-form", //<--request url for proccessing
        false, //<---auto process true or false
        ".address-proof-dropzone", //<---dropzones selectore
        "nav-document", //<---form id/selectore
        "#upload-kyc-button-address", //<---submit button selectore
        "Address proof" //<---Notification title
    );


    // kyc report js


    $(document).ready(function() {

        var dt = $('.upcoming-projects').fetch_data({
            url: "/user/kyc-management/kyc-report?op=data_table",
            columns: [{
                    "data": "issue_date"
                },
                {
                    "data": "expire_date"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                },

            ],
            icon_feather: false,
            length_change: false
        });
    });


    // admin Description view
    function view_document(e) {
        let obj = $(e);
        var id = obj.data('id');
        var table_id = obj.data('table_id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/user/kyc-management/kyc-report-view-descrption/' + id + '/' + table_id,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.group_name == 'id proof') {

                    $('#front_part').prop('src',data.front_part);
                    $('#backpart_part').prop('src',data.back_part);
                    $('#pills-profile-tab').show();
                } else if (data.group_name == 'address proof') {
                    // var address_proof = `/${data.image_path}/${data.images.front_part}`;
                    $('#front_part').attr("src", data.front_part);
                    $('#pills-profile-tab').hide();
                }

                $('#user-status').html(data.status);
                $('#user_name').text(data.user.name);
                $('#user-email').text(data.user.email);
                $('#user-phone').text(data.user.phone);
                $('#user-city').text(data.user.city);
                $('#user-state').text(data.user.state);
                $('#user-address').text(data.user.address);
                $('#user-zip-code').text(data.user.zip_code);
                $('#user-issue_date').text(data.issue_date);
                $('#user-exp_date').text(data.exp_date);
                $('#user-doc_type').text(data.document_name);
                $('#user-country').text(data.country.name);
                $('#user-dob').text(data.dob);
                $('#user-issuer-country').text(data.country.name);
            }
        });
    }
</script>
@endsection
