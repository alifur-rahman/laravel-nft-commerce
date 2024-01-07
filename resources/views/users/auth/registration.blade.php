@extends('layouts.users.user-layout')
@section('title', 'User Registration')    
@section('custom-css')
    <!-- Style css -->
 
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/forms/form-validation.css') }}">
 
<style>
.social-share-media.form-wrapper-one.pt-5 {
	padding-top: 91px !important;
}



.another-login.login-facebook {
	padding: 15px;
	background: #4267B2;
	width: 100% !important;
	display: block;
	border-radius: 5px; 
}
.another-login.login-facebook:hover {
	color: #fff;
}
.error-msg {
        color: #d71b1b;
    }
    .toast {
        font-size: 1.4rem;
        pointer-events: auto;
    }
    .toast .toast-title {
        font-size: 1.6rem;
    }
    .toast .toast-close-button {
        display: none;
    }

    /* copy btn design  */

    /* copy btn set on password field  */
  .pasGen-form-group{
    position: relative;
    }
    /* .copy_btn {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 99;
        border: none;
        background: #4FD1C5;
        padding: 0 12px;
        display: none;
        border-radius: 5px !important;
        color: #fff;
    } */
    .copy_btn {
        position: absolute;
        top: -6px;
        right: 0;
        z-index: 99;
        border: none;
        background: #4FD1C5;
        padding: 4px 12px;
        display: none;
        border-radius: 5px !important;
        color: #fff;
        width: 63px;
    }
    .btn-gen-password i {
        font-size: 16px;
    }
    .copy_btn::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        top: 24px;
        left: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid #4FD1C5;
        border-bottom: 8px solid transparent;
        right: 0;
        margin: 0 auto;
    }
    .btn-gen-password {
        color: #fff;
    }
    .copy_password{
        /* padding: 0.5rem 0.75rem !important;  */
    }
    /* password character check info css  */
    .password_ch_toltip{
        position: relative;
    }
    .info-icon {
        margin-right: -5px;
        background: #4FD1C5;
        color: #fff;
    }
    .input-group-text + .form-control {
        padding-left: 10px !important;
    }
    .pass_toltip_content {
        margin: 0;
        background: #15151F;
        font-size: 13px;
        position: absolute;
        top: -240px;
        padding: 19px 25px;
        border-radius: 5px !important;
        display: none;
        list-style: none;
        z-index: 99999;
    }
    .pass_toltip_content::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        top: 100%;
        left: 3px;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 20px solid #15151F;
        border-bottom: 15px solid transparent;
    }
    .pas_info_text {
        margin: 0;
        font-size: 16px;
    }
    .pass_toltip_content li i {
        margin-right: 5px;
    }
    .btn-gen-password {
        color: #fff;
        background: #0D9AC3;
        border: none;
        position: absolute !important;
        top: 26px;
        left: 87%;
        /* bottom: ; */
        height: 50px;
        width: 50px;
        text-align: center;
        display: flex;
        justify-content: center;
        border-radius: 2px;
        cursor: pointer;
    }
</style>
@endsection
@section('content')
    <!-- Registration section start -->

    <!-- Registration section end -->
    <!-- registration form -->
    <div class="login-area rn-section-gapTop">
        <div class="container">
            <form class="login-form" id="register_form" method="POST" action="{{route('user.registration')}}">
            <div class="row g-5">
                
                <div class="offset-2 col-lg-4 col-md-6 ml_md--0 ml_sm--0 col-sm-12">
                    <div class="form-wrapper-one registration-area">
                        <h4>Sign up</h4>
                            @csrf
                            <div class="mb-5">
                                <label for="full_name" class="form-label">Name</label>
                                <input type="text" name="full_name" id="full_name" placeholder="Name">
                            </div> 
                            <div class="mb-5">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="mb-5">
                                <label for="confirm_email" class="form-label">Confirm Email</label>
                                <input type="email" name="confirm_email" id="confirm_email" placeholder="Confirm Email">
                            </div>
                            
                            <div class="password_gen">
                                <div class="mb-5 pasGen-form-group password_ch_toltip">

                                    <ul class="pass_toltip_content"> 
                                        <h6 class="pas_info_text">Password Must:</h6>
                                        <li class="pwd-restriction-length"><i class="fas fa-info-circle"></i> Be between 10-16 characters in length</li>
                                        <li class="pwd-restriction-upperlower"><i class="fas fa-info-circle"></i> Contain at least 1 lowercase and 1 uppercase letter</li>
                                        <li class="pwd-restriction-number"><i class="fas fa-info-circle"></i> Contain at least 1 number (0–9)</li>
                                        <li class="pwd-restriction-special"><i class="fas fa-info-circle"></i> Contain at least 1 special character (!@#$%^&()'[]"?+-/*)</li>  
                                    </ul>  
                                    <button class="copy_btn" type="button">Copy</button>
    
                                    <label for="password" class="form-label">Create Password</label>
                                    <input class="copy_password check_password_chrac copy-pass-input" name="password" data-size="16" data-character-set="a-z,A-Z,0-9,#" rel="gp" placeholder="New Password" type="password" id="password"> 
                                     <span class="input-group-text position-relative bg-gradient-primary cursor-pointer btn-gen-password " style="padding:13px">
                                        <i class="fas fa-key"></i>
                                    </span>  
                                </div>
                                <div class="mb-5">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input class="password_gen" rel="gp" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password">  
                                </div>
                            </div> 
                            
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    
                    <div class="social-share-media form-wrapper-one pt-5">
                        <div class="mb-5">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" placeholder="Phone">
                        </div>
                        <div class="password_gen">
                            <div class="mb-5 pasGen-form-group password_ch_toltip">
                                <ul class="pass_toltip_content"> 
                                    <h6 class="pas_info_text">Password Must:</h6>
                                    <li class="pwd-restriction-length"><i class="fas fa-info-circle"></i> Be between 10-16 characters in length</li>
                                    <li class="pwd-restriction-upperlower"><i class="fas fa-info-circle"></i> Contain at least 1 lowercase and 1 uppercase letter</li>
                                    <li class="pwd-restriction-number"><i class="fas fa-info-circle"></i> Contain at least 1 number (0–9)</li>
                                    <li class="pwd-restriction-special"><i class="fas fa-info-circle"></i> Contain at least 1 special character (!@#$%^&()'[]"?+-/*)</li>  
                                </ul>  
                                <button class="copy_btn" type="button">Copy</button>
                                <label for="transaction_password" class="form-label">Transection Password</label>
                                <div>
                                    <input class="copy_password check_password_chrac copy-pass-input" name="transaction_password" data-size="16" data-character-set="a-z,A-Z,0-9,#" rel="gp" placeholder="Transection Password" type="password" id="transaction_password">
                                    <span class="input-group-text position-relative bg-gradient-primary cursor-pointer btn-gen-password " style="padding:13px">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                            </div> 
                            <label for="confirm_transaction_password" class="form-label">Confirm Transection Password</label>
                            <div class="mb-5">
                                <input class="password_gen" rel="gp" type="password" id="confirm_transaction_password" name="confirm_transaction_password" placeholder="Confirm password">
                            </div>
                        </div>  
                        <div class="d-flex">
                            <button type="button" class="w-50 btn btn-primary mr--15" id="registerBtn" onclick="_run(this)" data-el="fg" data-form="register_form" data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>" data-callback="userRegisterCallBack" data-btnid="registerBtn">Sign Up</button>  
                            <a href="/user" class="w-50 btn btn-primary-alta">Log In</a>
                        </div>

                        <h6 class="mt-5">Another way to sign up</h6>
                        <a href="{{ url('auth/google') }}" style="background: #ec7064" class="another-login login-facebook text-center"><i
                            class="fa-brands fa-google"></i>&nbsp;<span>Log in with Google</span></a> 
                        
                        <a href="{{ route('facebookRedirect') }}" class="another-login login-facebook text-center"><i
                            class="fa-brands fa-facebook-f"></i>&nbsp;<span>Log in with Facebook</span></a>
                    </div>
                </div>
            </div> 
        </form>
        </div>
    </div>
    <!-- registration form end -->

@stop

@section('custom-js')     
<!-- main JS -->
<script src="{{asset('assets/user/auth/js/main.js')}}"></script>
<!-- Meta Mask  -->
<script src="{{asset('assets/user/auth/js/vendor/web3.min.js')}}"></script>
<script src="{{asset('assets/user/auth/js/vendor/maralis.js')}}"></script>
<script src="{{asset('assets/user/auth/js/vendor/nft.js')}}"></script>

{{-- common js  --}}
{{-- <script src="{{asset('js/common-ajax.js')}}"></script>  --}}

{{-- <script src="{{ asset('assets/user/js/core/jquery.min.js') }}"></script> --}}
<script src="{{ asset('assets/user/auth/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/user/auth/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://kit.fontawesome.com/1198e48619.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/user/auth/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/user/auth/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('assets/src/js/core/confirm-alert.js') }}"></script>
<script src="{{ asset('assets/user/auth/js/scripts/pages/common-ajax.js') }}"></script>
<script src="{{ asset('assets/user/auth/js/custom-validation.js') }}"></script>

<script src="{{ asset('/js/copy-js.js') }}"></script>
<script src="{{ asset('/js/password-gen.js') }}"></script>
<script src="{{ asset('assets/user/auth/js/master.js') }}"></script> 

<script> 

    function userRegisterCallBack(data){ 
        if (data.status == true) {
            notify('success', data.message, 'Registraion Success');
            setTimeout(function() {
                window.location.href = "/user";
            }, 1000 * 2); 
        } else { 
            notify('error', data.message, 'Registraion Error');
            $.validator("register_form", data.errors);
        }
    }


    
    // genrate randome password
    $(document).on('click', ".btn-gen-password", function() {
        var field = $(this).closest('div.password_gen').find('input[rel="gp"]');
        field.val(rand_string(field));
        field.attr('type', 'text');
        $(this).closest('div.password_gen').find('.copy_btn').show(); 
    });   
    $('.copy_btn').on("click", function(e) { 
        e.preventDefault();
        $(this).html('copied');
        setTimeout(() => { 
            $(this).hide(); 
            $(this).html('Copy'); 
        }, 1000);
        let id = $(this).closest('div.password_gen').find('.copy-pass-input').attr('id');
        $(this).closest('div.password_gen').find('.copy-pass-input').select();
        if ($(this).closest('div.password_gen').find('.copy-pass-input').val() != "") {
            copy_to_clipboard(id);
        }
        $(this).closest('div.password_gen').find('input[rel="gp"]').attr('type', 'password');
    });  

    // password character check 
    $('.check_password_chrac').focusin(function(){
        $(this).closest('.password_ch_toltip').find('.pass_toltip_content').show();
    }); 
    $('.check_password_chrac').focusout(function(){
        $(this).closest('.password_ch_toltip').find('.pass_toltip_content').hide();
    });  
    $('.password_ch_toltip').find('.check_password_chrac').keyup(function () {  
        
        var pwdLength = /^.{10,16}$/;
        var pwdUpper = /[A-Z]+/;
        var pwdLower = /[a-z]+/;
        var pwdNumber = /[0-9]+/;
        var pwdSpecial = /[!@#$%^&()'[\]"?+-/*={}.,;:_]+/;
        pwdLength.test( $(this).val()); 

        var s = $(this).val();   

        if (pwdLength.test(s)) { 
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').css("color", "green");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').removeClass('fa-info-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').addClass('fa-check-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').removeClass("fa-times-circle");
        } else {
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').css("color", "#E84B21");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').removeClass("fa-check-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').removeClass("fa-info-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-length svg').addClass("fa-times-circle");
        }
        if (pwdUpper.test(s) && pwdLower.test(s)) { 
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').css("color", "green");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').removeClass('fa-info-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').addClass('fa-check-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').removeClass("fa-times-circle");
        } else {
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').css("color", "#E84B21");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').removeClass("fa-check-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').removeClass("fa-info-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-upperlower svg').addClass("fa-times-circle");
        }
        if (pwdNumber.test(s)) { 
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').css("color", "green");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').removeClass('fa-info-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').addClass('fa-check-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').removeClass("fa-times-circle");
        } else { 
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').css("color", "#E84B21");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').removeClass("fa-check-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').removeClass("fa-info-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-number svg').addClass("fa-times-circle");
        }
        if (pwdSpecial.test(s)) { 
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').css("color", "green");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').removeClass('fa-info-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').addClass('fa-check-circle');
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').removeClass("fa-times-circle");
        } else {
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').css("color", "#E84B21");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').removeClass("fa-check-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').removeClass("fa-info-circle");
            $(this).closest('.password_ch_toltip').find('.pwd-restriction-special svg').addClass("fa-times-circle");
        }
    });

     
</script>
@stop