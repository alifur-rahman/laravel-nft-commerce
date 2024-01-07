<?php

use Illuminate\Support\Facades\Cookie;
?>
@extends('layouts.users.user-auth')
@section('title', 'User Login') 
@section('style')
<style>
    .metamask {
        padding: 9px;
        color: #fff
    }
    .metamask:hover{
        color: #fff
    }
    .metamask img {
        width: 28px; 
    }
</style>
@stop
@section('content')
    <!-- log in section start -->
    <section class="login-section">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 login">

                <div class="row">
                    <div class="col-lg-7 p-0 login-left">
                        <img class="" src="{{ asset('/assets/user/images/logisn-sidebar.png') }}" alt=""
                            height="100%">

                    </div>
                    <div class="col-lg-5 login-right">
                        <form action="{{ route('user.login') }}" enctype="multipart/form-data" role="form" class="login-form"
                            method="POST" id="login_form">
                            @csrf
                            <div class="mb-lg-3 login-header">
                                <h2>Login</h2>
                            </div>

                            <div class="line"> <small class="text-muted">or</small></div>

                            <div class="mb-lg-4 text-center">
                                <span class="divider"></span>
                            </div>
                            <div class="mb-lg-3">
                                <a href="{{ url('auth/google') }}" class="btn google-btn gradiant-border" style="width: 100%;"><i
                                    class="fa-brands fa-google"></i> Sign in With Google</a>
                                {{-- <button type="submit" id="googleAuthSignIn" class="btn google-btn gradiant-border" style="width: 100%;"><i
                                        class="fa-brands fa-google"></i> Sign in With Google</button>   --}}
                            </div>
                            <div class="mb-lg-4">
                                <button onclick="web3Login();" type="button" class="btn metamask gradiant-border" style="width: 100%;">
                                    <img src="{{asset('assets/user/images/metamask-logo.png')}}" alt="">
                                    Sign in With Metamask</button>  
                            </div>
                            <div class="mb-lg-4">
                                <label for="exampleInputEmail1" class="form-label text-white">Email:</label>
                                <input type="email" name="email" class="form-control cus-input shadow"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="mail@exmple.com">

                            </div>
                            <div class="mb-lg-4">
                                <label for="exampleInputPassword1" class="form-label text-white">Password:</label>
                                <input type="password" name="password" class="form-control cus-input shadow"
                                    id="exampleInputPassword1" placeholder="Type your password here">
                            </div>
                            <div class="row rem-for p-0 m-0">
                                <div class="mb-lg-4 form-check">
                                    <input type="checkbox" class="form-check-input" name="remember_me" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember
                                        me</label>
                                </div>
                                <div class="mb-lg-4 form-check">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>

                            <div class="mb-lg-4">
                                {{-- <button type="submit" class="btn text-white login-btn" style="width: 100%;">Log In</button> --}} 

                                <button type="button" class="btn text-white login-btn" style="width: 100%;" id="loginFormBtn" onclick="_run(this)" data-el="fg" data-form="login_form" data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>" data-callback="userLoginForm" data-btnid="loginFormBtn">Log In</button>
                            </div>
                            <div class="mt-lg-4 text-center sign-opt">
                                <p>Don't have an account?<a href="{{route('user.registration')}}"> Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-2"></div>
        </div>

    </section>
    <!-- log in section end -->
@stop

@section('page-js')    
<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>

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
@stop
