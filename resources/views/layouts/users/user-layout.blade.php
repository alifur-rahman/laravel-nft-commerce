@php
use App\Models\Deposit;
use App\Models\Withdraw;

use App\Services\OthersHelperService;
use App\Services\CompanyInfoService;
$helperService = new OthersHelperService();
use App\Models\NftSale;
$data = DB::table('nft_sales')
    ->orderBy('id', 'desc')
    ->limit(3)
    ->get();
if (isset($data[0]->id) && isset($data[1]->id) && isset($data[2]->id)) {
    $asset_name = DB::table('nft_assets')
        ->join('nft_asset_images', 'nft_assets.id', '=', 'nft_asset_images.nft_asset_id')
        ->select('nft_assets.name', 'nft_asset_images.image')
        ->whereIn('nft_assets.id', [$data[0]->id, $data[1]->id, $data[2]->id])
        ->get();
}

$data_count = DB::table('nft_sales')->count();

// check current balance
if (Auth::check()):
    $total_deposit = Deposit::where('user_id', auth()->user()->id)->sum('amount');
    $total_withdraw = Withdraw::where('user_id', auth()->user()->id)->sum('amount');
    $total_balance = $total_deposit - $total_withdraw;
endif;

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title') </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-style-mode" content="1"> <!-- 0 == light, 1 == dark -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/user/images/favicon.png') }}">
    <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/vendor/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/plugins/feature.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/vendor/odometer.css') }}">
    @yield('vendor-css')
    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/user/auth/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/all.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/user/auth/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/al-ajax-search.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ext-component-drag-drop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/cart.css') }}">
    <style>
        .error-msg {
            color: #ff0000ab;
        }

        .dropdown-menu {
            width: 15rem;
        }

        .product-style-one .bid-react-area .react-area {
            z-index: 0;
        }

        .modal-dialog {
            pointer-events: auto;
        }

        .nuron-expo-filter-widget {
            background: var(--background-color-2);
        }

        input[type=radio]~label::after {
            top: 4px;
        }
    </style>
    @yield('custom-css')
    <style>
        .toast {
            font-size: 1.4rem;
            pointer-events: auto;
        }

        .toast .toast-title {
            font-size: 1.6rem;
        }

        .toast .toast-close-button {
            display: none;
        }

        .user_nav img {
            width: 30px;
            height: 30px;
            border-radius: 100%;
            object-fit: cover;
        }

        .dt-buttons {
            visibility: hidden !important;
        }

        .active-dark-mode .dataTables_empty {
            background-color: #212e48 !important;
            color: white;
            border-left: 3px solid antiquewhite !important;
            text-align: center;
            /* min-height: 103px !important; */
            padding: 3rem !important;
        }

        .active-light-mode .dataTables_empty {
            background-color: #eff4ff !important;
            color: black;
            border-left: 3px solid #212e48 !important;
            text-align: center;
            /* min-height: 103px !important; */
            padding: 3rem !important;
        }

        .al_show_error {
            position: relative;
            height: 60%;
        }

        .al_show_error .error-msg {
            position: absolute;
            bottom: -25px;
            left: 0;
            z-index: 9;
        }

        .al_show_error .has-error {
            position: absolute;
            bottom: -25px;
            left: 0;
            z-index: 9;
        }

        [liked~="1"] {
            color: var(--color-white);
            background-color: var(--color-primary) !important;
        }

        [follow_st~="1"] {
            color: var(--color-white) !important;
            background-color: var(--color-primary) !important;

        }

        .bid_value.error-msg {
            position: absolute !important;
            top: 53px !important;
            left: 0 !important;
            color: #ff000091 !important;
        }

        .nice-select .list {
            width: 100%;
        }
        .collection-big-thumbnail .thumb-img {
            max-height: 164px;
            min-height: 164px;
        }
        .collenction-small-thumbnail .asset-img {
            max-height: 100px;
            min-height: 100px;
        }
        .collection-profile-in-view {
        	height: 137px;
        }
    </style>

</head>
@php use App\Services\AllfunctionService; @endphp

<body class="template-color-1 nft-body-connect">
    <!-- start header area -->

    <!-- Start Header -->
    <header class="rn-header haeder-default header--sticky">
        <div class="container">
            <div class="header-inner">
                <div class="header-left">
                    <div class="logo-thumbnail logo-custom-css">
                        <a class="logo-light" href="{{ url('/') }}"><img
                                src="{{ asset('assets/user/images/') }}/logo/logo-white.png" alt="nft-logo"></a>
                        <a class="logo-dark" href="{{ url('/') }}"><img
                                src="{{ asset('assets/user/images/') }}/logo/logo-dark.png" alt="nft-logo"></a>
                    </div>
                    <div class="mainmenu-wrapper">
                        <nav id="sideNav" class="mainmenu-nav d-none d-xl-block">
                            <!-- Start Mainmanu Nav -->
                            <ul class="mainmenu">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="with-megamenu">
                                    <a href="#">NFTs</a>
                                    <div class="rn-megamenu">
                                        <div class="wrapper">
                                            <div class="row row--0">
                                                <div class="col-lg-3 single-mega-item">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="{{ route('nft.create') }}">Create NFT<i
                                                                    data-feather="file-plus"></i></a>
                                                        </li>
                                                        <!-- <li>
                                                            <a href="upload-variants.html">Upload Type<i data-feather="layers"></i></a>
                                                        </li> -->
                                                        <li><a href="{{ route('nft.activity') }}">Activity<i
                                                                    data-feather="activity"></i></a></li>
                                                        <li>
                                                            <a href="{{ route('user.creator') }}">Creators<i
                                                                    data-feather="users"></i></a>
                                                        </li>
                                                        <li><a href="{{ route('collections.all-collections') }}">Our
                                                                Collection<i data-feather="package"></i></a></li>
                                                        <!-- <li><a href="upcoming_projects.html">Upcoming Projects<i data-feather="loader"></i></a></li> -->
                                                        <li><a href="{{ route('asset.collections.create') }}">Create
                                                                Collection<i data-feather="edit-3"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3 single-mega-item">
                                                    <ul class="mega-menu-item">
                                                        <!-- <li><a href="login.html">Log In <i data-feather="log-in"></i></a></li> -->
                                                        @if (!auth()->check())
                                                            <li><a href="{{ route('user.registration') }}">Registration
                                                                    <i data-feather="user-plus"></i></a></li>
                                                        @endif
                                                        <li><a href="{{ route('user.forgot-password') }}">Forget
                                                                Password <i data-feather="key"></i></a></li>
                                                        <!-- <li>
                                                            <a href="author.html">Author/Profile(User) <i data-feather="user"></i></a>
                                                        </li> -->
                                                        <li>
                                                            <a href="{{ route('connect-to-wallet') }}">Connect to
                                                                Wallet <i data-feather="pocket"></i></a>
                                                        </li>
                                                        <li><a href="{{ route('user.privacy-policy') }}">Privacy
                                                                Policy <i data-feather="file-text"></i></a></li>
                                                        <li><a href="{{ route('news-later') }}">Newsletter<i
                                                                    data-feather="book-open"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3 single-mega-item">
                                                    <ul class="mega-menu-item">

                                                        <li><a href="{{ route('all-products') }}">Product<i
                                                                    data-feather="folder"></i></a></li>
                                                        <!-- <li><a href="product-details.html">Product Details <i data-feather="layout"></i></a></li> -->
                                                        <li><a href="{{ route('nft.ranking') }}">NFT Ranking<i
                                                                    data-feather="trending-up"></i></a></li>
                                                        @if (auth()->check())
                                                            <li><a href="{{ route('user.profile-settings') }}">Edit
                                                                    Profile<i data-feather="edit"></i></a></li>
                                                        @endif
                                                        <!-- <li><a href="blog-details.html">Blog Details<i data-feather="book-open"></i></a></li> -->
                                                        <!-- <li><a href="404.html">404 <i data-feather="alert-triangle"></i></a></li> -->
                                                        <li><a href="{{ route('forum-details') }}">Forum & Community<i
                                                                    data-feather="message-circle"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3 single-mega-item">
                                                    <ul class="mega-menu-item">
                                                        <li><a href="{{ route('about-us') }}">About Us<i
                                                                    data-feather="award"></i></a></li>
                                                        <li><a href="{{ route('contact-us') }}">Contact <i
                                                                    data-feather="headphones"></i></a></li>
                                                        <li><a href="{{ route('support-faq') }}">Support/FAQ <i
                                                                    data-feather="help-circle"></i></a></li>
                                                        <li><a href="{{ route('terms-condition') }}">Terms & Condition
                                                                <i data-feather="list"></i></a></li>
                                                        <li><a href="{{ route('comming-soon') }}">Coming Soon <i
                                                                    data-feather="clock"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="has-droupdown has-menu-child-item">
                                    <a class="down" href="{{ route('explore') }}">Explore</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('explore') }}">NFT Filter<i
                                                    class="feather-fast-forward"></i></a></li>
                                        <li><a href="{{ route('nft.ranking') }}">NFT Ranking<i
                                                    class="feather-fast-forward"></i></a></li>
                                    </ul>
                                </li>
                                @if (isset(auth()->user()->id))
                                    <li class="has-droupdown has-menu-child-item">
                                        <a class="down" href="#">Finance</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('user.finance.add_bank') }}">Add Bank <i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('user.finance.bank_deposit') }}">Bank Deposit<i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('user.finance.bank_withdraw') }}">Bank Withdraw<i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('user.finance.crypto_deposit') }}">Crypto Deposit<i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('user.finance.crypto_withdraw') }}">Crypto
                                                    Withdraw<i class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('finance.deposit.report') }}">Deposit Report<i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('finance.withdraw.report') }}">Withdraw Report<i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('user.sales_report') }}">Sales Report<i
                                                        class="feather-fast-forward"></i></a></li>
                                            <li><a href="{{ route('user.purchase_report') }}">Purchase Report<i
                                                        class="feather-fast-forward"></i></a></li>
                                        </ul>
                                    </li>
                                @endif
                                <li><a href="{{ route('contact-us') }}">Contact</a></li>
                                @if (!auth()->check())
                                    <li class="text-decoration-none"><a href="{{ route('login') }}">Login</a></li>
                                @endif
                            </ul>
                            <!-- End Mainmanu Nav -->
                        </nav>
                    </div>
                </div>
                <div class="header-right">
                    <div class="setting-option d-none d-lg-block al-ajax-search">

                        <form class="search-form-wrapper" action="{{ route('search') }}" method="GET">
                            <input type="search" name="keyword" placeholder="Search Here" aria-label="Search">
                            <div class="search-icon">
                                <button type="submit"><i class="feather-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="setting-option rn-icon-list d-block d-lg-none">
                        <div class="icon-box search-mobile-icon">
                            <button><i class="feather-search"></i></button>
                        </div>
                        <form id="header-search-1" action="#" method="GET" class="large-mobile-blog-search">
                            <div class="rn-search-mobile form-group">
                                <button type="submit" class="search-button"><i class="feather-search"></i></button>
                                <input type="text" placeholder="Search ...">
                            </div>
                        </form>
                    </div>

                    <div class="setting-option header-btn rbt-site-header" id="rbt-site-header">
                        <div class="icon-box">
                            <a id="connectbtn" class="btn btn-primary-alta btn-small"
                                href="{{ route('connect-to-wallet') }}">Wallet connect</a>
                        </div>
                    </div>

                    <div class="setting-option rn-icon-list notification-badge">
                        <div class="icon-box">
                            <a href="{{ route('user.notification') }}"><i class="feather-bell"></i><span
                                    class="badge">{{ $helperService->notificationCount() }}</span></a>
                        </div>
                    </div>
                    @if (auth()->check())
                        <div class="header_admin" id="header_admin" style="display: block">
                            <div class="setting-option rn-icon-list user-account">
                                <div class="icon-box">
                                    <a href="#">
                                        <img class="bg-color-primary"
                                            src="{{ AllfunctionService::userPhoto(auth()->user()->id) }}"
                                            alt="Images">
                                    </a>
                                    <div class="rn-dropdown">
                                        <div class="rn-inner-top">
                                            <h4 class="title"><a
                                                    href="{{ route('user.dashboard') }}">{{ ucwords(auth()->user()->name) }}</a>
                                            </h4>
                                            <span><a href="#">{{ ucwords(auth()->user()->email) }}</a></span>
                                        </div>
                                        <div class="rn-product-inner">
                                            <ul class="product-list">
                                                <li class="single-product-list">
                                                    <div class="thumbnail">
                                                        <a href="{{ route('all-products') }}"><img
                                                                class="bg-light p-2"
                                                                src="{{ asset('common-icon/bank-icon.png') }}"
                                                                alt="Nft Product Images"></a>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title"><a href="#">Balance</a></h6>
                                                        <span class="price">${{ $total_balance }}</span>
                                                    </div>
                                                    <div class="button"></div>
                                                </li>
                                                <li class="single-product-list d-none">
                                                    <div class="thumbnail">
                                                        <a href="#"><img
                                                                src="{{ asset('assets/user/images/') }}/portfolio/portfolio-01.jpg"
                                                                alt="Nft Product Images"></a>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title"><a href="#">Balance</a></h6>

                                                        <span class="price">25 ETH</span>
                                                    </div>
                                                    <div class="button"></div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="add-fund-button mt--20 pb--20">
                                            <a class="btn btn-primary-alta w-100"
                                                href="{{ route('user.finance.bank_deposit') }}">Add Your More
                                                Funds</a>
                                        </div>
                                        <ul class="list-inner">
                                            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                            <li><a href="{{ route('user.profile-settings') }}">Edit Profile</a></li>
                                            {{-- <li><a href="#">Manage funds</a></li> --}}
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                    <span class="menu-text">Sign Out</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- shopping card -->
                    <div class="setting-option rn-icon-list notification-badge">
                        <div class="icon-box">
                            <a class="cart-button" href="#">
                                <i class="feather-shopping-cart"></i>
                                <span class="badge cart-total-item" id="cart_val_show">{{ Cart::count() }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="setting-option mobile-menu-bar d-block d-xl-none">
                        <div class="hamberger">
                            <button class="hamberger-button">
                                <i class="feather-menu"></i>
                            </button>
                        </div>
                    </div>

                    {{-- <div id="my_switcher" class="my_switcher setting-option">
                        <ul>
                            <li>
                                <a href="javascript: void(0);" data-theme="light" class="setColor light">
                                    <img class="sun-image" src="{{ asset('assets/user/images/') }}/icons/sun-01.svg"
                    alt="Sun images">
                    </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                            <img class="Victor Image" src="{{ asset('assets/user/images/') }}/icons/vector.svg" alt="Vector Images">
                        </a>
                    </li>
                    </ul>
                </div> --}}
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <div class="popup-mobile-menu">
        <div class="inner">
            <div class="header-top">
                <div class="logo logo-custom-css">
                    <a class="logo-light" href="index.html"><img
                            src="{{ asset('assets/user/images/') }}/logo/logo-white.png" alt="nft-logo"></a>
                    <a class="logo-dark" href="index.html"><img
                            src="{{ asset('assets/user/images/') }}/logo/logo-dark.png" alt="nft-logo"></a>
                </div>
                <div class="close-menu">
                    <button class="close-button">
                        <i class="feather-x"></i>
                    </button>
                </div>
            </div>
            <nav>
                <!-- Start Mainmanu Nav -->
                <ul class="mainmenu">
                    <li>
                        <a class="nav-link its_new" href="{{ route('home') }}">Home</a>
                    </li>
                    <li><a href="about.html">About</a>
                    </li>
                    <li class="has-droupdown">
                        <a class="nav-link its_new" href="#">Explore</a>
                        <ul class="submenu">
                            <li><a href="{{ route('explore') }}">Explore<i class="feather-fast-forward"></i></a></li>
                            <li><a href="{{ route('nft.ranking') }}">NFT Ranking<i
                                        class="feather-fast-forward"></i></a></li>
                        </ul>
                    </li>
                    <li class="with-megamenu">
                        <a class="nav-link its_new" href="#">NFT's</a>
                        <div class="rn-megamenu">
                            <div class="wrapper">
                                <div class="row row--0">
                                    <div class="col-lg-3 single-mega-item">
                                        <ul class="mega-menu-item">
                                            <li>
                                                <a href="{{ route('nft.create') }}">Create NFT<i
                                                        data-feather="file-plus"></i></a>
                                            </li>
                                            <!-- <li>
                                                            <a href="upload-variants.html">Upload Type<i data-feather="layers"></i></a>
                                                        </li> -->
                                            <li><a href="{{ route('nft.activity') }}">Activity<i
                                                        data-feather="activity"></i></a></li>
                                            <li>
                                                <a href="{{ route('user.creator') }}">Creators<i
                                                        data-feather="users"></i></a>
                                            </li>
                                            <li><a href="{{ route('collections.all-collections') }}">Our
                                                    Collection<i data-feather="package"></i></a></li>
                                            <!-- <li><a href="upcoming_projects.html">Upcoming Projects<i data-feather="loader"></i></a></li> -->
                                            <li><a href="{{ route('asset.collections.create') }}">Create
                                                    Collection<i data-feather="edit-3"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 single-mega-item">
                                        <ul class="mega-menu-item">
                                            <!-- <li><a href="login.html">Log In <i data-feather="log-in"></i></a></li> -->
                                            @if (!auth()->check())
                                                <li><a href="sign-up.html">Registration <i
                                                            data-feather="user-plus"></i></a></li>
                                            @endif
                                            <li><a href="{{ route('user.forgot-password') }}">Forget
                                                    Password <i data-feather="key"></i></a></li>
                                            <!-- <li>
                                                            <a href="author.html">Author/Profile(User) <i data-feather="user"></i></a>
                                                        </li> -->
                                            <li>
                                                <a href="{{ route('connect-to-wallet') }}">Connect to
                                                    Wallet <i data-feather="pocket"></i></a>
                                            </li>
                                            <li><a href="{{ route('user.privacy-policy') }}">Privacy
                                                    Policy <i data-feather="file-text"></i></a></li>
                                            <li><a href="{{ route('news-later') }}">Newsletter<i
                                                        data-feather="book-open"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 single-mega-item">
                                        <ul class="mega-menu-item">

                                            <li><a href="{{ route('all-products') }}">Product<i
                                                        data-feather="folder"></i></a></li>
                                            <!-- <li><a href="product-details.html">Product Details <i data-feather="layout"></i></a></li> -->
                                            <li><a href="{{ route('nft.ranking') }}">NFT Ranking<i
                                                        data-feather="trending-up"></i></a></li>
                                            @if (auth()->check())
                                                <li><a href="{{ route('user.profile-settings') }}">Edit
                                                        Profile<i data-feather="edit"></i></a></li>
                                            @endif
                                            <!-- <li><a href="blog-details.html">Blog Details<i data-feather="book-open"></i></a></li> -->
                                            <!-- <li><a href="404.html">404 <i data-feather="alert-triangle"></i></a></li> -->
                                            <li><a href="{{ route('forum-details') }}">Forum & Community<i
                                                        data-feather="message-circle"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 single-mega-item">
                                        <ul class="mega-menu-item">
                                            <li><a href="{{ route('about-us') }}">About Us<i
                                                        data-feather="award"></i></a></li>
                                            <li><a href="{{ route('contact-us') }}">Contact <i
                                                        data-feather="headphones"></i></a></li>
                                            <li><a href="{{ route('support-faq') }}">Support/FAQ <i
                                                        data-feather="help-circle"></i></a></li>
                                            <li><a href="{{ route('terms-condition') }}">Terms & Condition
                                                    <i data-feather="list"></i></a></li>
                                            <li><a href="{{ route('comming-soon') }}">Coming Soon <i
                                                        data-feather="clock"></i></a></li>
                                            <!-- <li><a href="maintenance.html">Maintenance <i data-feather="cpu"></i></a></li> -->
                                            <!-- <li><a href="#">Forum Details <i data-feather="message-circle"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @if (isset(auth()->user()->id))
                        <li class="has-droupdown has-menu-child-item">
                            <a class="down" href="#">Finance</a>
                            <ul class="submenu">
                                <li><a href="{{ route('user.finance.bank_deposit') }}">Bank Deposit<i
                                            class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('user.finance.bank_withdraw') }}">Bank Withdraw<i
                                            class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('user.finance.crypto_deposit') }}">Crypto Deposit<i
                                            class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('user.finance.crypto_withdraw') }}">Crypto
                                        Withdraw<i class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('finance.deposit.report') }}">Deposit Report<i
                                            class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('finance.withdraw.report') }}">Withdraw Report<i
                                            class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('user.sales_report') }}">Sales Report<i
                                            class="feather-fast-forward"></i></a></li>
                                <li><a href="{{ route('user.purchase_report') }}">Purchase Report<i
                                            class="feather-fast-forward"></i></a></li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="{{ route('contact-us') }}">Contact</a></li>
                    @if (!auth()->check())
                        <li class="text-decoration-none"><a href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
                <!-- End Mainmanu Nav -->
            </nav>
        </div>
    </div>
    <!-- ENd Header Area -->



    @yield('content')


    <!-- Start Footer Area -->
    <div class="rn-footer-one rn-section-gap bg-color--1 mt--100 mt_md--80 mt_sm--80">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="widget-content-wrapper">
                        <div class="footer-left">
                            <div class="logo-thumbnail logo-custom-css">
                                <a class="logo-light" href="index.html"><img
                                        src="{{ asset('assets/user/images/') }}/logo/logo-white.png"
                                        alt="nft-logo"></a>
                                <a class="logo-dark" href="index.html"><img
                                        src="{{ asset('assets/user/images/') }}/logo/logo-dark.png"
                                        alt="nft-logo"></a>
                            </div>
                            <p class="rn-footer-describe">
                                Created with the collaboration of over 60 of the world's best
                                <span>{{ CompanyInfoService::com_name() }} </span> Artists.
                            </p>
                        </div>

                        <div class="widget-bottom mt--40 pt--40">
                            <h6 class="title">Get The Latest <span>{{ CompanyInfoService::com_name() }} </span>
                                Updates </h6>
                            <form method="POST" action="{{ route('subscription') }}" id="footer_subscribe_form">
                                @csrf
                                <div class="input-group">
                                    <input type="email" name="email" id="email"
                                        class="form-control bg-color--2" placeholder="Your Email"
                                        aria-label="Recipient's username">
                                    <div class="input-group-append">

                                        <button type="button" class="btn btn-primary-alta btn-outline-secondary"
                                            id="footer_subscribe_btn" onclick="_run(this)" data-el="fg"
                                            data-form="footer_subscribe_form"
                                            data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>"
                                            data-callback="footerSubscriptionCallBack"
                                            data-btnid="footer_subscribe_btn">Subscribe</button>
                                    </div>
                                </div>
                            </form>
                            <div class="newsletter-dsc">
                                <p>Email is safe. We don't spam.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt_mobile--40">
                    <div class="footer-widget widget-quicklink">
                        {{-- <h6 class="widget-title">Enviva</h6> --}}
                        <h6 class="widget-title">{{ CompanyInfoService::com_name() }}</h6>
                        <ul class="footer-list-one">
                            <li class="single-list"><a href="{{ route('home') }}">Home</a></li>
                            <li class="single-list"><a href="{{ route('nft.create') }}">Create NFTs</a></li>
                            @if (isset(auth()->user()->id))
                                <li class="single-list"><a
                                        href="{{ route('user.finance.bank_deposit') }}">Finance</a></li>
                            @endif
                            <li class="single-list"><a href="{{ route('explore') }}">Explore</a></li>
                            <li class="single-list"><a href="{{ route('contact-us') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt_md--40 mt_sm--40">
                    <div class="footer-widget widget-information">
                        <h6 class="widget-title">Information</h6>
                        <ul class="footer-list-one">
                            <li class="single-list"><a href="{{ route('about-us') }}">About Us</a></li>
                            <li class="single-list"><a href="{{ route('contact-us') }}">Contact Us</a></li>
                            <li class="single-list"><a href="{{ route('support-faq') }}">Support/FAQ</a></li>
                            <li class="single-list"><a href="{{ route('user.privacy-policy') }}">Privacy Policy</a>
                            </li>
                            <li class="single-list"><a href="{{ route('terms-condition') }}">Terms & Condition</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt_md--40 mt_sm--40">
                    <div class="footer-widget">
                        <h6 class="widget-title">Recent Sold Out</h6>
                        <ul class="footer-recent-post">
                            @if (isset($data[0]) && isset($asset_name[0]) && isset($data[2]))
                                <li class="recent-post">
                                    <div class="thumbnail">
                                        <a href="{{ url('asset-details') . '/' . $data[0]->id }}">
                                            <img src="{{ asset('Uploads/nft-assets') . '/' . $asset_name[0]->image }}"
                                                alt="Product Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a
                                                href="{{ url('asset-details') . '/' . $data[0]->id }}">{!! isset($asset_name[0]->name) ? $asset_name[0]->name : null !!}</a>
                                        </h6>
                                        <p>Highest bid {!! isset($data[2]->id) ? $data[2]->id : null !!}/{!! isset($data_count) ? $data_count : null !!}</p>
                                        <span class="price">{!! isset($data[2]->total_price) ? $data[2]->total_price : null !!} wETH</span>
                                    </div>
                                </li>
                            @endif

                            @if (isset($data[1]) && isset($asset_name[1]))
                                <li class="recent-post">
                                    <div class="thumbnail">
                                        <a href="{{ url('asset-details') . '/' . $data[1]->id }}">
                                            <img src="{{ asset('Uploads/nft-assets') . '/' . $asset_name[1]->image }}"
                                                alt="Product Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a
                                                href="{{ url('asset-details') . '/' . $data[1]->id }}">{!! isset($asset_name[1]->name) ? $asset_name[1]->name : null !!}</a>
                                        </h6>
                                        <p>Highest bid {!! isset($data[1]->id) ? $data[1]->id : null !!}/{!! isset($data_count) ? $data_count : null !!}</p>
                                        <span class="price">{!! isset($data[1]->total_price) ? $data[1]->total_price : null !!} wETH</span>
                                    </div>
                                </li>
                            @endif
                            @if (isset($data[2]) && isset($asset_name[2]) && isset($data[0]))
                                <li class="recent-post">
                                    <div class="thumbnail">
                                        <a href="{{ url('asset-details') . '/' . $data[2]->id }}">
                                            <img src="{{ asset('Uploads/nft-assets') . '/' . $asset_name[2]->image }}"
                                                alt="Product Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a
                                                href="{{ url('asset-details') . '/' . $data[2]->id }}">{!! isset($asset_name[2]->name) ? $asset_name[2]->name : null !!}</a>
                                        </h6>
                                        <p>Highest bid {!! isset($data[0]->id) ? $data[0]->id : null !!}/{!! isset($data_count) ? $data_count : null !!}</p>
                                        <span class="price">{!! isset($data[0]->total_price) ? $data[0]->total_price : null !!} wETH</span>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Area -->
    <!-- Start Footer Area -->
    @php
        $com_infos = App\Models\CompanyInfo::all()->first();
    @endphp
    <div class="copy-right-one ptb--20 bg-color--1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="copyright-left">

                        <span>© <?php echo date('Y'); ?>
                            {{ $com_infos == '' || $com_infos->copyright == '' ? 'Onenft,inc | All right Reserved' : $com_infos->copyright }}</span>

                        <ul class="privacy">
                            <li><a href="{{ route('terms-condition') }}">Terms</a></li>
                            <li><a href="{{ route('user.privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="copyright-right">
                        <ul class="social-copyright">
                            @php
                                $social = App\Models\CompanyInfo::select('com_social_info')->first();
                                // echo json_decode($social);
                                $com_social_info = empty($social->com_social_info) ? [] : json_decode($social->com_social_info);
                            @endphp
                            @if (isset($com_social_info->facebook))
                                <li><a href="{{ $com_social_info->facebook }}"><i data-feather="facebook"></i></a>
                                </li>
                            @endif
                            @if (isset($com_social_info->twitter))
                                <li><a href="{{ $com_social_info->twitter }}"><i data-feather="twitter"></i></a>
                                </li>
                            @endif
                            @if (isset($com_social_info->instagram))
                                <li><a href="{{ $com_social_info->instagram }}"><i
                                            data-feather="instagram"></i></a>
                                </li>
                            @endif
                            @if (isset($com_social_info->linkedin))
                                <li><a href="{{ $com_social_info->linkedin }}"><i data-feather="linkedin"></i></a>
                                </li>
                            @endif
                            @if (isset($com_social_info->github))
                                <li><a href="{{ $com_social_info->github }}"><i data-feather="github"></i></a></li>
                            @endif




                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Area -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- Start Top To Bottom Area  -->
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>


    <!-- Social Share Modal -->
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
                        <li><a href="#" target="blank" id="fbShare"><span class="icon"><i
                                        data-feather="facebook"></i></span><span class="text">facebook </span></a>
                        </li>
                        <li><a href="#" target="blank" id="twShare"><span class="icon"><i
                                        data-feather="twitter"></i></span><span class="text">twitter</span></a></li>
                        <li><a href="#" target="blank" id="linkShare"><span class="icon"><i
                                        data-feather="linkedin"></i></span><span class="text">linkedin</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    {{-- shipping cart sidebar  --}}

    <aside id="sidebar-cart">
        <main>
            <a href="#" class="close-button"><span class="close-icon">X</span></a>
            <h2>Shopping Bag <span class="count cart_count">{{ Cart::count() }}</span></h2>
            <ul class="products" id="product_append">
                @foreach (Cart::content() as $row)
                    @if (isset($row->id))
                        @php
                            $nft_img = AllfunctionService::get_nft_image($row->id);
                            $product_name = $row->name;
                            $product_qunatity = $row->qty;
                            $product_price = $row->price;
                        @endphp

                        <li data-row-id="{{ $row->rowId }}" class="product"
                            id="product_item_{{ $row->rowId }}">
                            <a href="{{ url('asset-details/' . $row->id) }}" class="product-link">
                                <span class="product-image">
                                    <img class="product_img" src="{{ isset($nft_img) ? $nft_img : '' }}"
                                        alt="Product Photo">
                                </span>
                                <span class="product-details">
                                    <h3 class="product_name">{{ isset($product_name) ? $product_name : '' }}</h3>
                                    <span class="qty-price">
                                        <span class="qty">
                                            {{-- <button class="minus-button" id="minus-button-1">-</button>
                                            <input type="number" id="qty-input-1" class="qty-input" step="1"
                                                min="1" max="1000" name="qty-input" value="1"
                                                pattern="[0-9]*" title="Quantity" inputmode="numeric">
                                            <button class="plus-button" id="plus-button-1">+</button>
                                            <input type="hidden" name="item-price" id="item-price-1" value="12.00"> --}}
                                            <p style="font-size: 13px">Product Quantity : <span
                                                    class="product_quantity">{{ isset($product_qunatity) ? $product_qunatity : '' }}</span>
                                            </p>
                                        </span>
                                        <span
                                            class="price product_price">{{ isset($product_price) ? $product_price : '' }}</span>
                                    </span>
                                </span>
                            </a>
                            <a href="#"
                                class="remove-button remove_to_card remove_sidebar_cart remove_btn_cart_{{ $row->rowId }}"><span
                                    class="remove-icon">X</span></a>
                        </li>
                    @endif
                @endforeach

            </ul>
            <div class="totals">
                <div class="subtotal">
                    <span class="label">Subtotal:</span> <span class="amount">$ <span
                            id="subtotalAmmount">{{ Cart::subtotal() }}</span> </span>
                </div>
                {{-- <div class="shipping">
                        <span class="label">Shipping:</span> <span class="amount">$7.95</span>
                    </div>
                    <div class="tax">
                        <span class="label">Tax:</span> <span class="amount">$71.95</span>
                    </div> --}}
            </div>
            <div class="action-buttons">
                <a class="view-cart-button" href="#">Cart</a><a class="checkout-button"
                    href="{{ route('cart.details') }}">Checkout</a>
            </div>
        </main>
    </aside>
    <div id="sidebar-cart-curtain"></div>


    <!-- End Top To Bottom Area  -->
    <!-- JS ============================================ -->
    <script src="{{ asset('assets/user/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/modernizer.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/feather.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/sal.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/particles.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/jquery.style.swicher.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/count-down.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/isotop.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/imageloaded.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/backtoTop.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/odometer.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/jquery-appear.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/scrolltrigger.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/jquery.custom-file-input.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/savePopup.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/vanilla.tilt.js') }}"></script>

    <!-- main JS -->
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
    <script src="{{ asset('js/fontawesome/all.min.js') }}"></script>
    <!-- Meta Mask  -->
    <script src="{{ asset('assets/user/js/vendor/web3.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/maralis.js') }}"></script>
    <script src="{{ asset('assets/user/js/vendor/nft.js') }}"></script>



    <script src="{{ asset('assets/user/auth/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('assets/user/auth/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/core/confirm-alert.js') }}"></script>
    <script src="{{ asset('assets/user/auth/js/scripts/pages/common-ajax.js') }}"></script>
    <script src="{{ asset('assets/user/auth/js/custom-validation.js') }}"></script>
    @yield('vendor-js')
    <!-- datatable -->
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/datatable/responsive.bootstrap5.js') }}"></script>

    <script type="text/javascript" language="javascript" src="{{ asset('js/datatable/dataTables.buttons.min.js') }}">
    </script>
    <!-- <script type="text/javascript" language="javascript" src="{{ asset('/js/jszip.min.js') }}"></script> -->
    <!-- <script type="text/javascript" language="javascript" src="{{ asset('/js/buttons.flash.min.js') }}"></script> -->
    <script type="text/javascript" language="javascript" src="{{ asset('js/datatable/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/datatable/buttons.print.min.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/server-side-button-action.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/datatable-functions.js') }}"></script>
    <script src="{{ asset('assets/user/auth/js/master.js') }}"></script>
    <script>


        function footerSubscriptionCallBack(data) {
            if (data.status == true) {
                $("#footer_subscribe_form").trigger("reset");
                notify('success', data.message, 'Subscribe Success');
                setTimeout(function() {

                }, 1000 * 2);
            } else {
                notify('error', data.message, 'Subscription Failed');
                // $.validator("footer_subscribe_form", data.errors);
            }
            $.validator("footer_subscribe_form", data.errors);
        }

        $(document).on('click', '.share-text', function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/social-media-share',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status) {
                        $("#fbShare").attr("href", data.message.facebook);
                        $("#twShare").attr("href", data.message.twitter);
                        $("#linkShare").attr("href", data.message.linkedin);
                    }
                }
            });
        })

        // add to cart design js

        $(document).ready(function() {
            function add_to_cart() {
                $('.add_to_card').click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
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
                                                            <p style="font-size: 13px" >Product Quantity : <span class="product_quantity">` + data.cartInfo
                                    .qty + `</span> </p>
                                                        </span>
                                                        <span class="price product_price">` + data.cartInfo.price + `</span>
                                                    </span>
                                                </span>
                                            </a>
                                            <a href="#" data_id="` + data.cartInfo.rowId +
                                    `" class=" remove_sidebar_cart remove-button remove_to_card remove_btn_cart_` +
                                    data.cartInfo.rowId + `"><span class="remove-icon">X</span></a>
                                        </li>
                                    `);

                                notify('success', data.message, 'Added to Cart');
                                remove_to_cart();
                            } else {
                                notify('error', data.message, 'Added Failed!');
                            }
                        }

                    })
                })
            }

            function remove_to_cart() {
                $('.remove_to_card').click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var parentLi = $(this).parent('li');
                    if (parentLi.length != 0) {
                        var rowId = parentLi.data('row-id');
                    } else {
                        var rowId = $('#rowId').val();
                    }
                    $.ajax({
                        method: 'POST',
                        url: '/cartRemove',
                        dataType: 'json',
                        data: {
                            rowId: rowId,
                        },
                        success: function(data) {
                            if (data.success == true) {
                                var removeVal = $('#cart_val_show').html();
                                var cart_count = $('.cart_count').html();
                                $('#product_item_' + rowId).hide();
                                $('#cart_val_show').html(removeVal - 1);
                                $('.cart_count').html(cart_count - 1);
                                $('.remove_to_card').hide();
                                setTimeout(function() {
                                    $('.remove_sidebar_cart').show(1);
                                }, 2000);
                                $('#cart_id').html(`<button type="button" class="add_to_card cart-button btn btn-primary mt--30"
                                                style="width: 100%">
                                                <i class="fas fa-cart-plus"></i>
                                                Add to Card</button>`);
                                notify('success', 'Remove to Cart Succesfully!',
                                    'Remove to Cart');
                                add_to_cart();
                            } else {
                                notify('error', 'something went to wrong', 'Remove Failed!');
                            }
                        }

                    })
                })
            }
            remove_to_cart();
            add_to_cart();
        })


        $(document).ready(function($) {
            // Declare the body variable
            var $body = $("body");

            // Function that shows and hides the sidebar cart
            $(".cart-button, .close-button, #sidebar-cart-curtain").click(function(e) {
                e.preventDefault();

                // Add the show-sidebar-cart class to the body tag
                $body.toggleClass("show-sidebar-cart");

                // Check if the sidebar curtain is visible
                if ($("#sidebar-cart-curtain").is(":visible")) {
                    // Hide the curtain
                    $("#sidebar-cart-curtain").fadeOut(500);
                } else {
                    // Show the curtain
                    $("#sidebar-cart-curtain").fadeIn(500);
                }
            });

            // Function that adds or subtracts quantity when a
            // plus or minus button is clicked
            $body.on('click', '.plus-button, .minus-button', function() {
                // Get quanitity input values
                var qty = $(this).closest('.qty').find('.qty-input');
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr('max'));
                var min = parseFloat(qty.attr('min'));
                var step = parseFloat(qty.attr('step'));

                // Check which button is clicked
                if ($(this).is('.plus-button')) {
                    // Increase the value
                    qty.val(val + step);
                } else {
                    // Check if minimum button is clicked and that value is
                    // >= to the minimum required
                    if (min && min >= val) {
                        // Do nothing because value is the minimum required
                        qty.val(min);
                    } else if (val > 0) {
                        // Subtract the value
                        qty.val(val - step);
                    }
                }
            });
        });
    </script>
    <script src="{{ asset('js/al-search.js') }}"></script>

    @yield('custom-js')
</body>

</html>
