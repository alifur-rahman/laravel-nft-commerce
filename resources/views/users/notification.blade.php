@extends('layouts.users.user-layout')
@section('title','User Notification')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/data-list-style.css') }}">
    <style>
        .lgrp-paginate {
            list-style-type: none;
            float: right;
            margin: 0;
            padding: 0;
        } 
        .data-list-total {
            display: flex;
            font-size: 13px;
            float: left;
            margin-top: 17px;
        }  
    </style>
@endsection
@section('content')


<div class="rn-activity-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--30">
            <h3 class="title">All following Notification</h3>
        </div>
        <div class="row g-6 activity-direction">
            <div class="col-lg-8 mb_dec--15"  >
              <div id="data-list">

              </div>

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
        

        {{-- <div class="row g-6 activity-direction" >
           <div class="col-lg-8 mb_dec--15" id="data-list">

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
        </div> --}}
       

        
    </div>
</div>
@endsection
@section('custom-js')
<script src="{{ asset('js/data-list.js') }}"></script>
<script src="{{ asset('js/data-col.js') }}"></script>
<script>
        var data_list = $("#data-list");
        var dataList = data_list.data_list({
            serverSide: true,
            url: '/user/notification-query',
            listPerPage: 5
        });
</script>
@endsection