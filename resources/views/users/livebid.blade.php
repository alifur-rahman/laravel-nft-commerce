@extends('layouts.users.user-admin-layout')
@section('title', auth()->user()->name)

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
                        <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">My All Live Bidding</h3>
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
                                        <a href="#" class="avatar" data-tooltip="Mark JOrdan"><img
                                                src="{{ asset('Uploads/profile/client-2.png') }}" alt="Nft_Profile"></a>
                                        <a href="#" class="avatar" data-tooltip="Mark"><img
                                                src="{{ asset('Uploads/profile/client-3.png') }}" alt="Nft_Profile"></a>
                                        <a href="#" class="avatar" data-tooltip="Jordan"><img
                                                src="{{ asset('Uploads/profile/client-4.png') }}" alt="Nft_Profile"></a>
                                        <a class="more-author-text"
                                            href="#">{{ AllfunctionService::get_all_bid_counts($live_bid->id) }} Place
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
                                                @if (Auth::user()->id == $live_bid->user->id)
                                                    <button type="button"
                                                        class="btn-setting-text collection-text btn-collection"
                                                        data-id="{{ $live_bid->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#collectionModel">
                                                        Add Collection
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
        </div>
        <!-- live Bidding area End -->

    

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
