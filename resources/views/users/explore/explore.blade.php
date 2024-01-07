@extends('layouts.users.user-layout')
@section('title', 'Explore')
@section('custom-css')

@endsection
@section('content')
    @php
        use App\Services\likeOperactionService;
        use App\Services\AllfunctionService;
        $likeService = new likeOperactionService();
    @endphp

    <!-- start page title area -->
    <div class="rn-breadcrumb-inner ptb--30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <h5 class="title text-center text-md-start">Non Fungible Token</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-list">
                        <li class="item"><a href="/">Home</a></li>
                        <li class="separator"><i class="feather-chevron-right"></i></li>
                        <li class="item current">Non Fungible Token</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title area -->

    <!-- explore section with left side filter start -->
    <div class="explore-area rn-section-gapTop">
        <div class="container">
            <div class="row mb--40">
                <div class="col-12">
                    <h3 class="title">Find Your Non Fungible Token</h3>
                </div>
            </div>
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
                                        @foreach ($category as $item)
                                            <div class="nuron-form-check">
                                                <input type="checkbox" name="cat[]"
                                                    id="cat-check{{ $item->category->id }}"
                                                    value="{{ $item->category->id }}">
                                                <label
                                                    for="cat-check{{ $item->category->id }}">{{ $item->category->category }}
                                                    <span>({{ $item->total }})</span></label>
                                            </div>
                                        @endforeach
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
                    <div class="row g-5" id="list-items">
                        @foreach ($NftAsset as $item)
                            <!-- start single product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="product-style-one no-overlay with-placeBid">
                                    <div class="card-thumbnail">
                                        <a href="{{ url('asset-details/' . $item->id) }}">
                                            <img id="explore_img"
                                                src="{{ asset('/Uploads/nft-assets') . '/' . $item->images[0]->image }}"
                                                alt="NFT_portfolio">
                                        </a>
                                        <a href="{{ url('asset-details/' . $item->id) }}" class="btn btn-primary">Place
                                            Bid</a>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($item->id);
                                            @endphp
                                            @foreach ($get_user as $data)
                                                @if ($data->profile_photo)
                                                    <a href="{{ url('/profile') . '/' . $data->id }}" class="avatar"
                                                        data-tooltip="{{ $data->name }}"><img
                                                            src="{{ asset('Uploads/profile') . '/' . $data->profile_photo }}"
                                                            alt="Nft_Profile"></a>
                                                @else
                                                    <a href="{{ url('/profile') . '/' . $data->id }}" class="avatar"
                                                        data-tooltip="{{ $data->name }}"><img
                                                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                            alt="Nft_Profile"></a>
                                                @endif
                                            @endforeach
                                            <a class="more-author-text"
                                                href="#">{{ AllfunctionService::get_all_bid_counts($item->id) }}
                                                Place Bit.</a>
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
                                                <button type="button" data-id="{{ $item->id }}"
                                                    class="btn-setting-text share-text" data-bs-toggle="modal"
                                                    data-bs-target="#shareModal">
                                                    Share
                                                </button>
                                                @if (Auth::check())
                                                    @if (Auth::user()->id == $item->user->id)
                                                        <button type="button"
                                                            class="btn-setting-text collection-text btn-collection"
                                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#collectionModel">
                                                            Add Collection
                                                        </button> 
                                                        <a class="btn-setting-text collection-text btn-collection"
                                                            href="{{ url('edit/nft/' . $item->id) }}">Edit</a>
                                                    @endif
                                                @else
                                                    <button type="button" class="btn-setting-text report-text"
                                                        data-bs-toggle="modal" data-bs-target="#reportModal">
                                                        Report
                                                    </button>
                                                @endif
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
                        {{ $NftAsset->links('users.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- explore section with left side filter End -->


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
    <script type="text/javascript">
        var form = $('#explore_filter_form');

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
                url: '/explore',
                dataType: "json",
                data: form_data,
                success: function(data) {
                    $("#list-items").html(data);
                }
            });
        })
    </script>

@endsection
