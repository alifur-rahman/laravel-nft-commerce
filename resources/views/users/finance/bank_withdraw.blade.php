@extends('layouts.users.user-admin-layout')
@section('title', 'User Bank Withdraw')
@section('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('content')
    <style>
        .nice-select.profile-edit-select {
            width: 100% !important;
            height: 55px;
            padding: 8px 8px 8px 20px;
        }

        /* select2 custom css */
        select#bank_ac_number {
            height: 55px;
            padding-left: 16px;
        }
    </style>
    <!-- start page title area -->
    <div class="rn-nft-mid-wrapper">
        <!-- end page title area -->
        <!-- start Create Collection -->
        <div class="creat-collection-area pt--80">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <aside class="rwt-sidebar">
                            <div class="rbt-single-widget widget_recent_entries mt--40">
                                <h3 class="title">Bank Withdraw Note</h3>
                                <div class="inner">
                                    <ul>
                                        <li><a class="d-block" href="#">&#10020; Account verification is required for
                                                Local Withdraw.</a></li>
                                        <li><a class="d-block" href="#">&#10020; Bank Withdraw takes a minimum of 6
                                                hours to 72 working hours to process.</a></li>
                                        <li><a class="d-block" href="#">&#10020; Fill in all important information
                                                correctly.</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <div class="col-lg-7">
                        <form action="{{ route('user.finance.bank_withdraw.add') }}" enctype="multipart/form-data"
                            method="post" id="bank_withdraw_form">
                            @csrf
                            <div class="create-collection-form-wrapper">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-warning text-dark w-auto d-flex m-auto">
                                            <p class="text-dark">Balance : <strong>$<a
                                                        class="p-0 m-0 wallet_balance text-dark">{{ $total_balance }}</a></strong>
                                            </p>
                                        </button>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label class="title required" for="bank-name">Bank Name</label>
                                            <select id="bank-name" class="profile-edit-select" name="bank_name">
                                                <option>Select A Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label class="title required" for="bank_ac_number">Bank Account Number</label>
                                            <select class="nice-select profile-edit-select" id="bank_ac_number"
                                                name="bank_ac_number">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="bank_acc_name" class="title required">Bank Account Name</label>
                                            <div class="create-collection-input">
                                                <input id="bank_acc_name" name="bank_acc_name" type="text" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="bank_swift_code" class="title required">Bank Swift Code</label>
                                            <div class="create-collection-input">
                                                <input id="bank_swift_code" name="bank_swift_code" type="text"
                                                    placeholder="" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="bank_iban" class="title required">Bank IBAN</label>
                                            <div class="create-collection-input">
                                                <input id="bank_iban" name="bank_iban" type="text" placeholder=""
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="bank_address" class="title required">Bank Address</label>
                                            <div class="create-collection-input">
                                                <input id="bank_address" name="bank_address" type="text" placeholder=""
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="bank_country" class="title required">Bank Country</label>
                                            <div class="create-collection-input">
                                                <input id="bank_country" name="bank_country" type="text" placeholder=""
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="usd_amount" class="title required">Amount</label>
                                            <div class="create-collection-input">
                                                <input id="usd_amount" name="usd_amount" type="text"
                                                    placeholder="$ 00.0" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized">
                                            <label for="transaction_password" class="title required">Transaction
                                                Password</label>
                                            <div class="create-collection-input">
                                                <input id="transaction_password" name="transaction_password"
                                                    type="password" placeholder="......." autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="button-wrapper float-end">
                                            <input type="hidden" name="bank_account_id" id="bank_account_id"
                                                value="">
                                            <button type="button" data-label="Submit Request" id="bank_withdraw_btn"
                                                data-btnid="bank_withdraw_btn" data-callback="bank_withdraw_callback"
                                                data-loading="<i class='fa-spinner fas fa-circle-notch'></i>"
                                                data-form="bank_withdraw_form" data-el="fg" data-file="true"
                                                onclick="_run(this)"
                                                class="btn btn-primary-alta btn-large">Confirm</button>
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
@section('vendor-js')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/user/auth/vendors/js/forms/select/select2.full.min.js') }}">
@endsection
@section('custom-js')
    <script>
        // save persional form
        function bank_withdraw_callback(data) {
            $('#bank_withdraw_btn').prop('disabled', true);
            console.log(data);
            if (data.status == true) {
                notify('success', data.message, 'Bank Withdraw');
                $('#bank_withdraw_form').trigger('reset');
            }
            if (data.status == false) {
                notify('error', data.message, 'Bank Withdraw');
                $.validator("bank_withdraw_form", data.errors);
            }
            setTimeout(function() {
                $('#bank_withdraw_btn').prop('disabled', false);
            }, 5000);
        }

        // find bank account number by bank name
        $(document).on("change", "#bank-name", function() {
            let bank_name = $(this).val();
            // get existing address
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                dataType: 'json',
                method: 'POST',
                url: '/user/finance/bank_withdraw/bank_name',
                data: {
                    bank_name: bank_name
                },
                success: function(data) {
                    $('#bank_ac_number').html(data.option);
                    $("#bank_ac_number").niceSelect('update');
                }
            });
        });

        // find bank account details by bank account number
        $(document).on("change", "#bank_ac_number", function() {
            let bank_ac_number = $(this).val();
            // get existing address
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                dataType: 'json',
                method: 'POST',
                url: '/user/finance/bank_withdraw/bank_ac_number',
                data: {
                    bank_ac_number: bank_ac_number
                },
                success: function(data) {
                    $('#bank_account_id').val(data.bank_account_id);
                    $('#bank_name').val(data.bank_name);
                    $('#bank_acc_name').val(data.bank_acc_name);
                    $('#bank_swift_code').val(data.bank_swift_code);
                    $('#bank_iban').val(data.bank_iban);
                    $('#bank_address').val(data.bank_address);
                    $('#bank_country').val(data.bank_country);
                }
            });
        });
    </script>
@endsection
