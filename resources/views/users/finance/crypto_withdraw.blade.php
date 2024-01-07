@extends('layouts.users.user-admin-layout')
@section('title','User Crypto Withdraw')
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
                <h5 class="title text-center text-md-start">Crypto Withdraw</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item">Finances</li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Crypto Withdraw</li>
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
                        <h3 class="title">Crypto Withdraw Note</h3>
                        <div class="inner">
                            <ul>
                                <li><a class="d-block" href="#">&#10020; This is satelment withdraw you have to withdraw all funds you cant put custom amount.</a></li>
                                <li><a class="d-block" href="#">&#10020; You can withdraw each asset 2 times in a week maximum.</a></li>
                                <li><a class="d-block" href="#">&#10020; The blockchain fee transaction fee and all other fees are included in withdraw fee.</a></li>
                                <li><a class="d-block" href="#">&#10020; Please put your address carefully any mistake made by you wont make us responsible.</a></li>
                                <li><a class="d-block" href="#">&#10020; Processing a Withdraw Request can take upto 72 hour time.</a></li>
                                <li><a class="d-block" href="#">&#10020; If you have any issue contact support.</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="col-lg-7">
                <form action="{{route('user.finance.crypto_withdraw.add')}}" enctype="multipart/form-data" method="post" id="crypto_withdraw_form">
                    @csrf
                    <div class="create-collection-form-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-warning text-dark w-auto d-flex m-auto">
                                    <p class="text-dark">Balance : <strong>$<a class="p-0 m-0 wallet_balance text-dark">{{$total_balance}}</a></strong></p>
                                </button>
                            </div>
                            <div class="col-lg-12">
                                <div class="collection-single-wized">
                                    <label class="title required bank-withdraw-label" for="block_chain">Block Chain</label>
                                    <select id="block_chain" class="profile-edit-select" name="block_chain">
                                        <option value="">Select A Block Chain</option>
                                        @foreach($block_chains as $block_chain)
                                        <option value="{{ $block_chain->block_chain }}">{{ $block_chain->block_chain }}</option>
                                        @endforeach
                                    </select>
                                    <span class="block-chain-error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3 crypto-address-div">
                                <div class="collection-single-wized">
                                    <label for="crypto-address" class="title required crypto-address-label">Crypto Address</label>
                                    <div class="create-collection-input">
                                        <input id="crypto-address" name="crypto_address" type="text" placeholder="" required>
                                    </div>
                                    <span class="crypto-address-success text-success"></span>
                                    <span class="crypto-address-error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="usd-amount" class="title p-0 m-0 required usd-amount-label">USD Amount</label>
                                    <div class="create-collection-input">
                                        <input id="usd-amount" name="usd_amount" type="text" placeholder="$ 00.0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="crypto-amount" class="title p-0 m-0 required">Crypto Amount</label>
                                    <div class="create-collection-input">
                                        <input id="crypto-amount" name="crypto_amount" type="text" placeholder="0" value="0" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="collection-single-wized">
                                    <label for="transaction-password" class="title p-0 m-0 required">Transaction Password</label>
                                    <div class="create-collection-input">
                                        <input id="transaction-password" name="transaction_password" type="password" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="button-wrapper float-end">
                                    <input type="hidden" name="crypto_name" id="crypto-name" value="">
                                    <button type="button" data-label="Submit Request" id="crypto_withdraw_btn" data-btnid="crypto_withdraw_btn" data-callback="crypto_withdraw_callback" data-loading="<i class='fa-spinner fas fa-circle-notch'></i>" data-form="crypto_withdraw_form" data-el="fg" data-file="true" onclick="_run(this)" class="btn btn-primary-alta btn-large">Confirm</button>
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
    function crypto_withdraw_callback(data) {
        $('#crypto_withdraw_btn').prop('disabled', true);
        if (data.status == true) {
            $('.bank-withdraw-label').css({
                marginTop: '0px',
                marginBottom: '0px'
            });
            $('.wallet_balance').html('<a class="p-0 m-0 wallet_balance text-dark">' + data.update_balance + '</a>');
            notify('success', data.message, 'Crypto Withdraw');
            $('.crypto-address-error').hide();
            $('.crypto-address-success').hide();
            $('#crypto_withdraw_form').trigger('reset');
        }
        if (data.status == false) {
            $('.bank-withdraw-label').css({
                marginTop: '15px',
                marginBottom: '5px'
            });
            $('.crypto-address-label').css({
                marginTop: '15px',
                marginBottom: '-10px'
            });
            notify('error', data.message, 'Crypto Withdraw');
            $.validator("crypto_withdraw_form", data.errors);
        }
        setTimeout(function() {
            $('#crypto_withdraw_btn').prop('disabled', false);
        }, 5000);
    }

    // check crypto address validation
    $(document).on("keyup", "#crypto-address", function() {
        let crypto_address = $(this).val();
        if (crypto_address == "") {
            $('.crypto-address-success').hide();
            $('.crypto-address-error').hide();
            return false;
        }
        // get existing address
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            dataType: 'json',
            method: 'POST',
            url: '/user/finance/crypto_withdraw/crypto_address',
            data: {
                crypto_address: crypto_address
            },
            success: function(data) {
                if (data.status == true) {
                    $('.crypto-address-error').hide();
                    $('.crypto-address-success').show();
                    $('.crypto-address-success').html(data.message);
                    $('#crypto-name').val(data.crypto_name);
                } else {
                    console.log(data.message);
                    $('.crypto-address-success').hide();
                    $('.crypto-address-error').show();
                    $('.crypto-address-error').html(data.message);
                }
            }
        });
    });

    $(document).on("change", "#block_chain", function() {
        $('.block-chain-error').hide();
    });

    // amount convert usd to crypto
    $(document).on("blur keyup", "#usd-amount", function() {
        let usd_amount = $(this).val();
        let crypto_type = $("#block_chain").val();
        let crypto_name = $("#crypto-name").val();
        if (crypto_type == "") {
            $('.block-chain-error').html("Please select a block chain.");
            notify('error', 'Fix the following error!', 'Crypto Deposit');
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/user/finance/crypto_withdraw/usd_to_crypto',
            dataType: 'json',
            method: 'POST',
            data: {
                usd_amount: usd_amount,
                crypto_type: crypto_type,
                crypto_name: crypto_name,
            },
            success: function(data) {
                if (data.status == false) {
                    console.log(data.message);
                } else {
                    $("#crypto-amount").val(data.crypto_amount);
                }
            }
        })
    });
</script>
@endsection