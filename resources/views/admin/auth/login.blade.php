@extends('layouts.admin.auth')
@section('title','Admin Login')
@section('content')
    <div class="d-flex flex-center w-lg-50 p-10">
        <!--begin::Card-->
        <div class="card rounded-3 w-md-550px">
            <!--begin::Card body-->
            <div class="card-body p-10 p-lg-20">
                <!--begin::Form-->
                <form method="POST" class="form w-100" novalidate="novalidate" id="admin_login_form"  action="{{route('admin.login')}}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                        <!--end::Subtitle=-->
                    </div>
                    <!--begin::Heading-->  
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Email" name="email" autocomplete="off"
                            class="form-control bg-transparent" />
                        <!--end::Email-->
                    </div>
                    <!--end::Input group=-->
                    <div class="fv-row mb-3">
                        <!--begin::Password-->
                        <input type="password" placeholder="Password" name="password" autocomplete="off"
                            class="form-control bg-transparent" />
                        <!--end::Password-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Wrapper-->
                    <!--end::Wrapper-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10"> 

                        <button type="button" class="btn btn-primary" style="width: 100%;" id="admin_login_btn" onclick="_run(this)" data-el="fg" data-form="admin_login_form" data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>" data-callback="adminLoginCallBack" data-btnid="admin_login_btn">Sign In</button> 
                    </div>
                    <!--end::Submit button--> 
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
@endsection

@section('custom-script')
    <script>
        function adminLoginCallBack(data){
            if (data.status == true) {
                notify('success', data.message, 'Login Success');
                setTimeout(function() {
                    window.location.href = "/admin/dashboard";
                }, 1000 * 2); 
            } else { 
                notify('error', data.message, 'Login Error');
                $.validator("admin_login_form", data.errors);
            }
        }
    </script>
@stop