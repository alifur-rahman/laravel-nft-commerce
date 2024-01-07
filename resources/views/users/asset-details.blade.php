@extends('layouts.users.user-layout')
@section('title', 'Product Details')

@section('custom-css')

    <style>
        .product-tab-wrapper .rn-pd-nav {
            justify-content: flex-start;
        }

        .rn-pd-thumbnail img {
            width: 100%;
        }

        .rn-pd-thumbnail img {
            width: 100%;
        }

        .base_pric {
            border: 1px solid rgb(80, 80, 80);
            padding: 10px 20px;
        }

        .base_pric h3,
        .base_pric h5 {
            margin: 0;
            padding: 0;
        }

        .bid-content-top {
            text-align: left;
            margin-bottom: 23px;
        }

        #make_offer_date {
            color: #ddd;
        }

        #make_offer_date {
            color: #ddd;
            font-size: 16px;
        }

        @media screen and (max-width: 992px) {
            .mobile-hide {
                display: none !important;
            }

            .product-tab-wrapper .rn-pd-content {
                flex-basis: 100%;
                padding-left: 0px;
            }
        }

        @media screen and (max-width: 992px) {
            .mobile-show {
                display: block !important;
            }
        }
    </style>
@endsection


@section('content')
    @php
        use App\Services\AllfunctionService;
        use App\Services\likeOperactionService;
        $likeService = new likeOperactionService();
    @endphp

    <div class="rn-breadcrumb-inner ptb--30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <h5 class="title text-center text-md-start">Product Details</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-list">
                        <li class="item"><a href="{{ asset(url('home')) }}">Home</a></li>
                        <li class="separator"><i class="feather-chevron-right"></i></li>
                        <li class="item current">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title area -->

    <!-- start product details area -->
    <div class="product-details-area rn-section-gapTop">
        <div class="container">
            <div class="row g-5">
                <!-- product image area -->

                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="product-tab-wrapper rbt-sticky-top-adjust">
                        <div class="pd-tab-inner">
                            <div class="nav rn-pd-nav rn-pd-rt-content nav-pills mobile-hide" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical">
                                <h4>By <b class="text-white-50">{{ $data->user->name }}</b></h4>
                                <p>{{ $data->details->description }}</p>
                            </div>

                            <div class="tab-content rn-pd-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="rn-pd-thumbnail">
                                        <img src="{{ AllfunctionService::asset_image($data->id) }}" alt="Nft_Profile">

                                    </div>
                                    <div class="nav rn-pd-nav rn-pd-rt-content nav-pills d-none mobile-show mt-2"
                                        id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <h4>By <b class="text-white-50">{{ $data->user->name }}</b></h4>
                                        <p>{{ $data->details->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product image area end -->

                <div class="col-lg-5 col-md-12 col-sm-12 mt_md--50 mt_sm--60">
                    <div class="rn-pd-content-area">
                        <div class="pd-title-area">
                            <h4 class="title">{{ $data->name }}</h4>
                            <div class="pd-react-area">
                                <div class="heart-count" {{ $likeService->is_liked($data->id) }}>
                                    <i data-feather="heart"></i>
                                    <span class="number">{{ $likeService->like_count($data->id) }}</span>
                                </div>
                                <div class="count">
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
                                            @if (Auth::check())
                                                @if (Auth::user()->id == $data->user->id)
                                                    <button type="button"
                                                        class="btn-setting-text collection-text btn-collection"
                                                        data-id="{{ $data->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#collectionModel">
                                                        Add Collection
                                                    </button>
                                                @else
                                                    <button type="button" class="btn-setting-text report-text"
                                                        data-bs-toggle="modal" data-bs-target="#reportModal">
                                                        Report
                                                    </button>
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
                            </div>
                        </div>

                        @if ($data->sale_type == 1)
                            <span class="bid"> Base Price <span class="price">{{ $data->base_price }}
                                    wETH</span></span>
                        @else
                            <span class="bid"> {{ isset($bids[0]) ? 'Height bid ' : 'Base Price ' }}<span
                                    class="price">{{ isset($bids[0]) ? $bids[0]->offer_price : $data->base_price }}wETH</span></span>
                        @endif

                        <h6 class="title-name"> <span class=" text-muted"> Category:</span>
                            {{ $data->category->category }}
                        </h6>
                        @if (isset($thisCollection->name))
                            <div class="catagory-collection">
                                <div class="collection">
                                    <span>Collection</span>
                                    <div class="top-seller-inner-one">
                                        <div class="top-seller-wrapper">
                                            <div class="thumbnail">
                                                <a
                                                    href="{{ url('collection/view/' . $thisCollection->name . '/' . $thisCollection->id) }}"><img
                                                        src="{{ AllfunctionService::collection_profile($thisCollection->id) }}"
                                                        alt="Nft_Profile"></a>
                                            </div>
                                            <div class="top-seller-content">
                                                <a
                                                    href="{{ url('collection/view/' . $thisCollection->name . '/' . $thisCollection->id) }}">
                                                    <h6 class="name">{{ $thisCollection->name }}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- <a class="btn btn-primary-alta" href="#">Unlockable content included</a> --}}
                        <div class="rn-bid-details">
                            <div class="tab-wrapper-one">
                                <nav class="tab-button-one">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                        @if ($data->sale_type != 1)
                                            <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-home" type="button" role="tab"
                                                aria-controls="nav-home" aria-selected="false">Bids</button>
                                        @endif

                                        <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="true">Details</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">History</button>
                                    </div>
                                </nav>
                                <div class="tab-content rn-bid-content" id="nav-tabContent">
                                    @if ($data->sale_type != 1)
                                        <div class="tab-pane fade" id="nav-home" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            <!-- single creator -->
                                            @foreach ($bids as $item)
                                                <div class="top-seller-inner-one">
                                                    <div class="top-seller-wrapper">
                                                        <div class="thumbnail">
                                                            <a href="{{ url('profile/' . $item->user->id) }}"><img
                                                                    src="{{ AllfunctionService::userPhoto($item->user->id) }}"
                                                                    alt="{{ $item->user->name }}"></a>
                                                        </div>
                                                        <div class="top-seller-content">
                                                            <span>{{ $item->offer_price }}wETH by <a
                                                                    href="{{ url('profile/' . $item->user->id) }}">{{ $item->user->name }}</a></span>
                                                            <span class="count-number">
                                                                {{ isset($item->created_at) ? $item->created_at->diffForHumans() : '' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- single creator -->
                                        </div>
                                    @endif
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <!-- single -->
                                        <div class="rn-pd-bd-wrapper">
                                            <div class="top-seller-inner-one">
                                                <!-- <p class="disc">Lorem ipsum dolor, sit amet consectetur adipisicing
                                                                                elit. Doloribus debitis nemo deserunt.</p> -->
                                                <h6 class="name-title">
                                                    Owner
                                                </h6>
                                                <div class="top-seller-wrapper">
                                                    <div class="thumbnail">
                                                        <a href="{{ url('prifile/' . $data->user->id) }}"><img
                                                                src="{{ AllfunctionService::userPhoto($data->user->id) }}"
                                                                alt="Nft_Profile"></a>
                                                    </div>
                                                    <div class="top-seller-content">
                                                        <a href="{{ url('prifile/' . $data->user->id) }}">
                                                            <h6 class="name">{{ $data->user->name }}</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single -->

                                            @if (!empty($data->details->meta_tags))
                                                <div class="rn-pd-sm-property-wrapper">
                                                    <h6 class="pd-property-title">
                                                        Property
                                                    </h6>
                                                    <div class="property-wrapper">
                                                        <!-- single property -->
                                                        @foreach (json_decode($data->details->meta_tags) as $item)
                                                            <div class="pd-property-inner">
                                                                <span class="color-white value">{{ $item }}</span>
                                                            </div>
                                                        @endforeach
                                                        <!-- single property End -->
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- single -->
                                            <!-- single -->
                                        </div>
                                        <!-- single -->
                                    </div>

                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <!-- single creator -->
                                        @if ($views)
                                            @foreach ($views as $item)
                                                <div class="top-seller-inner-one">
                                                    <div class="top-seller-wrapper">
                                                        <div class="thumbnail">
                                                            <a href="#"><img
                                                                    src="{{ AllfunctionService::userPhoto($item->user->id) }}"
                                                                    alt="Nft_Profile"></a>
                                                        </div>
                                                        <div class="top-seller-content">
                                                            <span>View by<a
                                                                    href="#">{{ $item->user->name }}</a></span>
                                                            <span class="count-number">
                                                                {{ $item->created_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p> No view yet</p>
                                        @endif
                                        <!-- single creator -->
                                    </div>
                                </div>
                            </div>
                            @if ($data->sale_type == 1)
                                <div class="base_pric">
                                    <h5>Current Price</h5>
                                    <h3><i class="fab fa-ethereum text-primary"></i> {{ $data->base_price }}</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="cart_id">
                                        <!-- <button type="button" class="btn btn-primary mt--30 enableEthereumButton"
                                                        style="width: 100%" data-bs-target="#makeOfferModel">Buy Now</button> -->
                                        @if (Cart::content()->where('id', $data->id)->first() == null)
                                            <button type="button" class="btn btn-primary mt--30 cart-button add_to_card"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i>
                                                Add to Card</button>
                                        @else
                                            <button type="button" class="remove_to_card btn btn-primary mt--30"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i>
                                                Remove to Card</button>
                                        @endif


                                    </div>
                                    <input type="hidden" name="" value="{{ $data->id }}" id="data_id">
                                    <input type="hidden" name="" value="{{ $data->name }}" id="data_name">
                                    <input type="hidden" name="" value="{{ $data->base_price }}"
                                        id="data_price">


                                    @foreach (Cart::content() as $item)
                                        @if (isset($item->rowId))
                                            @php
                                                $rowId = $item->rowId;
                                            @endphp
                                        @endif
                                    @endforeach


                                    <input type="hidden" name="" value="{{ isset($rowId) ? $rowId : '' }}"
                                        id="rowId">

                                    <div class="col-md-6">
                                        <button type="button" data-bs-toggle="modal"
                                            class="btn btn-primary-alta mt--30 " style="width: 100%"
                                            data-bs-target="#makeOfferModel">Make Offer</button>
                                    </div>
                                </div>
                            @endif

                            @if ($data->sale_type == 2)
                                <div class="place-bet-area">
                                    @if ($data->bit_time >= date('Y-m-d'))
                                        <div class="rn-bet-create">
                                            <div class="bid-list winning-bid">
                                                <h6 class="title">Winning bit</h6>
                                                <div class="top-seller-inner-one">
                                                    <div class="top-seller-wrapper">
                                                        <div class="thumbnail">
                                                            <a href="#"><img
                                                                    src="{{ asset('assets/user/images/') }}/client/client-7.png"
                                                                    alt="Nft_Profile"></a>
                                                        </div>
                                                        <div class="top-seller-content">
                                                            <span class="heighest-bid">Heighest bid <a
                                                                    href="#">{{ empty($bids) ? $bids[0]->user->name : 'No bit yet' }}</a></span>
                                                            <span class="count-number">
                                                                {{ empty($bids) ? $bids[0]->offer_price : 'Base Price: ' . $data->base_price }}wETH
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bid-list left-bid">
                                                <h6 class="title">Auction will ended</h6>
                                                <div class="countdown mt--15" data-date="{{ $data->bit_time }}">
                                                    <div class="countdown-container days">
                                                        <span class="countdown-value">87</span>
                                                        <span class="countdown-heading">D's</span>
                                                    </div>
                                                    <div class="countdown-container hours">
                                                        <span class="countdown-value">23</span>
                                                        <span class="countdown-heading">H's</span>
                                                    </div>
                                                    <div class="countdown-container minutes">
                                                        <span class="countdown-value">38</span>
                                                        <span class="countdown-heading">Min's</span>
                                                    </div>
                                                    <div class="countdown-container seconds">
                                                        <span class="countdown-value">27</span>
                                                        <span class="countdown-heading">Sec</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <a class="btn btn-primary-alta mt--30" href="#">Place a Bid</a> -->
                                        @if (Auth::check())
                                            @if (Auth::user()->id == $data->owner_id)
                                                <button type="button" class="btn btn-primary-alta mt--30 disabled"
                                                    data-bs-toggle="modal" data-bs-target="#placebidModal">You are owner
                                                    of
                                                    this nft</button>
                                            @else
                                                <button type="button" class="btn btn-primary-alta mt--30 "
                                                    data-bs-toggle="modal" data-bs-target="#placebidModal">Place a
                                                    Bid</button>
                                </div>
                            @endif
                        @else
                            <button type="button" class="btn btn-primary-alta mt--30 " data-bs-toggle="modal"
                                data-bs-target="#placebidModal">Place a Bid</button>

                            @endif
                        @else
                            <button type="button" class="btn btn-primary-alta mt--30 disabled" data-bs-toggle="modal"
                                data-bs-target="#placebidModal">Bid Date End</button>
                            @endif
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- End product details area -->



            <!-- New items Start -->
            <div class="rn-new-items rn-section-gapTop">
                <div class="container">
                    <div class="row mb--30 align-items-center">
                        <div class="col-12">
                            <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                Related
                                Item</h3>
                        </div>
                    </div>
                    <div class="row g-5">
                        <!-- start single product -->
                        @foreach ($related_views as $related_view)
                            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
                                class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="product-style-one no-overlay">
                                    <div class="card-thumbnail">
                                        <a href="{{ url('asset-details/' . $related_view->id) }}"><img
                                                src="{{ asset('/Uploads/nft-assets/' . '/' . $related_view->images[0]->image) }}"
                                                alt="NFT_portfolio"></a>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($related_view->id);
                                            @endphp
                                            @foreach ($get_user as $item)
                                                @if ($item->profile_photo)
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}"
                                                        class="avatar" data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                                            alt="Nft_Profile"></a>
                                                @else
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}"
                                                        class="avatar" data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                            alt="Nft_Profile"></a>
                                                @endif
                                            @endforeach
                                            <a class="more-author-text"
                                                href="#">{{ AllfunctionService::get_all_bid_counts($related_view->id) }}
                                                Place Bit.</a>
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
                                                <button type="button" class="btn-setting-text share-text"
                                                    data-bs-toggle="modal" data-bs-target="#shareModal">
                                                    Share
                                                </button>
                                                @if (Auth::check())
                                                    @if (Auth::user()->id == $related_view->user->id)
                                                        <button type="button"
                                                            class="btn-setting-text collection-text btn-collection"
                                                            data-id="{{ $related_view->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#collectionModel">
                                                            Add Collection
                                                        </button>
                                                        <a class="btn-setting-text collection-text btn-collection"
                                                            href="{{ url('edit/nft/' . $related_view->id) }}">Edit</a>
                                                    @else
                                                        <button type="button" class="btn-setting-text report-text"
                                                            data-bs-toggle="modal" data-bs-target="#reportModal">
                                                            Report
                                                        </button>
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
                                    <a href="#"><span class="product-name">{{ $related_view->name }}</span></a>
                                    <span class="latest-bid">Highest bid 1/20</span>
                                    <div class="bid-react-area">
                                        <div class="last-bid">{{ $related_view->base_price }}4wETH</div>
                                        <div class="react-area" {{ $likeService->is_liked($related_view->id) }}>
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <span class="number">{{ $likeService->like_count($related_view->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- end single product -->
                    </div>
                </div>
            </div>
            <!-- New items End -->



            <!-- Modal -->
            <div class="rn-popup-modal report-modal-wrapper modal fade" id="reportModal" tabindex="-1"
                aria-hidden="true">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        data-feather="x"></i></button>
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
                                    <button type="button" class="btn btn-primary-alta w-auto"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End product details area -->


        <!-- New items Start -->
        <div class="rn-new-items rn-section-gapTop">
            <div class="container">
                <div class="row mb--30 align-items-center">
                    <div class="col-12">
                        <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Recent
                            View
                        </h3>
                    </div>
                </div>
                <div class="row g-5">
                    <!-- start single product -->
                    @foreach ($last_views as $last_view)
                        <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
                            class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-style-one no-overlay">
                                <div class="card-thumbnail">
                                    <a href="{{ url('asset-details/' . $last_view->asset->id) }}"><img
                                            src="{{ asset('assets/user/images/portfolio/' . $last_view->asset->images[0]->image) }}"
                                            alt="NFT_portfolio"></a>
                                </div>
                                <div class="product-share-wrapper">
                                    <div class="profile-share">
                                        @php
                                            $get_user = AllfunctionService::get_all_bid_users_image($last_view->id);
                                        @endphp
                                        @foreach ($get_user as $item)
                                            <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                data-tooltip="{{ $item->name }}"><img
                                                    src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                                    alt="Nft_Profile"></a>
                                        @endforeach
                                        <a class="more-author-text"
                                            href="#">{{ AllfunctionService::get_all_bid_counts($last_view->id) }}
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
                                            <button type="button" class="btn-setting-text share-text"
                                                data-bs-toggle="modal" data-bs-target="#shareModal">
                                                Share
                                            </button>
                                            @if (Auth::check())
                                                @if (Auth::user()->id == $data->user->id)
                                                    <button type="button"
                                                        class="btn-setting-text collection-text btn-collection disabled"
                                                        data-id="{{ $data->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#collectionModel">
                                                        Add Collection
                                                    </button>
                                                @else
                                                    <button type="button" class="btn-setting-text report-text"
                                                        data-bs-toggle="modal" data-bs-target="#reportModal">
                                                        Report
                                                    </button>
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
                                <a href="#"><span class="product-name">{{ $last_view->asset->name }}</span></a>
                                <span class="latest-bid">Highest bid 1/20</span>
                                <div class="bid-react-area">
                                    <div class="last-bid">{{ $last_view->asset->base_price }}wETH</div>
                                    <div class="react-area" {{ $likeService->is_liked($last_view->asset->id) }}>
                                        <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                            class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                            <path
                                                d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                        <span class="number">{{ $likeService->like_count($last_view->asset->id) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end single product -->

                    <!-- end single product -->
                </div>
            </div>
        </div>
        <!-- New items End -->



        <!-- Modal -->
        <div class="rn-popup-modal share-modal-wrapper modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    data-feather="x"></i></button>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content share-wrapper">
                    <div class="modal-header share-area">
                        <h5 class="modal-title">Share this NFT</h5>
                    </div>
                    <div class="modal-body">
                        <ul class="social-share-default">
                            <li><a href="#"><span class="icon"><i data-feather="facebook"></i></span><span
                                        class="text">facebook</span></a></li>
                            <li><a href="#"><span class="icon"><i data-feather="twitter"></i></span><span
                                        class="text">twitter</span></a></li>
                            <li><a href="#"><span class="icon"><i data-feather="linkedin"></i></span><span
                                        class="text">linkedin</span></a></li>
                            <li><a href="#"><span class="icon"><i data-feather="instagram"></i></span><span
                                        class="text">instagram</span></a></li>
                            <li><a href="#"><span class="icon"><i data-feather="youtube"></i></span><span
                                        class="text">youtube</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="rn-popup-modal report-modal-wrapper modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    data-feather="x"></i></button>
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
                                <button type="button" class="btn btn-primary-alta w-auto"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="rn-popup-modal placebid-modal-wrapper modal fade" id="placebidModal" tabindex="-1"
            aria-hidden="true">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    data-feather="x"></i></button>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Place a bid</h3>
                    </div>
                    <div class="modal-body text-center">
                        @if (Auth::check())
                            <p>You are about to purchase This Product Form nft</p>
                            <form class="placebid-form-box" id="place_bid_form" action="{{ route('user.place.bid') }}"
                                method="POST">
                                @csrf
                                <h5 class="title">Your bid</h5>
                                <div class="bid-content">
                                    <div class="bid-content-top">
                                        <div class="bid-content-left">
                                            <input type="text" id="bid_value" name="bid_value">
                                            <input type="hidden" value="{!! $total_bid_ammount <= 0 ? $data->base_price : $total_bid_ammount !!}" id="base_or_bid"
                                                name="base_or_bid">
                                            <input type="hidden" value="{!! $data->id !!}" id="asset_id"
                                                name="asset_id">
                                            <span>wETH</span>
                                        </div>
                                        <span class="text-danger" id="bid_error"></span>
                                    </div>

                                    <div class="bid-content-mid">
                                        <div class="bid-content-left">
                                            <span>{!! $total_bid_ammount <= 0 ? 'Base amount' : 'Bid Amount' !!}</span>

                                        </div>

                                        <div class="bid-content-right">
                                            <span>{!! $total_bid_ammount <= 0 ? $data->base_price : $total_bid_ammount !!} wETH</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bit-continue-button">
                                    {{-- <a href="#" class="btn btn-primary w-100">Place a bid</a> --}}
                                    <button type="button" class="btn btn-primary w-100" id="placeBidBtn"
                                        onclick="_run(this)" data-el="fg" data-form="place_bid_form"
                                        data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                                        data-callback="placeBidCallBack" data-btnid="placeBidBtn">Place a bid</button>
                                    <button type="button" class="btn btn-primary-alta mt--10"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        @else
                            <p>You have to loging first for bid this nft</p>
                            <a href="{{ route('user.login') }}" class="btn btn-danger">Please Login For Bid</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- make Offer Modal -->
        <div class="rn-popup-modal placebid-modal-wrapper modal fade" id="makeOfferModel" tabindex="-1"
            aria-hidden="true">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    data-feather="x"></i></button>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Place a bid</h3>
                    </div>
                    <div class="modal-body text-center">
                        @if (Auth::check())
                            <p>You are make offer This Product Form nft</p>
                            <form class="placebid-form-box" id="make_offer_form" action="#" method="POST"
                                onsubmit="return false">
                                @csrf
                                <div class="bid-content">
                                    <div class="bid-content-top">
                                        <label for="make_value">Amount:</label>
                                        <div class="bid-content-left">
                                            <input type="text" id="make_amount" name="make_value">
                                            <input type="hidden" value="{!! $data->id !!}" id="asset_id"
                                                name="asset_id">
                                            <span>wETH</span>
                                        </div>
                                        <span class="text-danger" id="bid_error"></span>
                                    </div>
                                    <div class="bid-content-top">
                                        <label for="make_offer_date">Expiration Date:</label>
                                        <div class="bid-content-left">
                                            <input type="date" class="form-control" id="make_offer_date"
                                                name="make_offer_date">
                                        </div>
                                        <span class="text-danger" id="bid_error"></span>
                                    </div>

                                </div>
                                <div class="bit-continue-button">
                                    {{-- <a href="#" class="btn btn-primary w-100">Place a bid</a> --}}
                                    <button type="button" class="btn btn-primary w-100" id="makeOfferBtn"
                                        onclick="_run(this)" data-el="fg" data-form="make_offer_form"
                                        data-loading="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div>"
                                        data-callback="makeOfferCallBack" data-btnid="makeOfferBtn">Make
                                        Offer</button>
                                    <button type="button" class="btn btn-primary-alta mt--10"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        @else
                            <p>You have to loging first for make offer</p>
                            <a href="{{ route('user.login') }}" class="btn btn-danger">Please Login For Make
                                Offer</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>



    @endsection

    @section('custom-js')
        <script>
            function placeBidCallBack(data) {
                if (data.status == true) {
                    notify('success', data.message, 'Bid Success!');
                    $('#place_bid_form').reset();
                    $('#placebidModal').modal('toggle');
                    // $('#placebidModal').modal('hide');
                }
                if (data.status == false) {
                    notify('error', data.message, 'Bid Failed');
                }
                $.validator("place_bid_form", data.errors);
            }
        </script>
        <script src="{{ asset('assets/user/auth/js/scripts/pages/common-ajax.js') }}"></script>
        <script src="{{ asset('assets/user/js/custom-filter.js') }}"></script>
        <script src="{{ asset('assets/user/js/addCollection.js') }}"></script>

        <script src="{{ asset('js/like-operation.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.8.0/web3.min.js"
            integrity="sha512-bSQ2kf76XufUYS/4XinoHLp5S4lNOyRv0/x5UJACiOMy8ueqTNwRFfUZWmWpwnczjRp9SjiF1jrXbGEim7Y0Xg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js"></script>
        <script>
            // buy now
            // function startProcess() {
            //     // if ($('#inp_amount').val() > 0) {
            //     //     // run metamsk functions here

            //     // } else {
            //     //     alert('Please Enter Valid Amount');
            //     // }
            //     EThAppDeploy.loadEtherium();
            // }


            // EThAppDeploy = {
            //     loadEtherium: async () => {
            //         if (typeof window.ethereum !== 'undefined') {
            //             EThAppDeploy.web3Provider = ethereum;
            //             EThAppDeploy.requestAccount(ethereum);
            //         } else {
            //             alert(
            //                 "Not able to locate an Ethereum connection, please install a Metamask wallet"
            //             );
            //         }
            //     },
            //     /****
            //      * Request A Account
            //      * **/
            //     requestAccount: async (ethereum) => {
            //         ethereum
            //             .request({
            //                 method: 'eth_requestAccounts'
            //             })
            //             .then((resp) => {
            //                 //do payments with activated account
            //                 EThAppDeploy.payNow(ethereum, resp[0]);
            //             })
            //             .catch((err) => {
            //                 // Some unexpected error.
            //                 console.log(err);
            //             });
            //     },
            //     /***
            //      *
            //      * Do Payment
            //      * */
            //     payNow: async (ethereum, from) => {
            //         var amount = $('#inp_amount').val();
            //         ethereum
            //             .request({
            //                 method: 'eth_sendTransaction',
            //                 params: [{
            //                     from: from,
            //                     to: "{~Your Account Addree~}",
            //                     value: '0x' + ((amount * 1000000000000000000).toString(16)),
            //                 }, ],
            //             })
            //             .then((txHash) => {
            //                 if (txHash) {
            //                     console.log(txHash);
            //                     //Store Your Transaction Here
            //                 } else {
            //                     console.log("Something went wrong. Please try again");
            //                 }
            //             })
            //             .catch((error) => {
            //                 console.log(error);
            //             });
            //     },
            // }

            // meta mask code
 
            
            $(document).ready(function() {
                        function add_to_cart() {
                            $('.add_to_card').click(function() {
                                    var data_id = $('#data_id').val();
                                    var data_name = $('#data_name').val();
                                    var data_price = $('#data_price').val();
                                    $.ajax({
                                            method: 'POST',
                                            url: '/cart',
                                            dataType: 'json',
                                            data: {
                                                data_id: data_id,
                                                data_name: data_name,
                                                data_price: data_price
                                            },
                                            success: function(data) {
                                                if (data.success == true) {
                                                    var cart_val_show = $('#cart_val_show').html();
                                                    $('#cart_val_show').html(parseInt(cart_val_show) + data.cartInfo
                                                        .qty);
                                                    var cart_count = $('.cart_count').html();
                                                    $('.cart_count').html(parseInt(cart_count) + data.cartInfo
                                                        .qty);
                                                    $('#cart_id').html(`<button type="button" class="remove_to_card btn btn-primary mt--30"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i>
                                                Remove to Card</button>`);
                                                    $('.add_to_card').hide();

                                                    $('#rowId').val(data.cartInfo.rowId);
                                                    var subtotalAmmount = $('#subtotalAmmount').html();
                                                    console.log(subtotalAmmount);
                                                    $('#subtotalAmmount').html(parseInt(subtotalAmmount) + data
                                                        .cartInfo.price);
                                                    // product data add cart sidebar

                                                    $('#product_append').append(`
                                        <li class="product" data-row-id="` + data.cartInfo.rowId +
                                                        `" id="product_item_` + data.cartInfo.rowId + `">
                                            <a href="#" class="product-link">
                                                <span class="product-image">
                                                    <img class="product_img" src="` + data.product_img + `" alt="Product Photo">
                                                </span>
                                                <span class="product-details">
                                                    <h3 class="product_name">` + data.cartInfo.name +
                                                        `</h3>
                                                    <span class="qty-price">
                                                        <span class="qty">
                                                            <p style="font-size: 13px" >Product Quantity : <span class="product_quantity">` +
                                                        data.cartInfo
                                                        .qty + `</span> </p>
                                                        </span>
                                                        <span class="price product_price">` + data.cartInfo.price + `</span>
                                                    </span>
                                                </span>
                                            </a>
                                            <a href="#remove" data_id="` + data.cartInfo.rowId +
                                                        `" class="remove-button remove_to_card remove_btn_cart_` +
                                                        data.cartInfo.rowId + `"><span class="remove-icon">X</span></a>
                                        </li>
                                    `);

                                                    notify('success', data.message, 'Added to Cart');
                                                    remove_to_cart();
                                                } else {
                                                    notify('error', data.message, 'Added Failed!');
                                                }
                                            }
                                        }

                                    })
                            }
                        })
        </script>

    @endsection
