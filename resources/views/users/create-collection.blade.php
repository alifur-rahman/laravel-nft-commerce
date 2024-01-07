@extends('layouts.users.user-admin-layout')
@section('title', auth()->user()->name)
@section('content')
    <!-- start Create Collection -->
    <div class="rn-nft-mid-wrapper">
        <div class="list-item-1">
            <form action="{{ url('collection/create') }}" method="post" id="input-form">
                @csrf
                <div class="row g-5 ">
                    <div class="col-lg-3 offset-1 ml_md--0 ml_sm--0">
                        <div class="collection-single-wized banner">
                            <label class="title required">Logo image</label>

                            <div class="create-collection-input logo-image">
                                <div class="logo-c-image logo">
                                    <img id="rbtinput1" src="{{ asset('Uploads/profile/profile-01.png') }}"
                                        alt="Profile-NFT">
                                    <label for="fatima" title="No File Choosen">
                                        <span class="text-center color-white"><i class="feather-edit"></i></span>
                                    </label>
                                </div>
                                <div class="button-area">
                                    <div class="brows-file-wrapper">
                                        <!-- actual upload which is hidden -->
                                        <input name="profile_photo" id="fatima" type="file">
                                        <!-- our custom upload button -->

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="collection-single-wized banner">
                            <label class="title">Cover Image</label>
                            <div class="create-collection-input feature-image">
                                <div class="logo-c-image feature">
                                    <img id="rbtinput2" src="{{ asset('Uploads/profile/cover-04.png') }}" alt="Profile-NFT">
                                    <label for="nipa" title="No File Choosen">
                                        <span class="text-center color-white"><i class="feather-edit"></i></span>
                                    </label>
                                </div>
                                <div class="button-area">
                                    <div class="brows-file-wrapper">
                                        <!-- actual upload which is hidden -->
                                        <input name="cover_photo" id="nipa" type="file">
                                        <!-- our custom upload button -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-7">
                        <div class="create-collection-form-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="collection-single-wized">
                                        <label for="name" class="title required">Name</label>
                                        <div class="create-collection-input">
                                            <input name="name" id="name" class="name" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="collection-single-wized">
                                        <label for="description" class="title">Description</label>
                                        <div class="create-collection-input">
                                            <textarea id="description" name="description" class="text-area"></textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="collection-single-wized">
                                        <label for="earning" class="title">Creator Earnings</label>
                                        <div class="create-collection-input">
                                            <input id="earning" class="url" type="text">
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="collection-single-wized">
                                        <label for="wallet" class="title">Your payout wallet address</label>
                                        <div class="create-collection-input">
                                            <input id="wallet" class="url" type="text">
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-12">
                                    <div class="nuron-information mb--30">
                                        <div class="single-notice-setting">
                                            <div class="input">
                                                <input type="checkbox" id="themeSwitch" name="theme-switch"
                                                    class="theme-switch__input">
                                                <label for="themeSwitch" class="theme-switch__label">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="content-text">
                                                <p>Explicit & sensitive content</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="button-wrapper">
                                        <!-- <a href="#" class="btn btn-primary btn-large mr--30" data-bs-toggle="modal" data-bs-target="#collectionModal">Preview</a> -->

                                        <button type="button" id="InputtBtn" data-file="true"
                                                data-loading="<i class='fas fa-sync-alt fa-spin fa-1x fa-fw'></i>"
                                                data-btnid="InputtBtn" data-form="input-form" data-validator="true"
                                                data-callback="InputCallback" class="btn btn-primary-alta btn-large"
                                                onclick=" _run(this)"> Create</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Create Collection -->


    <!-- Modal -->
    {{-- <div class="rn-popup-modal upload-modal-wrapper modal fade" id="collectionModal" tabindex="-1" aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content share-wrapper">
                <div class="modal-body">
                    <a href="product-details.html" class="rn-collection-inner-one">
                        <div class="collection-wrapper">
                            <div class="collection-big-thumbnail">
                                <img src="assets/images/collection/collection-lg-01.jpg" alt="Nft_Profile">
                            </div>
                            <div class="collenction-small-thumbnail">
                                <img src="assets/images/collection/collection-sm-01.jpg" alt="Nft_Profile">
                                <img src="assets/images/collection/collection-sm-02.jpg" alt="Nft_Profile">
                                <img src="assets/images/collection/collection-sm-03.jpg" alt="Nft_Profile">
                            </div>
                            <div class="collection-profile">
                                <img src="assets/images/client/client-15.png" alt="Nft_Profile">
                            </div>
                            <div class="collection-deg">
                                <h6 class="title">Cubic Trad</h6>
                                <span class="items">27 Items</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection


@section('custom-js')
<script src="{{ asset('assets/user/auth/js/scripts/pages/common-ajax.js') }}"></script>
    <script>
       function InputCallback(data){
            if (data.success == true) {
                notify('success', data.message, 'Create Collection Success!');
                $("#rbtinput1").attr("src", "{{ asset('Uploads/profile/profile-01.png') }}");
                $("#rbtinput2").attr("src", "{{ asset('Uploads/profile/cover-04.png') }}");
                $("#input-form").trigger("reset");
            } else {
                notify('error', data.message,'Create Collection Error!');
                $.validator("input-form", data.errors);
            }
       }
    </script>
@endsection
