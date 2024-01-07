@extends('layouts.users.user-layout')
@section('title', 'User Login')
@if (!isset($company_infos->com_name))
    @section('company', config('app.name'))
@else
    @section('company', $company_infos->com_name)
@endif

@section('custom-css')
    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/forms/form-validation.css') }}">
<style>
.active-dark-mode .another-login.login-facebook {
	padding: 15px;
	background: #242435;
	width: 100% !important;
	display: block;
	border-radius: 5px; 
}

.active-light-mode .another-login.login-facebook {
	padding: 15px;
	background: var(--color-gray-2);
	width: 100% !important;
	display: block;
	border-radius: 5px;
	border: 1px solid #535353;
}

.active-light-mode .another-login.login-facebook:hover {
	color: #000;
}
.active-dark-mode .another-login.login-facebook:hover {
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

<div class="login-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class=" offset-2 col-lg-4 col-md-6 ml_md--0 ml_sm--0 col-sm-12">
                <div class="form-wrapper-one">
                    <h4>Login</h4>
                    <form action="{{ route('user.login') }}" enctype="multipart/form-data" role="form" class="login-form" method="POST" id="login_form">
                    @csrf

                    <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" placeholder="mail@exmple.com"
                            id="exampleInputEmail1">
                        </div>
                        <div class="mb-5">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password"
                            id="exampleInputPassword1" placeholder="Type your password here">
                        </div>
                        <div class="mb-5 rn-check-box">
                            <input type="checkbox" class="rn-check-box-input" id="exampleCheck1">
                            <label class="rn-check-box-label" for="exampleCheck1">Remember me leter</label>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="w-50 btn text-white login-btn btn btn-primary mr--15" id="loginFormBtn" onclick="_run(this)" data-el="fg" data-form="login_form" data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>" data-callback="userLoginForm" data-btnid="loginFormBtn">Log In</button>
                            <a href="/user/registration" class="w-50 btn btn-primary-alta">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="social-share-media form-wrapper-one">
                    <h6>Another way to log in</h6>
                    <a href="{{ url('auth/google') }}" style="background: #ec7064" class="another-login login-facebook text-center"><i
                        class="fa-brands fa-google"></i>&nbsp;<span>Log in with Google</span></a>

                    <a href="{{ route('facebookRedirect') }}" style="background: #4267B2" class="another-login login-facebook text-center"><i
                            class="fa-brands fa-facebook-f"></i>&nbsp;<span>Log in with Facebook</span></a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
        function userLoginForm(data) { 
            if (data.status == true) {
                notify('success', data.message, 'Login Success');
                setTimeout(function() {
                    window.location.href = "/user/dashboard";
                }, 1000 * 2);
            } else {
                notify('error', data.message, 'Login Error');
                $.validator("login_form", data.errors);
            }
        }
        async function web3Login() {
            if (!window.ethereum) {
                notify('error', 'MetaMask not detected. Please install MetaMask first.', 'Login Error');
            }
            const provider = new ethers.providers.Web3Provider(window.ethereum);

            let response = await fetch('/web3-login-message');
            const message = await response.text();

            await provider.send("eth_requestAccounts", []);
            const address = await provider.getSigner().getAddress();
            const signature = await provider.getSigner().signMessage(message);

            response = await fetch('/web3-login-verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'address': address,
                    'signature': signature,
                    '_token': '{{ csrf_token() }}'
                })
            });
            const data = await response.text();
            console.log(data);
        }
    </script>
    @endsection
