@extends('layouts.users.user-layout')
@section('title', 'Newsletter')
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
                    <h5 class="title text-center text-md-start">Newsletter</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-list">
                        <li class="item"><a href="index.html">Home</a></li>
                        <li class="separator"><i class="feather-chevron-right"></i></li>
                        <li class="item current">Newsletter</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title area -->


    <div class="newsletter-area rn-section-gapTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="newsletter-wrapper">
                        <h2 class="title">Sign up for The Tide, Envivas's newsletter!</h2>
                        <p class="discription">Sign up to receive our monthly newsletter, featuring updates from the
                            team, new decentralized applications and NFT projects, and trends we’re seeing in the space.
                        </p>
                        <form method="POST" action="{{ route('subscription') }}" id="subscribe_form">
                            @csrf
                            <div class="mb-5">
                                <input type="email" id="email" name="email" placeholder="Enter Your Email">
                            </div>
                            <button type="button" class="btn btn-primary mr--15" id="subscribe_btn" onclick="_run(this)" data-el="fg" data-form="subscribe_form" data-loading="<div class='spinner-border spinner-border-sm' role='status'></div>" data-callback="subscriptionCallBack" data-btnid="subscribe_btn">Subscribe</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="newsletter-right">
                        <img src="{{ asset('assets/user/images/newsletter/newsletter-01.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="rn-popup-modal upload-modal-wrapper modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content share-wrapper">
                <div class="modal-body">
                    <div class="product-style-one no-overlay">
                        <div class="card-thumbnail">
                            <a href="product-details.html"><img src="assets/images/portfolio/portfolio-08.jpg"
                                    alt="NFT_portfolio"></a>
                        </div>
                        <div class="product-share-wrapper">
                            <div class="profile-share">
                                <a href="author.html" class="avatar" data-tooltip="Jone lee"><img
                                        src="assets/images/client/client-1.png" alt="Nft_Profile"></a>
                                <a href="author.html" class="avatar" data-tooltip="Jone lee"><img
                                        src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                                <a href="author.html" class="avatar" data-tooltip="Jone lee"><img
                                        src="assets/images/client/client-3.png" alt="Nft_Profile"></a>
                                <a class="more-author-text" href="#">9+ Place Bit.</a>
                            </div>
                            <div class="share-btn share-btn-activation dropdown">

                                <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                    <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal"
                                        data-bs-target="#shareModal">
                                        Share
                                    </button>
                                    <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal"
                                        data-bs-target="#reportModal">
                                        Report
                                    </button>
                                </div>

                            </div>
                        </div>
                        <a href="product-details.html"><span class="product-name">Preatent</span></a>
                        <span class="latest-bid">Highest bid 1/20</span>
                        <div class="bid-react-area">
                            <div class="last-bid">0.244wETH</div>
                            <div class="react-area">
                                <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                    class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                    <path
                                        d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                        stroke="currentColor" stroke-width="2"></path>
                                </svg>
                                <span class="number">322</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-js')
<script>
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    function subscriptionCallBack(data) {
        if (data.status == true) {
            $("#subscribe_form").trigger("reset");
            notify('success', data.message, 'Subscribe Success');
            setTimeout(function() {

            }, 1000 * 2);
        } else {
            notify('error', data.message, 'Subscription Failed');
            // $.validator("contact_form", data.errors);
        }
        $.validator("subscribe_form", data.errors);
    }
</script>
@endsection
