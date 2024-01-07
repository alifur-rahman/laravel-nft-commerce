@extends('layouts.users.user-layout')
@section('title', 'Forum & Community')
@section('custom-css')
<!-- custom css here -->
<style>
    .custom-input{
        background: var(--background-color-2) !important;
        height: 50px !important;
        border-radius: 6px 10px 10px 6px !important;
        color: var(--color-white);
        font-size: 14px !important;
        padding: 10px 20px !important;
        transition: 0.3s !important;
    }
</style>
@endsection
@section('content')
@php use App\Services\AllfunctionService; @endphp
<!-- start page title area -->
<div class="rn-breadcrumb-inner ptb--30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h5 class="title text-center text-md-start">Forum Details</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-list">
                    <li class="item"><a href="index.html">Home</a></li>
                    <li class="separator"><i class="feather-chevron-right"></i></li>
                    <li class="item current">Forum Details</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end page title area -->

<div class="forum-top rn-section-gap bg-color--1">
    <div class="container">
        <div class="row g-5 align-items-center d-flex">
            <div class="col-lg-6 offset-lg-3">
                <div class="forum-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Hear..." aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-primary-alta btn-outline-secondary" type="button">Search
                                Hear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- community area start -->
<div class="nu-community-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="community-content-wrapper">

                    <!-- start Community single box -->
                    <div class="single-community-box">
                        <div class="community-bx-header">
                            <div class="header-left">
                                <div class="thumbnail">
                                    <img src="{{asset('assets/user/images/client/client-2.png')}}" alt="NFT-thumbnail">
                                </div>
                                <div class="name-date">
                                    <a href="#" class="name">Elijavd May</a>
                                    <span class="date">6 Hour Ago</span>
                                </div>
                            </div>
                            <!-- header-right -->
                            <div class="header-right">
                                <div class="product-share-wrapper">
                                    <div class="profile-share">
                                        <a href="author.html" class="avatar" data-tooltip="Owener:Mr.Jone-lee"><img class="large" src="{{asset('assets/user/images/client/client-1.png')}}" alt="Nft_Profile"></a>
                                        <a href="author.html" class="avatar" data-tooltip="Owener:Mr.Jone-lee"><img class="large" src="{{asset('assets/user/images/client/client-10.png')}}" alt="Nft_Profile"></a>
                                        <a href="author.html" class="avatar" data-tooltip="Owener:Mr.Jone-lee"><img class="large" src="{{asset('assets/user/images/client/client-11.png')}}" alt="Nft_Profile"></a>
                                        <a class="more-author-text" href="#">20+ People.</a>
                                    </div>
                                </div>
                            </div>
                            <!-- header-right End -->
                        </div>
                        <div class="community-content">
                            <h3 class="title">Localbitcoins Clone Script | Localbitcoins Clone Software</h3>
                            <p class="desc">
                                NFTs are tokens that we can use to represent ownership of unique items. They let us
                                tokenise things like art, collectibles, even real estate. They can only have one
                                official owner at a time and they're secured by the Ethereum blockchain – no one can
                                modify the record of ownership or copy/paste a new NFT into existence.

                                NFT stands for non-fungible token. Non-fungible is an economic term that you could
                                use to describe things like your furniture, a song file, or your computer.
                            </p>
                            <img class="community-img" src="{{asset('assets/user/images/blog/community/community-post-01.jpg')}}" alt="Nft_Community-image">
                            <div class="tags">
                                <span>#Bit Coin</span>
                                <span>#NFT Marketplace</span>
                                <span>#crypto Artists</span>
                                <span>#NFT Artists</span>
                            </div>
                            <div class="hr"></div>
                            <div class="rn-community-footer">
                                <div class="community-reaction">
                                    <a href="#" class="likes">
                                        <i class="feather-heart"></i>
                                        <span>2.1k</span>
                                    </a>
                                    <a href="https://rainbowit.net/html/nuron/post_details.html" class="comments">
                                        <i class="feather-message-circle"></i>
                                        <span>257 Comments</span>
                                    </a>
                                    <span class="views">
                                        <i class="feather-eye"></i>
                                        <span>257 Views</span>
                                    </span>
                                    <span class="time">
                                        <i class="feather-clock"></i>
                                        <span>2 days ago</span>
                                    </span>
                                </div>
                                <div class="answer">
                                    <a href="#" class="btn btn-primary-alta rounded">Answer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Community single box -->

                    <!-- comment Box -->
                    <div class="forum-input-ans-wrapper">
                        <img src="assets/images/client/client-10.png" alt="Nft-Profile">
                        <input type="text" placeholder="Write Answer...">
                        <button class="btn btn-primary rounded">Answer</button>
                    </div>
                    <!-- comment Box -->

                    <!-- answers box -->
                    <div class="forum-ans-box">
                        <!-- single answer -->
                        <div class="forum-single-ans">
                            <div class="ans-header">
                                <a href="author.html"><img src="assets/images/client/client-3.png" alt="Nft-Profile"></a>
                                <a href="author.html">
                                    <p class="name">@Mikle</p>
                                </a>
                                <div class="date">
                                    <i class="feather-watch"></i>
                                    <span>5 days ago</span>
                                </div>
                            </div>
                            <div class="ans-content">
                                <p>
                                    Check regularly the website, cause I’m in the same situation. They will add more
                                    artists sooner or later, check also the discord channel they have. But most
                                    important, be patient and keep sharing your work in other social media But most
                                    important, be patient and keep sharing your work in other social media</p>
                                <div class="reaction">
                                    <a href="#" class="like">
                                        <i class="feather-thumbs-up"></i>
                                        <span>27 Like</span>
                                    </a>
                                    <a href="#" class="dislike">
                                        <i class="feather-thumbs-down"></i>
                                        <span>27 dislike</span>
                                    </a>
                                </div>
                                <hr class="form-ans-separator">
                            </div>
                        </div>
                        <!-- single answer End -->
                        <!-- single answer -->
                        <div class="forum-single-ans">
                            <div class="ans-header">
                                <a href="author.html"><img src="assets/images/client/client-4.png" alt="Nft-Profile"></a>
                                <a href="author.html">
                                    <p class="name">@Jone Lee</p>
                                </a>
                                <div class="date">
                                    <i class="feather-watch"></i>
                                    <span>7 days ago</span>
                                </div>
                            </div>
                            <div class="ans-content">
                                <p>
                                    Check regularly the website, cause I’m in the same situation. They will add more
                                    artists sooner or later, check also the discord channel they have. But most
                                    important, be patient and keep sharing your work in other social media But most
                                    important, be patient and keep sharing your work in other social media</p>
                                <div class="reaction">
                                    <a href="#" class="like">
                                        <i class="feather-thumbs-up"></i>
                                        <span>27 Like</span>
                                    </a>
                                    <a href="#" class="dislike">
                                        <i class="feather-thumbs-down"></i>
                                        <span>27 dislike</span>
                                    </a>
                                </div>
                                <hr class="form-ans-separator">
                            </div>
                        </div>
                        <!-- single answer End -->
                        <!-- single answer -->
                        <div class="forum-single-ans">
                            <div class="ans-header">
                                <a href="author.html"><img src="assets/images/client/client-5.png" alt="Nft-Profile"></a>
                                <a href="author.html">
                                    <p class="name">@Alamin</p>
                                </a>
                                <div class="date">
                                    <i class="feather-watch"></i>
                                    <span>9 days ago</span>
                                </div>
                            </div>
                            <div class="ans-content">
                                <p>
                                    Check regularly the website, cause I’m in the same situation. They will add more
                                    artists sooner or later, check also the discord channel they have. But most
                                    important, be patient and keep sharing your work in other social media But most
                                    important, be patient and keep sharing your work in other social media</p>
                                <div class="reaction">
                                    <a href="#" class="like">
                                        <i class="feather-thumbs-up"></i>
                                        <span>27 Like</span>
                                    </a>
                                    <a href="#" class="dislike">
                                        <i class="feather-thumbs-down"></i>
                                        <span>27 dislike</span>
                                    </a>
                                </div>
                                <hr class="form-ans-separator">
                            </div>
                        </div>
                        <!-- single answer End -->
                        <!-- single answer -->
                        <div class="forum-single-ans">
                            <div class="ans-header">
                                <a href="author.html"><img src="assets/images/client/client-6.png" alt="Nft-Profile"></a>
                                <a href="author.html">
                                    <p class="name">@Mikle</p>
                                </a>
                                <div class="date">
                                    <i class="feather-watch"></i>
                                    <span>11 days ago</span>
                                </div>
                            </div>
                            <div class="ans-content">
                                <p>
                                    Check regularly the website, cause I’m in the same situation. They will add more
                                    artists sooner or later, check also the discord channel they have. But most
                                    important, be patient and keep sharing your work in other social media But most
                                    important, be patient and keep sharing your work in other social media</p>
                                <div class="reaction">
                                    <a href="#" class="like">
                                        <i class="feather-thumbs-up"></i>
                                        <span>27 Like</span>
                                    </a>
                                    <a href="#" class="dislike">
                                        <i class="feather-thumbs-down"></i>
                                        <span>27 dislike</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- single answer End -->
                    </div>
                    <!-- answers box End -->
                </div>
            </div>
            <div class="col-lg-4">
                <a class="btn btn-primary add-community" href="#">Start New Topic <i class="feather-plus"></i></a>

                <div class="rbt-single-widget widget_categories mt--30">
                    <h3 class="title">Categories</h3>
                    <div class="inner">
                        <ul class="category-list ">
                            <li><a href="#"><span class="left-content">Development</span><span class="count-text">300</span></a></li>
                            <li><a href="#"><span class="left-content">Company</span><span class="count-text">275</span></a></li>
                            <li><a href="#"><span class="left-content">Marketing</span><span class="count-text">625</span></a></li>
                            <li><a href="#"><span class="left-content">UX
                                        Design</span><span class="count-text">556</span></a></li>
                            <li><a href="#"><span class="left-content">Business</span><span class="count-text">247</span></a></li>
                            <li><a href="#"><span class="left-content">App
                                        Development</span><span class="count-text">457</span></a></li>
                            <li><a href="#"><span class="left-content">Application</span><span class="count-text">423</span></a></li>
                            <li><a href="#"><span class="left-content">Art</span><span class="count-text">235</span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="rbt-single-widget widget_tag_cloud mt--40">
                    <h3 class="title">Tags</h3>
                    <div class="inner mt--20">
                        <div class="tagcloud">
                            <a href="#">Corporate</a>
                            <a href="#">Agency</a>
                            <a href="#">Creative</a>
                            <a href="#">Design</a>
                            <a href="#">Minimal</a>
                            <a href="#">Company</a>
                            <a href="#">Development</a>
                            <a href="#">App Landing</a>
                            <a href="#">Startup</a>
                            <a href="#">App</a>
                            <a href="#">Business</a>
                            <a href="#">Software</a>
                            <a href="#">Landing</a>
                            <a href="#">Art</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- community area end -->




<!-- Modal -->
<div class="rn-popup-modal upload-modal-wrapper modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></button>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content share-wrapper">
            <div class="modal-body">
                <div class="product-style-one no-overlay">
                    <div class="form-group">
                        <label for="heading">Topic Heading</label>
                        <input type="text" name="heading" id="heading" class="custom-input">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-js')
<script>
    $(document).on('click', '.add-community', function(event) {
        event.preventDefault();
        $("#uploadModal").modal('show');
    })
</script>
@endsection
