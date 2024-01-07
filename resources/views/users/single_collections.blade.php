@extends('layouts.users.user-layout')
@section('title','User Profile')
@section('custom-css')
<style>

    [liked~="1"] {
        color: var(--color-white);
        background-color: var(--color-primary);
    }
    #list-items .data_not_found {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .clipboard-con-w {
    	padding: top;
    	padding-top: 0 !important;
    	padding-bottom: 0 !important;
    	padding-top: 15px !important;
    }
</style>
@stop
@section('content')
@php
$items = json_decode($nft_collection->item); 
use App\Services\AllfunctionService; 
use App\Services\likeOperactionService;
$likeService = new likeOperactionService();
@endphp 

<div class="rn-author-bg-area bg_image ptb--150" style="background-image: url('{{ AllfunctionService::collection_thumbnail($nft_collection->id) }}');">
    <div class="container">
        <div class="row">
        </div>
    </div>
</div>

<div class="rn-author-area mb--30 mt_dec--120">
    <div class="container">
        <div class="row padding-tb-50 align-items-center d-flex">
            <div class="col-lg-12">
                <div class="author-wrapper">
                    <div class="author-inner">
                        <div class="user-thumbnail">
                            <img class="collection-profile-in-view" src="{{ AllfunctionService::collection_profile($nft_collection->id) }}" alt="{{ $nft_collection->name }}">
                        </div>
                        <div class="rn-author-info-content">
                            <input type="hidden" name="" id="collection_name" value="{{ $nft_collection->name }}">
                            <input type="hidden" name="" id="collection_id" value="{{ $nft_collection->id }}">
                            <h4 class="title">{{ $nft_collection->name }}</h4>
                            <div class="follow-area">
                                <div class="follow followers">
                                    <span><a href="#" class="color-body">Created By </a> {{$nft_collection->user->name}}</span>
                                </div>
                            </div>

                            <div class="follow-area">
                                <div class="follow followers">
                                    {{-- <span><a href="#" class="color-body">Items</a> {{count($items)}}</span>  --}}
                                </div>
                                <div class="follow following">
                                    <span>  <a href="#" class="color-body">Created</a> {{date_format($nft_collection->created_at,"M Y");}}</span>
                                </div>
                            </div>
                            <div class="author-button-area">
                                @if(auth()->check() && auth()->user()->id==$nft_collection->user_id)
                                <span class="btn at-follw follow-button clipboard-con-w"><i class="fas  fa-clipboard-list" style="font-size:8px"></i></span>
                                @else
                                <span class="btn at-follw follow-button"><i data-feather="user-plus"></i> Follow</span>
                                @endif
                                <span class="btn at-follw share-button" data-bs-toggle="modal" data-bs-target="#shareModal"><i data-feather="share-2"></i></span>
                                <div class="count at-follw">
                                    <div class="share-btn share-btn-activation dropdown">
                                        <button class="icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                                            </svg>
                                        </button>

                                        <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                            @if(auth()->check() AND auth()->user()->id==$nft_collection->user_id)
                                            <a href="{{route('nft.create')}}" class="btn-setting-text report-text d-block">
                                                Add item
                                            </a>
                                            <a href="button" class="btn-setting-text report-text d-block">
                                                Creator earning
                                            </a>
                                            @else
                                                <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                                                Report
                                                </button>
                                                <button type="button" class="btn-setting-text report-text">
                                                    Claim Owenership
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(auth()->check() && auth()->user()->id==$nft_collection->user_id)
                                <a href="{{route('user.edit-collection',['id'=>$nft_collection->id])}}" class="btn at-follw follow-button edit-btn"><i data-feather="edit"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="explore-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="nu-course-sidebar">
                    <form id="explore_filter_form" action="" method="POST">
                        @csrf
                        <!-- Start Widget Wrapper  -->
                        <div class="nuron-expo-filter-widget widget-shortby">
                            <div class="inner">
                                <h5 class="widget-title">Sort By</h5>
                                <div class="content">
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="newest" id="short-check1">
                                        <label for="short-check1">Newest</label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="oldest" id="short-check2">
                                        <label for="short-check2">Oldest</label>
                                    </div>
                                    {{-- <div class="nuron-form-check">
                                        <input type="checkbox" name="populer" id="short-check3">
                                        <label for="short-check3">Popular NFT</label>
                                    </div> --}}
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="this_month" id="short-check4">
                                        <label for="short-check4">Featured On This Month</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Widget Wrapper  -->

                        <!-- Start Widget Wrapper  -->
                        <div class="nuron-expo-filter-widget widget-category mt--30">
                            <div class="inner">
                                <h5 class="widget-title">Categories</h5>
                                <div class="content"> 
                                    @if (isset($not_found))
                                        {{'Category Not Found'}}
                                    @else
                                        @foreach ($category as $item)
                                            <div class="nuron-form-check">
                                                <input type="checkbox" name="cat[]"
                                                    id="cat-check{{ $item->category->id }}" value="{{ $item->category->id }}">
                                                <label
                                                    for="cat-check{{ $item->category->id }}">{{ $item->category->category }}
                                                    <span>({{ $item->total }})</span></label>
                                            </div>
                                        @endforeach
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <!-- End Widget Wrapper  -->

                        <!-- Start Widget Wrapper  -->
                        <div class="nuron-expo-filter-widget widget-shortby mt--30">
                            <div class="inner">
                                <h5 class="widget-title">Price</h5>
                                <div class="content">
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="all_price" id="price-check1">
                                        <label for="price-check1">All Prices</label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="low_to_high" id="price-check2">
                                        <label for="price-check2">Price: Low to High</label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="high_to_low" id="price-check3">
                                        <label for="price-check3">Price: High to Low</label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="free_paid" id="price-check4">
                                        <label for="price-check4">Free Paid</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Widget Wrapper  -->

                        <!-- Start Widget Wrapper  -->
                        <div class="nuron-expo-filter-widget widget-shortby mt--30">
                            <div class="inner">
                                <h5 class="widget-title">Short By Rating</h5>
                                <div class="content">
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="star_5" id="rating-check1">
                                        <label for="rating-check1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="star_4" id="rating-check2">
                                        <label for="rating-check2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="star_3" id="rating-check3">
                                        <label for="rating-check3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="star_2" id="rating-check4">
                                        <label for="rating-check4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>

                                    <div class="nuron-form-check">
                                        <input type="checkbox" name="star_1" id="rating-check5">
                                        <label for="rating-check5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star-fill off" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Widget Wrapper  -->

                        <!-- Start Widget Wrapper  -->
                        <div class="nuron-expo-filter-widget widget-shortby mt--30">
                            <div class="inner">
                                <h5 class="widget-title">Filter By Price</h5>
                                <div class="content">
                                    <div class="price_filter s-filter clear">

                                            <div id="slider-range"
                                                class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div><span
                                                    class="ui-slider-handle ui-state-default ui-corner-all"
                                                    tabindex="0"></span><span
                                                    class="ui-slider-handle ui-state-default ui-corner-all"
                                                    tabindex="0"></span>
                                            </div>
                                            <div class="slider__range--output">
                                                <div class="price__output--wrap">
                                                    <div class="price--output">
                                                        <span>Price :</span><input type="text" id="amount"
                                                            readonly="" name="amount">
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Widget Wrapper  -->
                        {{-- <button type="submit" id="filter_submit">filter</button> --}}
                    </form>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row g-5" id="list-items" @if (isset($not_found)) style="height: 100%;" @endif>
                      
                    @if (isset($not_found))
                        <p class="data_not_found">{{'Data Not Found'}}</p>
                    @else
                        @foreach ($NftAsset as $item)
                        <!-- start single product -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="product-style-one no-overlay with-placeBid">
                                <div class="card-thumbnail">
                                    <a href="{{ url('asset-details/' . $item->id) }}">
                                        <img id="explore_img"
                                            src="{{ asset('/Uploads/nft-assets') . '/'.$item->images[0]->image }}"
                                            alt="NFT_portfolio">
                                    </a>
                                    <a href="{{ url('asset-details/' . $item->id) }}" class="btn btn-primary">Place Bid</a>
                                </div>
                                <div class="product-share-wrapper">
                                    <div class="profile-share">
                                        @php 
                                            $get_user = AllfunctionService::get_all_bid_users_image($item->id); 
                                        @endphp
                                        @foreach ($get_user as $data) 
                                            @if ($data->profile_photo)
                                                <a href="{{url('/profile').'/'.$data->id}}" class="avatar" data-tooltip="{{$data->name}}"><img
                                                src="{{ asset('Uploads/profile').'/'.$data->profile_photo }}"
                                                alt="Nft_Profile"></a>
                                            @else
                                                <a href="{{url('/profile').'/'.$data->id}}" class="avatar" data-tooltip="{{$data->name}}"><img
                                                src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                alt="Nft_Profile"></a>
                                            @endif 
                                        @endforeach 
                                        <a class="more-author-text" href="#">{{AllfunctionService::get_all_bid_counts($item->id)}} Place Bit.</a>
                                    </div>
                                    <div class="share-btn share-btn-activation dropdown">
                                        <button class="icon" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </button>

                                        <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                            <button type="button" class="btn-setting-text share-text"
                                                data-bs-toggle="modal" data-bs-target="#shareModal">
                                                Share
                                            </button>
                                            <button type="button" class="btn-setting-text report-text"
                                                data-bs-toggle="modal" data-bs-target="#reportModal">
                                                Report
                                            </button>
                                        </div>

                                    </div>
                                </div> 

                                <a href="{{ url('asset-details/' . $item->id) }}"><span id="explore_product_name"
                                        class="product-name">{{ $item->name }}</span></a>
                                <span class="latest-bid">Highest bid 1/20</span>
                                <div class="bid-react-area">
                                    <div class="last-bid" id="base_price">{{ $item->base_price }} wETH</div>
                                    <div class="react-area" {{ $likeService->is_liked($item->id) }}>
                                        <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                            class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                            <path
                                                d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                        <span class="number">{{ $likeService->like_count($item->id) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end single product -->
                    @endforeach
                    {{$NftAsset->links("users.pagination")}}
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>


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

@endsection
@section('custom-js')
<script src="{{ asset('js/like-operation.js') }}"></script>
    <script src="{{ asset('js/like-operation.js') }}"></script>


    <script type="text/javascript">
        var form = $('#explore_filter_form');
        var collection_id = $('#collection_id').val();
        var collection_name = $('#collection_name').val();

        $("input[type=checkbox]").on('change', function() {
            form.trigger('submit');
        });

        $(document).on('submit', '#explore_filter_form', function(event) {
            var form_data = $(this).serializeArray();

            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "/collection/view/"+collection_name+"/"+collection_id+"",
                dataType: "json",
                data: form_data,
                success: function(data) {
                    console.log(data);
                    $("#list-items").html(data);
                }
            });
        })
    </script>
@endsection
