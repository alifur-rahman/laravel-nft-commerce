@extends('layouts.users.user-admin-layout')
@section('title', auth()->user()->name)
@section('content')

@php
    $edit_collection = App\Models\NftCollection::where('id', request()->id)->first();
@endphp
<!-- start Create Collection -->
<div class="rn-nft-mid-wrapper">
    <div class="list-item-1">
        <form action="{{ url('mycollection/edit/') }}" method="post" id="edit_collection_form">
            @csrf
            <input type="hidden" name="collection_id" id="collection_id" value="{{ request()->id }}">
            <div class="row g-5 ">
                <div class="col-lg-3 offset-1 ml_md--0 ml_sm--0">
                    <div class="collection-single-wized banner">
                        <label class="title required">Logo image</label>
                        <div class="create-collection-input logo-image">
                            <div class="logo-c-image logo">
                                <img id="rbtinput1" src="{{ asset('Uploads/profile/' . $edit_collection->profile_photo) }}" alt="Profile-NFT">
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
                                <img id="rbtinput2" src="{{ asset('Uploads/cover/' . $edit_collection->cover_photo) }}" alt="Profile-NFT">
                                <label for="nipa" title="No File Choosen">
                                    <span class="text-center color-white"><i class="feather-edit"></i></span>
                                </label>
                            </div>
                            <div class="button-area">
                                <div class="brows-file-wrapper">
                                    <!-- actual upload which is hidden -->
                                    <input name="cover_photo" id="nipa" type="file" value="{{ $edit_collection->cover_photo }}">
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
                                        <input name="name" id="name" class="name" type="text" value="{{ $edit_collection->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="collection-single-wized">
                                    <label for="description" class="title">Description</label>
                                    <div class="create-collection-input">
                                        <textarea id="description" name="description" class="text-area">{{ $edit_collection->details }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="button-wrapper">

                                    {{-- <button type="button" id="InputtBtn" data-file="true" data-loading="<i class='fas fa-sync-alt fa-spin fa-1x fa-fw'></i>" data-btnid="InputtBtn" data-form="input-form" data-validator="true" data-callback="InputCallback" class="btn btn-primary-alta btn-large" onclick=" _run(this)"> Save</button> --}}

                                    <button type="button" id="edit_collection_btn" data-file="true" data-loading="<i class='fas fa-sync-alt fa-spin fa-1x fa-fw'></i>" data-btnid="edit_collection_btn" data-form="edit_collection_form" data-validator="true" data-callback="editCollectionCallback" class="btn btn-primary-alta btn-large" onclick=" _run(this)"> Save</button>

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
    function editCollectionCallback(data) {
        if (data.success == true) {
            notify('success', data.message, 'Update Collection Success!');
            window.location.href = "{{ route('my.collection')}}";

        } else {
            notify('error', data.message, 'Update Collection Error!');
            $.validator("edit_collection_form", data.errors);
        }
    }
</script>
@endsection
