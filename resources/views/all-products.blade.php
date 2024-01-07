@extends('layouts.users.user-layout')
@section('title', 'All Products')
@section('custom-css') 
<style>
    .page-item.prev.disabled a,
    .page-item.next.disabled a {
        background: transparent !important;
    }

    [data-sal|=slide] {
            opacity: unset;
        } 
</style>
@endsection
@section('content')
@php use App\Services\AllfunctionService;                    
use App\Services\likeOperactionService;
$likeService = new likeOperactionService();
@endphp
<!-- start page title area -->
<div class="rn-breadcrumb-inner ptb--30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h5 class="title text-center text-md-start">All Product</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="/">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">All Product</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end page title area -->

<!-- Start product area -->
<div class="rn-product-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--50 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">All Product</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <button class="discover-filter-button discover-filter-activation btn btn-primary">Filter<i class="feather-filter"></i></button>
                </div>
            </div>
        </div>

        <div class="default-exp-wrapper default-exp-expand">
            <form action="{{ url('explor-product') }}" method="post" id="report-form">
                @csrf
                <div class="inner">
                    <div class="filter-select-option">
                        <label class="filter-leble">Favorite</label>
                        <select name="like">
                            <option value="" data-display="All">All</option>
                            <option value="1">Most Favorite</option>
                            <option value="2">Least Favorite</option>
                        </select>
                    </div>

                    <div class="filter-select-option">
                        <label class="filter-leble">Category</label>
                        <select name="category">
                            <option value="" data-display="All">All</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-select-option">
                        <label class="filter-leble">Collections</label>
                        <select name="collection">
                            <option value="" data-display="All">All</option>
                            <option value="1">BoredApeYachtClub</option>
                            <option value="2">MutantApeYachtClub</option>
                            <option value="4">Art Blocks Factory</option>
                        </select>
                    </div>

                    <div class="filter-select-option">
                        <label class="filter-leble">Sale type</label>
                        <select name="sale_type">
                            <option value="" data-display="Sale type">All</option>
                            <option value="1">Fixed price</option>
                            <option value="2">Timed auction</option>
                            <option value="3">Not for sale</option>
                            <option value="4">Open for offers</option>
                        </select>
                    </div>

                    <div class="filter-select-option">
                        <label class="filter-leble">Price Range</label>
                        <div class="price_filter s-filter clear">
                            <div id="slider-range"></div>
                            <div class="slider__range--output">
                                <div class="price__output--wrap">
                                    <div class="price--output">
                                        <span>Price :</span><input type="text" name="price" id="amount"
                                            readonly>
                                    </div>
                                    <div class="price-filter">
                                        <button type="button" id="ReportBtn" data-file="true"
                                            data-loading="<i class='fas fa-sync-alt fa-spin fa-1x fa-fw'></i>"
                                            data-btnid="ReportBtn" data-form="report-form" data-validator="true"
                                            data-callback="ReportCallback" class="btn btn-primary btn-small"
                                            onclick="resetLimit(); _run(this)"> Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row g-5 filter_report">

            {{-- coming explor data form randomr_explor.blade.php --}}
            <!-- end single product -->
        </div>
 
    </div>
</div>
<!-- end product area -->



<!-- Modal -->
<div class="rn-popup-modal share-modal-wrapper modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content share-wrapper">
            <div class="modal-header share-area">
                <h5 class="modal-title">Share this NFT</h5>
            </div>
            <div class="modal-body">
                <ul class="social-share-default">
                    <li><a href="#"><span class="icon"><i data-feather="facebook"></i></span><span class="text">facebook</span></a></li>
                    <li><a href="#"><span class="icon"><i data-feather="twitter"></i></span><span class="text">twitter</span></a></li>
                    <li><a href="#"><span class="icon"><i data-feather="linkedin"></i></span><span class="text">linkedin</span></a></li>
                    <li><a href="#"><span class="icon"><i data-feather="instagram"></i></span><span class="text">instagram</span></a></li>
                    <li><a href="#"><span class="icon"><i data-feather="youtube"></i></span><span class="text">youtube</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="rn-popup-modal report-modal-wrapper modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content report-content-wrapper">
            <div class="modal-header report-modal-header">
                <h5 class="modal-title">Why are you reporting?
                </h5>
            </div>
            <div class="modal-body">
                <p>Describe why you think this item should be removed from marketplace</p>
                <div class="report-form-box">
                    <h6 class="title">Message</h6>
                    <textarea name="message" placeholder="Write issues"></textarea>
                    <div class="report-button">
                        <button type="button" class="btn btn-primary mr--10 w-auto">Report</button>
                        <button type="button" class="btn btn-primary-alta w-auto" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Add Collection Model --}}
    <div class="rn-popup-modal collection-modal-wrapper modal fade" id="collectionModel" tabindex="-1"
        aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="nuron-expo-filter-widget widget-shortby">
                <div class="inner">
                    <h5 class="widget-title">Select Collection</h5>
                    <div class="content">
                        <form action="" id="select_collection" method="post">
                            @csrf
                            @foreach ($mycollections as $mycollection)
                                <div class="nuron-form-check">
                                    <input type="radio" name="collection_name" id="{{ $mycollection->id }}"
                                        value="{{ $mycollection->id }}">
                                    <label for="{{ $mycollection->id }}">{{ $mycollection->name }}</label>
                                    <input type="hidden" name="asset_id" id="asset_id" value="">
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="report-button mt-5">
                        <button type="submit" id="collection_add_btn"
                            class="btn btn-primary mr--10 w-auto">Save</button>
                        <button type="button" class="btn btn-primary-alta w-auto"
                            data-bs-dismiss="modal">Cancel</button>
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
<script src="{{ asset('js/like-operation.js') }}"></script>
@endsection