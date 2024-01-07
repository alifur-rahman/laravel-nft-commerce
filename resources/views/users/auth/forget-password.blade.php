@extends('layouts.users.user-layout')
@section('title', 'Forgot Password')
@section('custom-css')
<!-- custom css here -->
@endsection
@section('content')
@php use App\Services\AllfunctionService; @endphp
<!-- start page title area -->
<div class="rn-breadcrumb-inner ptb--30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h5 class="title text-center text-md-start">Forget Password?</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Forget Password?</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end page title area -->

<div class="forget-password-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="offset-lg-4 col-lg-4">
                <div class="form-wrapper-one">
                    <form action="{{ route('user.forgot-password') }}" enctype="multipart/form-data" method="post" id="forgot_email_form">
                        @csrf
                        <div class="logo-thumbnail logo-custom-css mb--50">
                            <a class="logo-light" href="{{ route('home') }}"><img src="{{ asset('assets/user/images/logo/logo-white.png') }}" alt="nft-logo"></a>
                            <a class="logo-dark" href="{{ route('home') }}"><img src="{{ asset('assets/user/images/logo/logo-dark.png') }}" alt="nft-logo"></a>
                        </div>

                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" id="exampleInputEmail1" name="forgot_email" placeholder="Enter your email">
                        </div>
                        <div class="mb-5">
                            <input type="checkbox" class="rn-check-box-input" id="exampleCheck1">
                            <label class="rn-check-box-label" for="exampleCheck1">I agree to the <a href="privacy-policy.html">privacy policy</a> </label>
                        </div>

                        <div class="mb-5">
                            <button type="button" data-label="Submit Request" id="forgot_email_btn" data-btnid="forgot_email_btn" data-callback="forgot_email_callback" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="forgot_email_form" data-el="fg" data-file="true" onclick="_run(this)" class="btn btn-primary-alta btn-large">Confirm</button>
                        </div>
                        <span class="mt--20 notice">Note: We will send a password to your email</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-js')
<script>
    // save persional form
    function forgot_email_callback(data) {
        $('#forgot_email_btn').prop('disabled', true);
        if (data.status == true) {
            notify('success', data.message, 'Bank Deposit');
        }
        if (data.status == false) {
            notify('error', data.message, 'Bank Deposit');
            $.validator("forgot_email_form", data.errors);
        }
    }
</script>
