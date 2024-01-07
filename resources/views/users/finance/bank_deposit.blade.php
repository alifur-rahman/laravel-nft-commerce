@extends('layouts.users.user-admin-layout')
@section('title','User Deposit')
@section('content')
<style>
    .nice-select.profile-edit-select {
        width: 100% !important;
        height: 55px;
        padding: 8px 8px 8px 20px;
    }
</style>
<!-- start page title area -->
<div class="rn-nft-mid-wrapper">
<!-- <div class="rn-breadcrumb-inner ptb--30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h5 class="title text-center text-md-start">Bank Deposit</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item">Finances</li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Bank Deposit</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<!-- end page title area -->
<!-- start Create Collection -->
<div class="creat-collection-area pt--80">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <aside class="rwt-sidebar">
                    <div class="rbt-single-widget widget_recent_entries mt--40">
                        <h3 class="title">Bank Deposit Note</h3>
                        <div class="inner">
                            <ul>
                                <li><a class="d-block" href="#">&#10020; Account verification is required for Local deposit.</a></li>
                                <li><a class="d-block" href="#">&#10020; Bank Deposit takes a minimum of 6 hours to 72 working hours to process.</a></li>
                                <li><a class="d-block" href="#">&#10020; Fill in all important information correctly.</a></li>
                                <li><a class="d-block" href="#">&#10020; For Neteller or Skrill just submit a screenshot of your transaction to Continue Account.</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="col-lg-7">
                <form action="{{route('user.finance.bank_deposit.add')}}" enctype="multipart/form-data" method="post" id="bank_deposit_form">
                    @csrf 
                    <div class="create-collection-form-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="collection-single-wized">
                                    <label class="title required">Bank</label>
                                    <select id="account_number" class="profile-edit-select" name="account_number">
                                        <option value="">Select Your Bank</option>
                                        @foreach($admin_bank as $bank)
                                        <option value="{{ $bank->account_number }}">{{ $bank->account_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="amount" class="title required">Amount</label>
                                    <div class="create-collection-input">
                                        <input name="amount" type="text" placeholder="$ 00.0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized banner">
                                    <label class="title required">Bank Proof</label>
                                    <div class="create-collection-input logo-image">
                                        <div class="logo-c-image logo">
                                            <img id="rbtinput1" src="{{ asset('/assets/user/images/profile/cover-04.png') }}" alt="Profile-NFT">
                                            <label for="fatima" title="No File Choosen">
                                                <span class="text-center color-white"><i class="feather-edit"></i></span>
                                            </label>
                                        </div>
                                        <div class="button-area">
                                            <div class="brows-file-wrapper">
                                                <input name="bank_proof" id="fatima" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="button-wrapper float-end">
                                    <button type="button" data-label="Submit Request" id="bank_deposit_btn" data-btnid="bank_deposit_btn" data-callback="bank_deposit_callback" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="bank_deposit_form" data-el="fg" data-file="true" onclick="_run(this)" class="btn btn-primary-alta btn-large">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Create Collection -->
@endsection
@section('custom-js')
<script>
    // save persional form
    function bank_deposit_callback(data) {
        $('#bank_deposit_btn').prop('disabled', true);
        if (data.status == true) {
            notify('success', data.message, 'Bank Deposit');
            $('.profile-edit-select').val('');
            $('.profile-edit-select').niceSelect('update');
            $('#bank_deposit_form').trigger('reset');
            setTimeout(function() {
                location.reload();
            }, 5000);
        }
        if (data.status == false) {
            notify('error', data.message, 'Bank Deposit');
            $.validator("bank_deposit_form", data.errors);
        }
        setTimeout(function() {
            $('#bank_deposit_btn').prop('disabled', false);
        }, 5000);

    }
</script>
@endsection