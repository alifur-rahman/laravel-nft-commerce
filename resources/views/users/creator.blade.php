@extends('layouts.users.user-layout')
@section('title', 'Creator')
@section('custom-css')
<!-- custom css here -->
@endsection
@section('content')
@php use App\Services\AllfunctionService; @endphp
<div class="rn-creator-title-area rn-section-gapTop">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h2 class="title mb--0">Our Best Creators</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                <div class="shortby-default text-start text-sm-end">
                    <label class="filter-leble">SHOT BY:</label>
                    <select>
                        <option data-display="Top Rated">Top Rated</option>
                        <option value="1">Best Seller</option>
                        <option value="2">Recent Added</option>
                        <option value="3">Varified</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row g-5 mt--30 creator-list-wrapper">
            <!-- start single top-seller -->
            @foreach($creator as $value)
            <div class="creator-single col-lg-3 col-md-4 col-sm-6" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                <div class="top-seller-inner-one explore">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail varified">
                            <a href="author.html">
                                <img src="{{AllfunctionService::userPhoto($value->id)}}" alt="Nft_Profile">
                            </a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Brodband</h6>
                            </a>
                            <span class="count-number">
                                $2500,000
                            </span>
                        </div>
                    </div>
                    <a class="over-link" href="author.html"></a>
                </div>
            </div>
            @endforeach
            <!-- End single top-seller -->
            <!-- start single top-seller -->
            <!-- <div class="creator-single col-lg-3 col-md-4 col-sm-6" data-sal="slide-up" data-sal-delay="200" data-sal-duration="800">
                <div class="top-seller-inner-one explore">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail">
                            <a href="author.html"><img src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Marks</h6>
                            </a>
                            <span class="count-number">
                                $2200,000
                            </span>
                        </div>
                    </div>
                    <a class="over-link" href="author.html"></a>
                </div>
            </div> -->
            <!-- End single top-seller -->
        </div>
        <div class="row d-none">
            <div class="col-lg-12" data-sal="slide-up" data-sal-delay="950" data-sal-duration="800">
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
@endsection
@section('custom-js')

@endsection
