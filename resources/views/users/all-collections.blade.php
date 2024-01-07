@extends('layouts.users.user-layout')
@section('title', 'All Collection')
@section('custom-css')
    <!-- custom css here -->
@endsection
@section('content')
    @php use App\Services\AllfunctionService; @endphp
    <!-- start page title area -->
    <div class="rn-breadcrumb-inner ptb--30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <h5 class="title text-center text-md-start">Our Collection</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-list">
                        <li class="item"><a href="index.html">Home</a></li>
                        <li class="separator"><i class="feather-chevron-right"></i></li>
                        <li class="item current">Collection</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title area -->

    <!-- collection area Start -->
    <div class="rn-collection-area rn-section-gapTop">
        <div class="container">
            <div class="row g-5">
                <!-- start single collention -->
                @foreach ($collections as $value)
                    <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
                        class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                        <a href="{{ url('collection/view/' . $value->name . '/' . $value->id) }}" class="rn-collection-inner-one">
                            <div class="collection-wrapper">
                                <div class="collection-big-thumbnail">
                                    <img class="thumb-img" src="{{ AllfunctionService::collection_thumbnail($value->id) }}" alt="Nft_Profile">
                                </div>
                                <div class="collenction-small-thumbnail">

                                    @php
                                        $items = json_decode($value->item);
                                    @endphp
                                    @if ($items != null)
                                        @foreach ($items as $key => $item)
                                            @if ($key <= 2)
                                                @php
                                                    $asset = App\Models\NftAsset::find($item);
                                                @endphp

                                                <img class="asset-img" src="{{ AllfunctionService::asset_image($asset->id) }}"
                                                    alt="Nft_Profile"> 
                                            @endif
                                        @endforeach
                                    @endif
 
                                </div>
                                <div class="collection-profile">
                                    <img src="{{ AllfunctionService::collection_profile($value->user_id) }}"
                                        alt="Nft_Profile">
                                </div>
                                <div class="collection-deg">
                                    <h6 class="title">Cubic Trad</h6>
                                    <span class="items">{{ $items != null ? count($items) : '0' }} Items</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <!-- End single collention -->
                <!-- start single collention -->
                <!-- <div data-sal="slide-up" data-sal-delay="200" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                    <a href="product-details.html" class="rn-collection-inner-one">
                        <div class="collection-wrapper">
                            <div class="collection-big-thumbnail">
                                <img src="assets/images/collection/collection-lg-02.jpg" alt="Nft_Profile">
                            </div>
                            <div class="collenction-small-thumbnail">
                                <img src="assets/images/collection/collection-sm-04.jpg" alt="Nft_Profile">
                                <img src="assets/images/collection/collection-sm-05.jpg" alt="Nft_Profile">
                                <img src="assets/images/collection/collection-sm-06.jpg" alt="Nft_Profile">
                            </div>
                            <div class="collection-profile">
                                <img src="assets/images/client/client-12.png" alt="Nft_Profile">
                            </div>
                            <div class="collection-deg">
                                <h6 class="title">Diamond Dog</h6>
                                <span class="items">20 Items</span>
                            </div>
                        </div>
                    </a>
                </div> -->
                <!-- End single collention -->
            </div>
            <div class="row d-none">
                <div class="col-lg-12" data-sal="slide-up" data-sal-delay="550" data-sal-duration="800">
                    <nav class="pagination-wrapper" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- collection area End -->

@endsection
@section('custom-js')

@endsection
