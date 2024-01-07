@extends('layouts.users.user-layout')
@section('title', 'Support FAQ')
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
                <h5 class="title text-center text-md-start">Support Center</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Support Center</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end page title area -->
<!-- start service area -->
<div class="rn-service-area rn-section-gapTop">
    <div class="container">
        <div class="row">
            <div class="col-12 mb--50">
                <h3 class="title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Create and sell your NFTs</h3>
            </div>
        </div>
        <div class="row g-5">
            <!-- start single service -->
            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="rn-service-one color-shape-7">
                    <div class="inner">
                        <div class="icon">
                            <img src="assets/images/icons/shape-7.png" alt="Shape">
                        </div>
                        <div class="subtitle">Step-01</div>
                        <div class="content">
                            <h4 class="title"><a href="#">Set up your wallet</a></h4>
                            <p class="description">Powerful features and inclusions, which makes Nuron standout,
                                easily customizable and scalable.</p>
                            <a class="read-more-button" href="#"><i class="feather-arrow-right"></i></a>
                        </div>
                    </div>
                    <a class="over-link" href="#"></a>
                </div>
            </div>
            <!-- End single service -->
            <!-- start single service -->
            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div data-sal="slide-up" data-sal-delay="200" data-sal-duration="800" class="rn-service-one color-shape-1">
                    <div class="inner">
                        <div class="icon">
                            <img src="assets/images/icons/shape-1.png" alt="Shape">
                        </div>
                        <div class="subtitle">Step-02</div>
                        <div class="content">
                            <h4 class="title"><a href="#">Create your collection</a></h4>
                            <p class="description">A great collection of beautiful website templates for your need.
                                Choose the best suitable template.</p>
                            <a class="read-more-button" href="#"><i class="feather-arrow-right"></i></a>
                        </div>
                    </div>
                    <a class="over-link" href="#"></a>
                </div>
            </div>
            <!-- End single service -->
            <!-- start single service -->
            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div data-sal="slide-up" data-sal-delay="250" data-sal-duration="800" class="rn-service-one color-shape-5">
                    <div class="inner">
                        <div class="icon">
                            <img src="assets/images/icons/shape-5.png" alt="Shape">
                        </div>
                        <div class="subtitle">Step-03</div>
                        <div class="content">
                            <h4 class="title"><a href="#">Add your NFT's</a></h4>
                            <p class="description">We've made the template fully responsive, so it looks great on
                                all devices: desktop, tablets and.</p>
                            <a class="read-more-button" href="#"><i class="feather-arrow-right"></i></a>
                        </div>
                    </div>
                    <a class="over-link" href="#"></a>
                </div>
            </div>
            <!-- End single service -->
            <!-- start single service -->
            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div data-sal="slide-up" data-sal-delay="300" data-sal-duration="800" class="rn-service-one color-shape-6">
                    <div class="inner">
                        <div class="icon">
                            <img src="assets/images/icons/shape-6.png" alt="Shape">
                        </div>
                        <div class="subtitle">Step-04</div>
                        <div class="content">
                            <h4 class="title"><a href="#">Sell Your NFT's</a></h4>
                            <p class="description">I throw myself down among the tall grass by the stream as I
                                lie close to the earth NFT's.</p>
                            <a class="read-more-button" href="#"><i class="feather-arrow-right"></i></a>
                        </div>
                    </div>
                    <a class="over-link" href="#"></a>
                </div>
            </div>
            <!-- End single service -->
        </div>
    </div>
</div>
<!-- End service area -->
<!-- support center -->
<div class="rn-support-area rn-section-gapTop">
    <div class="container">
        <div class="row g-6">
            <div class="col-lg-6">
                <div class="rn-support-read">
                    <div class="read-card">
                        <h4>How to start as a seller?</h4>
                        <div class="content">
                            <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as
                                necessary, making this the first true generator on the Internet.</p>
                            <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                                (injected humour and the like).</p>
                        </div>
                    </div>
                    <div class="read-card">
                        <h4>What happens when there are no orders?</h4>
                        <div class="content">
                            <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as
                                necessary, making this the first true generator on the Internet.</p>
                            <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                                (injected humour and the like).</p>
                        </div>
                    </div>
                    <div class="read-card">
                        <h4>Why are you getting rejected shares?</h4>
                        <div class="content">
                            <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as
                                necessary, making this the first true generator on the Internet.
                                Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                                (injected humour and the like).</p>
                        </div>
                    </div>
                    <a href="{{route('nft.create')}}" class="btn btn-primary mr--15">Create</a>
                    <a href="{{route('contact-us')}}" class="btn btn-primary-alta">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="support-accordion">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is the NFTs reward system?
                                    <i class="feather-chevron-up"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Which servers are available?
                                    <i class="feather-chevron-up"></i>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Which miners are supported?
                                    <i class="feather-chevron-up"></i>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Keep It Short, Simple, and to the Point.
                                    <i class="feather-chevron-up"></i>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    How quickly can I get customer support?
                                    <i class="feather-chevron-up"></i>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Okay, I'm afraid to ask but... what is SEO?
                                    <i class="feather-chevron-up"></i>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- support center end -->

@endsection
@section('custom-js')

@endsection
