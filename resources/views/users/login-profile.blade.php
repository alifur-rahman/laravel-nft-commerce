@extends('layouts.users.user-admin-layout')
@section('title', 'Dashboard')

@section('content')
    @php
        use App\Services\likeOperactionService;
        $likeService = new likeOperactionService();
    @endphp
    <div class="rn-nft-mid-wrapper">
        <div class="rn-author-bg-area bg_image ptb--150"
            style="background-image: url('{{ isset($user_data->cover_photo) ? asset('/Uploads/cover') . '/' . $user_data->cover_photo : asset('assets/user/images/profile/cover-04.png') }}');">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
    @php use App\Services\AllfunctionService; @endphp
    <div class="rn-nft-mid-wrapper">
        <div class="rn-author-area mb--30 mt_dec--120">
            <div class="container">
                <div class="row padding-tb-50 align-items-center d-flex">
                    <div class="col-lg-12">
                        <div class="author-wrapper">
                            <div class="author-inner">
                                <div class="user-thumbnail">
                                    <img src="{{ AllfunctionService::userPhoto(auth()->user()->id) }}"
                                        alt="{{ $user_data->name }}" class="bg-color-primary">
                                </div>
                                <div class="rn-author-info-content">
                                    <h4 class="title">{{ ucwords($user_data->name) }}</h4>
                                    <a href="#" class="social-follw">
                                        <i data-feather="twitter"></i>
                                        <span class="user-name">{{ $user_data->email }}</span>
                                    </a>
                                    <div class="follow-area">
                                        <div class="follow followers">
                                            <span>{{ $likeService->followersCount(Auth()->user()->id) }}<a href="#"
                                                    class="color-body">followers</a></span>
                                        </div>
                                        <div class="follow following">
                                            <span>{{ $likeService->followingCount(Auth()->user()->id) }}<a href="#"
                                                    class="color-body">following</a></span>
                                        </div>
                                    </div>
                                    <div class="author-button-area">
                                        {{-- <span class="btn at-follw follow-button"  {{ $likeService->is_follow(Auth()->user()->id) }}><i data-feather="user-plus"></i> <span class="al_fol_text">Follow</span></span> --}}
                                        <span class="btn at-follw share-button" data-bs-toggle="modal"
                                            data-bs-target="#shareModal"><i data-feather="share-2"></i></span>
                                        <div class="count at-follw">
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
                                                    <button type="button" class="btn-setting-text report-text"
                                                        data-bs-toggle="modal" data-bs-target="#reportModal">
                                                        Report
                                                    </button>
                                                    <button type="button" class="btn-setting-text report-text">
                                                        Claim Owenership
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('user.profile-settings') }}"
                                            class="btn at-follw follow-button edit-btn"><i data-feather="edit"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rn-authore-profile-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-wrapper-one">
                            <nav class="tab-button-one">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="false">On
                                        Sale</button>
                                    <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="true">Owned</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Created</button>
                                    <button class="nav-link" id="nav-liked-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-liked" type="button" role="tab" aria-controls="nav-liked"
                                        aria-selected="false">Liked</button>
                                    <button class="nav-link" id="nav-collection-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-collection" type="button" role="tab"
                                        aria-controls="nav-collection" aria-selected="false">Collection</button>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="tab-content rn-bid-content" id="nav-tabContent">
                    <div class="tab-pane row g-5 d-flex fade" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        @foreach ($mySalesNFT as $row)
                            <!-- start single product -->
                            <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="product-style-one no-overlay with-placeBid">
                                    <div class="card-thumbnail">
                                        <a href="/asset-details/{{ $row->id }}">
                                            <img src="{{ asset($doct_folder . $row->image) }}" alt="NFT_portfolio">
                                        </a>
                                        <a href="/asset-details/{{ $row->id }}" class="btn btn-primary">Place
                                            Bid</a>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($row->id);
                                            @endphp
                                            @foreach ($get_user as $item)
                                                @if ($item->profile_photo)
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                                            alt="Nft_Profile"></a>
                                                @else
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                            alt="Nft_Profile"></a>
                                                @endif
                                            @endforeach
                                            <a class="more-author-text"
                                                href="#">{{ AllfunctionService::get_all_bid_counts($row->id) }}
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
                                                <button data-id="{{ $row->id }}" type="button"
                                                    class="btn-setting-text share-text" data-bs-toggle="modal"
                                                    data-bs-target="#shareModal">
                                                    Share
                                                </button>
                                                <button type="button" class="btn-setting-text report-text"
                                                    data-bs-toggle="modal" data-bs-target="#reportModal">
                                                    Report
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="/asset-details/{{ $row->id }}"><span
                                            class="product-name">{{ $row->name }}</span></a>
                                    {{-- <span class="latest-bid">Highest bid 6/20</span> --}}
                                    <div class="bid-react-area">
                                        <div class="last-bid">{{ $row->base_price . ' ' . $row->price_symbol }}</div>
                                        <div class="react-area " {{ $likeService->is_liked($row->id) }}>
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <span class="number">{{ $likeService->like_count($row->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end single product -->
                        @endforeach


                    </div>
                    <div class="tab-pane row g-5 d-flex fade show active" id="nav-profile" role="tabpanel"
                        aria-labelledby="nav-profile-tab">

                        @foreach ($MynftAssets as $row)
                            <!-- start single product -->
                            <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="product-style-one no-overlay with-placeBid">
                                    <div class="card-thumbnail">
                                        <a href="/asset-details/{{ $row->id }}">
                                            <img src="{{ asset($doct_folder . $row->image) }}" alt="NFT_portfolio">
                                        </a>
                                        <a href="/asset-details/{{ $row->id }}" class="btn btn-primary">Place
                                            Bid</a>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($row->id);
                                            @endphp
                                            @foreach ($get_user as $item)
                                                @if ($item->profile_photo)
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                                            alt="Nft_Profile"></a>
                                                @else
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                            alt="Nft_Profile"></a>
                                                @endif
                                            @endforeach
                                            <a class="more-author-text"
                                                href="#">{{ AllfunctionService::get_all_bid_counts($row->id) }}
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
                                    <a href="/asset-details/{{ $row->id }}"><span
                                            class="product-name">{{ $row->name }}</span></a>
                                    {{-- <a href="#"><span class="latest-bid">Highest bid 6/20</span></a> --}}
                                    <div class="bid-react-area">
                                        <div class="last-bid">{{ $row->base_price . ' ' . $row->price_symbol }}</div>
                                        <div class="react-area " {{ $likeService->is_liked($row->id) }}>
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <span class="number">{{ $likeService->like_count($row->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end single product -->
                        @endforeach

                    </div>
                    <div class="tab-pane row g-5 d-flex fade" id="nav-contact" role="tabpanel"
                        aria-labelledby="nav-contact-tab">
                        @foreach ($myCreatedNFT as $row)
                            <!-- start single product -->
                            <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="product-style-one no-overlay with-placeBid">
                                    <div class="card-thumbnail">
                                        <a href="/asset-details/{{ $row->id }}">
                                            <img src="{{ asset($doct_folder . $row->image) }}" alt="NFT_portfolio">
                                        </a>
                                        <a href="/asset-details/{{ $row->id }}" class="btn btn-primary">Place
                                            Bid</a>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($row->id);
                                            @endphp
                                            @foreach ($get_user as $item)
                                                @if ($item->profile_photo)
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                                            alt="Nft_Profile"></a>
                                                @else
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                            alt="Nft_Profile"></a>
                                                @endif
                                            @endforeach
                                            <a class="more-author-text"
                                                href="#">{{ AllfunctionService::get_all_bid_counts($row->id) }}
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
                                    <a href="/asset-details/{{ $row->id }}"><span
                                            class="product-name">{{ $row->name }}</span></a>
                                    {{-- <span class="latest-bid">Highest bid 6/20</span> --}}
                                    <div class="bid-react-area">
                                        <div class="last-bid">{{ $row->base_price . ' ' . $row->price_symbol }}</div>
                                        <div class="react-area " {{ $likeService->is_liked($row->id) }}>
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <span class="number">{{ $likeService->like_count($row->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end single product -->
                        @endforeach
                    </div>
                    <div class="tab-pane row g-5 d-flex fade" id="nav-liked" role="tabpanel"
                        aria-labelledby="nav-contact-tab">
                        @foreach ($myFavoriteNFT as $row)
                            <!-- start single product -->
                            <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="product-style-one no-overlay with-placeBid">
                                    <div class="card-thumbnail">
                                        <a href="/asset-details/{{ $row->id }}">
                                            <img src="{{ asset($doct_folder . $row->image) }}" alt="NFT_portfolio">
                                        </a>
                                        <a href="/asset-details/{{ $row->id }}" class="btn btn-primary">Place
                                            Bid</a>
                                    </div>
                                    <div class="product-share-wrapper">
                                        <div class="profile-share">
                                            @php
                                                $get_user = AllfunctionService::get_all_bid_users_image($row->id);
                                            @endphp
                                            @foreach ($get_user as $item)
                                                @if ($item->profile_photo)
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile') . '/' . $item->profile_photo }}"
                                                            alt="Nft_Profile"></a>
                                                @else
                                                    <a href="{{ url('/profile') . '/' . $item->bidder_id }}" class="avatar"
                                                        data-tooltip="{{ $item->name }}"><img
                                                            src="{{ asset('Uploads/profile/avater-men.jpg') }}"
                                                            alt="Nft_Profile"></a>
                                                @endif
                                            @endforeach
                                            <a class="more-author-text"
                                                href="#">{{ AllfunctionService::get_all_bid_counts($row->id) }}
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
                                    <a href="/asset-details/{{ $row->id }}"><span
                                            class="product-name">{{ $row->name }}</span></a>
                                    {{-- <span class="latest-bid">Highest bid 6/20</span> --}}
                                    <div class="bid-react-area">
                                        <div class="last-bid">{{ $row->base_price . ' ' . $row->price_symbol }}</div>
                                        <div class="react-area  " {{ $likeService->is_liked($row->id) }}>
                                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                                <path
                                                    d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <span class="number">{{ $likeService->like_count($row->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end single product -->
                        @endforeach
                    </div>

                    <div class="tab-pane row g-5 d-flex fade" id="nav-collection" role="tabpanel"
                        aria-labelledby="nav-contact-tab">

                        @foreach ($myCollection as $collection)
                            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
                                class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                                <a href="{{ url('collection/view/' . $collection->name . '/' . $collection->user_id) }}"
                                    class="rn-collection-inner-one">
                                    <div class="collection-wrapper">
                                        <div class="collection-big-thumbnail">
                                            <img src="{{ asset('Uploads/cover/' . $collection->cover_photo) }}"
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

                                                        <img src="{{ asset('Uploads/nft-assets/' . $asset->images[0]->image) }}"
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
    </div>
@endsection
@section('custom-js')
    <script src="{{ asset('js/like-operation.js') }}"></script>
@stop
