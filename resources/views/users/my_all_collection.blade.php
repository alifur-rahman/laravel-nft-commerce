@extends('layouts.users.user-admin-layout')
@section('title', 'My Collections')

@section('custom-css')
<style>
    [data-sal|=slide] {
        opacity: unset;
    }
</style>
@endsection
@section('content')
@php
use App\Services\AllfunctionService;
use App\Services\likeOperactionService;
$likeService = new likeOperactionService();
@endphp


<div class="rn-nft-mid-wrapper">
    <!-- live Bidding area start -->
    <div class="rn-live-bidding-area ptb--70" id="list-item-2">
        <div class="container">
            <div class="row mb--30 align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">My Collections</h3>
                </div>
            </div>
            <div class="row g-5">
                <!-- start single product -->
                @foreach ($collections as $collection)
                <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="rn-collection-inner-one">
                        <div class="collection-wrapper">
                            <a class="collection-big-thumbnail" href="{{ url('collection/view/' . $collection->name . '/' . $collection->id) }}">
                                <img class="thumb-img" src="{{ AllfunctionService::collection_thumbnail($collection->id) }}" alt="Nft_Profile">
                            </a>
                            <a href="{{ url('collection/view/' . $collection->name . '/' . $collection->id) }}" class="collenction-small-thumbnail">

                                @php
                                $items = json_decode($collection->item);
                                @endphp
                                @if ($items != null)
                                @foreach ($items as $key => $item)
                                @if ($key <= 2) @php $asset=App\Models\NftAsset::find($item); @endphp <img src="{{ asset('Uploads/nft-assets/' . $asset->images[0]->image) }}" alt="nft asset">
                                    @endif
                                    @endforeach
                                    @endif
                            </a>
                            <div class="collection-profile">
                                <img src="{{ AllfunctionService::collection_profile($collection->id) }}" alt="Nft_Profile">
                            </div>
                            <div class="collection-deg">
                                <h6 class="title">{{ $collection->name }}</h6>
                                <span href="" class="items">
                                    <!-- {{ $items != null ? count(json_decode($collection->item)) : '0' }} -->
                                    <a href="{{route('user.edit-collection',['id'=>$collection->id])}}">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end single product -->
            </div>
        </div>
    </div>
    <!-- live Bidding area End -->



</div>

<div class="rn-popup-modal collection-modal-wrapper modal fade" id="collectionModel" tabindex="-1" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="nuron-expo-filter-widget widget-shortby">
            <div class="inner">
                <h5 class="widget-title">Select Collection</h5>
                <div class="content">
                    <form action="" id="select_collection" method="post">
                        @csrf
                        @foreach ($mycollections as $mycollection)
                        <div class="nuron-form-check">
                            <input type="radio" name="collection_name" id="{{ $mycollection->id }}" value="{{ $mycollection->id }}">
                            <label for="{{ $mycollection->id }}">{{ $mycollection->name }}</label>
                            <input type="hidden" name="asset_id" id="asset_id" value="">
                        </div>
                        @endforeach
                    </form>
                </div>
                <div class="report-button mt-5">
                    <button type="submit" id="collection_add_btn" class="btn btn-primary mr--10 w-auto">Save</button>
                    <button type="button" class="btn btn-primary-alta w-auto" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('assets/user/auth/js/scripts/pages/common-ajax.js') }}"></script>
<script src="{{ asset('assets/user/js/custom-filter.js') }}"></script>
<script src="{{ asset('assets/user/js/addCollection.js') }}"></script>
@endsection