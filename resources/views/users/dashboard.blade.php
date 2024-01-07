@extends('layouts.users.user-admin-layout')
@section('title', auth()->user()->name)

@section('custom-css')
    <style>
        [data-sal|=slide] {
            opacity: unset;
        }

        .bg_image--15 {
            /* background-image: url({{ asset('Uploads/profile/' . $banner->cover_photo) }}); */
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
        <div id="list-item-1">
            <!-- banner area start -->
            <div class="rn-banner-area">
                <div class="slider-style-7 bg_image--15 bg_image" data-black-overlay="8">
                    <div class="rn-banner-wrapper row">
                        <div class="col-xl-5 col-lg-12 col-12 order-3 order-xl-1">
                            <div class="item-description">
                                <p>
                                    The term fungible means something that can be replaced by something similar. So, by
                                    the
                                    name Non Fungible Tokens, we can easily understand.
                                </p>
                                <div class="product-share-wrapper">
                                    <div class="profile-share">
                                        @php
                                            $get_user = AllfunctionService::get_a_user_bid_image(auth()->user()->id);
                                        @endphp
                                        @foreach ($get_user as $item)
                                            <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                data-tooltip="{{ $item->name }}"><img
                                                    src="{{ AllfunctionService::userPhoto($item->bidder_id) }}"
                                                    alt="Nft_Profile"></a>
                                        @endforeach
                                        <a class="more-author-text" href="#">
                                            {{ AllfunctionService::get_a_user_total_bid(auth()->user()->id) }} Place
                                            Bit.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-12 order-2 order-xl-2">
                            <h2 class="title">
                                Discover <br> Rare Product & collect <span>NFT's</span>
                            </h2>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-12 order-1 order-xl-3">
                            <div class="img-thumb-award">
                                <img src="assets/images/logo/award-logo.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner area end -->
        </div>

        <!-- live Bidding area start -->
        <div class="rn-live-bidding-area ptb--70" id="list-item-2">
            @if (!empty($live_bids))
                <div class="container">
                    <div class="row mb--30 align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Live
                                Bidding</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                            <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up"
                                data-sal-duration="800">
                                <a class="btn-transparent" href="{{ url('/mylivebid') }}">VIEW ALL<i
                                        data-feather="arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5">
                        <!-- start single product -->
                        @foreach ($live_bids as $live_bid)
                            <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-12">
                                <div class="product-style-one">
                                    <div class="card-thumbnail">
                                        <a href="{{ url('asset-details/' . $live_bid->id) }}"><img
                                                src="{{ asset('Uploads/nft-assets/' . $live_bid->images[0]->image) }}"
                                                alt="NFT_portfolio"></a>
                                        <div class="countdown" data-date="{{ $live_bid->bit_time }}">
                                            <div class="countdown-container days">
                                                <span class="countdown-value"> </span>
                                                <span class="countdown-heading">D's</span>
                                            </div>
                                            <div class="countdown-container hours">
                                                <span class="countdown-value"> </span>
                                                <span class="countdown-heading">H's</span>
                                            </div>
                                            <div class="countdown-container minutes">
                                                <span class="countdown-value"> </span>
                                                <span class="countdown-heading">Min's</span>
                                            </div>
                                            <div class="countdown-container seconds">
                                                <span class="countdown-value">27</span>
                                                <span class="countdown-heading">Sec</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($live_bid->id);
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
                                                href="#">{{ AllfunctionService::get_all_bid_counts($live_bid->id) }}
                                                Place
                                                Bit.</a>
                                        </div>
                                        <div class="share-btn share-btn-activation dropdown">
                                            <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                                    class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </button>

                                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                                <button type="button" data-id="{{ $live_bid->id }}"
                                                    class="btn-setting-text share-text" data-bs-toggle="modal"
                                                    data-bs-target="#shareModal">
                                                    Share
                                                </button>
                                                @if (Auth::check())
                                                    @if (Auth::user()->id == $live_bid->user->id)
                                                        <button type="button"
                                                            class="btn-setting-text collection-text btn-collection"
                                                            data-id="{{ $live_bid->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#collectionModel">
                                                            Add Collection
                                                        </button>

                                                        <a class="btn-setting-text collection-text btn-collection"
                                                            href="{{ url('edit/nft/' . $live_bid->id) }}">Edit</a>
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
                                    <a href="product-details.html"><span
                                            class="product-name">{{ $live_bid->name }}</span></a>
                                    <span class="latest-bid">Highest bid 1/20</span>
                                    <div class="bid-react-area">
                                        <div class="last-bid">{{ $live_bid->base_price }}wETH</div>
                                        <div class="react-area" {{ $likeService->is_liked($live_bid->id) }}>
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <span class="number">{{ $likeService->like_count($live_bid->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- end single product -->
                    </div>
                </div>
            @endif
        </div>
        <!-- live Bidding area End -->

        <!-- collection area Start -->
        <div class="rn-collection-area rn-section-gapBottom">
            @if (!empty($collections))
                <div class="container">
                    <div class="row mb--30 align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">My
                                Collection</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                            <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up"
                                data-sal-duration="800">
                                <a class="btn-transparent" href="{{ url('mycollection/') }}">VIEW ALL<i
                                        data-feather="arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5">
                        <!-- start single collention -->
                        @foreach ($collections as $collection)
                            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
                                class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                                <a href="{{ url('collection/view/' . $collection->name . '/' . $collection->id) }}"
                                    class="rn-collection-inner-one">
                                    <div class="collection-wrapper">
                                        <div class="collection-big-thumbnail">
                                            <img class="thumb-img" src="{{ asset('Uploads/cover/' . $collection->cover_photo) }}"
                                                alt="Nft_Profile">
                                        </div>
                                        <div class="collenction-small-thumbnail">

                                            @php
                                                $items = json_decode($collection->item);
                                            @endphp
                                            @if ($items != null)
                                                @foreach ($items as $key => $item)
                                                    @if ($key <= 2)
                                                        @php
                                                            $asset = App\Models\NftAsset::find($item);
                                                        @endphp

                                                        <img class="asset-img" src="{{ asset('Uploads/nft-assets/' . $asset->images[0]->image) }}"
                                                            alt="Nft_Profile">
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="collection-profile">
                                            <img src="{{ asset('Uploads/profile/' . $collection->profile_photo) }}"
                                                alt="Nft_Profile">
                                        </div>
                                        <div class="collection-deg">
                                            <h6 class="title">{{ $collection->name }}</h6>
                                            <span
                                                class="items">{{ $items != null ? count(json_decode($collection->item)) : '0' }}
                                                Items</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <!-- End single collention -->
                    </div>
                </div>
            @endif
        </div>
        <!-- collection area End -->


        <!-- start service area -->
        <div class="rn-service-area pb--70" id="list-item-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb--30">
                        <h3 class="title">Make Easyer</h3>
                    </div>
                </div>
                <div class="row g-5">
                    <!-- start single service -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
                            class="rn-service-one color-shape-7">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('Uploads//icons/shape-7.png') }}" alt="Shape">
                                </div>
                                <div class="subtitle">Step-01</div>
                                <div class="content">
                                    <h4 class="title">
                                        <a href="{{ route('connect-to-wallet') }}">Set up your wallet</a>
                                    </h4>
                                    <p class="description">Powerful features and inclusions, which makes Nuron standout,
                                        easily customizable and scalable.</p>
                                    <a class="read-more-button" href="{{ route('connect-to-wallet') }}">
                                        <i class="feather-arrow-right"></i></a>
                                </div>
                                <a class="over-link" href="#"></a>
                            </div>
                            <a class="over-link" href="{{ route('connect-to-wallet') }}"></a>
                        </div>
                    </div>
                    <!-- End single service -->
                    <!-- start single service -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div data-sal="slide-up" data-sal-delay="200" data-sal-duration="800"
                            class="rn-service-one color-shape-1">
                            <a href="{{ url('/collection/create') }}">
                                <div class="inner">
                                    <div class="icon">
                                        <img src="{{ asset('Uploads//icons/shape-1.png') }}" alt="Shape">
                                    </div>
                                    <div class="subtitle">Step-02</div>
                                    <div class="content">
                                        <h4 class="title"><a href="#">Create your collection</a></h4>
                                        <p class="description">A great collection of beautiful website templates for your
                                            need.
                                            Choose the best suitable template.</p>
                                        <a class="read-more-button" href="#"><i
                                                class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </a>
                            <a class="over-link" href="{{ route('asset.collections.create') }}"></a>
                        </div>
                    </div>
                    <!-- End single service -->

                    <!-- start single service -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div data-sal="slide-up" data-sal-delay="250" data-sal-duration="800"
                            class="rn-service-one color-shape-5">
                            <a href="{{ asset('/user/create') }}">
                                <div class="inner">
                                    <div class="icon">
                                        <img src="{{ asset('Uploads/icons/shape-5.png') }}" alt="Shape">
                                    </div>
                                    <div class="subtitle">Step-03</div>
                                    <div class="content">
                                        <h4 class="title"><a href="#">Add your NFT's</a></h4>
                                        <p class="description">We've made the template fully responsive, so it looks great
                                            on
                                            all devices: desktop, tablets and.</p>
                                        <a class="read-more-button" href="#"><i
                                                class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </a>
                            <a class="over-link" href="{{ asset('/user/create') }}"></a>
                        </div>
                    </div>
                    <!-- End single service -->
                </div>
            </div>
        </div>
        <!-- End service area -->

        <div class="rn-service-area pb--70" id="list-item-4">
            <div class="container">
                <div class="row mb--30 align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800"> My
                            Explore</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                        <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up"
                            data-sal-duration="800">
                            <button class="discover-filter-button discover-filter-activation btn btn-primary">Filter<i
                                    class="feather-filter"></i></button>
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
                    <!-- start single service -->

                </div>
            </div>
        </div>

    </div>


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
@endsection
