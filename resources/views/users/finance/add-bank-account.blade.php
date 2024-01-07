@extends('layouts.users.user-admin-layout')
@section('title', 'Add Bank')
@section('content')
    <style>
        .nice-select.profile-edit-select {
            width: 100% !important;
            height: 55px;
            padding: 8px 8px 8px 20px;
        }

        .create-collection-input input{
            margin-top: 5px !important;
        }
    </style>
    <div class="rn-nft-mid-wrapper">
        <!-- end page title area -->
        <!-- start Create Collection -->
        <div class="creat-collection-area pt--80">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <aside class="rwt-sidebar">
                            <div class="rbt-single-widget widget_recent_entries mt--40">
                                <h3 class="title">Bank Add Note</h3>
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
                        <form action="{{ route('user.finance.add_bank') }}" method="post" id="bank_add_form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                            <div class="create-collection-form-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <h2 class="m-0">Add Bank</h2>
                                    </div>

                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label for="bank_name" class="title required m-0">Bank Name</label>
                                            <div class="create-collection-input">
                                                <input id="bank_name" name="bank_name" type="text" placeholder="Bank Name" autocomplete="off"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label for="bank_ac_name" class="title required m-0">Bank Account Name</label>
                                            <div class="create-collection-input">
                                                <input id="bank_ac_name" name="bank_ac_name" type="text" placeholder="Bank Account Name" autocomplete="off"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label for="bank_ac_number" class="title required m-0">Bank Account Number</label>
                                            <div class="create-collection-input">
                                                <input id="bank_ac_number" name="bank_ac_number" type="text" placeholder="Account Number" autocomplete="off"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label for="bank_swift_code" class="title required m-0">Bank Swift Code</label>
                                            <div class="create-collection-input">
                                                <input id="bank_swift_code" name="bank_swift_code" type="text"
                                                    placeholder="Swift Code" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label for="bank_iban" class="title required m-0">Bank IBAN</label>
                                            <div class="create-collection-input">
                                                <input id="bank_iban" name="bank_iban" type="text" placeholder="Bnak IBAN"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label for="bank_address" class="title required m-0">Bank Address</label>
                                            <div class="create-collection-input">
                                                <input id="bank_address" name="bank_address" type="text" placeholder="Bank Address"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="collection-single-wized mb-2">
                                            <label class="title required m-0" for="bank-country">Bank Country</label>
                                            <select id="bank_country" class="profile-edit-select" name="bank_country">
                                                <option>Select A Bank</option>
                                                @foreach ($bank_country as $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3">
                                        <div class="button-wrapper float-end">
                                            <button type="button" id="bank_add_btn"
                                                data-btnid="bank_add_btn" data-callback="addBankCallback"
                                                data-loading="<i class='fa-spinner fas fa-circle-notch'></i>"
                                                data-form="bank_add_form" data-el="fg" data-file="true"
                                                onclick="_run(this)"
                                                class="btn btn-primary-alta btn-large">Add Bnak</button>
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

@endsection
@section('custom-js')
    <script>
       function addBankCallback(data) {
        if (data.status == true) {
                $("#bank_add_form").trigger("reset");
                notify('success', data.message, 'Bank Added');
                setTimeout(function() {

                }, 1000 * 2);
            } else {
                notify('error', data.message, 'Bank Added Failed');
                // $.validator("footer_subscribe_form", data.errors);
            }
            $.validator("bank_add_form", data.errors);
       }

    </script>
@endsection
