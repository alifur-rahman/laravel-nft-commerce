@extends('layouts.admin.app')
@section('custom-css')
<style>
    /* .tab-content input {
        border-left: none;
    } */
    #qrcodeurl {
        margin-left: 2rem;
    }

    #google_auth_modal {
        background-color: var(--kt-page-bg);
        border-radius: 10px;
    }

    .error-msg {
        color: red;
    }

    .steper {
        width: 25px;
        height: 25px;
    }

    .vertical-line::after {
        content: "";
        background-color: #4fd1c5;
        height: 100%;
        width: 2px;
        position: absolute;
        left: 12px;
        z-index: 1;
        top: 58%;
    }

    .last-connector::after {
        content: "";
        background-color: #4fd1c5;
        height: 50%;
        width: 2px;
        position: absolute;
        left: 12px;
        z-index: 1;
        top: 19px;
    }

    .last-connector-vertical::after {
        content: "";
        background-color: #4fd1c5;
        height: 2px;
        width: 100%;
        position: absolute;
        left: 13px;
        z-index: 1;
        top: 60%;
    }

    .accounts-tab-list .moving-tab {
        width: 33.33% !important;
    }

    .loader-container {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        padding-top: 13%;
    }

    .z-index-sticky {
        z-index: 10000;
    }
</style>
@endsection
@section('content')
<!--begin::Container-->
<div class="container-xxl" id="kt_content_container">
    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xxl-4">
            <!--begin::Mixed Widget 12-->
            <div class="card mb-5 mb-xxl-8">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="card-body d-flex flex-column py-9 px-5">
                        <!--begin::Avatar-->
                        <div class="d-flex flex-center symbol symbol-65px symbol-circle mb-5">
                            <img src="{{ asset('assets/admin/images/avatars/' . $avatar) }}" alt="image" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0 d-flex flex-center">{{ $user->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6 d-flex flex-center">Admin</div>
                        <!--end::Position-->
                        <!--begin::Social-->
                        <div class="d-flex flex-center flex-wrap my-7">
                            <a href="#" class="btn btn-icon btn-light-facebook me-5 "><i class="fab fa-facebook-f fs-4"></i></a>
                            <a href="#" class="btn btn-icon btn-light-google me-5 "><i class="fab fa-google fs-4"></i></a>
                            <a href="#" class="btn btn-icon btn-light-twitter me-5 "><i class="fab fa-twitter fs-4"></i></a>
                            <a href="#" class="btn btn-icon btn-light-instagram me-5 "><i class="fab fa-instagram fs-4"></i></a>
                            <a href="#" class="btn btn-icon btn-light-youtube me-5 "><i class="fab fa-youtube fs-4"></i></a>
                        </div>
                        <!--end::Social-->
                        <!--begin::Info-->
                        <h4 class="card-label fw-bold fs-3 my-4 pb-3 border-bottom">Details</h4>
                        <div class="infro-container">
                            <ul class="list-unstyled">
                                <li class="mb-4">
                                    <span class="fw-bold mb-3">Name:</span>
                                    <span>{{ $user->name }}</span>
                                </li>
                                <li class="mb-4">
                                    <span class="fw-bold mb-3">Email:</span>
                                    <span class="text-gray-800 fw-normal mb-5">{{ $user->email }}</span>
                                </li>
                                <li class="mb-4">
                                    <span class="fw-bold mb-3">Status:</span>
                                    <span class="badge badge-light-success">Active</span>
                                </li>
                                <li class="mb-4">
                                    <span class="fw-bold mb-3">Role:</span>
                                    <span>Admin</span>
                                </li>
                                <li class="mb-4">
                                    <span class="fw-bold mb-3">Contact:</span>
                                    <span>017566555565</span>
                                </li>
                                <li class="mb-4">
                                    <span class="fw-bold mb-3">Country:</span>
                                    <span>{{ $country }}</span>
                                </li>
                            </ul>
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 12-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-8">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x d-flex justify-content-around border-0 fs-6 fw-semibold mt-6 mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item flex-grow-1">
                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary d-flex justify-content-center active" id="home-tab-fill" aria-selected="true" aria-controls="form-profile-edit" role="tab" data-bs-toggle="tab" href="#form-profile-edit">
                        Profile Edit
                    </a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item flex-grow-1">
                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary d-flex justify-content-center" id="profile-tab-fill" aria-selected="false" role="tab" aria-controls="profile-fill" data-bs-toggle="tab" href="#profile-fill">
                        Security Settings
                    </a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item flex-grow-1">
                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary d-flex justify-content-center" id="messages-tab-fill" aria-selected="false" role="tab" aria-controls="messages-fill" data-bs-toggle="tab" href="#messages-fill">
                        Change Email & Phone
                    </a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Tab content-->
                    <div class="tab-content pt-1">
                        <!-----------Profile edit part start---------------->
                        <form class="tab-pane active" action="{{ route('admin.profile-settings.update-profile') }}" method="POST" id="form-profile-edit" role="tabpanel" aria-labelledby="home-tab-fill">
                            @csrf
                            <h4>Personal Information</h4>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Name<span class="text-danger">&#9734;</span></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                    <span class="">Email</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control" name="email" readonly placeholder="email" value="{{ $user->email }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Phone</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                        </span>
                                        <input type="tel" class="form-control" name="phone" placeholder="Phone" readonly value="01794060623" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                    <span class="">Country</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select name="country" aria-label="Select a Country" data-control="select2" id="country" class="form-select form-select-solid form-select-lg fw-semibold">
                                        {!! $country_options !!}
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <hr>
                            <h4>Social Profile</h4>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Skype</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-skype" viewBox="0 0 16 16">
                                                <path d="M4.671 0c.88 0 1.733.247 2.468.702a7.423 7.423 0 0 1 6.02 2.118 7.372 7.372 0 0 1 2.167 5.215c0 .344-.024.687-.072 1.026a4.662 4.662 0 0 1 .6 2.281 4.645 4.645 0 0 1-1.37 3.294A4.673 4.673 0 0 1 11.18 16c-.84 0-1.658-.226-2.37-.644a7.423 7.423 0 0 1-6.114-2.107A7.374 7.374 0 0 1 .529 8.035c0-.363.026-.724.08-1.081a4.644 4.644 0 0 1 .76-5.59A4.68 4.68 0 0 1 4.67 0zm.447 7.01c.18.309.43.572.729.769a7.07 7.07 0 0 0 1.257.653c.492.205.873.38 1.145.523.229.112.437.264.615.448.135.142.21.331.21.528a.872.872 0 0 1-.335.723c-.291.196-.64.289-.99.264a2.618 2.618 0 0 1-1.048-.206 11.44 11.44 0 0 1-.532-.253 1.284 1.284 0 0 0-.587-.15.717.717 0 0 0-.501.176.63.63 0 0 0-.195.491.796.796 0 0 0 .148.482 1.2 1.2 0 0 0 .456.354 5.113 5.113 0 0 0 2.212.419 4.554 4.554 0 0 0 1.624-.265 2.296 2.296 0 0 0 1.08-.801c.267-.39.402-.855.386-1.327a2.09 2.09 0 0 0-.279-1.101 2.53 2.53 0 0 0-.772-.792A7.198 7.198 0 0 0 8.486 7.3a1.05 1.05 0 0 0-.145-.058 18.182 18.182 0 0 1-1.013-.447 1.827 1.827 0 0 1-.54-.387.727.727 0 0 1-.2-.508.805.805 0 0 1 .385-.723 1.76 1.76 0 0 1 .968-.247c.26-.003.52.03.772.096.274.079.542.177.802.293.105.049.22.075.336.076a.6.6 0 0 0 .453-.19.69.69 0 0 0 .18-.496.717.717 0 0 0-.17-.476 1.374 1.374 0 0 0-.556-.354 3.69 3.69 0 0 0-.708-.183 5.963 5.963 0 0 0-1.022-.078 4.53 4.53 0 0 0-1.536.258 2.71 2.71 0 0 0-1.174.784 1.91 1.91 0 0 0-.45 1.287c-.01.37.076.736.25 1.063z" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="skype" placeholder="Skype" value="{{ $link->skype }}" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Whatsapp</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp" value="" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Facebook</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="facebook" placeholder="Facebook" value="" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">LinkedIn</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="linkedin" placeholder="LinkedIn" value="" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Twitter</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="twitter" placeholder="Twitter" value="" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <hr>
                            <h4>Change Password</h4>

                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Current
                                    Password<span class="text-danger">&#9734;</span></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                            </svg>
                                        </span>
                                        <input type="password" class="form-control" name="current_password" placeholder="" value="" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">New Password</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                            </svg>
                                        </span>
                                        <input type="password" id="new_passoword" data-size="16" data-character-set="a-z,A-Z,0-9,#" rel="gp" class="form-control" name="new_password" placeholder="Password" />
                                        <button class="btn btn-primary btn-gen-password" type="button" id="rstButton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg></button>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-semibold fs-6">Confirm Password</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                            </svg>
                                        </span>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="" value="" />
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>

                            <hr>
                            <div class="row mb-6">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3"></div>
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary btn_prop_disabled" id="admin_change_pass" onclick="_run(this)" data-form="form-profile-edit" data-callback="create_manager_call_back" data-btnid="admin_change_pass">Save Changes</button>
                                </div>
                                <!--end::Col-->
                            </div>
                        </form>
                        <!-----------Profile edit part end---------------->

                        <!-----------Security part start------------------>
                        <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                            <h4>Security Settings</h4>
                            <hr class="mb-12">
                            <div class="form-check form-switch form-check-custom form-check-solid mb-10 ps-5">
                                <input class="form-check-input" type="checkbox" value="no_auth" id="noAuthCheck" <?= (auth()->user()->email_auth == 0 && auth()->user()->g_auth == 0) ? "checked" : "" ?> />
                                <label class="form-check-label" for="noAuthCheck">
                                    Normal - Simple security system. No additional check require.
                                </label>
                            </div>
                            <div class="form-check form-switch form-check-custom form-check-solid mb-10 ps-5">
                                <input class="form-check-input" type="checkbox" id="mailAuthCheck" value="mail_auth" <?= (auth()->user()->email_auth == 1) ? "checked" : "" ?> />
                                <label class="form-check-label" for="mailAuthCheck">
                                    Mail Verification - Require mail verification for every login when your IP address will be changed.
                                </label>
                            </div>
                            <div class="form-check form-switch form-check-custom form-check-solid mb-10 ps-5">
                                <input class="form-check-input" type="checkbox" id="googleAuthCheck" value="google_auth" <?= (auth()->user()->g_auth == 1) ? "checked" : "" ?> />
                                <label class="form-check-label" for="googleAuthCheck">
                                    Google Authenticate - Need google authenticate app where you will get security code for login.
                                </label>
                            </div>
                            <!-----------google auth start------------------>
                            <div class="card-google-auth row d-none pt-5" id="google_auth_modal">
                                @php
                                use App\Services\GoogleAuthService;
                                $google = new GoogleAuthService();
                                $secret = $google->createSecret();
                                $qrCodeUrl = $google->getQRCodeGoogleUrl(auth()->user()->email, $secret, config('app.name'));
                                @endphp
                                <ul class="col-11 mx-auto" id="step">
                                    <!-- google auth setup form -->
                                    <form class="mx-2" action="{{ route('admin.google-security-setting') }}" method="post" enctype="multipart/form-data" id="google_auth_setup_form">
                                        @csrf
                                        <input type="hidden" name="user_id" value="<?= auth()->user()->id ?>">
                                        <li class="list-group-item active">
                                            <h5>Google Authenticator</h5>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center position-relative border-0">
                                            <div class="col-4">
                                                <div class="d-flex">
                                                    <span class="steper border-2 border-primary border text-center rounded-circle text-primary font-weight-bolder d-block z-index-2 bg-body">1</span>
                                                    <h6 class="mb-0 ms-3 mt-1">Download 2FA Backup Key:</h6>
                                                </div>
                                            </div>

                                            <div class="col-8 p-4 vertical-line">
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control d-block" id="secret_key" name="secret_key" value="<?= $secret ?>" aria-describedby="secret_key">
                                                        <span class="input-group-text position-relative" style="padding: 13px;" data-clipboard-target="#secret_key" id="copy_secret_key"> <i class="fas fa-download"></i> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item d-flex align-items-center position-relative border-0">
                                            <div class="col-4">
                                                <div class="d-flex">
                                                    <span class="steper border-2 border-primary border text-center rounded-circle text-primary font-weight-bolder d-block z-index-2 bg-body">2</span>
                                                    <h6 class="ms-3 mb-0 mt-1">Download And Install:</h6>
                                                </div>
                                            </div>
                                            <div class="col-8 p-4 vertical-line">
                                                <div class="dapp d-flex">
                                                    <a class="w-100" href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank">
                                                        <img class="img-fluid w-100 h-100" style="padding: 0 2.5px 0 0;" src="{{ asset('/assets/admin/brands/iphone.png') }}" alt="App Store">
                                                    </a>

                                                    <a class="w-100" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&amp;hl=en" target="_blank">
                                                        <img class="img-fluid  w-100" style="padding: 0 0 0 2.5px;" src="{{ asset('/assets/admin/brands/android.png') }}" alt="App Store">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="clr"></div>
                                        </li>

                                        <li class="list-group-item d-flex align-items-center position-relative border-0">
                                            <div class="col-4 position-relative">
                                                <div class="d-flex last-connector-vertical pb-5">
                                                    <span class="steper border-2 border-primary border text-center rounded-circle text-primary font-weight-bolder block z-index-2 bg-body">3</span>
                                                    <h6 class="ms-3 mt-1">Scan QR:</h6>
                                                </div>
                                                <div id="qrcode" class="ms-5 pl-5">
                                                    <img id="qrcodeurl" class="z-index-2 position-relative" src='<?= $qrCodeUrl; ?>'>
                                                </div>
                                            </div>
                                            <div class="code_in col-8 p-4 last-connector">
                                                <h6>Enter 2FA Code Form The App:</h6>
                                                <div class="input-group mb-md pt-5">
                                                    <input class="form-control d-block" type="text" onfocus="focused(this)" onfocusout="defocused(this)" name="v_code" placeholder="Enter 2FA verification code form the app">
                                                </div>
                                            </div>
                                        </li>
                                    </form>
                                    <li class="list-group-item d-flex align-items-center position-relative border-0">
                                        <div class="col-4 position-relative">
                                            &nbsp;
                                        </div>
                                        <div class="code_in col-8 p-4">
                                            <button type="button" class="btn bg-primary float-end" style="width: 200px" id="googleAuthSetupBtn" onclick="_run(this)" data-el="fg" data-form="google_auth_setup_form" data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>" data-callback="googleAuthSetupCallBack" data-btnid="googleAuthSetupBtn">Save Change</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-----------google auth end------------------>





                            <h4 class="mt-16">Reset Transaction Password</h4>
                            <hr>
                            <p class="pt-5 ps-4">Please click on this button. After that a new Transaction Password
                                will be send to your
                                mail !!</p>
                            <form class="" action="" method="" id="form-sent-reset-mai" role="tabpanel" aria-labelledby="home-tab-fill">
                                @csrf

                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-3"></div>
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Sent Reset Mail</button>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </form>
                            <hr>
                            <!------------Tranasaciton Passsword Change here------------>
                            <h4>Change Transaction Password</h4>
                            <form class="" action="" method="" id="form-trans-pass-change" role="tabpanel" aria-labelledby="home-tab-fill">
                                @csrf

                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Cuurent
                                        Password</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                    <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                                </svg>
                                            </span>
                                            <input type="password" class="form-control" name="current-password" placeholder="" value="" />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">New Password</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                    <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                                </svg>
                                            </span>

                                            <input type="password" id="new_passoword" data-size="16" data-character-set="a-z,A-Z,0-9,#" rel="gp" class="form-control" name="new_password" placeholder="Password" />
                                            <button class="btn btn-primary btn-gen-password" type="button" id="rstButton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                </svg></button>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Confirm Password</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                    <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                                </svg>
                                            </span>
                                            <input type="password" class="form-control" name="con-password" placeholder="" value="" />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-3"></div>
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </form>
                        </div>
                        <!-----------Security part end------------------>

                        <!------------Change phone and Email part start------------------->
                        <div class="tab-pane" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">
                            <form class="" action="" method="" id="form-email-sent-mail" role="tabpanel" aria-labelledby="home-tab-fill">
                                @csrf
                                <h4>Email & Phone Change</h4>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                        <span class="">Email</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                </svg>
                                            </span>
                                            <input type="email" class="form-control" name="Email" readonly placeholder="email" value="{{ $user->email }}" />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-3"></div>
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                                </svg></span> Sent Mail To Change Current
                                            Mail</button>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <hr>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Phone</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                                </svg>
                                            </span>
                                            <input type="tel" class="form-control" name="phone" placeholder="Phone" value="" />
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-3"></div>
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                                </svg></span>Sent Phone Change Mail</button>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </form>
                        </div>
                        <!------------Change phone and Email part end------------------->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

</div>
<!--end::Container-->
@endsection

@section('custom-script')
<script src="{{ asset('assets/admin/js/common-ajax.js') }}"></script>
<script>
    function rand_string(id) {
        var dataSet = $(id).attr('data-character-set').split(',');
        var possible = '';
        if ($.inArray('a-z', dataSet) >= 0) {
            possible += 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($.inArray('A-Z', dataSet) >= 0) {
            possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($.inArray('0-9', dataSet) >= 0) {
            possible += '0123456789';
        }
        if ($.inArray('#', dataSet) >= 0) {
            possible += '![]{}()%&*$#^<>~@|';
        }
        var text = '';
        for (var i = 0; i < $(id).attr('data-size'); i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    }
    // genrate randome password
    $(document).on('click', ".btn-gen-password", function() {
        var field = $(this).closest('div').find('input[rel="gp"]');
        field.val(rand_string(field));
        field.attr('type', 'text');
    });

    function create_manager_call_back(data) {
        $('#admin_change_pass').prop('disabled', false);
        if (data.status == true) {
            toastr['success'](data.message, 'Profile', {
                showMethod: 'slideDown',
                hideMethod: 'slideUp',
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
                timeOut: 2000,
            });
        }

        if (data.status == false) {
            toastr['error'](data.message, 'Password', {
                showMethod: 'slideDown',
                hideMethod: 'slideUp',
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
                timeOut: 2000,
            });
        }


        $.validator("form-profile-edit", data.errors);
        // submit_wait("#save-wallet-balance", data.submit_wait);
    }

    function create_manager_call_back(data) {
        $('#admin_change_pass').prop('disabled', false);
        if (data.status == true) {
            toastr['success'](data.message, 'Profile', {
                showMethod: 'slideDown',
                hideMethod: 'slideUp',
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
                timeOut: 2000,
            });
        }
    }
</script>

<!-- 2FA authentication script -->
<script>
    // secret key copy script start
    $(document).on('click', '#copy_secret_key', function() {
        var clipboardText = "";
        clipboardText = $('#secret_key').val();
        copyToClipboard(clipboardText);
        notify('success', "Copied To Clipboard", 'Secret Key');

    });

    function copyToClipboard(text) {
        var sampleTextarea = document.createElement("textarea");
        document.body.appendChild(sampleTextarea);
        sampleTextarea.value = text; //save main text in it
        sampleTextarea.select(); //select textarea contenrs
        document.execCommand("copy");
        document.body.removeChild(sampleTextarea);
    }
    // secret key copy script end

    if ($('#googleAuthCheck[type="checkbox"]')) {
        if ($('#googleAuthCheck').prop("checked") == true) {
            $('#google_auth_modal').show();
            $('#google_auth_modal').removeClass('d-none');
        } else if ($('#googleAuthCheck').prop("checked") == false) {
            $('#google_auth_modal').addClass('d-none');
        }
    }
    // check or uncheck property
    // no auth
    $('#noAuthCheck[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#noAuthCheck').prop('checked', true);
            $('#mailAuthCheck').prop('checked', false);
            $('#googleAuthCheck').prop('checked', false);
            $('#google_auth_modal').addClass('d-none');
        } else if ($(this).is(":not(:checked)")) {
            $('#noAuthCheck').prop('checked', false);
            $('#mailAuthCheck').prop('checked', false);
            $('#googleAuthCheck').prop('checked', false);
            $('#google_auth_modal').addClass('d-none');
        }
    });
    // mail auth
    $('#mailAuthCheck[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#noAuthCheck').prop('checked', false);
            $('#mailAuthCheck').prop('checked', true);
            $('#googleAuthCheck').prop('checked', false);
            $('#google_auth_modal').addClass('d-none');
        } else if ($(this).is(":not(:checked)")) {
            $('#noAuthCheck').prop('checked', false);
            $('#mailAuthCheck').prop('checked', true);
            $('#googleAuthCheck').prop('checked', false);
            $('#google_auth_modal').addClass('d-none');
        }
    });
    // google auth
    $('#googleAuthCheck[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#noAuthCheck').prop('checked', false);
            $('#mailAuthCheck').prop('checked', false);
            $('#googleAuthCheck').prop('checked', true);
            $('#google_auth_modal').show();
            $('#google_auth_modal').removeClass('d-none');
        } else if ($(this).is(":not(:checked)")) {
            $('#noAuthCheck').prop('checked', false);
            $('#mailAuthCheck').prop('checked', false);
            $('#googleAuthCheck').prop('checked', false);
            $('#google_auth_modal').addClass('d-none');
        }
    });

    // no auth
    $(document).on('change', '#noAuthCheck', function(event) {
        let check_auth = $('#noAuthCheck').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/update-security-setting/' + check_auth,
            method: 'POST',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,

            success: function(data) {
                if (data.success) {
                    notify('success', data.message, 'Authentication');
                    $('#noAuthCheck').prop('checked', true);
                    $('#mailAuthCheck').prop('checked', false);
                    $('#googleAuthCheck').prop('checked', false);
                } else {
                    notify('error', data.message, 'Authentication');
                }
            }
        });
    });
    // mail auth
    $(document).on('click', '#mailAuthCheck', function(event) {

        let check_auth = $('#mailAuthCheck').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/update-security-setting/' + check_auth,
            method: 'POST',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,

            success: function(data) {
                if (data.success) {
                    notify('success', data.message, 'Authentication');
                    $('#noAuthCheck').prop('checked', false);
                    $('#mailAuthCheck').prop('checked', true);
                    $('#googleAuthCheck').prop('checked', false);
                } else {
                    notify('error', data.message, 'Authentication');
                }
            }
        });
    });

    // google auth setup callback
    function googleAuthSetupCallBack(data) {
        $('#googleAuthSetupBtn').prop('disabled', false);
        if (data.success) {
            notify('success', data.message, 'Google Authentication');
            $('#noAuthCheck').prop('checked', false);
            $('#mailAuthCheck').prop('checked', false);
            $('#googleAuthCheck').prop('checked', true);
        } else {
            notify('error', data.message, 'Google Authentication');
        }
    }
</script>
@endsection