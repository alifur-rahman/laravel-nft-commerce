@php
use App\Models\Deposit;
use App\Models\Withdraw;


use App\Services\OthersHelperService;
use App\Services\CompanyInfoService;
$helperService = new OthersHelperService();
use App\Models\NftSale;
$data=DB::table('nft_sales')->orderBy('id','desc')->limit(3)->get();
// $asset_name=DB::table('nft_assets')->select('name')->whereIn('id',[$data[0]->id,$data[1]->id,$data[2]->id])->get();
$data_count=DB::table('nft_sales')->count();

// check current balance
if(Auth::check()):
$total_deposit = Deposit::where('user_id', auth()->user()->id)->sum('amount');
$total_withdraw = Withdraw::where('user_id', auth()->user()->id)->sum('amount');
$total_balance = $total_deposit - $total_withdraw;
endif

@endphp
<!DOCTYPE html>
<html lang="en">
@php use App\Services\AllfunctionService; @endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }} - @yield('title') </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-style-mode" content="1"> <!-- 0 == light, 1 == dark -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/user/images/favicon.png')}}">
    <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/user/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/vendor/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/plugins/feature.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/vendor/odometer.css')}}">
    @yield('vendor-css')

    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/auth/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/data-list-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/al-ajax-search.css') }}">
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
            background-color: var(--color-primary);
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

        .dataTables_length .nice-select.form-select {
            width: 200px;
        }
    </style>
    <style>
        .lgrp-paginate {
            list-style-type: none;
            float: right;
            margin: 0;
            padding: 0;
            display: block;
        }

        .data-list-total {
            display: flex;
            font-size: 13px;
            float: left;
            margin-top: 17px;
        }

        .setting-option.icon-box-logout {
            width: 86px;
        }

        .logout-anchor {
            width: 100% !important;
        }

        /* test menu  */
        .menu-parent ul ul {
            display: none;
            list-style: none;
        }

        .menu-parent li.active>ul {
            display: block;
        }

        .menu-parent>ul>li>a {
            position: relative;
        }

        .menu-parent>ul>li>a .fa {
            margin-right: 8px;
        }

        .menu-parent ul ul li a {
            position: relative;
        }

        .menu-parent ul ul ul {
            background: rgba(0, 0, 0, 0.1);
            padding: 0;
        }

        .menu-parent a:not(:only-child):after {
            position: absolute;
            right: 20px;
            content: "\f067";
            top: -6px;
            font-size: 20px;
            font-family: FontAwesome;
        }

        .menu-parent .active>a:not(:only-child):after {
            content: "\f068";
            top: -6px;
            font-size: 20px;
            font-family: FontAwesome;
        }

        .acordian-menu-ul {
            padding: 0 0 0 20px;
        }

        .menu.mainmenu.accordion-mainmenu {
            margin-top: 0 !important;
        }

        .nav-link.acormenu_icon_anchor {
            justify-content: space-between;
        }

        .left_arrow svg {
            background: transparent !important;
        }

        .acormenu_icon_anchor::hover .left_arrow svg {
            background: transparent !important;
        }
        .left-header-style .mainmenu-nav .mainmenu li a:hover .left_arrow svg, .left-header-style .mainmenu-nav .mainmenu li a:focus .left_arrow svg{
            background: transparent !important;
        }

        .al-ajax-loader {
            width: 100%;
            text-align: center;
            max-width: 50px;
            margin: 0 auto;
            height: 100%;
        }
        #topUser-list .list-group-item{
            background: transparent !important;
        }
        
        .collection-big-thumbnail .thumb-img {
            max-height: 164px;
            min-height: 164px;
        }
        .collenction-small-thumbnail .asset-img {
        	max-height: 80px;
        	min-height: 80px;
        }

    </style>
    @yield('custom-css')
</head>

<body class="home-sticky-pin sidebar-header scrollspy-example position-relative" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0">

    <!-- start header area -->
    <div class="d-none d-lg-block">
        <div class="header-area left-header-style d-flex">
            <div class="logo-area logo-custom-css">
                <a class="logo-light" href="{{ url('/') }}"><img src="{{ asset('assets/user/images/logo/logo-white.png') }}" alt="nft-logo"></a>
                <a class="logo-dark" href="{{ url('/') }}"><img src="{{ asset('assets/user/images/logo/logo-dark.png') }}" alt="nft-logo"></a>
            </div>
            <div class="sidebar-nav-wrapper">
                <nav class="mainmenu-nav">
                    <ul class="mainmenu list-group">
                        <li class="nav-item"><a class="nav-link" href="/"> <i data-feather="home"></i>Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('user.dashboard')}}"> <i data-feather="grid"></i>Dashboard</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.login_profile')}}">
                                <i data-feather="user"></i>
                                Profile
                            </a>
                        </li>
                    </ul>
                </nav>

                <div id="accordian" class="menu-parent style1 help-center-area mainmenu-nav">
                    <ul class="menu mainmenu accordion-mainmenu">
                        <li class="menu-child nav-item">
                            <a href="#"   class="nav-link acormenu_icon_anchor"><span><i data-feather="credit-card"></i> Finance</span><span class="left_arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="acordian-menu-ul">
                                <li class="nav-item"><a class="nav-link" href="{{route('user.finance.add_bank')}}"><i data-feather="command"></i> Add Bank </a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.finance.bank_deposit')}}"><i data-feather="command"></i> Bank Deposit</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.finance.crypto_deposit')}}"><i data-feather="dollar-sign"></i> Crypto Deposit</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.finance.bank_withdraw')}}"><i data-feather="cpu"></i> Bank Withdraw</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.finance.crypto_withdraw')}}"><i data-feather="codepen"></i> Crypto Withdraw</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="accordian-2" class="menu-parent style1 help-center-area mainmenu-nav">
                    <ul class="menu mainmenu accordion-mainmenu">
                        <li class="menu-child nav-item">
                            <a href="#" class="nav-link acormenu_icon_anchor"><span><i data-feather="repeat"></i> Reports</span><span class="left_arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="acordian-menu-ul">
                                <li class="nav-item"><a class="nav-link" href="{{route('finance.deposit.report')}}"><i data-feather="pie-chart"></i> Deposit Report</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('finance.withdraw.report')}}"><i data-feather="move"></i> Withdraw Report</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.sales_report')}}"><i data-feather="shopping-cart"></i> Sales Report</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.purchase_report')}}"><i data-feather="shopping-bag"></i> Purchase Report</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div id="accordian-2" class="menu-parent style1 help-center-area mainmenu-nav">
                    <ul class="menu mainmenu accordion-mainmenu">
                        <li class="menu-child nav-item">
                            <a href="#" class="nav-link acormenu_icon_anchor"><span><i data-feather="repeat"></i> Collection</span><span class="left_arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="acordian-menu-ul">
                                <li class="nav-item"><a class="nav-link" href="{{url('collection/create')}}"><i data-feather="pie-chart"></i> Create Collection</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{url('mycollection')}}"><i data-feather="move"></i>All Collection</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                {{-- test menu  --}}
                <div class="help-center-area mainmenu-nav mt--30">
                    <ul class="mainmenu">
                        <li class="nav-item"><a class="nav-link" href="{{route('user.profile-settings')}}"> <i data-feather="settings"></i>Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('support-faq') }}"> <i data-feather="help-circle"></i>Help Center</a></li>
                    </ul>
                </div>
            </div>
            <div class="authore-profile">
                <div class="thumbnail">
                    <img src="{{AllfunctionService::userPhoto(auth()->user()->id)}}" alt="Nft_marketplaces">
                </div>
                <div class="au-content">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="blc">Balance:<span class="value">$ {{ AllfunctionService::balance(null) }}</span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- end header arae -->

    <!-- Start Popup Moobile Menu  -->
    <div class="popup-mobile-menu one-page-vavigation-popup">
        <div class="inner">
            <div class="header-top">
                <div class="logo logo-custom-css">
                    <a class="logo-light" href="index.html"><img src="assets/images/logo/logo-white.png" alt="nft-logo"></a>
                    <a class="logo-dark" href="index.html"><img src="assets/images/logo/logo-dark.png" alt="nft-logo"></a>
                </div>
                <div class="close-menu">
                    <button class="close-button">
                        <i class="feather-x"></i>
                    </button>
                </div>
            </div>
            <nav>
                <!-- Start Mainmanu Nav -->
                <ul class="mainmenu" id="navbar-example2">
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#list-item-1">Home</a></li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#list-item-2">Live Auction</a></li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#list-item-3">Newest Item</a></li>
                    <li class="nav-item"><a class="nav-link smoth-animation" href="#list-item-4">Explore Product</a></li>
                </ul>
                <!-- End Mainmanu Nav -->
            </nav>
        </div>
    </div>
    <!-- Start Popup Moobile Menu  -->

    <div class="rn-nft-mid-wrapper">
        <div id="list-item-1"></div>
        <!-- top bar -->
        <div class="rn-top-bar-area">
            <div class="d-none d-lg-block al-ajax-search">
                <form class="search-form-wrapper" action="{{ route('search') }}" method="GET">
                    <div class="input-group ">

                            <input type="text"  name="keyword" placeholder="Search Here..." class="form-control bg-color--2">
                            <div class="input-group-append">
                                <button class="btn btn-primary-alta btn-outline-secondary" type="submit">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                    </div>
                </form>
            </div>

            <div class="contact-area">
                <div class="rn-icon-list setting-option d-block d-lg-none">
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

                <div class="setting-option">
                    <div class="icon-box">
                        <a title="Contact With Us" href="{{ route('contact-us') }}"><i class="feather-phone"></i></a>
                    </div>
                </div>

                {{-- <div class="setting-option">
                    <div class="icon-box">
                        <a title="Message" href="#"><i class="feather-message-circle"></i></a>
                    </div>
                </div> --}}

                <div class="setting-option header-btn">
                    <div class="icon-box">
                        <a class="btn btn-primary-alta btn-small" href="{{ route('nft.create') }}">Create</a>
                    </div>
                </div>

                <div class="setting-option mobile-menu-bar ml--5 d-block d-lg-none">
                    <div class="hamberger icon-box">
                        <button class="hamberger-button">
                            <i class="feather-menu"></i>
                        </button>
                    </div>
                </div>

                <div class="setting-option rbt-site-header ml--5" id="rbt-site-header">
                    <div class="icon-box">
                        <a href="{{ route('connect-to-wallet') }}" id="connectbtn" class="btn btn-primary-alta btn-small">Wallet connect</a>
                    </div>
                </div>

                <div class="header_admin" id="header_admin">
                    <div class="setting-option rn-icon-list user-account">
                        <div class="icon-box">
                            <a href="author.html"><img src="assets/images/icons/boy-avater.png" alt="Images"></a>
                            <div class="rn-dropdown">
                                <div class="rn-inner-top">
                                    <h4 class="title"><a href="product-details.html">Christopher William</a></h4>
                                    <span><a href="#">Set Display Name</a></span>
                                </div>
                                <div class="rn-product-inner">
                                    <ul class="product-list">
                                        <li class="single-product-list">
                                            <div class="thumbnail">
                                                <a href="product-details.html"><img src="assets/images/portfolio/portfolio-07.jpg" alt="Nft Product Images"></a>
                                            </div>
                                            <div class="content">
                                                <h6 class="title"><a href="product-details.html">Balance</a></h6>
                                                <span class="price">25 ETH</span>
                                            </div>
                                            <div class="button"></div>
                                        </li>
                                        <li class="single-product-list">
                                            <div class="thumbnail">
                                                <a href="product-details.html"><img src="assets/images/portfolio/portfolio-01.jpg" alt="Nft Product Images"></a>
                                            </div>
                                            <div class="content">
                                                <h6 class="title"><a href="product-details.html">Balance</a></h6>
                                                <span class="price">25 ETH</span>
                                            </div>
                                            <div class="button"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add-fund-button mt--20 pb--20">
                                    <a class="btn btn-primary-alta w-100" href="connect.html">Add Your More Funds</a>
                                </div>
                                <ul class="list-inner">
                                    <li><a href="{{route('user.login_profile')}}">My Profile</a></li>
                                    <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                                    <!--<li><a href="connect.html">Manage funds</a></li>-->
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Sign Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="setting-option icon-box-logout">
                    <div class="icon-box">
                        <a class="logout-anchor" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span class="menu-text"><i class="feather-log-out">&nbsp;Logout</i> </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>


                <!-- {{-- <div id="my_switcher" class="my_switcher setting-option">
                        <ul>
                            <li>
                                <a href="javascript: void(0);" data-theme="light" class="setColor light">
                                    <img src="{{asset('assets/user/images/icons/sun-01.svg')}}" alt="Sun images">
                </a>
                </li>
                <li>
                    <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                        <img src="assets/images/icons/vector.svg" alt="Vector Images">
                    </a>
                </li>
                </ul>
            </div> --}} -->

            </div>
            <!-- top bar End -->
        </div>
        <!-- top bar End -->
    </div>
    </div>


    @yield('content')

    <div class="header-right-fixed">
        <!-- notificatio area -->
        <div class="rn-notification-area right-fix-notice">
            <div class="h--100">
                <div class="notice-heading">
                    <h4>Notification</h4>
                    <div class="nice-select" tabindex="0"><span class="current">Newest</span>
                        <ul class="list">
                            <li data-value="Potato" data-display="Newest" class="option selected">Newest</li>
                            <li data-value="1" class="option">Tranding</li>
                            <li data-value="2" class="option">Saved</li>
                            <li data-value="4" class="option">Delated</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="rn-notification-wrapper">

                <div id="data-list">
                    <div class="al-ajax-loader">
                        <img src="{{ asset('assets/user/images/ajax-loader-big.gif') }}" >
                    </div>
                </div>


            </div>
        </div>
        <!-- notificatio area End -->

        <!-- start creators area -->
        <div class="rn-creators-area right-fix-notice creators mt--30">
            <div class="h--100">
                <div class="notice-heading">
                    <h4>
                        Top NFT Sales
                    </h4>
                    <div>
                        <select class="nice-select" tabindex="0" name="top_sales_filter" id="top_sales_filter" class="list">
                            <option value="today" class="option selected">Today</option>
                            <option value="7d" class="option">7 Day's</option>
                            <option value="30d" class="option">30 Days</option>
                            <option value="6m" class="option">6 Month's</option>
                        </select>
                        {{-- <ul class="list">
                            <li data-value="today" data-display="Today" class="option selected">Today</li>
                            <li data-value="7d" class="option">7 Day's</li>
                            <li data-value="30d" class="option">30 Days</li>
                            <li data-value="6m" class="option">6 Month's</li>
                        </ul> --}}
                    </div>
                </div>
            </div>
            <div class="rn-notification-wrapper creators" id='topUser-list'>
                <div class="al-ajax-loader">
                    <img src="{{ asset('assets/user/images/ajax-loader-big.gif') }}" >
                </div>

            </div>
        </div>
        <!-- End creators area -->
    </div>

    <!-- Start Footer Area  -->
    @php
        $com_infos = App\Models\CompanyInfo::all()->first();
    @endphp
    <div class="rn-footer-area footer-for-left-sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <div class="logo logo-custom-css">
                            <a class="logo-light" href="{{ url('/') }}"><img src="{{ asset('assets/user/images/logo/logo-white.png') }}" alt="nft-logo"></a>
                            <a class="logo-dark" href="{{ url('/') }}"><img src="{{ asset('assets/user/images/logo/logo-dark.png') }}" alt="nft-logo"></a>
                        </div>
                        <p class="description mt--30">© <?php echo date("Y"); ?> {{  $com_infos == '' || $com_infos->copyright == '' ? "Onenft.inc | All right Reserved" : $com_infos->copyright }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Area  -->

    <!-- Modal -->
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
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- Start Top To Bottom Area  -->
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
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
    <script src="{{ asset('js/data-list.js') }}"></script>
    {{-- <script src="{{ asset('js/data-col.js') }}"></script> --}}
    <script>
            // notification
            var data_list = $("#data-list");
            var dataList = data_list.data_list({
                serverSide: true,
                url: '/user/dashboard/notification-query',
                listPerPage: 5
            });
            // top User's
            var topUser_list = $("#topUser-list");
            var topUser_list = topUser_list.data_list({
                serverSide: true,
                url: '/user/dashboard/top-user-query',
                listPerPage: 5,
            });

            $(document).ready(function(){
                $('#top_sales_filter').change(function(){
                    // // var formData = $(this).serialize();
                    var topUser_list = $("#topUser-list");
                    var formData = $(this).serialize();
                    var topUser_list = topUser_list.data_list({
                        serverSide: true,
                        url: '/user/dashboard/top-user-query',
                        listPerPage: 5,
                        data: formData,
                    });
                })
            })

    </script>

    <script>
        $(document).ready(function() {
            var i = 0;
            $(".acormenu_icon_anchor").click(function() {
                if(i==0){
                    $('.left_arrow svg').css("transform", "rotate(-90deg)");
                    i=1;
                }else{
                    $('.left_arrow svg').css("transform", "rotate(0deg)");
                    i=0;
                }
            });
        });

        // for social share
        $(document).on('click','.share-text',function() {
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
    </script>

    <script src="{{ asset('assets/user/auth/vendors/js/forms/validation/jquery.validate.min.js') }}">
        </script>

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
                    // $.validator("contact_form", data.errors);
                }
                $.validator("footer_subscribe_form", data.errors);
            }
        </script>

        <script>
            $(document).ready(function() {

                var i = 0;
                $(".acormenu_icon_anchor").click(function() {
                    if (i == 0) {
                        $(this).find('.left_arrow svg').css("transform", "rotate(90deg)");
                        i = 1;
                    } else {
                        $(this).find('.left_arrow svg').css("transform", "rotate(0deg)");
                        i = 0;
                    }
                });

            });


            $(document).ready(function() {
                // prevent page from jumping to top from  # href link
                $('.menu-parent li.menu-child > a').click(function(e) {
                    e.preventDefault();
                });

                // remove link from menu items that have children
                $(".menu-parent li.menu-child > a").attr("href", "#");

                //  function to open / close menu items
                $(".menu-parent a").click(function() {
                    var link = $(this);
                    var closest_ul = link.closest("ul");
                    var parallel_active_links = closest_ul.find(".active")
                    var closest_li = link.closest("li");
                    var link_status = closest_li.hasClass("active");
                    var count = 0;

                    closest_ul.find("ul").slideUp(function() {
                        if (++count == closest_ul.find("ul").length)
                            parallel_active_links.removeClass("active");
                    });

                    if (!link_status) {
                        closest_li.children("ul").slideDown();
                        closest_li.addClass("active");
                    }
                })
            })
        </script>
           <script src="{{ asset('js/al-search.js') }}"></script>
           <script src="{{ asset('js/like-operation.js') }}"></script>
        @yield('custom-js')


</body>

</html>
