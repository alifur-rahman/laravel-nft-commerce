@extends('layouts.users.user-admin-layout')
@section('title','User Crypto Deposit')
@section('content')
<style>
    .nice-select.profile-edit-select {
        width: 100% !important;
        height: 55px;
        padding: 8px 8px 8px 20px;
    }

    /* form validation error */

    .collection-single-wized {
        margin-bottom: 0px !important;
    }

    span.block_chain.error-msg {
        position: relative;
        top: 75px;
    }

    span.crypto_name.error-msg {
        position: relative;
        top: 75px;
    }
</style>
<!-- start page title area -->
<div class="rn-nft-mid-wrapper">
<!-- <div class="rn-breadcrumb-inner ptb--30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h5 class="title text-center text-md-start">Crypto Deposit</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item">Finances</li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Crypto Deposit</li>
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
                        <h3 class="title">Crypto Deposit Note</h3>
                        <div class="inner">
                            <ul>
                                <li><a class="d-block" href="#">&#10020; Transaction ID is mendatory you can find your transaction ID on your wallet or in blockchain.info.</a></li>
                                <li><a class="d-block" href="#">&#10020; Deposit can take sometime its not instant confirmation time deppends on blockchain mining time.</a></li>
                                <li><a class="d-block" href="#">&#10020; Check carefully the bitcoin address and amount is correct where you are sending and amount you are sending.</a></li>
                                <li><a class="d-block" href="#">&#10020; If you have any issue contact support.</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="col-lg-7">
                <form action="{{route('user.finance.crypto_deposit.add')}}" enctype="multipart/form-data" method="post" id="crypto_deposit_form">
                    @csrf
                    <div class="create-collection-form-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="collection-single-wized">
                                    <label class="title required bank-deposit-label" for="block_chain">Block Chain</label>
                                    <select id="block_chain" class="profile-edit-select" name="block_chain">
                                        <option value="">Select A Block Chain</option>
                                        @foreach($block_chains as $block_chain)
                                        <option value="{{ $block_chain->block_chain }}">{{ $block_chain->block_chain }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3 crypto-name-div">
                                <div class="collection-single-wized">
                                    <label class="title required bank-deposit-label" for="crypto-name">Crypto Name</label>
                                    <select class="profile-edit-select" id="crypto-name" name="crypto_name">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="usd-amount" class="title required p-0 m-0 usd-amount-label">USD Amount</label>
                                    <div class="create-collection-input">
                                        <input id="usd-amount" name="usd_amount" type="text" placeholder="$ 00.0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="crypto-amount" class="title required p-0 m-0">Crypto Amount</label>
                                    <div class="create-collection-input">
                                        <input id="crypto-amount" name="crypto_amount" type="text" placeholder="0" value="0" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="transaction-password" class="title required p-0 m-0">Transaction Password</label>
                                    <div class="create-collection-input">
                                        <input id="transaction-password" name="transaction_password" type="password" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="button-wrapper float-end">
                                    <input type="hidden" name="crypto_address" id="crypto_address" value="">
                                    <button type="button" data-label="Submit Request" id="crypto_deposit_btn" data-btnid="crypto_deposit_btn" data-callback="crypto_deposit_callback" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="crypto_deposit_form" data-el="fg" data-file="true" onclick="_run(this)" class="btn btn-primary-alta btn-large mt-5">Confirm</button>
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
    function crypto_deposit_callback(data) {
        $('#crypto_deposit_btn').prop('disabled', true);
        if (data.status == true) {
            $('.bank-deposit-label').css({
                marginTop: '0px',
                marginBottom: '0px'
            });
            notify('success', data.message, 'Crypto Deposit');
            $('.profile-edit-select').val('');
            $('.profile-edit-select').niceSelect('update');
            $('#crypto_deposit_form').trigger('reset');
        }
        if (data.status == false) {
            $('.bank-deposit-label').css({
                marginTop: '0px',
                marginBottom: '0px'
            });
            $('.crypto-name-div').addClass('mt-4');
            notify('error', "Fix the following error!", 'Crypto Deposit');
            $.validator("crypto_deposit_form", data.errors);
        }
        setTimeout(function() {
            $('#crypto_deposit_btn').prop('disabled', false);
            // $('.profile-edit-select').val('');
            // $('.profile-edit-select').niceSelect('update');
        }, 5000);
    }


    $(document).on("change", "#block_chain", function() {
        let block_chain = $(this).val();
        // get existing address
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            dataType: 'json',
            method: 'POST',
            url: '/user/crypto-name',
            data: {
                block_chain: block_chain
            },
            success: function(data) {
                $('#crypto-name').html(data.option);
                $('#crypto-name').niceSelect('update');
                $('#crypto_address').val(data.address);
            }
        });
    });

    // amount convert usd to crypto
    $(document).on("blur keyup", "#usd-amount", function() {
        let usd_amount = $(this).val();
        let crypto_type = $("#block_chain").val();
        let crypto_name = $("#crypto-name").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/user/crypto-convert',
            dataType: 'json',
            method: 'POST',
            data: {
                usd_amount: usd_amount,
                crypto_type: crypto_type,
                crypto_name: crypto_name,
            },
            success: function(data) {
                $("#crypto-amount").val(data.crypto_amount);
            }
        });
    });
</script>
@endsection