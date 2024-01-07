@extends('layouts.users.user-layout')
@section('title', 'Activity')
@section('custom-css')
<!-- custom css here -->
@endsection
@section('content')
@php use App\Services\AllfunctionService; @endphp
<div class="rn-activity-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--30">
            <h3 class="title">All following Acivity</h3>
        </div>
        <div class="row g-6 activity-direction">
            <div class="col-lg-8 mb_dec--15">
                <!-- single activity -->
                @foreach($assets as $value)
                <div class="single-activity-wrapper">
                    <div class="inner">
                        <div class="read-content">
                            <div class="thumbnail">
                                <a href="product-details.html">
                                    <img src="{{AllfunctionService::asset_image($value->id)}}" alt="Nft_Profile">
                                </a>
                            </div>
                            <div class="content">
                                <a href="product-details.html">
                                    <h6 class="title">Diamond Dog</h6>
                                </a>
                                <p>10 editions listed by Bits for <span>2.50 ETH</span> each</p>
                                <div class="time-maintane">
                                    <div class="time data">
                                        <i data-feather="clock"></i>
                                        <span>2:30 PM on 19th June, </span>
                                    </div>
                                    <div class="user-area data">
                                        <i data-feather="user"></i>
                                        <a href="#">John Lee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="icone-area">
                            <i data-feather="message-circle"></i>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- single activity -->

            </div>
            <div class="col-lg-4">
                <div class="filter-wrapper">
                    <div class="widge-wrapper rbt-sticky-top-adjust">
                        <div class="inner">
                            <h3>Market filter</h3>
                            <div class="sing-filter">
                                <button>Purchases</button>
                                <button>Sales</button>
                                <button>Followers</button>
                                <button>Following</button>
                                <button>Reserved</button>
                                <button>Live Auction</button>
                            </div>
                        </div>
                        <div class="inner">
                            <h3>Filter by users</h3>
                            <div class="sing-filter">
                                <button>Love</button>
                                <button>Saved</button>
                                <button>Support us</button>
                                <button>Report</button>
                                <button>Vedio</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')

@endsection
